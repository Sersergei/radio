<?php
/* @var $this UsertestController */
/* @var $model Usertest */
/* @var $form CActiveForm */
?>

<div id="filter">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',

)); ?>
<div class="chek">
	<div class="sex">
		<p>
		<?php echo $form->labelEx($model,'sex'); ?></p>
		<?php echo $form->checkBoxList($model,'sex',array(1=>Yii::t('radio', 'Man'),2=>Yii::t('radio', 'Woman')));?>
		<?php echo $form->error($model,'sex'); ?>
	</div>
</div>
	<div class="row">
		<p><?php echo $form->labelEx($model,'age_from'); ?></p>
		from
		<?php echo $form->textField($model,'age_from'); ?>
		<?php echo $form->error($model,'age_from'); ?>
		to
		<?php echo $form->textField($model,'after_age'); ?>
		<?php echo $form->error($model,'after_age'); ?>
	</div>
	<table>
		<tr>
			<td style=" vertical-align: top; ">
				<p><?php echo $form->labelEx($model,'region'); ?></p>

				<?php echo $form->checkBoxList($model,'region',TestSettings::getregion($model->idTest->id_radiostation)); ?>
				<?php echo $form->error($model,'region'); ?>
			</td>
			<td style=" vertical-align: top; ">
				<p><?php echo $form->labelEx($model,'id_education'); ?></p>

				<?php echo $form->checkBoxList($model,'id_education',EducationMult::all()); ?>
				<?php echo $form->error($model,'id_education'); ?>
			</td>
		</tr>
		<tr>
			<td style=" vertical-align: top; ">

				<p><?php echo $form->labelEx($model,'P1'); ?></p>


				<?php echo $form->checkBoxList($model,'P1',RadiostationSettings::getradiostation($model->idTest->id_radiostation)); ?>
				<?php echo $form->error($model,'P1'); ?>

			</td>
			<td style=" vertical-align: top; ">
				<p><?php echo $form->labelEx($model,'P2'); ?></p>
				<?php echo $form->checkBoxList($model,'P2',RadiostationSettings::getradiostation($model->idTest->id_radiostation)); ?>
				<?php echo $form->error($model,'P2'); ?>
			</td>
		</tr>
	</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->