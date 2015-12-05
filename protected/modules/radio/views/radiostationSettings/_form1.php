<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'radiostation-settings-form',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>


    <?php echo $form->errorSummary($model); ?>
<div class="row">
    <?php echo Chtml::activeFileField($model,'file[]',['multiple'=>true]); ?>
</div>
    <div class="row">
        <?php echo $form->labelEx($model,''); ?>
        <?php echo $form->checkboxList($model,'mixmarker',Mixmarker::all()); ?>
        <?php echo $form->error($model,'id_lang'); ?>
    </div>

    <?php echo $form->textField($model,'lable',array('class'=>'hide','value'=>2)); ?>
    <div class="row buttons">
        <?php echo CHtml::submitButton( 'Next'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->