<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */

$this->breadcrumbs=array(
	'Radiostation Settings'=>array('index'),
	$model->id_radio_settings,
);

$this->menu=array(
	array('label'=>'List RadiostationSettings', 'url'=>array('index')),
	array('label'=>'Create RadiostationSettings', 'url'=>array('create')),
	array('label'=>'Update RadiostationSettings', 'url'=>array('update', 'id'=>$model->id_radio_settings)),
	array('label'=>'Delete RadiostationSettings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_radio_settings),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RadiostationSettings', 'url'=>array('admin')),
);
?>

<h1>View RadiostationSettings #<?php echo $model->id_radio_settings; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_radio_settings',
		'id_lang',
		'id_user',
		'test_song',
		'not_use_music_marker',
		'not_register_users',
		'not_invite_users',
		'mix_marker_1',
		'mix_marker_2',
		'mix_marker_3',
		'mix_marker_4',
		'mix_marker',
		'id_radiostation',
		'other_radiostations',
		'id_card_registration',
	),
)); ?>
