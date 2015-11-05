<?php
/* @var $this MusicTestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Music Tests',
);

$this->menu=array(
	array('label'=>'Create MusicTest', 'url'=>array('create')),
	array('label'=>'Manage MusicTest', 'url'=>array('admin')),
);
?>

<h1>Music Tests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
