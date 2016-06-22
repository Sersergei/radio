<?php
/* @var $this RadiostationListController */
/* @var $model RadiostationList */

$this->breadcrumbs=array(
	'Radiostation Lists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RadiostationList', 'url'=>array('index')),
	array('label'=>'Manage RadiostationList', 'url'=>array('admin')),
);
?>

<h1>Create RadiostationList</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>