<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\CountriesTranslationsSearch */

$this->title = Yii::t('app', 'Translations');
$this->params['breadcrumbs'][] = $this->title;


$searchModel = new CountriesTranslationsSearch();
$searchModel->country_id = $lan_id;
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
?>
<div class="translations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cl Languages'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'count',
            'created_at',
            'language_code',
            'name',
            'slug',
            'seo_title',
            'seo_description',
            'seo_keywords',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
