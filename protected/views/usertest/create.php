<?php
/* @var $this UsertestController */
/* @var $model Usertest */

$this->breadcrumbs=array(
	'Usertests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Usertest', 'url'=>array('index')),
	array('label'=>'Manage Usertest', 'url'=>array('admin')),
);
?>

<h1>Create Usertest</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>