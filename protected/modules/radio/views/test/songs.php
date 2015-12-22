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
	'template'=>"". Yii::t('radio','Users:')."{$model->search()->data[0]->Coun} {pager}{items}{pager}",


	'columns'=>array(

		array(
			'name' => 'song_name',
			'type' => 'raw',
			'value' => '$data->idSong->name',
		),
		array(
			'name' => 'positive',
			'type' => 'raw',
			'value' => 'round(($data->Coun5*100/$data->getCoun())+
                        ($data->Coun4*100/$data->getCoun())+
                        ($data->Coun3*100/$data->getCoun()),2)',
		),
		array(
			'name' => 'negative',
			'type' => 'raw',
			'value' => 'round(($data->Coun2*100/$data->getCoun())+
                        ($data->Coun1*100/$data->getCoun()),2)',
		),

		array(
			'name' => 'favorite',
			'type' => 'raw',
			'value' => 'round($data->Coun5*100/$data->getCoun(),2)',
		),
		array(
			'name' => 'like',
			'type' => 'raw',
			'value' => 'round($data->Coun4*100/$data->getCoun(),2)',
		),
		array(
			'name' => 'normal',
			'type' => 'raw',
			'value' => 'round($data->Coun3*100/$data->getCoun(),2)',
		),
		array(
			'name' => 'tired',
			'type' => 'raw',
			'value' => 'round($data->Coun2*100/$data->getCoun(),2)',
		),
		array(
			'name' => 'dislike',
			'type' => 'raw',
			'value' => 'round($data->Coun1*100/$data->getCoun(),2)',
		),
				array(
			'name' => 'never',
			'type' => 'raw',
			'value' =>  'round($data->never*100/$data->getCoun(),2)',
		),
	))); ?>
<a href="?file=1&type=Excel2007">Скачать отчет Excel</a></br>
<a href="?file=1&type=CSV">Скачать отчет csv</a>
