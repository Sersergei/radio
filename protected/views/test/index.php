<div class="message">
<h1><?php echo $message ?></h1>
<?php echo $model; ?><br>
<?php echo CHtml::button(Yii::t('radio', 'Next'), array('class'=>'never','submit' => array('test/'.$buton))); ?>
</div>