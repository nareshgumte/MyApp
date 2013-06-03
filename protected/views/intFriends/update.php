<?php
/* @var $this IntFriendsController */
/* @var $model IntFriends */

$this->breadcrumbs=array(
	'Int Friends'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List IntFriends', 'url'=>array('index')),
	array('label'=>'Create IntFriends', 'url'=>array('create')),
	array('label'=>'View IntFriends', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage IntFriends', 'url'=>array('admin')),
);
?>

<h1>Update IntFriends <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>