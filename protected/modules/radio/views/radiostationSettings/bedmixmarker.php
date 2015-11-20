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

    <h1><?php echo Yii::t('radio','Неподходящие миксмаркеры') ?></h1>

<p><?php echo Yii::t('radio','Выберите 4-е миксмаркера') ?></p>
<?php

$this->renderPartial('_form1', array('model' => $model));

?>