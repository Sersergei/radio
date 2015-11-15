<?php
/* @var $this TestSettingsController */
/* @var $model TestSettings */

$this->breadcrumbs=array(
	'Test Settings'=>array('index'),
	$model->id_test_settings,
);

$this->menu=array(
	array('label'=>'List TestSettings', 'url'=>array('index')),
	array('label'=>'Create TestSettings', 'url'=>array('create')),
	array('label'=>'Update TestSettings', 'url'=>array('update', 'id'=>$model->id_test_settings)),
	array('label'=>'Delete TestSettings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_test_settings),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TestSettings', 'url'=>array('admin')),
);
?>

<h1>View TestSettings #<?php echo $model->id_test_settings; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_test_settings',
		'id_radiostation',
		'sex',
		'age_from',
		'after_age',
		'id_education',
		'Invitations',
	),
)); ?>
