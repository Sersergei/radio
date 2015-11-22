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



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'music-test-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_test',
		array(
			'name' => 'id_radiostation',
			'type' => 'raw',
			'value' => '$data->id_radiostation',
			'filter'=>false,
		),
		array(
			'name' => 'id_type',
			'type' => 'raw',
			'value' => '$data->type->type_name',
		),


		array(
			'name' => 'date_add',
			'type' => 'raw',
			'value' => '$data->date_add',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'date_add',
				'language'=>Yii::app()->language,
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd',
					'changeMonth' => 'true',
					'changeYear'=>'true',
				),
			),true),
		),
		array(
			'name' =>'date_started',
			'type' => 'raw',
			'value' => '$data->date_started',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'date_started',
				'language'=>Yii::app()->language,
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd',
					'changeMonth' => 'true',
					'changeYear'=>'true',
				),
			),true),
		),
		array(
			'name' =>'date_finished',
			'type' => 'raw',
			'value' => '$data->date_finished',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'date_finished',
				'language'=>Yii::app()->language,
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd',
					'changeMonth' => 'true',
					'changeYear'=>'true',
				),
			),true),
		),
		array(
			'name' => 'id_status',
			'type' => 'raw',
			'value' => '$data->getStatus()',
		),
		array(
			'name' => 'max_listeners',
			'type' => 'raw',
			'value' => '$data->getMaxLisners()',
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
	'afterAjaxUpdate'=>"function() {
        jQuery('#MusicTest_date_add,#MusicTest_date_started,#MusicTest_date_finished').datepicker(jQuery.extend(jQuery.datepicker.regional['".Yii::app()->language."'],{
                                            'showAnim':'fold',
                                            'dateFormat':'yy-mm-dd',
                                            'changeMonth':'true',
                                            'changeYear':'true'}));
    }",
)); ?>
