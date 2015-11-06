<?php
/* @var $this MusicTestController */
/* @var $model MusicTest */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'music-test-form',
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
		<?php echo $form->textField($model,'id_test'); ?>
		<?php echo $form->error($model,'id_test'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_radiostation'); ?>
		<?php echo $form->textField($model,'id_radiostation'); ?>
		<?php echo $form->error($model,'id_radiostation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_type'); ?>
		<?php echo $form->textField($model,'id_type'); ?>
		<?php echo $form->error($model,'id_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_add'); ?>
		<?php echo $form->textField($model,'date_add'); ?>
		<?php echo $form->error($model,'date_add'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_started'); ?>
		<?php echo $form->textField($model,'date_started'); ?>
		<?php echo $form->error($model,'date_started'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_control'); ?>
		<?php echo $form->textField($model,'id_control'); ?>
		<?php echo $form->error($model,'id_control'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_listeners'); ?>
		<?php echo $form->textField($model,'max_listeners'); ?>
		<?php echo $form->error($model,'max_listeners'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'test_number'); ?>
		<?php echo $form->textField($model,'test_number'); ?>
		<?php echo $form->error($model,'test_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_finished'); ?>
		<?php echo $form->textField($model,'date_finished'); ?>
		<?php echo $form->error($model,'date_finished'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->