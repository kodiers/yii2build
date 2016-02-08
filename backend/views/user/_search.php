<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\search\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

<!--    --><?//= $form->field($model, 'auth_key') ?>
<!---->
<!--    --><?//= $form->field($model, 'password_hash') ?>
<!---->
<!--    --><?//= $form->field($model, 'password_reset_token') ?>

    <?php  echo $form->field($model, 'email') ?>

    <?php  echo $form->field($model, 'status_id')->dropDownList(User::getStatusList(), ['prompt' => 'Please choose one']) ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php  echo $form->field($model, 'role_id')->dropDownList(User::getRoleList(), ['prompt' => 'Please choose one']) ?>

    <?php  echo $form->field($model, 'user_type_id')->dropDownList(User::getUserTypeList(), ['prompt' => 'Please choose one']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
