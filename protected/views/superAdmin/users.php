<?php
/* @var $this AdminController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Int Logins',
);

$this->menu = array(
    array('label' => 'Create IntLogin', 'url' => array('create')),
    array('label' => 'Manage IntLogin', 'url' => array('admin')),
);
?>


<h1>Users List</h1>
<div class="span-5 last">
    <div id="sidebar">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => 'Operations',
        ));
        $this->widget('zii.widgets.CMenu', array(
            'items' => $this->menu,
            'htmlOptions' => array('class' => 'operations'),
        ));
        $this->endWidget();
        ?>
    </div><!-- sidebar -->
</div>
<div class="clear"></div>
<table class="table table-striped">
    <tr><th>ID</th><th>UserName</th><th>FirstName</th><th>LastName</th><th>Email</th><th>Image</th></tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
    ));
    ?>
</table>