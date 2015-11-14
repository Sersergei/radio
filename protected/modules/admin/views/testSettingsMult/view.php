<?php
/* @var $this TestSettingsMultController */
/* @var $model TestSettingsMult */

$this->breadcrumbs=array(
	'Test Settings Mults'=>array('index'),
	$model->id_test_mult,
);

$this->menu=array(
	array('label'=>'List TestSettingsMult', 'url'=>array('index')),
	array('label'=>'Create TestSettingsMult', 'url'=>array('create')),
	array('label'=>'Update TestSettingsMult', 'url'=>array('update', 'id'=>$model->id_test_mult)),
	array('label'=>'Delete TestSettingsMult', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_test_mult),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TestSettingsMult', 'url'=>array('admin')),
);
?>

<h1>View TestSettingsMult #<?php echo $model->id_test_mult; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_test_mult',
		'id_radiostations',
		'text_before_test',
		'text_after_test',
		'invitation_topic',
		'invitation_text',
		'test_song',
	),
)); ?>
