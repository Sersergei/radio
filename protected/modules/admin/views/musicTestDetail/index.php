<?php
/* @var $this MusicTestDetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Music Test Details',
);

$this->menu=array(
	array('label'=>'Create MusicTestDetail', 'url'=>array('create')),
	array('label'=>'Manage MusicTestDetail', 'url'=>array('admin')),
);
?>

<h1>Music Test Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
