<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Thankyou for the visting the Itropost.</p>

<p>Please Login and Continue Your expirence with the Intropost.</p>
<?php
echo $message;
?>