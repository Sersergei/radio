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
$iterator = new CDataProviderIterator($model->search());
//var_dump($iterator->coun5);
$sumneverP1=0;
$sumCounP11=0;
$sumCounP12=0;
$sumCounP13=0;
$sumCounP14=0;
$sumCounP15=0;

foreach ($iterator as $test){
	$sumCounP1+=$test->CounP1;
	$sumCounP11+=$test->CounP11;
	$sumCounP12+=$test->CounP12;
	$sumCounP13+=$test->CounP13;
	$sumCounP14+=$test->CounP14;
	$sumCounP15+=$test->CounP15;
	$sumneverP1+=$test->neverP1;
}
if(!$sumCounP1)
	$sumCounP1=1;
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
			'footer'=>round((($sumCounP15+$sumCounP14+$sumCounP13)*100/$sumCounP1),2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
		array(
			'name' => 'negative_P1',
			'type' => 'raw',
			'value' => 'round(($data->CounP12*100/$data->getCounP1())+
                        ($data->CounP11*100/$data->getCounP1()),2)',
			'footer'=>round((($sumCounP12+$sumCounP11)*100/$sumCounP1),2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),

		array(
			'name' => 'favorite_P1',
			'type' => 'raw',
			'value' => 'round($data->CounP15*100/$data->getCounP1(),2)',
			'footer'=>round($sumCounP15*100/$sumCounP1,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
		array(
			'name' => 'like_P1',
			'type' => 'raw',
			'value' => 'round($data->CounP14*100/$data->getCounP1(),2)',
			'footer'=>round($sumCounP14*100/$sumCounP1,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
		array(
			'name' => 'normal_P1',
			'type' => 'raw',
			'value' => 'round($data->CounP13*100/$data->getCounP1(),2)',
			'footer'=>round($sumCounP13*100/$sumCounP1,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
		array(
			'name' => 'tired_P1',
			'type' => 'raw',
			'value' => 'round($data->CounP12*100/$data->getCounP1(),2)',
			'footer'=>round($sumCounP12*100/$sumCounP1,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
		array(
			'name' => 'dislike_P1',
			'type' => 'raw',
			'value' => 'round($data->CounP11*100/$data->getCounP1(),2)',
			'footer'=>round($sumCounP11*100/$sumCounP1,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
		array(
			'name' => 'never_P1',
			'type' => 'raw',
			'value' =>  'round($data->neverP1*100/$data->getCounP1(),2)',
			'footer'=>round($sumneverP1*100/$sumCounP1,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
	))); ?>
<a href="?file=1&type=Excel2007">Download report Excel</a></br>
<a href="?file=1&type=CSV">Download report csv</a>
