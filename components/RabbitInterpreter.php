<?php

namespace app\components;

use webtoucher\amqp\components\AmqpInterpreter;


class RabbitInterpreter extends AmqpInterpreter
{
    /**
     * Interprets AMQP message with routing key 'Registration'.
     *
     * @param array $message
     */
    public function readRegistration($message)
    {
        \Yii::$app->mailer->compose('registration/html', ['text' => $message['text']])
            ->setFrom(\Yii::$app->params['adminEmail'])
            ->setTo($message['email'])
            ->setSubject(\Yii::t('app', 'registration'))
            ->send();

    }
}