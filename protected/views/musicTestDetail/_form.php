<?php
/* @var $this MusicTestDetailController */
/* @var $model MusicTestDetail */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'music-test-detail-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_test_det'); ?>
		<?php echo $form->textField($model,'id_test_det'); ?>
		<?php echo $form->error($model,'id_test_det'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_test'); ?>
		<?php echo $form->textField($model,'id_test'); ?>
		<?php echo $form->error($model,'id_test'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
		<?php echo $form->error($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_last'); ?>
		<?php echo $form->textField($model,'date_last'); ?>
		<?php echo $form->error($model,'date_last'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'finaly'); ?>
		<?php echo $form->textField($model,'finaly'); ?>
		<?php echo $form->error($model,'finaly'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_song'); ?>
		<?php echo $form->textField($model,'id_song'); ?>
		<?php echo $form->error($model,'id_song'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_like'); ?>
		<?php echo $form->textField($model,'id_like'); ?>
		<?php echo $form->error($model,'id_like'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->