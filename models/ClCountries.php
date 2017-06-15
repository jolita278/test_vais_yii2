<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cl_countries".
 *
 * @property integer $count
 * @property string $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property CountriesTranslations[] $countriesTranslations
 * @property CountryCitiesConn[] $countryCitiesConns
 */
class ClCountries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cl_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
           // [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['id'], 'string', 'max' => 36],
            [['id'], 'unique'],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'count' => Yii::t('app', 'Count'),
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesTranslations()
    {
        return $this->hasMany(CountriesTranslations::className(), ['contry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryCitiesConns()
    {
        return $this->hasMany(CountryCitiesConn::className(), ['country_id' => 'id']);
    }
}
