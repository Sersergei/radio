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
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name'); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
    <div class="row">
        <label for="MusicTest_date_started"><?php echo Yii::t('radio', 'Date Started'); ?></label>
        <?php

        $this->widget ('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',
            array(
                'model'=>$model, //Model object
                'attribute'=>'date_started', //attribute name
                'mode'=>'datetime', //use "time","date" or "datetime" (default)
                'language'=>Yii::app()->language,
                'options'=>array(
                    'regional'=>'',
                    'dateFormat'=>'yy-mm-dd',
                    'showAnim'=>'fold',
                    'minDate'=>0,
                    'readonly'=>'true',
                ) // jquery plugin options
            )); ?>
    </div>
    <div class="row">
        <label for="MusicTest_date_finished"><?php echo Yii::t('radio', 'Date Finished'); ?></label>
        <?php

        $this->widget ('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',
            array(
                'model'=>$model, //Model object
                'attribute'=>'date_finished', //attribute name
                'mode'=>'datetime', //use "time","date" or "datetime" (default)
                'language'=>Yii::app()->language,
                'options'=>array(
                    'regional'=>'',
                    'dateFormat'=>'yy-mm-dd',
                    'showAnim'=>'fold',
                    'minDate'=>0,
                    'readonly'=>'true',
                ) // jquery plugin options
            )); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'max_listeners'); ?>
        <?php echo $form->DropDownList($model,'max_listeners',array('unlimited',100,120,150,200,250,300,350,400,450,500,600,700,800,900,1000)); ?>
        <?php echo $form->error($model,'max_listeners'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'id_status'); ?>
        <?php echo $form->DropDownList($model,'id_status',array(1=>Yii::t('radio','Ready'),2=>Yii::t('radio','Started'),3=>Yii::t('radio','Finished'))); ?>
        <?php echo $form->error($model,'id_status'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->