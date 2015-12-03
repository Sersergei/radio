<?php
/* @var $this UsertestController */
/* @var $model Usertest */

$this->breadcrumbs=array(
	'Usertests'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usertest-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Usertests</h1>



<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usertest-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

		array(
			'name' => 'id_song',
			'type' => 'raw',
			'value' => '$data->idSong->singer',
		),
		array(
			'name' => 'favorite',
			'type' => 'raw',
			'value' => '$data->id_like',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<a href="?file=1">Скачать отчет</a>
