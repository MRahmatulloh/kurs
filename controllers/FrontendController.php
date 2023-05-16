<?php

namespace app\controllers;

use app\components\AuthHandler;
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
                'redirectView' => [
                    'site/index']
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
        return $this->render('index');
    }

    public function actionBooks(){
        return $this->render('index');
    }

    public function actionAboutUs(){
        return $this->render('index');
    }

    public function actionCourses(){
        return $this->render('index');
    }

}