

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
    <?php //echo Chtml::activeFileField($model,'file[]',['multiple'=>true]); ?>
</div>
    <div class="main">
    <div class="mix">

        <?php echo $form->checkboxList($model,'mixmarker',Mixmarker::all(),array('separator'=>'<td>','labelOptions'=>array('style'=>'display:inline'))); ?>
        <?php echo $form->error($model,'id_lang'); ?>
    </div>
</div>
    <?php echo $form->textField($model,'lable',array('class'=>'hide','value'=>2)); ?>
    <div class="row buttons">
        <?php echo CHtml::Button('back',array('onclick'=>'javascript:history.back()','class'=>'back')); ?>
        <?php echo CHtml::Button('return',array('submit'=>array('/radio/radiostationSettings'),'class'=>'return')); ?>
        <?php echo CHtml::submitButton('Next',array('class'=>'next')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->