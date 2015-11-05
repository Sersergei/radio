<?php
/* @var $this MusicTestDetailController */
/* @var $model MusicTestDetail */

$this->breadcrumbs=array(
	'Music Test Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MusicTestDetail', 'url'=>array('index')),
	array('label'=>'Manage MusicTestDetail', 'url'=>array('admin')),
);
?>

<h1>Create MusicTestDetail</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>