<?php

namespace app\controllers;

use app\components\Globals;
use app\models\Lesson;
use app\models\search\LessonSearch;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LessonController implements the CRUD actions for Lesson model.
 */
class LessonController extends Controller
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
     * Lists all Lesson models.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['module/index']);

//        $searchModel = new LessonSearch();
//        $dataProvider = $searchModel->search($this->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
    }

    /**
     * Displays a single Lesson model.
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
     * Creates a new Lesson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Lesson(
            [
                'status' => Lesson::STATUS_ACTIVE,
            ]
        );

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateAjax()
    {
        $model = new Lesson(
            [
                'status' => Lesson::STATUS_ACTIVE,
            ]
        );
        $model->scenario = 'create';

        if ($this->request->isGet) {
            return $this->redirect(['module/index']);
        }

        if ($this->request->isAjax && $model->load($this->request->post())) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->uuid = format_uuidv4(random_bytes(16));
            $model->created_by = Yii::$app->user->identity->id;

            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file) {
                $model->filename = $model->uuid . '.' . $model->file->extension;
                $model->file->saveAs($model->getFilePath(), false);
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Ma\'lumotlar muvaffaqiyatli saqlandi!'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', '{title}: {errors}', [
                    'title' => $model->getTitle(),
                    'errors' => \app\components\Globals::errorMessageText($model->getErrors()),
                ]));
            }

            return $this->redirect([
                'module/index',
                'id' => $model->module_id
            ]);
        }

        return $this->renderAjax('create_ajax', [
            'model' => $model,
        ]);
    }

    public function actionDownloadFile($id)
    {
        $model = $this->findModel($id);

        if (!Yii::$app->user->identity->isRoleUser('admin')) {
            throw new Exception('Sizga ruxsat berilmagan');
        }

        if (file_exists($model->getFilePath()) && !is_dir($model->getFilePath())) {
            return Yii::$app->response->sendFile($model->getFilePath());
        } else {
            throw new Exception('Fayl topilmadi');
        }
    }

    /**
     * Updates an existing Lesson model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->updated_by = Yii::$app->user->identity->id;

            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file) {
                $model->filename = $model->uuid . '.' . $model->file->extension;
                $model->file->saveAs($model->getFilePath(), false);
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Ma\'lumotlar muvaffaqiyatli saqlandi!'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', '{title}: {errors}', [
                    'title' => $model->getTitle(),
                    'errors' => \app\components\Globals::errorMessageText($model->getErrors()),
                ]));
            }

            return $this->redirect([
                'module/index',
                'id' => $model->module_id
            ]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Lesson model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $res = $this->findModel($id)->delete();

        if ($res) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Ma\'lumot muvaffaqiyatli o\'chirildi'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Ma\'lumot o\'chirib bo\'lmadi'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lesson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Lesson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lesson::findOne(['uuid' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
