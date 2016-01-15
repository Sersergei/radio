<?php
/* @var $this UsertestController */
/* @var $model Usertest */

$this->breadcrumbs=array(
	'Usertests'=>array('index'),
	'Manage',
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
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
</div><!-- search-form -->
</br>
<a href="?status=P1">P1</a></br>
<a href="?status=P2">P2</a></br>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usertest-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

		array(
			'name' => 'song_name',
			'type' => 'raw',
			'value' => '$data->idSong->name',
		),

		array(
			'name' => 'positive_P1',
			'type' => 'raw',
			'value' => 'round(($data->CounP15*100/$data->CounP1)+
                        ($data->CounP14*100/$data->getCounP1())+
                        ($data->CounP13*100/$data->getCounP1()),2)',
		),
		array(
			'name' => 'negative_P1',
			'type' => 'raw',
			'value' => 'round(($data->CounP12*100/$data->getCounP1())+
                        ($data->CounP11*100/$data->getCounP1()),2)',
		),

		array(
			'name' => 'favorite_P1',
			'type' => 'raw',
			'value' => 'round($data->CounP15*100/$data->getCounP1(),2)',
		),
		array(
			'name' => 'like_P1',
			'type' => 'raw',
			'value' => 'round($data->CounP14*100/$data->getCounP1(),2)',
		),
		array(
			'name' => 'normal_P1',
			'type' => 'raw',
			'value' => 'round($data->CounP13*100/$data->getCounP1(),2)',
		),
		array(
			'name' => 'tired_P1',
			'type' => 'raw',
			'value' => 'round($data->CounP12*100/$data->getCounP1(),2)',
		),
		array(
			'name' => 'dislike_P1',
			'type' => 'raw',
			'value' => 'round($data->CounP11*100/$data->getCounP1(),2)',
		),
		array(
			'name' => 'never_P1',
			'type' => 'raw',
			'value' =>  'round($data->neverP1*100/$data->getCounP1(),2)',
		),
	))); ?>
<a href="?file=1&type=Excel2007">Скачать отчет Excel</a></br>
<a href="?file=1&type=CSV">Скачать отчет csv</a>
