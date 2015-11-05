<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name_listener'); ?>
		<?php echo $form->textField($model,'name_listener',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name_listener'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_birth'); ?>
		<?php echo $form->textField($model,'date_birth'); ?>
		<?php echo $form->error($model,'date_birth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->textField($model,'sex'); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_education'); ?>
		<?php echo $form->textField($model,'id_education'); ?>
		<?php echo $form->error($model,'id_education'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_add'); ?>
		<?php echo $form->textField($model,'date_add'); ?>
		<?php echo $form->error($model,'date_add'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_category'); ?>
		<?php echo $form->textField($model,'id_category'); ?>
		<?php echo $form->error($model,'id_category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_radiostation'); ?>
		<?php echo $form->textField($model,'id_radiostation'); ?>
		<?php echo $form->error($model,'id_radiostation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mix_marker'); ?>
		<?php echo $form->textField($model,'mix_marker',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'mix_marker'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'P1'); ?>
		<?php echo $form->textField($model,'P1'); ?>
		<?php echo $form->error($model,'P1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_card'); ?>
		<?php echo $form->textField($model,'id_card'); ?>
		<?php echo $form->error($model,'id_card'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile_ID'); ?>
		<?php echo $form->textField($model,'mobile_ID'); ?>
		<?php echo $form->error($model,'mobile_ID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->