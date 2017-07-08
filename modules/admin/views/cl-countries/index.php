<?php

use app\models\CountriesTranslationsSearch;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CountriesTranslationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cl Countries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cl-countries-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cl Countries'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
        'columns' => [
            'class' => 'kartik\grid\ExpandRowColumn',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {

                return Yii::$app->controller->renderPartial('_translations.php', [
                    'lan_id' => $model->id
                ]);
            },

            'count',
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            ['class' => 'yii\grid\ActionColumn'],
            'responsive' => true,
            'hover' => true

        ],
    ]); ?>
</div>
