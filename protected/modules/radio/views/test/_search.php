<?php
/* @var $this UsertestController */
/* @var $model Usertest */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',

)); ?>
<div class="chek">
	<div class="sex">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->checkBoxList($model,'sex',array(1=>Yii::t('radio', 'Man'),2=>Yii::t('radio', 'Woman'))); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>
</div>
	<div class="row">
		<?php echo $form->labelEx($model,'age_from'); ?>
		<?php echo $form->textField($model,'age_from',array( 'separator'=>'<p>')); ?>
		<?php echo $form->error($model,'age_from'); ?>

		<?php echo $form->textField($model,'after_age'); ?>
		<?php echo $form->error($model,'after_age'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_education'); ?>
		<?php echo $form->checkBoxList($model,'id_education',EducationMult::all()); ?>
		<?php echo $form->error($model,'id_education'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->