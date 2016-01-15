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


</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usertest-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name' => 'user',
			'type' => 'raw',
			'value' => '$data->user->name_listener',
		),
		array(
			'name' => 'email',
			'type' => 'raw',
			'value' => '$data->user->email',
		),
		array(
			'name' => 'sex',
			'type' => 'raw',
			'value' => '$data->user->sex',
		),
		array(
			'name' => 'P1',
			'type' => 'raw',
			'value' => '$data->user->radio->name',
		),

		'id_music',
		'date',
		'time',

	),
));








?>
<a href="?file=1&type=Excel2007">Скачать отчет Excel</a></br>
<a href="?file=1&type=CSV">Скачать отчет csv</a>
