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
			'htmlOptions' => array('width' => '100px'),

		),

		array(
			'name' => 'positive_P2',
			'type' => 'raw',
			'value' => 'round(($data->CounP25*100/$data->getCounP2())+
                        ($data->CounP24*100/$data->getCounP2())+
                        ($data->CounP23*100/$data->getCounP2()),2)',
		),
		array(
			'name' => 'negative_P2',
			'type' => 'raw',
			'value' => 'round(($data->CounP22*100/$data->getCounP2())+
                        ($data->CounP21*100/$data->getCounP2()),2)',
		),

		array(
			'name' => 'favorite_P2',
			'type' => 'raw',
			'value' => 'round($data->CounP25*100/$data->getCounP2(),2)',
		),
		array(
			'name' => 'like_P2',
			'type' => 'raw',
			'value' => 'round($data->CounP24*100/$data->getCounP2(),2)',
		),
		array(
			'name' => 'normal_P2',
			'type' => 'raw',
			'value' => 'round($data->CounP23*100/$data->getCounP2(),2)',
		),
		array(
			'name' => 'tired_P2',
			'type' => 'raw',
			'value' => 'round($data->CounP22*100/$data->getCounP2(),2)',
		),
		array(
			'name' => 'dislike_P2',
			'type' => 'raw',
			'value' => 'round($data->CounP21*100/$data->getCounP2(),2)',
		),
		array(
			'name' => 'never_P2',
			'type' => 'raw',
			'value' =>  'round($data->neverP2*100/$data->getCounP2(),2)',
		),





	))); ?>
<a href="?file=1&type=Excel2007">Скачать отчет Excel</a></br>
<a href="?file=1&type=CSV">Скачать отчет csv</a>
