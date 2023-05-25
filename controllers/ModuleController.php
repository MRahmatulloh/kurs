<?php

namespace app\controllers;

use app\models\Module;
use app\models\Order;
use app\models\search\ModuleSearch;
use services\CheckAccessService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModuleController implements the CRUD actions for Module model.
 */
class ModuleController extends Controller
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
     * Lists all Module models.
     *
     * @return string
     */
    public function actionIndex($id = null, $lesson_id = null, $next = null)
    {

        $searchModel = new ModuleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $lesson = \app\models\Lesson::findOne(['uuid' => $lesson_id]);

        $ordered = Order::findOne(['wants_id' => '3ffb626c-07b2-4928-a5eb-4ee1e78c1f2c', 'user_id' => Yii::$app->user->identity->id, 'status' => Order::STATUS_APPROVED]);

        if (!$ordered && Yii::$app->user->identity->isRoleUser('pupil')) {
            return $this->render('index_locked', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'id' => $id,
                'lesson_id' => $lesson_id,
                'lesson' => $lesson,
                'ordered' => $ordered,
            ]);
        }

        if ($next && $lesson) {
            $module = $lesson->module;
            $lessonList = $module->lessons;
            $nextLesson = null;
            $nextModule = null;
            foreach ($lessonList as $key => $value) {
                if ($value->uuid == $lesson->uuid) {
                    $nextLesson = $lessonList[$key + 1] ?? null;
                }
            }

            if ($nextLesson) {
                $lesson = $nextLesson;
                return $this->redirect(['index', 'id' => $nextLesson->module_id, 'lesson_id' => $nextLesson->uuid]);
            }
            else{
                $moduleList = Module::find()->orderBy('name ASC')->all();
                foreach ($moduleList as $key => $value) {
                    if ($value->id == $module->id) {
                        $nextModule = $moduleList[$key + 1] ?? null;
                    }
                }

                if ($nextModule){
                    $nextLesson = $nextModule->lessons[0] ?? $lesson->uuid;
                    return $this->redirect(['index', 'id' => ($nextModule->id ?? $id), 'lesson_id' => ($nextLesson->uuid ?? $lesson_id)]);
                }
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
            'lesson_id' => $lesson_id,
            'lesson' => $lesson,
        ]);
    }

    public function actionWatch($lesson_id = null)
    {
        $searchModel = new ModuleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $lesson = \app\models\Lesson::findOne($lesson_id);

        return $this->render('watch', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'lesson_id' => $lesson_id,
            'lesson' => $lesson,
        ]);
    }

    /**
     * Displays a single Module model.
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
     * Creates a new Module model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Module([
            'status' => Module::STATUS_ACTIVE,
        ]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->created_by = Yii::$app->user->id;
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Ma\'lumotlar muvaffaqiyatli saqlandi!'));
                }else{
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Xatolik yuz berdi!. {title}: {errors}', [
                        'title' => $model->getTitle(),
                        'errors' => json_encode($model->getErrors()),
                    ]));
                }
                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateAjax()
    {
        $model = new Module();

        if ($this->request->isAjax && $model->load($this->request->post())) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->created_by = Yii::$app->user->id;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Ma\'lumotlar muvaffaqiyatli saqlandi!'));
            }else{
                Yii::$app->session->setFlash('error', Yii::t('app', 'Xatolik yuz berdi!. {title}: {errors}', [
                    'title' => $model->getTitle(),
                    'errors' => json_encode($model->getErrors()),
                ]));
            }

            return $this->redirect(['course/details', 'id' => $model->course_id]);
        }

        return $this->renderAjax('create_ajax', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Module model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->updated_by = Yii::$app->user->id;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Ma\'lumotlar muvaffaqiyatli saqlandi!'));
            }else{
                Yii::$app->session->setFlash('error', Yii::t('app', 'Xatolik yuz berdi!. {title}: {errors}', [
                    'title' => $model->getTitle(),
                    'errors' => json_encode($model->getErrors()),
                ]));
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Module model.
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

    /**
     * Finds the Module model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Module the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Module::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
