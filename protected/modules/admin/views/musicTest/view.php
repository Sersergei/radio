<?php
/* @var $this MusicTestController */
/* @var $model MusicTest */

$this->breadcrumbs=array(
	'Music Tests'=>array('index'),
	$model->id_test,
);

$this->menu=array(
	array('label'=>'List MusicTest', 'url'=>array('index')),
	array('label'=>'Create MusicTest', 'url'=>array('create')),
	array('label'=>'Update MusicTest', 'url'=>array('update', 'id'=>$model->id_test)),
	array('label'=>'Delete MusicTest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_test),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MusicTest', 'url'=>array('admin')),
);
?>

<h1>View MusicTest #<?php echo $model->id_test; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_test',
		'id_radiostation',
		'id_type',
		'date_add',
		'date_started',
		'id_control',
		'max_listeners',
		'test_number',
		'date_finished',
	),
)); ?>
