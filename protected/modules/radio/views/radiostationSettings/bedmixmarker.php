<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/mini_player.js', CClientScript::POS_HEAD); ?>
<div id="header-bedmix"></div>

    <h1><?php echo Yii::t('radio','Add or choose unsuitable mix marker') ?></h1>

<p><?php echo Yii::t('radio','We can choose no more.').$i; ?></p>
<?php

$this->renderPartial('_form1', array('model' => $model));

?>