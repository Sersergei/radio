<?php
/* @var $this RadistationsController */
/* @var $model Radistations */

$this->breadcrumbs=array(
	'Radistations'=>array('index'),
	$model->name=>array('view','id'=>$model->id_radiostation),
	'Update',
);

$this->menu=array(
	array('label'=>'List Radistations', 'url'=>array('index')),
	array('label'=>'View Radistations', 'url'=>array('view', 'id'=>$model->id_radiostation)),
	array('label'=>'Manage Radistations', 'url'=>array('admin')),
);
?>

<h1>Update Radistations <?php echo $model->id_radiostation; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>