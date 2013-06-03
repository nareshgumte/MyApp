<?php
/* @var $this AdminController */
/* @var $model IntLogin */

$this->breadcrumbs=array(
	'Int Logins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IntLogin', 'url'=>array('index')),
	array('label'=>'Manage IntLogin', 'url'=>array('admin')),
);
?>

<h1>Create IntLogin</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>