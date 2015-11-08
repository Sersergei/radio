<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */

$this->breadcrumbs=array(
	'Radiostation Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RadiostationSettings', 'url'=>array('index')),
	array('label'=>'Manage RadiostationSettings', 'url'=>array('admin')),
);
?>

<h1>Create RadiostationSettings</h1>


<?php

//var_dump($model->lable);
switch ($model->lable) {
	case 1:
		$this->renderPartial('_form1', array('model' => $model));
		break;
	case 2:
		$this->renderPartial('_form2', array('model' => $model));
		break;
	default:
		$this->renderPartial('_form', array('model' => $model));
		break;
}
		?>