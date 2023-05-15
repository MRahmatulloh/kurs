<?php

namespace app\controllers;

use yii\web\Controller;

class FrontendController extends Controller
{
    public $layout = 'main-frontend';

    public function actionIndex(){
        return $this->render('index');
    }

}