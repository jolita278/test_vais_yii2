<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClLanguages */

$this->title = Yii::t('app', 'Create Cl Languages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cl Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cl-languages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
