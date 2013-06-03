<?php
/* @var $this ProfileController */
/* @var $model IntLogin */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'int-login-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
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
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 100, "disabled" => "disabled")); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'profile_image'); ?>
        <?php echo CHtml::activeFileField($model, 'profile_image'); ?>  // by this we can upload image
        <?php echo $form->error($model, 'profile_image'); ?>
    </div>
    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->profile_image, "image", array("width" => 200)); ?> 



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->