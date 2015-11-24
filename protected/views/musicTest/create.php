<?php
/* @var $this MusicTestController */
/* @var $model MusicTest */

$this->breadcrumbs=array(
	'Music Tests'=>array('index'),
	'Create',
);

$this->menu=array(

	array('label'=>'Manage MusicTest', 'url'=>array('index')),
);
?>

<h1>Create MusicTest</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>