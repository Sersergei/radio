<?php
/* @var $this TestSettingsMultController */
/* @var $model TestSettingsMult */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_test_mult'); ?>
		<?php echo $form->textField($model,'id_test_mult'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_radiostations'); ?>
		<?php echo $form->textField($model,'id_radiostations'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'text_before_test'); ?>
		<?php echo $form->textField($model,'text_before_test',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'text_after_test'); ?>
		<?php echo $form->textField($model,'text_after_test',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invitation_topic'); ?>
		<?php echo $form->textField($model,'invitation_topic',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invitation_text'); ?>
		<?php echo $form->textField($model,'invitation_text',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'test_song'); ?>
		<?php echo $form->textField($model,'test_song'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->