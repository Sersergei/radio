
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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'name_listener'); ?>
		<?php echo $form->textField($model,'name_listener',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name_listener'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>20,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'date_birth'); ?>
		<?php

		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			'name'=>'date_birth',
			'model'=>$model,
			'attribute'=>'date_birth',
			// additional javascript options for the date picker plugin
			'options'=>array(
				'dateFormat'=>'yy-mm-dd',
				'showAnim'=>'fold',
				'changeMonth' => 'true',
				'changeYear'=>'true',
				'maxDate'=>-365*14,
				'minDate'=>-365*80,
				'readonly'=>'true',
			),
			'language'=>Yii::app()->language,
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		)); ?>
		<?php echo $form->error($model,'date_birth'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->DropDownList($model,'sex',array(1=>Yii::t('radio', 'Man'),2=>Yii::t('radio', 'Woman'))); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'id_education'); ?>
		<?php echo $form->DropDownList($model,'id_education', EducationMult::all()); ?>
		<?php echo $form->error($model,'id_education'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'P1'); ?>
		<?php echo $form->DropDownList($model,'P1',RadiostationSettings::getradiostation($model->id_radiostation)); ?>
		<?php echo $form->error($model,'P1'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'P2'); ?>
		<?php echo $form->DropDownList($model,'P2',RadiostationSettings::getradiostation($model->id_radiostation)); ?>
		<?php echo $form->error($model,'P2'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
Yii::app()->clientScript->registerScript('loading', '
var audioPlayer = document.getElementById("audioplayer"),
audioTrack = document.getElementById("audiotrack"),
playButton = document.createElement("button");
playButton.type = "button";
audioPlayer.appendChild(playButton);
audioTrack.removeAttribute("controls");


var muteButton = document.createElement("button");
setText(muteButton,"Mute");
muteButton.type = "button";
audioPlayer.appendChild(muteButton);
muteButton.addEventListener("click", muter);
function muter() {
if (audioTrack.volume == 0) {
setText(this,"Mute");
audioTrack.volume = 1;
} else {
setText(this,"Unmute");
audioTrack.volume = 0;
} }
', CClientScript::POS_READY);
?>