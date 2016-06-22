<?php
/* @var $this RadiostationListController */
/* @var $model RadiostationList */

$this->breadcrumbs=array(
	'Radiostation Lists'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RadiostationList', 'url'=>array('index')),
	array('label'=>'Create RadiostationList', 'url'=>array('create')),
	array('label'=>'Update RadiostationList', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RadiostationList', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RadiostationList', 'url'=>array('admin')),
);
?>

<h1>View RadiostationList #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_region',
		'name_radio',
	),
)); ?>
