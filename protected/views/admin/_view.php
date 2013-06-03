<?php
/* @var $this AdminController */
/* @var $data IntLogin */
?>


<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></td>

    <td><?php echo CHtml::encode($data->username); ?></td>
    <td><?php echo CHtml::encode($data->firstname); ?></td>
    <td><?php echo CHtml::encode($data->lastname); ?></td>
    <td><?php echo CHtml::encode($data->email); ?></td>
    <td><?php echo CHtml::link("<img src=" . Yii::app()->baseUrl . "/images/" . CHtml::encode($data->profile_image) . " class='img-circle'/>", array('view', 'id' => $data->id)); ?></td>

</tr>