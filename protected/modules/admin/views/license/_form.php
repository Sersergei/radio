<?php
/* @var $this LicenseController */
/* @var $model License */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'license-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_radiostation'); ?>
		<?php echo $form->DropDownList($model,'id_radiostation',Radistations::all()); ?>
		<?php echo $form->error($model,'id_radiostation'); ?>
	</div>

	<div class="row">
		<label for="date"><?php echo Yii::t('radio', 'Date Finished'); ?></label>
		<?php

		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			'name'=>'License[date_finished]',
			'model'=>$model,
			'attribute'=>'date',
			// additional javascript options for the date picker plugin
			'options'=>array(
				'dateFormat'=>'yy-mm-dd',
				'showAnim'=>'fold',
			),
			'language'=>Yii::app()->language,
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'test_count'); ?>
		<?php echo $form->textField($model,'test_count'); ?>
		<?php echo $form->error($model,'test_count'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->