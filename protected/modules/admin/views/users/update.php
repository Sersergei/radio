<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id_user=>array('view','id'=>$model->id_user),
	'Update',
);

$this->menu=array(

	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'View Users', 'url'=>array('view', 'id'=>$model->id_user)),
	array('label'=>'Manage Users', 'url'=>array('index')),
);
?>

<h1>Update Users <?php echo $model->id_user; ?></h1>

<?php $this->renderPartial('_formupdate', array('model'=>$model)); ?>