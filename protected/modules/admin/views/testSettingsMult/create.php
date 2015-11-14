<?php
/* @var $this TestSettingsMultController */
/* @var $model TestSettingsMult */

$this->breadcrumbs=array(
	'Test Settings Mults'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TestSettingsMult', 'url'=>array('index')),
	array('label'=>'Manage TestSettingsMult', 'url'=>array('admin')),
);
?>

<h1>Create TestSettingsMult</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>