<?php
/* @var $this SuperAdminController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Int Logins',
);

$this->menu=array(
	array('label'=>'Create IntLogin', 'url'=>array('create')),
	array('label'=>'Manage IntLogin', 'url'=>array('admin')),
);
?>

<h1>Int Logins</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
