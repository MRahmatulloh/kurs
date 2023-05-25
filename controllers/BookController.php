<?php

namespace app\controllers;

use app\models\Book;
use app\models\search\BookSearch;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Book models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Book model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewDetail($id)
    {
        $model = Book::findOne(['uuid' => $id]);
        if (!$model){
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Book([
            'status' => Book::STATUS_ACTIVE,
        ]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->uuid = format_uuidv4(random_bytes(16));

                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file){
                    $model->filename = $model->uuid . '.' . $model->file->extension;
                    $model->file->saveAs($model->getFilePath(), false);
                }

                $model->image = UploadedFile::getInstance($model, 'image');
                if ($model->image){
                    $model->photo = $model->uuid . '.' . $model->image->extension;
                    $model->image->saveAs($model->getPhotoFilePath(), false);
                }

                if ($model->save()){
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Ma\'lumotlar muvaffaqiyatli saqlandi!'));
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Xatolik yuz berdi!'));
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file){
                    if (file_exists($model->getFilePath()) && !is_dir($model->getFilePath())){
                        unlink($model->getFilePath());
                    }
                    $model->filename = $model->uuid . '.' . $model->file->extension;
                    $model->file->saveAs($model->getFilePath(), false);
                }

                $model->image = UploadedFile::getInstance($model, 'image');
                if ($model->image){
                    if (file_exists($model->getPhotoFilePath()) && !is_dir($model->getPhotoFilePath())){
                        unlink($model->getPhotoFilePath());
                    }
                    $model->photo = $model->uuid . '.' . $model->image->extension;
                    $model->image->saveAs($model->getPhotoFilePath(), false);
                }

                if ($model->save()){
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Ma\'lumotlar muvaffaqiyatli saqlandi!'));
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Xatolik yuz berdi!'));
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDownloadFile($id)
    {
        $model = $this->findModel($id);

        if (!$model->isPurchased()){
            Yii::$app->session->setFlash('error', Yii::t('app', 'Iltimos, kitobni sotib oling!'));
            return $this->redirect(Yii::$app->request->referrer);
        }

        if (file_exists($model->getFilePath()) && !is_dir($model->getFilePath())){
            return Yii::$app->response->sendFile($model->getFilePath());
        } else{
            Yii::$app->session->setFlash('error', Yii::t('app', 'Fayl topilmadi'));
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionDownloadPhoto($id)
    {
        $model = $this->findModel($id);

        if (file_exists($model->getPhotoFilePath()) && !is_dir($model->getPhotoFilePath())){
            return Yii::$app->response->sendFile($model->getPhotoFilePath());
        } else{
            Yii::$app->session->setFlash('error', Yii::t('app', 'Rasm topilmadi'));
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionDownload()
    {
        if (Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $model = Book::findOne(['uuid' => $id]);

            if (file_exists($model->getFilePath()) && !is_dir($model->getFilePath())){
                return Yii::$app->response->sendFile($model->getFilePath());
            } else{
                Yii::$app->session->setFlash('error', Yii::t('app', 'Fayl topilmadi'));
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
