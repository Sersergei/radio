<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/mini_player.js', CClientScript::POS_HEAD); ?>
<?php
/* @var $this MusicTestController */
/* @var $model MusicTest */

$this->breadcrumbs=array(
	'Music Tests'=>array('index'),
	$model->id_test,
);

$this->menu=array(
	array('label'=>'Create MusicTest', 'url'=>array('create')),
	array('label'=>'Update MusicTest', 'url'=>array('update', 'id'=>$model->id_test)),

	array('label'=>'Manage MusicTest', 'url'=>array('index')),
);
?>

<h1>View MusicTest #<?php echo $model->id_test; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_test',
		'name',
		array(
			'label' => 'id_radiostation',
			'type' => 'raw',
			'value' => $model->radio->name,
		),
		array(
			'label' => 'id_type',
			'type' => 'raw',
			'value' => $model->type->type_name,
		),
		'date_add',
		'date_started',
		'date_finished',
		array(
			'name' => 'id_status',
			'type' => 'raw',
			'value' => $model->getStatus(),
		),
		array(
			'name' => 'max_listeners',
			'type' => 'raw',
			'value' => $model->getMaxLisners(),
		),

	),
)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'music-test-grid',
	'dataProvider'=>$songs->search(),
	'filter'=>$songs,
	'columns'=>array(
		array(
			'name' => 'name',
			'type' => 'raw',
			'value' => '$data->getsongs()',
		),
		'name',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'buttons'=>array(
				'delete'=>array(

					'url'=>'Yii::app()->getUrlManager()->createURL("radio/musicTest/deletesongs",array("id"=>$data->id_song))',
				),)

		),
	),

));
?>
