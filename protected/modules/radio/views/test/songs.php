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
			'value' => '$data->getfavorite(5)*100/count($data)',
		),
		array(
			'name' => 'like',
			'type' => 'raw',
			'value' => '$data->getfavorite(4)*100/count($data)',
		),
		array(
			'name' => 'normal',
			'type' => 'raw',
			'value' => '$data->getfavorite(3)*100/count($data)',
		),
		array(
			'name' => 'tired',
			'type' => 'raw',
			'value' => '$data->getfavorite(2)*100/count($data)',
		),
		array(
			'name' => 'dislike',
			'type' => 'raw',
			'value' => '$data->getfavorite(1)*100/count($data)',
		),
		array(
			'name' => 'never',
			'type' => 'raw',
			'value' => '$data->getnever()*100/count($data)',
		),

	),
)); ?>
<a href="?file=1">Скачать отчет</a>
