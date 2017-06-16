<?php

namespace app\controllers;

use app\models\CountriesTranslations;
use Yii;
use app\models\ClCountries;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
        $dataProvider = new ActiveDataProvider([
            'query' => ClCountries::find(),
        ]);

        return $this->render('index', [
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
        $modelClCountries = $this->findModel($id);

        return $this->render('view', [
            'model' => $modelClCountries,
            'modelsCountriesTranslations' => $modelClCountries->countriesTranslations,
        ]);
    }

    /**
     * Creates a new ClCountries model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelClCountries = new ClCountries();
        $modelsCountriesTranslations = [new CountriesTranslations];

        if ($modelClCountries->load(Yii::$app->request->post())) /*&& $model->save()*/ {
            $modelsCountriesTranslations = Model::createMultiple(CountriesTranslations::classname());
            Model::loadMultiple($modelsCountriesTranslations, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsCountriesTranslations),
                    ActiveForm::validate($modelClCountries)
                );
            }

            $valid = $modelClCountries->validate();
            $valid = Model::validateMultiple($modelsCountriesTranslations) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelClCountries->save(false)) {

                        foreach ($modelsCountriesTranslations as $modelCountryTranslation) {
                            $modelCountryTranslation->country_id = $modelClCountries->id;
                            if (!($flag = $modelCountryTranslation->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelClCountries->id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }


        } else {
            return $this->render('create', [
                'modelClCountries' => $modelClCountries,
                'modelsCountriesTranslations' => (empty($modelsCountriesTranslations)) ? [new CountriesTranslations] : $modelsCountriesTranslations
            ]);
        }
    }

    /**
     * Updates an existing ClCountries model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelClCountries = $this->findModel($id);

        if ($modelClCountries->load(Yii::$app->request->post()) && $modelClCountries->save()) {
            return $this->redirect(['view', 'id' => $modelClCountries->id]);
        } else {
            return $this->render('update', [
                'model' => $modelClCountries,
            ]);
        }
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
        if (($modelClCountries = ClCountries::findOne($id)) !== null) {
            return $modelClCountries;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
