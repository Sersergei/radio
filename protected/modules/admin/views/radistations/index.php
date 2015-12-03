<?php
/* @var $this RadistationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Radistations',
);

$this->menu=array(
	array('label'=>'Manage Radistations', 'url'=>array('admin')),
);
?>

<h1>Radistations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
