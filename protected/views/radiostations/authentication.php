<header>
    <div id="lang"><a class="by" href="?lang=ru"></a><a class="en" href="?lang=en"></a><a class="uk" href="?lang=uk"></a> <a class="et" href="?lang=et"></a></div>
</header>
<?php  $path=new ServiceUserIdentity();
$path=$path->seturl(); ?>
<div id="facebook">
    <br>
    <?php echo Yii::t('radio','Login with'); ?>
<a href="<?php echo $path ?>"><img src="/images/facebook_big.jpg" width="150"
                                   height="50" alt="<?php echo Yii::t('radio','Login with Facebook'); ?>"></a>
    <br>
    <?php echo Yii::t('radio','Or'); ?>
    Email
</div>
<div class="registration">

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



    <div class="row">
        <?php //echo $form->labelEx($model,'email'); ?><br><br>
        <?php echo $form->textField($model,'email',array('size'=>40,'maxlength'=>40)); ?><br><br>
        <?php echo $form->error($model,'email'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('radio','Next')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
