<?php
/* @var $this MusicTestDetailController */
/* @var $model MusicTestDetail */

$this->breadcrumbs=array(
	'Music Test Details'=>array('index'),
	$model->id_test_det=>array('view','id'=>$model->id_test_det),
	'Update',
);

$this->menu=array(
	array('label'=>'List MusicTestDetail', 'url'=>array('index')),
	array('label'=>'Create MusicTestDetail', 'url'=>array('create')),
	array('label'=>'View MusicTestDetail', 'url'=>array('view', 'id'=>$model->id_test_det)),
	array('label'=>'Manage MusicTestDetail', 'url'=>array('admin')),
);
?>

<h1>Update MusicTestDetail <?php echo $model->id_test_det; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>