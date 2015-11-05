<?php
/* @var $this RadistationsController */
/* @var $model Radistations */

$this->breadcrumbs=array(
	'Radistations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Radistations', 'url'=>array('index')),
	array('label'=>'Manage Radistations', 'url'=>array('admin')),
);
?>

<h1>Create Radistations</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>