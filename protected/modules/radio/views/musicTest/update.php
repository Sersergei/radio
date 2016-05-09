<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/mini_player.js', CClientScript::POS_HEAD); ?>
<?php
/* @var $this MusicTestController */
/* @var $model MusicTest */

$this->breadcrumbs=array(
	'Music Tests'=>array('index'),
	$model->id_test=>array('view','id'=>$model->id_test),
	'Update',
);

$this->menu=array(
	array('label'=>'Create MusicTest', 'url'=>array('create')),
	array('label'=>'View MusicTest', 'url'=>array('view', 'id'=>$model->id_test)),
	array('label'=>'Manage MusicTest', 'url'=>array('index')),
);
?>

<h1>Update MusicTest <?php echo $model->id_test; ?></h1>

<?php $this->renderPartial('_form_update', array('model'=>$model)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'music-test-grid',
	'dataProvider'=>$songs->search(),
	'filter'=>$songs,
	'columns'=>array(
		array(
			'type' => 'raw',
			'value' => '$data->getsongs()',
			'htmlOptions'=>array('style'=>'width: 16px; text-align: center;'),

		),
		'name',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'buttons'=>array(
				'delete'=>array(
					'visible'=>'$data->musicTest->id_status==1',
					'url'=>'Yii::app()->getUrlManager()->createURL("radio/musicTest/deletesongs",array("id"=>$data->id_song))',
				),
		)),
	),

));
?>

