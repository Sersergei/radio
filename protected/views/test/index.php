
<header>
    <div id="lang"><a class="by" href="?lang=ru"></a><a class="en" href="?lang=en"></a><a class="uk" href="?lang=uk"></a> <a class="et" href="?lang=et"></a></div>
</header>
<div class="message">
<?php echo $model; ?><br>
<?php echo CHtml::button(Yii::t('radio', 'Next'), array('class'=>'never','submit' => array('test/'.$buton))); ?>
</div>