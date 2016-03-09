<?php

namespace app\models;

use app\models\Users;

class User extends \yii\base\Object implements \yii\web\IdentityInterface {

    public $id;
    public $userName;
    public $userFullName;
    public $password;
    public $authKey;
    public $accessToken;
    public $email;
    public $phoneNumber;
    public $userType;
    
    private static $users = null;
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $dbUser = Users::find()->where(['id' => $id])->one();
        
        return !empty($dbUser) ? new static($dbUser) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $userType = null)
    {
        $dbUser = Users::find()->where(['accessToken' => $token])->one();
        
        return !empty($dbUser) ? new static($dbUser) : null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $dbUser = Users::find()->where(['userName' => $username])->one();
        
        return !empty($dbUser) ? new static($dbUser) : null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

}
