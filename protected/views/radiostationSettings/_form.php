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
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_lang'); ?>
		<?php echo $form->textField($model,'id_lang'); ?>
		<?php echo $form->error($model,'id_lang'); ?>
		язык, на котором будет осуществляться общение со слушателями во время тестирования песен

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'test_song'); ?>
		<?php echo $form->textField($model,'test_song'); ?>
		<?php echo $form->error($model,'test_song'); ?>
		</br>
		загрузить песню для проверки звука (не загружайте одну из песен, которую вы собираетесь тестировать, так как двойное прослушивание повлияет на её результаты)
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

		<?php echo $form->textField($model,'lable',array('class'=>'hide','value'=>1)); ?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Next' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->