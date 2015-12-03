<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */

$this->breadcrumbs=array(
    'Radiostation Settings'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'List RadiostationSettings', 'url'=>array('index')),
    array('label'=>'Manage RadiostationSettings', 'url'=>array('admin')),
);
?>

    <h1><p><?php echo Yii::t('radio','Mix-markers similiar on format your radiostation') ?></p></h1>

    <p><?php echo Yii::t('radio','We can choose no more 2 mix-marker. If you don\'t find suitable mix markers, we can add no more 2 your mix markers.') ?></p>
<?php

$this->renderPartial('_form1', array('model' => $model));

?>