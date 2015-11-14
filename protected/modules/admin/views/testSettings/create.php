<?php
/* @var $this TestSettingsController */
/* @var $model TestSettings */

$this->breadcrumbs=array(
	'Test Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TestSettings', 'url'=>array('index')),
	array('label'=>'Manage TestSettings', 'url'=>array('admin')),
);
?>

<h1>Create TestSettings</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>