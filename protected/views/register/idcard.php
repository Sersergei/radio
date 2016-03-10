<?php
/* @var $this UsersController */
/* @var $model Users */


$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>
<div class="idcard">
<h1><?php echo Yii::t('radio','Registration'); ?></h1>



<?php


$form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'clientOptions'=>array(
		'validateOnChange'=>true,
		'validateOnSubmit'=>true
	),
)); ?>

<p class="note"><?php echo Yii::t('radio','Fields with* are required.') ?> </p>

<?php //echo $form->errorSummary($model); ?>
<div class="row">
	<?php echo $form->labelEx($model,'card'); ?>
	<?php echo $form->textField($model,'card',array('size'=>11,'maxlength'=>11)); ?>
	<?php echo $form->error($model,'card'); ?>
</div>


<div class="row buttons">
	<?php echo CHtml::submitButton(Yii::t('radio','Next')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



