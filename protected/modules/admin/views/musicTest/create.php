<?php
/* @var $this MusicTestController */
/* @var $model MusicTest */

$this->breadcrumbs=array(
	'Music Tests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MusicTest', 'url'=>array('index')),
	array('label'=>'Manage MusicTest', 'url'=>array('admin')),
);
?>

<h1>Create MusicTest</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>