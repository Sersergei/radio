<?php
/* @var $this UsertestController */
/* @var $model Usertest */

$this->breadcrumbs=array(
	'Usertests'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Usertest', 'url'=>array('index')),
	array('label'=>'Create Usertest', 'url'=>array('create')),
	array('label'=>'View Usertest', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Usertest', 'url'=>array('admin')),
);
?>

<h1>Update Usertest <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>