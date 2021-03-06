<?php
/* @var $this RadistationsController */
/* @var $model Radistations */

$this->breadcrumbs=array(
	'Radistations'=>array('index'),
	'Manage',
);
$this->menu=array(
	//array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Radiostation', 'url'=>array('users/create')),
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#radistations-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Radistations</h1>

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
	'id'=>'radistations-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'location',
		array(
			'name' => 'license',
			'type' => 'raw',
			'value' => '$data->getLicenseCount()',
		),
		array(
			'name' => 'license_date',
			'type' => 'raw',
			'value' => '$data->getLicenseDate()',
		),
		array(
			'name' => 'active_test',
			'type' => 'raw',
			'value' => 'count($data->MusicTest(array("condition"=>"id_status=2")))',
		),
		array(
			'name' => 'finished_test',
			'type' => 'html',
			'value' => 'count($data->MusicTest(array("condition"=>"id_status=3")))',
		),
		/*
		array(
			'name' => 'users',
			'type' => 'raw',
			'value' => '$data->finduser()->login',
		),
*/

		'date_add',
		array(
			'name' => 'status',
			'value' => '$data->getstatus()',
		),
		/*
		'songs',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
