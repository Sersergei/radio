<header></header>
<h1><?php echo $message ?></h1>
<?php echo $model; ?><br>
<br>
<div class="row buttons" align="right">
    <?php echo CHtml::button( Yii::t('radio','finish test'),array('submit'=>array($url))); ?>
</div>
<br>
<?php $this->renderPartial('_messages', array('messages'=>$messages)); ?>
