<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'radiostation-settings-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_lang'); ?>
		<?php echo $form->DropDownList($model,'id_lang',Lang::all()); ?>
		<?php echo $form->error($model,'id_lang'); ?>
		<br>
		<?php echo Yii::t('radio','Language for music-test') ?>


	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'never_test'); ?>
		<?php echo $form->checkBox($model,'never_test'); ?>
		<?php echo $form->error($model,'never_test'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'not_use_music_marker'); ?>
		<?php echo $form->checkBox($model,'not_use_music_marker'); ?>
		<?php echo $form->error($model,'not_use_music_marker'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'not_register_users'); ?>
		<?php echo $form->checkBox($model,'not_register_users'); ?>
		<?php echo $form->error($model,'not_register_users'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'not_invite_users'); ?>
		<?php echo $form->checkBox($model,'not_invite_users'); ?>
		<?php echo $form->error($model,'not_invite_users'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'id_card_registration'); ?>
		<?php echo $form->checkBox($model,'id_card_registration'); ?>
		<?php echo $form->error($model,'id_card_registration'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'other_radiostations'); ?>
		<?php echo $form->textField($model,'other_radiostations',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'other_radiostations'); ?>
		<br>
		<?php echo Yii::t('radio','Add all radiostations of your regions (separate them with commas)') ?>
	</div>





	<div class="row button">
		<?php echo CHtml::Button('sdfsd',array('submit'=>array('/radio'),'class'=>'back')); ?>
		<?php echo CHtml::submitButton('Next',array('class'=>'next')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->