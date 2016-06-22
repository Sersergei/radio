<?php
/* @var $this RadiostationListController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Radiostation Lists',
);

$this->menu=array(
	array('label'=>'Create RadiostationList', 'url'=>array('create')),
	array('label'=>'Manage RadiostationList', 'url'=>array('admin')),
);
?>

<h1>Radiostation Lists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
