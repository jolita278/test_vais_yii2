<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cl_languages".
 *
 * @property integer $count
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $code
 * @property string $name
 *
 * @property BreedGroupTranslations[] $breedGroupTranslations
 * @property BreedTranslations[] $breedTranslations
 * @property CategoryTranslations[] $categoryTranslations
 * @property CitiesTranslations[] $citiesTranslations
 * @property CountriesTranslations[] $countriesTranslations
 * @property PetTypesTranslations[] $petTypesTranslations
 */
class ClLanguages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cl_languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 45],
            [['code'], 'unique'],
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
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBreedGroupTranslations()
    {
        return $this->hasMany(BreedGroupTranslations::className(), ['language_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBreedTranslations()
    {
        return $this->hasMany(BreedTranslations::className(), ['language_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryTranslations()
    {
        return $this->hasMany(CategoryTranslations::className(), ['language_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCitiesTranslations()
    {
        return $this->hasMany(CitiesTranslations::className(), ['language_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesTranslations()
    {
        return $this->hasMany(CountriesTranslations::className(), ['language_code' => 'code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPetTypesTranslations()
    {
        return $this->hasMany(PetTypesTranslations::className(), ['language_code' => 'code']);
    }
}
