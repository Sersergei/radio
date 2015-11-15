<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_radio_settings'); ?>
		<?php echo $form->textField($model,'id_radio_settings'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_lang'); ?>
		<?php echo $form->textField($model,'id_lang'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'test_song'); ?>
		<?php echo $form->textField($model,'test_song'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'not_use_music_marker'); ?>
		<?php echo $form->textField($model,'not_use_music_marker'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'not_register_users'); ?>
		<?php echo $form->textField($model,'not_register_users'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'not_invite_users'); ?>
		<?php echo $form->textField($model,'not_invite_users'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mix_marker_1'); ?>
		<?php echo $form->textField($model,'mix_marker_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mix_marker_2'); ?>
		<?php echo $form->textField($model,'mix_marker_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mix_marker_3'); ?>
		<?php echo $form->textField($model,'mix_marker_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mix_marker_4'); ?>
		<?php echo $form->textField($model,'mix_marker_4'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mix_marker'); ?>
		<?php echo $form->textField($model,'mix_marker'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_radiostation'); ?>
		<?php echo $form->textField($model,'id_radiostation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'other_radiostations'); ?>
		<?php echo $form->textField($model,'other_radiostations',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_card_registration'); ?>
		<?php echo $form->textField($model,'id_card_registration'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->