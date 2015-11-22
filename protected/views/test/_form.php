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
		<?php echo $form->labelEx($model,'never'); ?>
		<?php echo $form->radioButton($model,'never',array('never'=>'Never')); ?>
		<?php echo $form->error($model,'never'); ?>
	</div>

	<div class="radio">

		<?php echo $form->radioButtonList($model,'id_like',SongLikesMult::all(),array( 'separator'=>'',
			'labelOptions'=> array('style' => 'display: inline'))); ?>
		<?php echo $form->error($model,'id_like'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Next'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->