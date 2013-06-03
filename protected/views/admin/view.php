<?php
/* @var $this AdminController */
/* @var $model IntLogin */

$this->breadcrumbs=array(
	'Int Logins'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List IntLogin', 'url'=>array('index')),
	array('label'=>'Create IntLogin', 'url'=>array('create')),
	array('label'=>'Update IntLogin', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete IntLogin', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IntLogin', 'url'=>array('admin')),
);
?>

<h1>View IntLogin #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'firstname',
		'lastname',
		'email',
		'profile_image',
		'password',
//		'login_via',
//		'status',
	),
)); ?>
