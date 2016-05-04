<div class="form" style="margin-left: 20%">
<?php $form=$this->beginWidget('CActiveForm',array(
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
    <div class="form">
    <div class="row">
    <?php echo $form->labelEx($model,'image'); ?>
    <?php echo $form->fileField($model,'image'); ?>
    <?php echo $form->error($model,'image'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Create'); ?>
        </div>
    </div>
    <br>
    <div class="form">
<?php if($model->image){
    echo $baner;
} ?>
    </div>
<?php $this->endWidget(); ?>
    <div>
        <?php if($model->image)
            echo CHtml::activeTextArea($model,'message',array('value'=>$baner,'cols'=>70,'rows'=>10)); ?>
    </div>
    </div>
