<?php
//Yii::app()->clientScript->registerScript();
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
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Usertests</h1>
<?php echo CHtml::link('Advanced filters','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
</div><!-- search-form -->
</br>
<a href="?status=P1">P1</a></br>
<a href="?status=P2">P2</a></br>
<div >
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
<?php

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$user->search(),


	'columns'=>array(
		array(
			'name' => 'Name',
			'type' => 'raw',
			'value' => '$data->user->name_listener',
		),
		array(
			'name' => 'Email',
			'type' => 'raw',
			'value' => '$data->user->email',
		),
		array(
			'name' => 'Sex',
			'type' => 'raw',
			'value' => '$data->user->getsex()',
		),
		array(
			'name' => 'education',
			'type' => 'raw',
			'value' => '$data->user->education()',
			),
		array(
			'name' => 'P1',
			'type' => 'raw',
			'value' => '$data->user->radio->radiostationSettings->getradio($data->user->P1)',
			),
		array(
			'name' => 'P2',
			'type' => 'raw',
			'value' => '$data->user->radio->radiostationSettings->getradio($data->user->P2)',

		),
		array(
			'name' => 'region',
			'type' => 'raw',
			'value' => '$data->user->getregion()',
		),
		'time',

		array(
			'class'=>'CButtonColumn',
			'template'=>'{View}',
			'buttons'=>array(
				'View'=>array(
					'Label'=>Yii::t('radio','View'),

					'url'=>'Yii::app()->getUrlManager()->createURL("radio/users/view",array("id"=>$data->user->id_user))',
					'imageUrl'=>'/images/folder.png',
				),)),

	)));
?>
</div>