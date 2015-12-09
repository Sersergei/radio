
    <div id="header-mymix"></div>
    <h1><?php echo Yii::t('radio','Add or choose  mix marker') ?></h1>

<p><?php echo Yii::t('radio','We can choose no more 1 mix-marker. If you don\'t find suitable mix markers, we can add no more 1 your mix markers.') ?></p>
    <?php
    echo CHtml::beginForm('','post',array('enctype'=>'multipart/form-data'));
    echo CHtml::error($model,'file');

    echo Chtml::activeFileField($model,'file[]',['multiple'=>true]);
    ?>

    <div class="row buttons">
        <?php echo CHtml::Button('back',array('onclick'=>'javascript:history.back()','class'=>'back')); ?>
    <?php echo CHtml::Button('return',array('submit'=>array('/radio/radiostationSettings'),'class'=>'return')); ?>
    <?php echo CHtml::submitButton('Next',array('class'=>'next')); ?>
    </div>
   <?php echo CHtml::endForm(); ?>