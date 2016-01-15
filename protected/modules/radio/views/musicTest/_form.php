<?php
/* @var $this MusicTestController */
/* @var $model MusicTest */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'music-test-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_type'); ?>
		<?php echo $form->DropDownList($model,'id_type',Type::all()); ?>
		<?php echo $form->error($model,'id_type'); ?>
	</div>
	<div class="row">
		<label for="MusicTest_date_started"><?php echo Yii::t('radio', 'Date Started'); ?></label>
		<?php

		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			'name'=>'MusicTest[date_started]',
			'model'=>$model,
			'attribute'=>'date_started',
			// additional javascript options for the date picker plugin
			'options'=>array(
				'dateFormat'=>'yy-mm-dd',
				'showAnim'=>'fold',
				'minDate'=>0,
				'readonly'=>'true',
			),
			'language'=>Yii::app()->language,
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		)); ?>
	</div>
	<div class="row">
		<label for="MusicTest_date_finished"><?php echo Yii::t('radio', 'Date Finished'); ?></label>
		<?php

		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
		'name'=>'MusicTest[date_finished]',
			'model'=>$model,
			'attribute'=>'date_finished',
		// additional javascript options for the date picker plugin
		'options'=>array(
			'dateFormat'=>'yy-mm-dd',
			'showAnim'=>'fold',
			'minDate'=>0,

		),
			'language'=>Yii::app()->language,
			'htmlOptions'=>array(
			'style'=>'height:20px;'
		),
		)); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'max_listeners'); ?>
		<?php echo $form->DropDownList($model,'max_listeners',array('unlimited',100,120,150,200,250,300,350,400,450,500,600,700,800,900,1000)); ?>
		<?php echo $form->error($model,'max_listeners'); ?>
	</div>
	<?php
	$this->widget('ext.EAjaxUpload.EAjaxUpload',
		array(
			'id'=>'uploadFile',
			'config'=>array(
				'action'=>Yii::app()->createUrl('/admin/musicTest/upload'),
				'allowedExtensions'=>array("mp3"),//array("jpg","jpeg","gif","exe","mov" and etc...
				'sizeLimit'=>1000*1024*1024,// maximum file size in bytes
				'minSizeLimit'=>1*1024,
				'auto'=>true,
				'multiple' => true,
				'onComplete'=>"js:function(id, fileName, responseJSON){

				  }",
				'messages'=>array(
					'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
					'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
					'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
					'emptyError'=>"{file} is empty, please select files again without it.",
					'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
				),
				'showMessage'=>"js:function(message){ alert(message); }"
			)

		));
	?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->