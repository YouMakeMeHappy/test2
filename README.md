Test task (Using Yii 2 Basic Project Template)
============================


REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.

CONFIGURATION
-------------

 Change default database credentials  in `config/db.php`:

 Run migrations

```php
    php yii migrate/up
```

 Change default credentials to RabbitMQ in `config/console.php` and `config/web.php`

```php
    'components' => [
        ...
            'amqp' => [
                'class' => 'webtoucher\amqp\components\Amqp',
                'host' => '127.0.0.1',
                'port' => 5672,
                'user' => 'guest',
                'password' => 'guest',
                'vhost' => '/',
            ],
        ...
    ],
```

 Change default exchange in `config/console.php`

```php
    'controllerMap' => [
        ...
        'rabbit' => [
            'class' => 'webtoucher\amqp\controllers\AmqpListenerController',
            'interpreters' => [
                'reg' => 'app\components\RabbitInterpreter', // interpreters for each exchange
            ],
            'exchange' => 'reg', // default exchange
        ],
        ...
    ],
```


 Change default clientId and clientSecret in `config/web.php`

```php
    'components' => [
        ...
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => '862441133808634',
                    'clientSecret' => '71fe77db3c6f1de0ca6f498bc9ccd8fe',
                    'attributeNames' => ['email'],
                ],
            ],
        ],
        ...
    ],
```

**NOTE:**

If you want to use default clientId and clientSecret, your host must be named 'localhost'