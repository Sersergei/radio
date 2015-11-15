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
		array(
			'name' => 'id_radiostation',
			'type' => 'raw',
			'value' => $model->Radiostation->name,
		),
		array(
			'name' => 'id_lang',
			'type' => 'raw',
			'value' => $model->idLang->name,
		),
		'test_song',
		array(
			'name' => 'not_use_music_marker',
			'type' => 'raw',
			'value' => $model->getnot_use_music_marker(),
		),
		array(
			'name' => 'not_register_users',
			'type' => 'raw',
			'value' => $model->getnot_register_users(),
		),
		array(
			'name' => 'not_invite_users',
			'type' => 'raw',
			'value' => $model->getnot_invite_users(),
		),
		array(
			'name' => 'id_card_registration',
			'type' => 'raw',
			'value' => $model->getid_card_registration(),
		),
		array(
			'name' => 'mix_marker',
			'type' => 'raw',
			'value' => $model->getmixmarker(),
		),
		array(
			'name' => 'bed_marker',
			'type' => 'raw',
			'value' => $model->getbedmixmarker(),
		),
		array(
			'name' => 'god_marker',
			'type' => 'raw',
			'value' => $model->getgodmixmarker(),
		),
		'other_radiostations',
		array(
			'name' => 'sex',
			'type' => 'raw',
			'value' => $model->testsetings->getsex(),
		),
		array(
			'name' => 'age_from',
			'type' => 'raw',
			'value' => $model->testsetings->age_from,
		),
		array(
			'name' => 'after_age',
			'type' => 'raw',
			'value' => $model->testsetings->after_age,
		),
		array(
			'name' => 'id_education',
			'type' => 'raw',
			'value' => $model->testsetings->idEducation->education_level,
		),
		array(
			'name' => 'Invitations',
			'type' => 'raw',
			'value' => $model->testsetings->getInvitations(),
		),
		array(
			'name' => 'text_before_test',
			'type' => 'raw',
			'value' => $model->testsetingsmult->text_before_test,
		),
		array(
			'name' => 'text_after_test',
			'type' => 'raw',
			'value' => $model->testsetingsmult->text_after_test,
		),
		array(
			'name' => 'invitation_topic',
			'type' => 'raw',
			'value' => $model->testsetingsmult->invitation_topic,
		),
		array(
			'name' => 'invitation_text',
			'type' => 'raw',
			'value' => $model->testsetingsmult->invitation_text,
		),
		array(
			'name' => 'test_song',
			'type' => 'raw',
			'value' => $model->testsetingsmult->test_song,
		),
	),
)); ?>
