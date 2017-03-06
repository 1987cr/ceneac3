<?php

namespace app\models;

use Yii;
use \app\models\base\User as BaseUser;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 */
class User extends BaseUser implements IdentityInterface
{
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
       return static::findOne(['username' => $username]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

     public function validatePassword($password)
    {
       return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            else{
                $this->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }
}
