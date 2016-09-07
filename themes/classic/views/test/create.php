
<h1></h1>


<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'test-settings-mult-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

<div class="testsong_classic">

    <div class="progress-bar_classic">
        <div class="progress">
        <?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
            'id'=>'progress_classic',
            'value'=>$progress,

        ));?>
            </div>
        <div class="text_classic">
            <?php echo Yii::t('radio','What do you think about this song?'); ?>
        </div>
        <div class="divnever">
            <div class="never">
            <?php echo Yii::t('radio','Even if you don`t know the song, do you like it?'); ?>
            </div>
            <?php echo CHtml::Button(Yii::t('radio','I never heard of it'),array('class'=>'em1')); ?>
        </div>
    </div>
    <div class="button">
        <div class="em22"></div>
        <?php echo CHtml::submitButton(Yii::t('radio','I love it'),array('class'=>'em2')); ?>
        <div class="em32"></div>
        <?php echo CHtml::submitButton(Yii::t('radio','I just like it'),array('class'=>'em3')); ?>
        <div class="em42"></div>
        <?php echo CHtml::submitButton(Yii::t('radio','I would listen to it'),array('class'=>'em4','id'=>'em4')); ?>

    </div>
    <div class="navigation">
        <div class="repeat">
            <a class="previus" href="Repeat"></a>
            <div class="beck">
            вернуться назад
            </div>
        </div>

        <div class="lm-inner">
            <div class="controls">
                <a href="javascript:void(0)" class="play" style="display: none;" onclick="document.getElementById('player').play()"></a>
                <a href="javascript:void(0)" class="pause " style="display: block;" onclick="document.getElementById('player').pause()"></a>
            </div>
            <div class="plaer">
                проиграть еще раз
            </div>
            <div class="lm-track lmtr-top">
                <audio id="player" class="track_player" src="<?php echo $song ?>" autoplay></audio>
            </div>
        </div>
    </div>
    <div class="button2">
        <div class="em52">
            <?php echo CHtml::submitButton(Yii::t('radio','I`m tired of it'),array('class'=>'em5','id'=>'em5'));  ?>
        </div>
        <?php echo CHtml::submitButton(Yii::t('radio','I don`t like it'),array('class'=>'em6')); ?>
    </div>
    </div>
<?php $this->endWidget(); ?>