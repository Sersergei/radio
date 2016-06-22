<?php
/* @var $this RadiostationListController */
/* @var $model RadiostationList */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_region'); ?>
		<?php echo $form->textField($model,'id_region'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_radio'); ?>
		<?php echo $form->textField($model,'name_radio',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->