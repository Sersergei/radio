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

<?php

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$radiostation,
	'attributes'=>array(
		array(
			'name' => 'id_radiostation',
			'type' => 'raw',
			'value' => $radiostation->Radiostation->name,
		),
		array(
			'name' => 'id_lang',
			'type' => 'raw',
			'value' => $radiostation->idLang->name,
		),
		'test_song',
		array(
			'name' => 'not_use_music_marker',
			'type' => 'raw',
			'value' => $radiostation->getnot_use_music_marker(),
		),
		array(
			'name' => 'not_register_users',
			'type' => 'raw',
			'value' => $radiostation->getnot_register_users(),
		),
		array(
			'name' => 'not_invite_users',
			'type' => 'raw',
			'value' => $radiostation->getnot_invite_users(),
		),
		array(
			'name' => 'id_card_registration',
			'type' => 'raw',
			'value' => $radiostation->getid_card_registration(),
		),
		array(
			'name' => 'mix_marker',
			'type' => 'raw',
			'value' => $radiostation->getmixmarker(),
		),
		array(
			'name' => 'bed_marker',
			'type' => 'raw',
			'value' => $radiostation->getbedmixmarker(),
		),
		array(
			'name' => 'god_marker',
			'type' => 'raw',
			'value' => $radiostation->getgodmixmarker(),
		),

		'other_radiostations',
		array(
			'name' => 'sex',
			'type' => 'raw',
			'value' => $test->getsex(),
		),
		array(
			'name' => 'age_from',
			'type' => 'raw',
			'value' => $test->age_from,
		),
		array(
			'name' => 'after_age',
			'type' => 'raw',
			'value' => $test->after_age,
		),
		array(
			'name' => 'id_education',
			'type' => 'raw',
			'value' => $test->idEducation->education_level,
		),
		array(
			'name' => 'Invitations',
			'type' => 'raw',
			'value' => $test->getInvitations(),
		),
		array(
			'name' => 'text_before_test',
			'type' => 'raw',
			'value' => $testsetingsmult->text_before_test,
		),
		array(
			'name' => 'text_after_test',
			'type' => 'raw',
			'value' => $testsetingsmult->text_after_test,
		),
		array(
			'name' => 'invitation_topic',
			'type' => 'raw',
			'value' => $testsetingsmult->invitation_topic,
		),
		array(
			'name' => 'invitation_text',
			'type' => 'raw',
			'value' => $testsetingsmult->invitation_text,
		),
		array(
			'name' => 'test_song',
			'type' => 'raw',
			'value' => $testsetingsmult->test_song,
		),
	),
)); ?>
