<?php

namespace app\modules\admin\controllers;

use app\models\CountriesTranslations;
use thamtech\uuid\helpers\UuidHelper;
use Yii;
use app\models\ClCountries;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\base\Model;

/**
 * ClCountriesController implements the CRUD actions for ClCountries model.
 */
class ClCountriesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ClCountries models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClCountriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClCountries model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
            'modelsCountriesTranslations' => $model->countriesTranslations,
        ]);
    }

    /**
     * Creates a new ClCountries model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClCountries();
        $modelsCountriesTranslations = [new CountriesTranslations];

        if ($model->load(Yii::$app->request->post())) /*&& $model->save()*/ {
            $model['id'] = UuidHelper::uuid();
            $modelsCountriesTranslations = Model::createMultiple(CountriesTranslations::classname());
            Model::loadMultiple($modelsCountriesTranslations, Yii::$app->request->post());


            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsCountriesTranslations),
                    ActiveForm::validate($model));
            }

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsCountriesTranslations) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {

                        foreach ($modelsCountriesTranslations as $modelCountryTranslation) {
                            $modelCountryTranslation->country_id = $model->id;
                            if (!($flag = $modelCountryTranslation->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }


        }

        return $this->render('create', [
            'model' => $model,
            'modelsCountriesTranslations' => (empty($modelsCountriesTranslations)) ? [new CountriesTranslations] : $modelsCountriesTranslations
        ]);
    }


    /**
     * Updates an existing ClCountries model with connection model CountriesTranslation.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsCountriesTranslations = $model->countriesTranslations;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsCountriesTranslations, 'count', 'count');
            $modelsCountriesTranslations = Model::createMultiple(CountriesTranslations::classname(), $modelsCountriesTranslations);
            Model::loadMultiple($modelsCountriesTranslations, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsCountriesTranslations, 'count', 'count')));


            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsCountriesTranslations),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsCountriesTranslations) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            CountriesTranslations::deleteAll(['count' => $deletedIDs]);
                        }
                        foreach ($modelsCountriesTranslations as $modelCountriesTranslations) {
                            $modelCountriesTranslations->offer_id = $model->id;
                            if (!($flag = $modelCountriesTranslations->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsCountriesTranslations' => (empty($modelsCountriesTranslations)) ? [new CountriesTranslations] : $modelsCountriesTranslations
        ]);

    }


    /**
     * Deletes an existing ClCountries model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ClCountries model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ClCountries the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClCountries::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
