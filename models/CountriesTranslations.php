<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "countries_translations".
 *
 * @property integer $count
 * @property string $created_at
 * @property string $language_code
 * @property string $country_id
 * @property string $name
 *
 * @property ClLanguages $languageCode
 * @property ClCountries $country
 */
class CountriesTranslations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries_translations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['created_at'], 'safe'],
            [['language_code'], 'string', 'max' => 2],
            [['country_id'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 255],
            [['language_code'], 'exist', 'skipOnError' => true, 'targetClass' => ClLanguages::className(), 'targetAttribute' => ['language_code' => 'code']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClCountries::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'count' => Yii::t('app', 'Count'),
            'created_at' => Yii::t('app', 'Created At'),
            'language_code' => Yii::t('app', 'Language'),
            'country_id' => Yii::t('app', 'Country ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguageCode()
    {
        return $this->hasOne(ClLanguages::className(), ['code' => 'language_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(ClCountries::className(), ['id' => 'country_id']);
    }
}
