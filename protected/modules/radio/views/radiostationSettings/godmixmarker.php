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

    <h1><p><?php echo Yii::t('radio','Подходящие миксмаркеры') ?></p></h1>

    <p><?php echo Yii::t('radio','Выберите 2-а миксмаркера') ?></p>
<?php

$this->renderPartial('_form1', array('model' => $model));

?>