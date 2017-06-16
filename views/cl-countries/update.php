<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelClCountries app\models\ClCountries */
/* @var $modelsCountriesTranslations app\models\CountriesTranslations */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cl Countries',
]) . $modelClCountries->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cl Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelClCountries->id, 'url' => ['view', 'id' => $modelClCountries->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cl-countries-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelClCountries' => $modelClCountries,
        'modelsCountriesTranslations' => $modelsCountriesTranslations,
    ]) ?>

</div>
