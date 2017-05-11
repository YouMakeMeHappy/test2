<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RegistrationForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Sign Up</div>
                <div style="float:right; font-size: 85%; position: relative; top:-10px">
                </div>
            </div>
            <div class="panel-body" >

                <?php $form = ActiveForm::begin(['id' => 'registration-form']); ?>

                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">
                        Email
                    </label>
                    <div class="col-md-9">
                        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Password</label>
                    <div class="col-md-9">
                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="repeat_password" class="col-md-3 control-label">Repeat password</label>
                    <div class="col-md-9">
                        <?= $form->field($model, 'repeat_password')->passwordInput(['placeholder' => 'Repeat password'])->label(false); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-3 col-md-3">
                        <?= Html::submitButton(
                            '<i class="icon-hand-right"></i> &nbsp Sign Up', ['class' => 'btn btn-info', 'name' => 'contact-button']
                        ); ?>
                    </div>
                    <div class="col-md-1">
                        <span style="margin-left:8px;">or</span>
                    </div>

                    <div class="col-md-5">
                        <?= yii\authclient\widgets\AuthChoice::widget([
                            'baseAuthUrl' => ['site/auth'],
                        ]) ?>
                    </div>
                </div>



                <?php ActiveForm::end(); ?>
            </div>
        </div>




    </div>
</div>
