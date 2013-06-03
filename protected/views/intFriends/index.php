<?php
/* @var $this IntFriendsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Int Friends',
);

$this->menu=array(
	array('label'=>'Create IntFriends', 'url'=>array('create')),
	array('label'=>'Manage IntFriends', 'url'=>array('admin')),
);
?>

<h1>Int Friends</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
