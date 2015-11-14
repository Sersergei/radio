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
		<?php echo $form->labelEx($model,'test_song'); ?>
		<?php echo $form->checkBox($model,'test_song'); ?>
		<?php echo $form->error($model,'test_song'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text_before_test'); ?>
		<?php $this->widget('application.extensions.ckeditor.CKEditor', array( 'model'=>$model,
			'attribute'=> 'text_before_test',
			'editorTemplate'=>'full', )); ?>
		<?php echo $form->error($model,'text_before_test'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text_after_test'); ?>
		<?php $this->widget('application.extensions.ckeditor.CKEditor', array( 'model'=>$model,
			'attribute'=> 'text_after_test',
			'editorTemplate'=>'full', )); ?>
		<?php echo $form->error($model,'text_after_test'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invitation_topic'); ?>
		<?php echo $form->textField($model,'invitation_topic',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'invitation_topic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invitation_text'); ?>
		<?php $this->widget('application.extensions.ckeditor.CKEditor', array( 'model'=>$model,
			'attribute'=> 'invitation_text',
			'editorTemplate'=>'full', )); ?>
		<?php echo $form->error($model,'invitation_text'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->