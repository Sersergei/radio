<?php
/* @var $this RadiostationListController */
/* @var $model RadiostationList */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'radiostation-list-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_region'); ?>
		<?php echo $form->textField($model,'id_region'); ?>
		<?php echo $form->error($model,'id_region'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_radio'); ?>
		<?php echo $form->textField($model,'name_radio',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name_radio'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->