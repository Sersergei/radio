<?php
/* @var $this RadiostationListController */
/* @var $model RadiostationList */

$this->breadcrumbs=array(
	'Radiostation Lists'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RadiostationList', 'url'=>array('index')),
	array('label'=>'Create RadiostationList', 'url'=>array('create')),
	array('label'=>'View RadiostationList', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RadiostationList', 'url'=>array('admin')),
);
?>

<h1>Update RadiostationList <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>