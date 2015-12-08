
    <div id="header-mymix"></div>
    <h1><?php echo Yii::t('radio','Add or choose  mix marker') ?></h1>

<p><?php echo Yii::t('radio','We can choose no more 1 mix-marker. If you don\'t find suitable mix markers, we can add no more 1 your mix markers.') ?></p>
<?php

$this->renderPartial('_form1', array('model' => $model));

?>