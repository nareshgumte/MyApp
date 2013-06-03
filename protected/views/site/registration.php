<?php
/* @var $this IntLoginController */
/* @var $model IntLogin */
/* @var $form CActiveForm */
$this->pageTitle = Yii::app()->name . ' - Registration';
$this->breadcrumbs = array(
    'Registration',
);
?>
<h1>Registration</h1>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'int-login-registration-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php //echo $form->errorSummary($model); ?>

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
        <?php echo $form->labelEx($model, 'confirmPassword'); ?>
        <div class="controls">
            <?php echo $form->passwordField($model, 'confirmPassword'); ?>
            <?php echo $form->error($model, 'confirmPassword'); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'email'); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'email'); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
    </div>


    <div class="control-group">
        <?php echo $form->labelEx($model, 'firstname'); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'firstname'); ?>
            <?php echo $form->error($model, 'firstname'); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'lastname'); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'lastname'); ?>
            <?php echo $form->error($model, 'lastname'); ?>
        </div>
    </div>



    <div class="control-group">
        <?php echo CHtml::submitButton('Submit'); ?>
        <?php echo CHtml::link('Back To Login', array("/site/login")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->