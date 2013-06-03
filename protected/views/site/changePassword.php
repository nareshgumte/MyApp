<?php
$this->pageTitle = Yii::app()->name . ' - Change Password';
$this->breadcrumbs = array(
    'Profile' => array('/Store/profile'),
    'Change Password',
);
$this->menu = array(
    array('label' => 'Edit Profile', 'url' => array('edit')),
    array('label' => 'Change Password', 'url' => array('changepassword')),
);
?>

<h1>Change password</h1>

<?php if (Yii::app()->user->hasFlash('changepassword')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('changepassword'); ?>
    </div>

<?php else: ?>



    <div class="form">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'changepassword-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('class' => 'forms columnar'),
                ));
        ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>
        <?php echo $form->errorSummary($model); ?>

        <fieldset>
            <ul>
                <li>
                    <?php echo $form->labelEx($model, 'oldPassword'); ?>
                    <?php echo $form->passwordField($model, 'oldPassword'); ?>
                    <?php echo $form->error($model, 'oldPassword'); ?>  
                </li>
                <li>

                    <?php echo $form->labelEx($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password'); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </li><li>

                    <?php echo $form->labelEx($model, 'verifyPassword'); ?>
                    <?php echo $form->passwordField($model, 'verifyPassword'); ?>
                    <?php echo $form->error($model, 'verifyPassword'); ?>
                </li>
                <li class="push">


                    <?php echo CHtml::submitButton("Save", array('class' => 'btn')); ?>
                </li>
            </ul>
        </fieldset>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
<?php endif; ?>