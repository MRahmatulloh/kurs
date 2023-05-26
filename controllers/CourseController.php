<?php

namespace app\controllers;

use app\models\Course;
use app\models\Lesson;
use app\models\Module;
use app\models\search\CourseSearch;
use app\models\search\LessonSearch;
use app\models\search\ModuleSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
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
     * Lists all Course models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Course model.
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
     * Displays a single Course model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetails($id, $module_id = null)
    {
        $searchModule = new ModuleSearch();
        $searchModule->course_id = $id;
        $moduleDataProvider = $searchModule->search($this->request->queryParams);

        $searchLesson = new LessonSearch();
        $searchLesson->module_id = $module_id;
        $lessonDataProvider = $searchLesson->search($this->request->queryParams);

        $module_name = Module::findOne($module_id)->name ?? '';

        return $this->render('details', [
            'model' => $this->findModel($id),
            'moduleDataProvider' => $moduleDataProvider,
            'lessonDataProvider' => $lessonDataProvider,
            'searchModule' => $searchModule,
            'module_name' => $module_name,
            'module_id' => $module_id,
        ]);
    }

    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Course([
            'status' => Course::STATUS_ACTIVE
        ]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->uuid = format_uuidv4(random_bytes(16));
                $model->created_by = Yii::$app->user->identity->id;

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Ma\'lumotlar muvaffaqiyatli saqlandi!'));
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', '{title}: {errors}', [
                        'title' => $model->getTitle(),
                        'errors' => \app\components\Globals::errorMessageText($model->getErrors()),
                    ]));
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Course model.
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
                $model->updated_by = Yii::$app->user->identity->id;

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Ma\'lumotlar muvaffaqiyatli saqlandi!'));
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', '{title}: {errors}', [
                        'title' => $model->getTitle(),
                        'errors' => \app\components\Globals::errorMessageText($model->getErrors()),
                    ]));
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        return $this->redirect(['index']);
//        $this->findModel($id)->delete();
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
