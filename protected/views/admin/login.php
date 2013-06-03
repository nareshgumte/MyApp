<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - AdminLogin';
$this->breadcrumbs = array(
    'AdminLogin',
);
?>

<h1>Admin Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
            ));
    ?>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'username'); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'username'); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'password'); ?>
        <div class="controls">
            <?php echo $form->passwordField($model, 'password'); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <?php echo $form->checkBox($model, 'rememberMe'); ?>
            <?php echo $form->label($model, 'rememberMe'); ?>
            <?php echo $form->error($model, 'rememberMe'); ?>
            <?php echo CHtml::submitButton('Login'); ?>
        </div>
    </div>


    <?php $this->endWidget(); ?>
</div><!-- form -->
