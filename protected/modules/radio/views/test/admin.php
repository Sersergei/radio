<?php
/* @var $this UsertestController */
/* @var $model Usertest */

$this->breadcrumbs=array(
	'Usertests'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Usertest', 'url'=>array('index')),
	array('label'=>'Create Usertest', 'url'=>array('create')),
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
	'id'=>'usertest-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name' => 'user',
			'type' => 'raw',
			'value' => '$data->getuser($data->id_user,"name_listener")',
		),
		/*array(
			'name' => 'email',
			'type' => 'raw',
			'value' => '$data->user->email',
		),
		array(
			'name' => 'sex',
			'type' => 'raw',
			'value' => '$data->getuser->sex',
		),
		array(
			'name' => 'P1',
			'type' => 'raw',
			'value' => '$data->user->radio->name',
		),
*/
		'id_music',
		'date',
		'time',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<a href="?file=1">Скачать отчет</a>
