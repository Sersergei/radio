<?php
/* @var $this RadistationsController */
/* @var $model Radistations */

$this->breadcrumbs=array(
	'Radistations'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Radistations', 'url'=>array('index')),
	array('label'=>'Update Radistations', 'url'=>array('update', 'id'=>$model->id_radiostation)),
	array('label'=>'Delete Radistations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_radiostation),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Radistations', 'url'=>array('admin')),
);
?>

<h1>View Radistations #<?php echo $model->id_radiostation; ?></h1>

<?php

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_radiostation',
		'name',
		'location',
		'all_tests',
		'date_add',
		'status',
		array(
			'name' => 'all_tests',
			'type' => 'raw',
			'value' => count($model->MusicTest),
		),
		array(
			'name' => 'login',
			'type' => 'raw',
			'value' => $model->users(array('condition'=>'id_category=2'))[0]->login,
		),
		array(
			'name' => 'password',
			'type' => 'raw',
			'value' => $model->users(array('condition'=>'id_category=2'))[0]->password,
		),
		array(
			'name' => 'license date',
			'type' => 'raw',
			'value' => $model->license->date,
		),
		array(
			'name' => 'license count',
			'type' => 'raw',
			'value' => $model->license->test_count,
		),
		//'mix',
	),
)); ?>
