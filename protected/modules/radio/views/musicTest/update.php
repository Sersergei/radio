<?php
/* @var $this MusicTestController */
/* @var $model MusicTest */

$this->breadcrumbs=array(
	'Music Tests'=>array('index'),
	$model->id_test=>array('view','id'=>$model->id_test),
	'Update',
);

$this->menu=array(
	array('label'=>'Create MusicTest', 'url'=>array('create')),
	array('label'=>'View MusicTest', 'url'=>array('view', 'id'=>$model->id_test)),
	array('label'=>'Manage MusicTest', 'url'=>array('index')),
);
?>

<h1>Update MusicTest <?php echo $model->id_test; ?></h1>

<?php $this->renderPartial('_form_update', array('model'=>$model)); ?>