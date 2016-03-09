<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $userName
 * @property string $userFullName
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string $email
 * @property string $phoneNumber
 * @property integer $userType
 */
class Users extends \yii\db\ActiveRecord
{
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
            [['userName', 'userFullName','password', 'authKey', 'accessToken', 'email', 'phoneNumber', 'userType'], 'required'],
            [['userType'], 'integer'],
            [['userName', 'password', 'email'], 'string', 'max' => 100],
            [['authKey', 'accessToken'], 'string', 'max' => 64],
            [['phoneNumber'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userName' => 'User Name',
            'userFullName' => 'User Full Name',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'email' => 'Email',
            'phoneNumber' => 'Phone Number',
            'userType' => 'User Type',
        ];
    }
}
