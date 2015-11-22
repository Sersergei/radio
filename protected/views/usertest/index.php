<?php
/* @var $this UsertestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usertests',
);

$this->menu=array(
	array('label'=>'Create Usertest', 'url'=>array('create')),
	array('label'=>'Manage Usertest', 'url'=>array('admin')),
);
?>

<h1>Usertests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
