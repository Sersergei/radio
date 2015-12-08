<div id="header-check"></div>

<?php

$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,

    'attributes'=>array(
/*
        array(
            'name' => 'id_radiostation',
            'type' => 'raw',
            'value' => $model->Radiostation->name,
        ),

        array(
            'name' => 'id_lang',
            'type' => 'raw',
            'value' => $model->idLang->name,
        ),

*/
        array(
            'name' => 'not_use_music_marker',
            'type' => 'raw',
            'value' => $model->getnot_use_music_marker(),
        ),

        array(
            'name' => 'not_register_users',
            'type' => 'raw',
            'value' => $model->getnot_register_users(),
        ),
        array(
            'name' => 'not_invite_users',
            'type' => 'raw',
            'value' => $model->getnot_invite_users(),
        ),
        array(
            'name' => 'id_card_registration',
            'type' => 'raw',
            'value' => $model->getid_card_registration(),
        ),

                array(
                'name' => 'mix_marker',
                'type' => 'raw',
                'value' => $model->getMixmarker(),
                ),

        array(
            'name' => 'bed_marker',
            'type' => 'raw',
            'value' => $model->getbedmixmarker(),
        ),

        array(
            'name' => 'god_marker',
            'type' => 'raw',
            'value' => $model->getgodmixmarker(),
        ),
    ))); ?>
<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'radiostation-settings-form',
        //'htmlOptions' => array('enctype' => 'multipart/form-data'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>


    <div class="row buttons">
        <?php echo CHtml::Button('back',array('onclick'=>'javascript:history.back()','class'=>'back')); ?>
        <?php echo CHtml::Button('return',array('submit'=>array('/radio/radiostationSettings'),'class'=>'return')); ?>
        <?php echo CHtml::submitButton('Next',array('class'=>'next')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->