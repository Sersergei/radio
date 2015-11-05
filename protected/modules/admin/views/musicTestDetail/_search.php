<?php
/* @var $this MusicTestDetailController */
/* @var $model MusicTestDetail */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_test_det'); ?>
		<?php echo $form->textField($model,'id_test_det'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_test'); ?>
		<?php echo $form->textField($model,'id_test'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_last'); ?>
		<?php echo $form->textField($model,'date_last'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finaly'); ?>
		<?php echo $form->textField($model,'finaly'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_song'); ?>
		<?php echo $form->textField($model,'id_song'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_like'); ?>
		<?php echo $form->textField($model,'id_like'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->