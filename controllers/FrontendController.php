<?php

namespace app\controllers;

use app\components\AuthHandler;
use yii\helpers\Url;
use yii\web\Controller;

class FrontendController extends Controller
{
    public $layout = 'main-frontend';

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
                'successUrl'=>Url::to(['site/index'])
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
    }

    public function actionIndex(){

        $books = \app\models\Book::find()->orderBy('id desc')->limit(4)->all();
        $blogs = \app\models\Blog::find()->orderBy('id desc')->limit(3)->all();

        return $this->render('index',[
            'books' => $books,
            'blogs' => $blogs
        ]);
    }

    public function actionBlogs(){
        $searchModel = new \app\models\search\BlogSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('blogs',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionBooks(){

        $searchModel = new \app\models\search\BookSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('books',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionAboutUs(){
        return $this->render('about-us');
    }

    public function actionCourses(){
        return $this->render('index');
    }

}