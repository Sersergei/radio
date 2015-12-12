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
		<?php //echo $form->labelEx($model,'never'); ?>
		<?php //echo $form->radioButton($model,'never',array('never'=>'Never')); ?>
		<?php// echo $form->error($model,'never'); ?>
	</div>

	<div class="divnever">
		<?php echo Yii::t('radio','Even if you don`t know the song, do you like it?'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::Button(Yii::t('radio','I never heard of it'),array('class'=>'never')); ?>
		<?php echo CHtml::submitButton(Yii::t('radio','I love it')); ?>
		<?php echo CHtml::submitButton(Yii::t('radio','I just like it')); ?>
		<?php echo CHtml::submitButton(Yii::t('radio','I would listen to it')); ?>
		<?php echo CHtml::submitButton(Yii::t('radio','I`am tired of it')); ?>
		<?php echo CHtml::submitButton(Yii::t('radio','I don`t like it')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->