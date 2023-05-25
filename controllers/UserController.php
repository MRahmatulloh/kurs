<?php

namespace app\controllers;


use app\models\User;
use mdm\admin\models\form\ChangePassword;
use mdm\admin\models\searchs\User as UserSearch;
use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class UserController extends Controller
{

    public function actionAdmins()
    {
        $searchModel = new UserSearch([
            'role' => 'admin'
        ]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => 'Adminlar'
        ]);
    }

    public function actionTeachers()
    {
        $searchModel = new UserSearch([
            'role' => 'teacher'
        ]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => 'O\'qituvchilar'
        ]);
    }

    public function actionPupils()
    {
        $searchModel = new UserSearch([
            'role' => 'pupil'
        ]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => 'O\'quvchilar'
        ]);
    }

    public function actionDelete()
    {
        $id = Yii::$app->request->post('id');
        $user = User::findOne($id);
        if ($user) {

            if ($user->orders) {
                foreach ($user->orders as $order) {
                    $order->delete();
                }
            }

            $user->delete();

            Yii::$app->session->setFlash('success', 'Foydalanuvchi o\'chirildi');
        } else {
            Yii::$app->session->setFlash('error', 'Foydalanuvchi topilmadi');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCreate()
    {
        $ids = Yii::$app->authManager->getUserIdsByRole("pupil");
        $users = User::find()->where(['id' => $ids])->asArray()->all();
        $userList = ArrayHelper::map($users, 'id', 'name');

        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->id) {

                $auth = Yii::$app->authManager;
                $auth->revokeAll($model->id);
                $role = $auth->getRole('admin');
                if ($auth->assign($role, $model->id)) {
                    Yii::$app->session->setFlash('success', 'Admin muvaffaqiyatli qo\'shildi');
                    return $this->redirect(['user/admins']);
                }

            } else {
                Yii::$app->session->setFlash('error', 'Foydalanuvchini tanlang');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'userList' => $userList
        ]);
    }

    /**
     * Reset password
     * @return string
     */
    public function actionChangePassword()
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($model->change()) {
                Yii::$app->session->setFlash('success', 'Parol muvaffaqiyatli o\'zgartirildi');
                return $this->redirect(['site/index']);
            } else {
                Yii::$app->session->setFlash('error', 'Parol o\'zgartirishda xatolik');
            }
        }

        return $this->render('change-password', [
            'model' => $model,
        ]);
    }

    public function actionProfile()
    {
        $model = User::findOne(Yii::$app->user->id);

        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = User::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->password_reset_token = Yii::$app->security->generateRandomString();

            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->image) {
                if (file_exists($model->getPhotoFilePath()) && !is_dir($model->getPhotoFilePath())) {
                    unlink($model->getPhotoFilePath());
                }
                $model->photo = $model->id . '.' . $model->image->extension;
                $model->image->saveAs($model->getPhotoFilePath(), false);
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Ma\'lumotlar muvaffaqiyatli saqlandi!'));
                return $this->redirect(['profile', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Xatolik yuz berdi!'));
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

}