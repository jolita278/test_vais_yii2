<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClCountries */
/* @var $modelsCountriesTranslations app\models\CountriesTranslations */

$this->title = Yii::t('app', 'Create Cl Countries');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cl Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cl-countries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsCountriesTranslations' => $modelsCountriesTranslations,
    ]) ?>

</div>
