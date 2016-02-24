<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'users-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
    'clientOptions'=>array(
        'validateOnChange'=>false,
        'validateOnSubmit'=>true
    ),
)); ?>
<div class="row">
    <?php echo $form->labelEx($mes,'message'); ?><br>
    <?php echo $form->textArea($mes,'message',array('rows'=>6,
                                                    'cols'=>50
                                                    )); ?>


    <?php echo $form->error($mes,'message'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::button( Yii::t('radio','Send'),array('submit'=>array('test/messages'))); ?>
</div>

<?php $this->endWidget(); ?>

