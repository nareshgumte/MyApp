<?php
/* @var $this AdminController */
/* @var $model IntLogin */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'int-login-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 56, 'maxlength' => 56)); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'firstname'); ?>
        <?php echo $form->textField($model, 'firstname', array('size' => 56, 'maxlength' => 56)); ?>
        <?php echo $form->error($model, 'firstname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'lastname'); ?>
        <?php echo $form->textField($model, 'lastname', array('size' => 56, 'maxlength' => 56)); ?>
        <?php echo $form->error($model, 'lastname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'profile_image'); ?>
        <?php echo $form->textField($model, 'profile_image', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'profile_image'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'login_via'); ?>
        <?php echo $form->textField($model, 'login_via'); ?>
        <?php echo $form->error($model, 'login_via'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->textField($model, 'status', array('size' => 1, 'maxlength' => 1)); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->