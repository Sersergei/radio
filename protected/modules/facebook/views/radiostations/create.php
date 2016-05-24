<h1></h1>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/player.js', CClientScript::POS_HEAD); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'test-settings-mult-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

<table class="testsong">
    <tr>
        <td width="100%">
            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="724" height="197">
                <tr>
                    <td width="9" height="472" rowspan="11"></td>
                    <td width="625" height="86" colspan="4"></td>
                    <td width="90" height="472" rowspan="11"></td>
                </tr>
                <tr>
                    <td width="288" height="40" colspan="3"></td>
                    <td width="337" height="40" align="left" valign="top">
                      <?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                        'id'=>'progress',
                        'value'=>$progress,
                        'htmlOptions'=>array(
                        'style'=>'width:292px; height:30px; float:left;'
                        ),
                        ));?>

                </tr>
                <tr>
                    <td width="95" height="152" rowspan="5"></td>
                    <td width="498" height="37" colspan="3" style="text-align: center; font-size: 18px" ><?php echo Yii::t('radio','What do you think about this song?'); ?></td>
                </tr>
                <tr>
                    <td width="337" height="29" colspan="3" align="right">
                        <div class="divnever" style="background: 0px;width: 337px; text-align: center;">
                            <?php echo Yii::t('radio','Even if you don`t know the song, do you like it?'); ?>
                        </div>
                        <?php echo CHtml::Button(Yii::t('radio','I never heard of it'),array('class'=>'em1')); ?>
                    </td>
                </tr>
                <tr>
                    <td width="161" height="93" colspan="2" rowspan="3" align="left">
                        <div class="lm-inner">
                            <div class="controls">
                                <a href="javascript:void(0)" class="play" style="display: none;" onclick="document.getElementById('player').play()"></a>
                                <a href="javascript:void(0)" class="pause " style="display: block;" onclick="document.getElementById('player').pause()"></a>
                            </div>
                            <div class="lm-track lmtr-top">
                                <audio id="player" class="track_player" src="<?php echo $song ?>" autoplay></audio>
                            </div>
                        </div>
                        <div align="left"> <?php echo Yii::t('radio','If you wanna listen this song again, click the button please!') ?></div> </td>
                    <td width="337" height="29" align="right">
                        <div class="em22"></div>
                        <?php echo CHtml::submitButton(Yii::t('radio','I love it'),array('class'=>'em2')); ?>
                        </td>
                </tr>
                <tr>
                    <td width="337" height="29" align="right">
                        <div class="em32"></div>
                        <?php echo CHtml::submitButton(Yii::t('radio','I just like it'),array('class'=>'em3')); ?>
                    </td>

                </tr>
                <tr>
                    <td width="337" height="29" align="right">
                        <div class="em42"></div>
                        <?php echo CHtml::submitButton(Yii::t('radio','I would listen to it'),array('class'=>'em4','id'=>'em4')); ?>
                    </td>
                </tr>
                <tr>
                    <td width="127" height="69" colspan="2" rowspan="3" align="right" valign="bottom">
                        <div>
                        <a class="previus" href="Repeat"></a>
                        </div>
                    </td>
                    <td width="161" height="32" align="right"></td>
                    <td width="337" height="29" align="right">
                        <div class="em52"><?php echo CHtml::submitButton(Yii::t('radio','I`m tired of it'),array('class'=>'em5','id'=>'em5'));  ?></div>

                    </td>
                </tr>
                <tr>
                    <td width="161" height="29" style="font-size: 12px"><?php echo Yii::t('radio','listen a previous song again')?></td>
                    <td width="337" height="29" align="right">
                        <?php echo CHtml::submitButton(Yii::t('radio','I don`t like it'),array('class'=>'em6')); ?>
                      </td>
                </tr>
                <tr>
                    <td width="161" height="17"></td>
                    <td width="337" height="17" align="right"></td>
                </tr>
                <tr>
                    <td width="625" height="116" colspan="4"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<?php $this->endWidget(); ?>