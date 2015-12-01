<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . Yii::t('radio','Login');

?>
<div id="center">
<h1><?php echo (Yii::t('radio','Login')); ?></h1>



<?php if(Yii::app()->user->hasFlash('error')): ?>

	<div class="success">
		<?php echo Yii::app()->user->getFlash('error'); ?>
	</div>

<?php endif; ?>
</div>

<div class="form">
	<div id="center">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'form1',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


		<?php// echo $form->labelEx($model,'username'); ?>
		<label>
			<?php echo Yii::t('radio','Username') ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</label>

		<label>
			<?php echo Yii::t('radio','Password'); ?>
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>
		</label>
		<?php echo CHtml::submitButton('Login'); ?>

<?php $this->endWidget(); ?>
	</div>
</div><!-- form -->
