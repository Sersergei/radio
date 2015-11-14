<?php
/* @var $this TestSettingsController */
/* @var $model TestSettings */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_test_settings'); ?>
		<?php echo $form->textField($model,'id_test_settings'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_radiostation'); ?>
		<?php echo $form->textField($model,'id_radiostation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sex'); ?>
		<?php echo $form->textField($model,'sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'age_from'); ?>
		<?php echo $form->textField($model,'age_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'after_age'); ?>
		<?php echo $form->textField($model,'after_age'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_education'); ?>
		<?php echo $form->textField($model,'id_education'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Invitations'); ?>
		<?php echo $form->textField($model,'Invitations'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->