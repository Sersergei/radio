<?php
/* @var $this TestSettingsController */
/* @var $model TestSettings */

$this->breadcrumbs=array(
	'Test Settings'=>array('index'),
	$model->id_test_settings=>array('view','id'=>$model->id_test_settings),
	'Update',
);

$this->menu=array(
	array('label'=>'List TestSettings', 'url'=>array('index')),
	array('label'=>'Create TestSettings', 'url'=>array('create')),
	array('label'=>'View TestSettings', 'url'=>array('view', 'id'=>$model->id_test_settings)),
	array('label'=>'Manage TestSettings', 'url'=>array('admin')),
);
?>

<h1>Update TestSettings <?php echo $model->id_test_settings; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>