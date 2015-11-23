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