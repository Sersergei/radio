<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/mini_player.js', CClientScript::POS_HEAD); ?>
<div id="header-godmix"></div>

    <h1><p><?php echo Yii::t('radio','Mix-markers similiar on format your radiostation') ?></p></h1>

    <p><?php echo Yii::t('radio','We can choose no more 2 mix-marker. If you don\'t find suitable mix markers, we can add no more 2 your mix markers.') ?></p>
<?php

$this->renderPartial('_form1', array('model' => $model));

?>