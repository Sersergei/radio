<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/mini_player.js', CClientScript::POS_HEAD); ?>
<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */

$this->breadcrumbs=array(
	'Radiostation Settings'=>array('index'),
	$model->id_radio_settings,
);


$this->menu=array(
	array('label'=>'List RadiostationSettings', 'url'=>array('index')),
<<<<<<< HEAD
	array('label'=>'Update You mixmarker', 'url'=>array('mymix','id'=>$radiostation->id_radio_settings)),
	array('label'=>'Update Bad mixmarker','url'=>array('bedmix','id'=>$radiostation->id_radio_settings)),
	array('label'=>'Update God mixmarker','url'=>array('godmix','id'=>$radiostation->id_radio_settings)),
	array('label'=>'Update God mixmarker','url'=>array('Test songs','id'=>$radiostation->id_radio_settings)),
	array('label'=>'Update RadiostationSettings', 'url'=>array('update', 'id'=>$radiostation->id_radio_settings)),
	array('label'=>'Update  Invitation','url'=>array('/radio/TestSettings/update','id'=>$test->id_test_settings)),
	array('label'=>'Update Text Invitation','url'=>array('/radio/TestSettingsMult/update','id'=>$testsetingsmult->id_test_mult)),

	//array('label'=>'Delete RadiostationSettings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$radiostation->id_radio_settings),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage RadiostationSettings', 'url'=>array('admin')),
);
?>

<h1>View RadiostationSettings #<?php echo $radiostation->id_radio_settings; ?></h1>
=======
	array('label'=>'Update My mix-marker', 'url'=>array('updatemixmarker', 'id'=>$model->id_radio_settings)),
	array('label'=>'Update God mix-marker', 'url'=>array('updategodmixmarker', 'id'=>$model->id_radio_settings)),
	array('label'=>'Update Bed mix-marker', 'url'=>array('updatebedmixmarker', 'id'=>$model->id_radio_settings)),
	array('label'=>'Update Test Settings Text', 'url'=>array('testSettingsMult/update', 'id'=>$testsetingsmult->id_test_mult)),
	array('label'=>'Update Test Settings', 'url'=>array('testSettings/update', 'id'=>$testsetings->id_test_settings)),
	array('label'=>'Update Radiostation Settings', 'url'=>array('update', 'id'=>$model->id_radio_settings)),

);
?>

<h1>View Radiostation Settings </h1>
>>>>>>> test12

<?php

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,

	'attributes'=>array(
<<<<<<< HEAD
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
=======

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
                array(
                    'name' => 'email',
                    'type' => 'raw',
                    'value' => $model->email,
                ),

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
                                'value' => $model->getMixmarker(),
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
                                                'value' => $testsetings->getsex(),
                                                ),

                                                array(
                                                    'name' => 'age_from',
                                                    'type' => 'raw',
                                                    'value' => $testsetings->age_from,
                                                ),
                                                array(
                                                    'name' => 'after_age',
                                                    'type' => 'raw',
                                                    'value' => $testsetings->after_age,
                                                ),
                                                array(
                                                    'name' => 'region',
                                                    'type' => 'raw',
                                                    'value' => $testsetings->region,
                                            ),

                                                array(
                                                    'name' => 'id_education',
                                                    'type' => 'raw',
                                                    'value' => $testsetings->geteducation(),
                                                ),

                                                array(
                                                    'name' => 'Invitations',
                                                    'type' => 'raw',
                                                    'value' => $testsetings->getInvitations(),
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

>>>>>>> test12
	),
)); ?>
