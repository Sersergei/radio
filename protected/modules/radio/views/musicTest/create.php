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
<p>last call-out test name: <?php if($colaut) echo $colaut->name; ?></p>
<p>last AMT test name: <?php if($amt) echo $amt->name; ?></p>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
?>
