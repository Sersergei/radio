<?php
/* @var $this UsertestController */
/* @var $model Usertest */

$this->breadcrumbs=array(
	'Usertests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Usertest', 'url'=>array('index')),
	array('label'=>'Create Usertest', 'url'=>array('create')),
	array('label'=>'Update Usertest', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Usertest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Usertest', 'url'=>array('admin')),
);
?>

<h1>View Usertest #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_user',
		'id_music',
		'date',
		'time',
	),
)); ?>
