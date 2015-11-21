<?php
/* @var $this TestSettingsMultController */
/* @var $model TestSettingsMult */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'test-settings-mult-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'id_test'); ?>
		<?php echo $form->textField($model,'id_test',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'id_test'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_song'); ?>
		<?php echo $form->textField($model,'id_song',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'id_song'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'id_like'); ?>
		<?php echo $form->radioButtonList($model,'id_like',SongLikesMult::all()); ?>
		<?php echo $form->error($model,'id_like'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->