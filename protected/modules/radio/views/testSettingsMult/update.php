<?php
/* @var $this TestSettingsMultController */
/* @var $model TestSettingsMult */

$this->breadcrumbs=array(
	'Test Settings Mults'=>array('index'),
	$model->id_test_mult=>array('view','id'=>$model->id_test_mult),
	'Update',
);

$this->menu=array(

	array('label'=>'Manage TestSettingsMult', 'url'=>array('admin')),
);
?>

<h1>Update TestSettingsMult <?php echo $model->id_test_mult; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>