<?php

use app\models\Author;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\AuthorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mualliflar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <p class="text-right">
        <?= Html::a('Muallif qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'phone',
            'email:email',
            [
                'attribute' => 'user_id',
                'value' => function (Author $author) {
                    return $author->user->name ?? '';
                }
            ],
            [
                'attribute' => 'status',
                'value' => function (Author $author) {
                    return \app\components\Globals::getStatuses()[$author->status];
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function (\app\models\Author $model) {
                    return Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s');
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function (\app\models\Author $model) {
                    return Yii::$app->formatter->asDatetime($model->updated_at, 'php:d.m.Y H:i:s');
                }
            ],
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            //'last_login',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Author $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
