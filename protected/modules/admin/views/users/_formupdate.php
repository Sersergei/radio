<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

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

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'admin_name'); ?>
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
        <br>
        <?php echo Yii::t('radio','YYYY-MM-DD'); ?>
        <?php
        $this->widget('CMaskedTextField',array(
            'mask'=>'9999-99-99',
            'value'=>$model->date_birth,
            'placeholder'=>'x',
            'model'=>$model,
            'name'=>'date_birth',

        ));
       ?>
        <?php echo $form->error($model,'date_birth'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'sex'); ?>
        <?php echo $form->DropDownList($model,'sex',array(1=>Yii::t('radio', 'Man'),2=>Yii::t('radio', 'Woman')),array('empty' => '')); ?>
        <?php echo $form->error($model,'sex'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'admin_region'); ?>
        <?php echo $form->DropDownList($model,'region', TestSettings::getregion($model->id_radiostation),array('empty' => '')); ?>
        <?php echo $form->error($model,'region'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'education'); ?>
        <?php echo $form->DropDownList($model,'id_education', EducationMult::all(),array('empty' => '')); ?>
        <?php echo $form->error($model,'id_education'); ?>
    </div>
    <div class="row1">
        <?php echo $form->labelEx($model,'admin_P1'); ?>
        <?php echo $form->DropDownList($model,'P1',RadiostationSettings::getradiostation($model->id_radiostation),array('empty' => '')); ?>
        <?php echo $form->error($model,'P1'); ?>
    </div>
    <br>
    <div class="row2" >
        <?php echo $form->labelEx($model,'admin_P2'); ?>
        <?php echo $form->DropDownList($model,'P2',RadiostationSettings::getradiostation($model->id_radiostation),array('empty' => '')); ?>
        <?php echo $form->error($model,'P2'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->