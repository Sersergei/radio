<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
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
<div class="admintable">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_user',
		array(
			'name' => 'admin_name',
			'type' => 'raw',
			'value' => '$data->name_listener',

		),
		'email',
        'age',
		'date_birth',
		array(
			'name' => 'sex',
			'type' => 'raw',
			'value' => '$data->getsex()',
			'filter'=>CHtml::activeDropDownList($model,'sex',array(1=>yii::t('radio','M'),2=>yii::t('radio','W')),array(
				'empty'=>'',
			)),),
		array(
			'name' => 'education',
			'type' => 'raw',
			'value' => '$data->education()',
			'filter'=>CHtml::activeDropDownList($model,'id_education',EducationMult::all(),array(
				'empty'=>'',
			)),

		),
		array(
			'name' => 'status',
			'type' => 'raw',
			'value' => '$data->getstatus()',
			),


		'marker',
		//'id_card',
		'date_add',
		array(
			'name' => 'id_radiostation',
			'type' => 'raw',
			'value' => '$data->radio->name',
			'filter'=>CHtml::activeDropDownList($model,'id_radiostation',Radistations::all(),array(
				'empty'=>'',
			)),),
		array(
			'name' => 'admin_P1',
			'type' => 'raw',
			'value' => '$data->radio->radiostationSettings->getradio($data->P1)',

		),
		array(
			'name' => 'admin_P2',
			'type' => 'raw',
			'value' => '$data->radio->radiostationSettings->getradio($data->P2)',

		),
        array(
            'name' => 'admin_region',
            'type' => 'raw',
            'value' => '$data->getregion()',
        ),
		array(
			'name'=>'test_count',
			'type'=>'raw',
			'value'=>'$data->getAmt()',
		),
		array(
			'name'=>'date_lasttest',
			'type'=>'raw',
			'value'=>'$data->getDateLastTest()',
		),

		/*
		'login',
		'password',

		'id_category',
		'id_radiostation',
		'P1',
		'mobile_ID',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}{Activate}',
			'buttons'=>array(
			'Activate'=>array(
				'label'=>Yii::t('radio','Активировать пользователя'),
				'visible'=>'$data->status==1',
				'url'=>'Yii::app()->getUrlManager()->createURL("/admin/users/Activate",array("id"=>$data->id_user))',
				'imageUrl'=>'/images/itunes.png',
		),
	)),
)));
?>
</div>
