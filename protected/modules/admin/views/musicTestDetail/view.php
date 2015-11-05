<?php
/* @var $this MusicTestDetailController */
/* @var $model MusicTestDetail */

$this->breadcrumbs=array(
	'Music Test Details'=>array('index'),
	$model->id_test_det,
);

$this->menu=array(
	array('label'=>'List MusicTestDetail', 'url'=>array('index')),
	array('label'=>'Create MusicTestDetail', 'url'=>array('create')),
	array('label'=>'Update MusicTestDetail', 'url'=>array('update', 'id'=>$model->id_test_det)),
	array('label'=>'Delete MusicTestDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_test_det),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MusicTestDetail', 'url'=>array('admin')),
);
?>

<h1>View MusicTestDetail #<?php echo $model->id_test_det; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_test_det',
		'id_test',
		'id_user',
		'date_last',
		'finaly',
		'id_song',
		'id_like',
	),
)); ?>
