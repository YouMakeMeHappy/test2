<?php

namespace app\models;

use app\events\RegistrationEvent;
use yii\helpers\Json;

/**
 * Class User
 * @package app\models
 *
 */

/**
 * @property string email
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'unique'],
        ];
    }

    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['token' => $token]);
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
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public static function registrationEvent(RegistrationEvent $event)
    {
        \Yii::$app->amqp->send('reg', 'registration', Json::encode(
            ['email' => $event->getUser()->email, 'text' => 'Registration complete'])
        );
    }
}
