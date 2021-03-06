<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),

);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	//array('label'=>'Create Users', 'url'=>array('create')),
	//array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_user),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View Users </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(


		array(
			'name'=>'Name',
			'value'=>$model->name_listener,
		),
		'email',
		'date_birth',
		array(
			'name'=>'sex',
			'value'=>$model->getsex(),
		),
		array(
			'name'=>'education',
			'value'=>$model->education(),
		),
		'date_add',
		array(
			'name'=>'status',
			'value'=>$model->getstatus(),
		),
		array(
			'name'=>'id_radiostation',
			'value'=>$model->radio->name,
		),
		'marker',
		array(
			'name'=>'admin_P1',
			'value'=>$model->radio->radiostationSettings->getradio($model->P1),
		),
		array(
			'name'=>'admin_P2',
			'value'=>$model->radio->radiostationSettings->getradio($model->P2),
		),
		'id_card',

	),
)); ?>
<br>
<?php

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$test->testuserserch(),
	'filter'=>$test,
	'columns'=>array(
		'id_music',
		'date',
		'time',
		array(
			'name'=>'test.id_type',
			'value'=>'$data->test->gettype()',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{View}',
			'buttons'=>array(
				'View'=>array(
					'Label'=>Yii::t('radio','View'),

					'url'=>'Yii::app()->getUrlManager()->createURL("radio/users/test",array("id"=>$data->user->id_user,
																	"test"=>$data->id_music))',
					'imageUrl'=>'/images/folder.png',
				),)),
	),));
