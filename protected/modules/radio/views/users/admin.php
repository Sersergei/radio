<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(

);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

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
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_user',
		'name_listener',
		'email',
		'date_birth',
		array(
			'name' => 'sex',
			'type' => 'raw',
			'value' => '$data->getsex()',

		),
		array(
			'name' => 'education',
			'type' => 'raw',
			'value' => '$data->education->education_level',

		),

		'date_add',
		array(
			'name' => 'P1',
			'type' => 'raw',
			'value' => '$data->P1',

		),

		'status',
		/*
		'login',
		'password',
		'date_add',
		'id_category',
		'id_radiostation',
		'mix_marker',
		'id_card',
		'mobile_ID',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
