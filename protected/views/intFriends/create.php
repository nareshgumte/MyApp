<?php
/* @var $this IntFriendsController */
/* @var $model IntFriends */

$this->breadcrumbs=array(
	'Int Friends'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IntFriends', 'url'=>array('index')),
	array('label'=>'Manage IntFriends', 'url'=>array('admin')),
);
?>

<h1>Create IntFriends</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>