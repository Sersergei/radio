<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/mini_player.js', CClientScript::POS_HEAD); ?>
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
<div class="chosemix">
<div class="row">
	<?php echo Yii::t('radio','Choose one music-mix, which you like more than other') ?>
	<br>
	<table class="mix">
		<tr>
		<td><?php echo $mix[$arr[0]];?><input  name="mixmarker" type="radio"  value="<?php echo $arr[0] ?>">
			</td>

		</tr>
				<tr>
			<td><?php echo $mix[$arr[1]];?><input name="mixmarker" type="radio" value="<?php echo $arr[1] ?>"></td>
		</tr>
		<tr>
			<td ><?php echo $mix[$arr[2]];?><input name="mixmarker" type="radio" value="<?php echo $arr[2] ?>"></td>
		</tr>
		<tr>
			<td><?php echo $mix[$arr[3]];?><input name="mixmarker" type="radio" value="<?php echo $arr[3] ?>"></td>
		</tr>
		<tr>
			<td><?php echo $mix[$arr[4]];?><input name="mixmarker" type="radio" value="<?php echo $arr[4] ?>"></td>
		</tr>

	</table>

	<?php echo $form->error($model,'mixmarker'); ?>
	<div class="mixs" float="left" border-reight="30px">
		<?php echo CHtml::submitButton(Yii::t('radio','Next')); ?>
	</div>
</div>

</div>
<?php $this->endWidget(); ?>