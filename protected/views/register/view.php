
<?php $form=$this->beginWidget('CActiveForm', array(
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

<div class="row">
	<?php echo $form->labelEx($model,'mixmarker'); ?>
	<br>
	<p><input name="mixmarker" type="radio" value="<?php echo $arr[0] ?>"><?php echo $mix[$arr[0]];?></p>
	<p><input name="mixmarker" type="radio" value="<?php echo $arr[1] ?>"><?php echo $mix[$arr[1]];?></p>
	<p><input name="mixmarker" type="radio" value="<?php echo $arr[2] ?>"><?php echo $mix[$arr[2]];?></p>
	<p><input name="mixmarker" type="radio" value="<?php echo $arr[3] ?>"><?php echo $mix[$arr[3]];?></p>
	<p><input name="mixmarker" type="radio" value="<?php echo $arr[4] ?>"><?php echo $mix[$arr[4]];?></p>


	<?php echo $form->error($model,'mixmarker'); ?>
</div>
<div class="row buttons">
	<?php echo CHtml::submitButton('Next'); ?>
</div>

<?php $this->endWidget(); ?>