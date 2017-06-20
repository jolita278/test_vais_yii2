<?php

use app\models\ClLanguages;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\ClCountries */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelsCountriesTranslations app\models\CountriesTranslations */
?>

<div class="cl-countries-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $modelsCountriesTranslations[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'name',
                'language_code',
                'slug',
                'seo_title',
                'seo_description',
                'seo_keywords',
            ],
        ]); ?>

        <div class="panel panel-default">
            <div class="panel-heading"><h4></i> Translations </h4>
            </div>
            <div class="panel-body">

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelsCountriesTranslations as $i => $modelCountriesTranslations): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Translation</h3>

                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i
                                                class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                                class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (!$modelCountriesTranslations->isNewRecord) {
                                    echo Html::activeHiddenInput($modelCountriesTranslations, "[{$i}]count");
                                }
                                ?>
                                <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($modelCountriesTranslations, "[{$i}]language_code")->dropDownList(
                                        ArrayHelper::map(ClLanguages::find()->all(), 'code', 'name'),
                                        [
                                            'prompt' => 'Choose language ...',
                                        ]) ?>
                                </div>

                                <div class="col-sm-4">
                                    <?= $form->field($modelCountriesTranslations, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                                </div>

                                <div class="col-sm-4">
                                    <?= $form->field($modelCountriesTranslations, "[{$i}]slug")->textInput(['maxlength' => true]) ?>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($modelCountriesTranslations, "[{$i}]seo_title")->textInput(['maxlength' => true]) ?>
                                </div>

                                <div class="col-sm-4">
                                    <?= $form->field($modelCountriesTranslations, "[{$i}]seo_description")->textInput(['maxlength' => true]) ?>
                                </div>

                                <div class="col-sm-4">
                                    <?= $form->field($modelCountriesTranslations, "[{$i}]seo_keywords")->textInput(['maxlength' => true]) ?>
                                </div>
                                </div>

                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
