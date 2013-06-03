<?php
/* @var $this ProfileController */
/* @var $model IntLogin */

$this->breadcrumbs = array(
    'Int Logins' => array('index'),
    $model->id,
);
?><br>

<!--<h1>View IntLogin #<?php //echo $model->id;    ?></h1>-->


<table>
    <tr>
        <td><img src="<?php echo Yii::app()->baseUrl . "/images/" . CHtml::encode($model->profile_image); ?>" class="img-polaroid" height="120" width="120"></td>
        <td><?php echo CHtml::link("Edit Profile", "update/" . $model->id) ?></td>
    </tr>
    <tr>
        <td><?php echo CHtml::encode($model->username); ?></td>
        <td></td>
    </tr>
    <tr>
        <td><b>First Name:</b></td>
        <td><?php echo CHtml::encode($model->firstname); ?></td>
    </tr>
    <tr>
        <td><b>Last Name:</b></td>
        <td><?php echo CHtml::encode($model->lastname); ?></td>

    </tr>
    <tr>
        <td><b>Email-address:</b></td>
        <td><?php echo CHtml::encode($model->email); ?></td>

    </tr>
</table>
