<?php
/* @var $this TestSettingsController */
/* @var $model TestSettings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'test-settings-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->DropDownList($model,'sex',array(0=>'',1=>Yii::t('radio', 'Man'),2=>Yii::t('radio', 'Woman'))); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'age_from'); ?>
		<?php echo $form->textField($model,'age_from'); ?>
		<?php echo $form->error($model,'age_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'after_age'); ?>
		<?php echo $form->textField($model,'after_age'); ?>
		<?php echo $form->error($model,'after_age'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_education'); ?>
		<?php echo $form->DropDownList($model,'id_education',EducationMult::all()); ?>
		<?php echo $form->error($model,'id_education'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Invitations'); ?>
		<?php echo $form->DropDownList($model,'Invitations',array(0=>'приглашение всем, кто зарегистрировался, перейдя по ссылке с нашей радиостанции',
																	1=>'приглашение только тем, кто назвал нашу станцию (P1 or P2) и указал микс нашей станции',
																	2=>'приглашение только тем, кто назвал нашу станцию (P1) и указал микс нашей станции',
																	3=>'приглашение только тем, кто указал микс нашей станции')); ?>
		<?php echo $form->error($model,'Invitations'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->