<?php

use yii\db\Migration;

class m170511_154905_users extends Migration
{

    public function up()
    {
        $this->createTable('users',
            [
                'id' => $this->primaryKey(),
                'email' => $this->string(50)->notNull(),
                'password' => $this->string(150)->notNull(),
                'auth_key' => $this->string(150),
                'access_token' => $this->string(150)
            ]
        );
    }

    public function down()
    {
        $this->dropTable('users');
    }

}
