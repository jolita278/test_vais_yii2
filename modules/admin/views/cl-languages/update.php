<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClLanguages */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cl Languages',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cl Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->count]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cl-languages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
