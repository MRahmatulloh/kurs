<?php

namespace app\controllers;


use app\models\User;
use mdm\admin\models\searchs\User as UserSearch;
use Yii;
use yii\base\Controller;
use yii\data\ActiveDataProvider;

class UserController extends Controller
{

    public function actionAdmins()
    {
        $ids = Yii::$app->authManager->getUserIdsByRole("Administrator");
        $searchModel = new UserSearch();
        $query = User::find()->where(['id' => $ids]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => 'Adminlar'
        ]);
    }

    public function actionTeachers()
    {
        $ids = Yii::$app->authManager->getUserIdsByRole("Teacher");
        $searchModel = new UserSearch();
        $query = User::find()->where(['id' => $ids]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => 'O\'qituvchilar'
        ]);
    }

    public function actionPupils()
    {
        $ids = Yii::$app->authManager->getUserIdsByRole("Pupil");
        $searchModel = new UserSearch();
        $query = User::find()->where(['id' => $ids]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => 'O\'quvchilar'
        ]);
    }

}