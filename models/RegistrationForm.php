<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegistrationForm extends Model
{
    public $email;
    public $password;
    public $repeat_password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password', 'repeat_password'], 'required'],
            ['email', 'email'],
            ['repeat_password', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"],
            ['email', 'checkUnique']
        ];
    }

    public function checkUnique()
    {
        if (User::findByEmail($this->email)) {
            $this->addError('email', 'User already exists');
        }
    }

    public function createUser()
    {
        $user = new User();
        $user->attributes = $this->attributes;

        if ($this->validate() && $user->validate() && $user->save()) {
            return $user;
        }

        return false;
    }
}
