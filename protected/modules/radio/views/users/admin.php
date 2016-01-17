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

		array(
			'name' => 'admin_name',
			'type' => 'raw',
			'value' => '$data->name_listener',

		),
		'email',
		'age',

		array(
			'name' => 'Sex',
			'type' => 'raw',
			'value' => '$data->getsex()',
			'filter'=>CHtml::activeDropDownList($model,'sex',array(1=>yii::t('radio','Man'),2=>yii::t('radio','Woman')),array(
				'empty'=>'',
			)),

		),
		array(
			'name' => 'education',
			'type' => 'raw',
			'value' => '$data->education->education_level',
			'filter'=>CHtml::activeDropDownList($model,'id_education',EducationMult::all(),array(
				'empty'=>'',
			)),

		),

                'date_add',
                array(
                    'name' => 'admin_P1',
                    'type' => 'raw',
                    'value' => '$data->radio->radiostationSettings->getradio($data->P1)',
                    'filter'=>CHtml::activeDropDownList($model,'id_education',RadiostationSettings::getradiostation($model->id_radiostation),array(
                        'empty'=>'',
                    )),

                ),

            array(
                'name' => 'admin_P2',
                'type' => 'raw',
                'value' => '$data->radio->radiostationSettings->getradio($data->P2)',

            ),
		/*
        array(
            'name' => 'admin_region',
            'type' => 'raw',
            'value' => '$data->getregion()',

        ),
        array(
            'name' => 'test_done',
            'type' => 'raw',
            'value' => '$data->getcounttest()',

        ),

        //'status',

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
