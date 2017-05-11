<?php
namespace app\events;

use app\models\User;

class RegistrationEvent extends \yii\base\Event {

    /**
     * @var User
     */
    private $_user;

    const EVENT_CREATE = 'create';

    public function setUser(User $user)
    {
        $this->_user = $user;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->_user;
    }
}