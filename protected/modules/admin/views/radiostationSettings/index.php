<?php
/* @var $this RadiostationSettingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Radiostation Settings',
);

$this->menu=array(
	array('label'=>'Create RadiostationSettings', 'url'=>array('create')),
	array('label'=>'Manage RadiostationSettings', 'url'=>array('admin')),
);
?>

<h1>Radiostation Settings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
