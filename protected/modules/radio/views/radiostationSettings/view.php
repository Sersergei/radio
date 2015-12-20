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
	array('label'=>'Update My mix-marker', 'url'=>array('updatemixmarker', 'id'=>$model->id_radio_settings)),
	array('label'=>'Update God mix-marker', 'url'=>array('updategodmixmarker', 'id'=>$model->id_radio_settings)),
	array('label'=>'Update Bed mix-marker', 'url'=>array('updatebedmixmarker', 'id'=>$model->id_radio_settings)),
	array('label'=>'Update Test Settings Text', 'url'=>array('testSettingsMult/update', 'id'=>$testsetingsmult->id_test_mult)),
	array('label'=>'Update Test Settings', 'url'=>array('testSettings/update', 'id'=>$testsetings->id_test_settings)),
	array('label'=>'Update Radiostation Settings', 'url'=>array('update', 'id'=>$model->id_radio_settings)),

);
?>

<h1>View Radiostation Settings </h1>

<?php

$this->widget('zii.widgets.CDetailView', array(
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

	),
)); ?>
