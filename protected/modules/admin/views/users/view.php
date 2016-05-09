<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id_user,
);

$this->menu=array(
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->id_user)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_user),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('index')),
);
?>

<h1>View Users #<?php echo $model->id_user; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(

		'name_listener',
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
		array(
			'name'=>'admin_region',
			'value'=>$model->getregion(),
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
	'dataProvider'=>$test->search(),
	'filter'=>$test,
	'columns'=>array(
		'id_music',
		'date',
		'time',
		array(
			'name'=>'test.id_type',
			'value'=>'$data->test->gettype()',
		),
	),));

