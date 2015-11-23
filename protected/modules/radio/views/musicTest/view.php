<?php
/* @var $this MusicTestController */
/* @var $model MusicTest */

$this->breadcrumbs=array(
	'Music Tests'=>array('index'),
	$model->id_test,
);

$this->menu=array(
	array('label'=>'Create MusicTest', 'url'=>array('create')),
	array('label'=>'Update MusicTest', 'url'=>array('update', 'id'=>$model->id_test)),
	array('label'=>'Delete MusicTest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_test),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MusicTest', 'url'=>array('index')),
);
?>

<h1>View MusicTest #<?php echo $model->id_test; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_test',
		array(
			'label' => 'id_radiostation',
			'type' => 'raw',
			'value' => $model->radio->name,
		),
		array(
			'label' => 'id_type',
			'type' => 'raw',
			'value' => $model->type->type_name,
		),
		'date_add',
		'date_started',
		'date_finished',
		array(
			'name' => 'id_status',
			'type' => 'raw',
			'value' => $model->getStatus(),
		),
		array(
			'name' => 'max_listeners',
			'type' => 'raw',
			'value' => $model->getMaxLisners(),
		),

	),
)); ?>
