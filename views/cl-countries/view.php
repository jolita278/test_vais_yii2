<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $modelClCountries app\models\ClCountries */

$this->title = $modelClCountries->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cl Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cl-countries-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $modelClCountries->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $modelClCountries->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $modelClCountries,
        'attributes' => [
            'count',
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
        ],
    ]) ?>

</div>
