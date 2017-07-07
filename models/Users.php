<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Users extends ActiveRecord implements IdentityInterface
{
    /**
     * **
     * This is the model class for table "users".
     *
     * @property integer $count
     * @property string $id
     * @property string $created_at
     * @property string $updated_at
     * @property string $deleted_at
     * @property string $username
     * @property string $email
     * @property string $password
     * @property string $first_name
     * @property string $last_name
     * @property string $remember_token
     *
     * @property UserAdvertsConn[] $userAdvertsConns
     * @property UserEventsConn[] $userEventsConns
     * @property UserPetHotelsConn[] $userPetHotelsConns
     * @property UserRolesConn[] $userRolesConns
     * @property UserVetClinicsConn[] $userVetClinicsConns
     * @property UsersGroomerSalonsConn[] $usersGroomerSalonsConns
     * @property UsersKennelsConn[] $usersKennelsConns
     * @property UsersPhotosConn[] $usersPhotosConns
     */

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['id'], 'string', 'max' => 36],
            [['username', 'first_name', 'last_name'], 'string', 'max' => 45],
            [['email', 'password'], 'string', 'max' => 255],
            [['remember_token'], 'string', 'max' => 100],
            [['id'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'email'],

        ];
    }

    /*
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
            'username' => Yii::t('app', 'User Name'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'remember_token' => Yii::t('app', 'Remember Token'),
        ];
    }

    public function getAuthKey()
    {
        throw new NotSupportedException();
    }

    public function getID()
    {
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException();
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);

    }

    public function validatePassword($password)
    {

        return $this->password === md5($password);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAdvertsConns()
    {
        return $this->hasMany(UserAdvertsConn::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserEventsConns()
    {
        return $this->hasMany(UserEventsConn::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPetHotelsConns()
    {
        return $this->hasMany(UserPetHotelsConn::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRolesConns()
    {
        return $this->hasMany(UserRolesConn::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserVetClinicsConns()
    {
        return $this->hasMany(UserVetClinicsConn::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersGroomerSalonsConns()
    {
        return $this->hasMany(UsersGroomerSalonsConn::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersKennelsConns()
    {
        return $this->hasMany(UsersKennelsConn::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersPhotosConns()
    {
        return $this->hasMany(UsersPhotosConn::className(), ['user_id' => 'id']);
    }

}

?>

