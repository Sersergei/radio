<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'radiostation-settings-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,''); ?>
        <?php echo $form->checkboxList($model,'mixmarker',Mixmarker::all()); ?>
        <?php echo $form->error($model,'id_lang'); ?>
    </div>


    <input type="hidden" name="lable" value="2">
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Next' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->