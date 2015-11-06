<?php
/* @var $this MusicTestController */
/* @var $model MusicTest */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_test'); ?>
		<?php echo $form->textField($model,'id_test'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_radiostation'); ?>
		<?php echo $form->textField($model,'id_radiostation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_type'); ?>
		<?php echo $form->textField($model,'id_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_add'); ?>
		<?php echo $form->textField($model,'date_add'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_started'); ?>
		<?php echo $form->textField($model,'date_started'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_control'); ?>
		<?php echo $form->textField($model,'id_control'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_listeners'); ?>
		<?php echo $form->textField($model,'max_listeners'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'test_number'); ?>
		<?php echo $form->textField($model,'test_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_finished'); ?>
		<?php echo $form->textField($model,'date_finished'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->