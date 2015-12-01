<?php
/* @var $this TestSettingsMultController */
/* @var $model TestSettingsMult */

$this->breadcrumbs=array(
	'Test Settings Mults'=>array('index'),
	$model->id_test_mult,
);

$this->menu=array(
	array('label'=>'Update TestSettingsMult', 'url'=>array('update', 'id'=>$model->id_test_mult)),

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
