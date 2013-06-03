<?php
/* @var $this AdminController */
/* @var $model IntLogin */

$this->breadcrumbs=array(
	'Int Logins'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List IntLogin', 'url'=>array('index')),
	array('label'=>'Create IntLogin', 'url'=>array('create')),
	array('label'=>'View IntLogin', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage IntLogin', 'url'=>array('admin')),
);
?>

<h1>Update IntLogin <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>