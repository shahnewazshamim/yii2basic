<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * UserLoginForm is the model behind the login form.
 */
class UserLoginForm extends Model {

    public $userName;
    public $password;
    public $rememberMe = true;
    
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['userName', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword(md5($this->password))) {
                $this->addError($attribute, 'User Name or Password Error.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->userName);
        }

        return $this->_user;
    }

}
