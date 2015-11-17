
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
	<?php echo $form->labelEx($model,'name_listener'); ?>
	<?php echo $form->radioButtonList($model,'Mixmarker',$arr); ?>
	<?php echo $form->error($model,'name_listener'); ?>
</div>
