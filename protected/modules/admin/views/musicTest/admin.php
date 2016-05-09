<?php
/* @var $this MusicTestController */
/* @var $model MusicTest */

$this->breadcrumbs=array(
	'Music Tests'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MusicTest', 'url'=>array('index')),
	array('label'=>'Create MusicTest', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#music-test-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Music Tests</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'music-test-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_test',
		array(
			'name' => 'id_radiostation',
			'value' => '$data->radio->name',
		),
		array(
			'name' => 'id_type',
			'value' => '$data->gettype()',
		),

		'date_add',
		'date_started',
		'date_finished',
		array(
			'name' => 'id_status',
			'value' => '$data->getStatus()',
		),
		array(
			'name' => 'RTD',
			'value' => '$data->getRTD()',
		),
		/*
		'max_listeners',
		'test_number',
		'date_finished',
		*/
		array(
			'class'=>'CButtonColumn',

		),
	),
)); ?>
