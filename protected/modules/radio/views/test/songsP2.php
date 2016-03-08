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
$sumneverP2=0;
$sumCounP21=0;
$sumCounP22=0;
$sumCounP23=0;
$sumCounP24=0;
$sumCounP25=0;

foreach ($iterator as $test){
	$sumCounP2+=$test->CounP2;
	$sumCounP21+=$test->CounP21;
	$sumCounP22+=$test->CounP22;
	$sumCounP23+=$test->CounP23;
	$sumCounP24+=$test->CounP24;
	$sumCounP25+=$test->CounP25;
	$sumneverP2+=$test->neverP2;
}
if(!$sumCounP2)
	$sumCounP2=1;
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
			'footer'=>round((($sumCounP25+$sumCounP24+$sumCounP23)*100)/$sumCounP2,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
		array(
			'name' => 'negative_P2',
			'type' => 'raw',
			'value' => 'round(($data->CounP22*100/$data->getCounP2())+
                        ($data->CounP21*100/$data->getCounP2()),2)',
			'footer'=>round((($sumCounP22+$sumCounP21)*100)/$sumCounP2,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),

		array(
			'name' => 'favorite_P2',
			'type' => 'raw',
			'value' => 'round($data->CounP25*100/$data->getCounP2(),2)',
			'footer'=>round($sumCounP25*100/$sumCounP2,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
		array(
			'name' => 'like_P2',
			'type' => 'raw',
			'value' => 'round($data->CounP24*100/$data->getCounP2(),2)',
			'footer'=>round($sumCounP24*100/$sumCounP2,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
		array(
			'name' => 'normal_P2',
			'type' => 'raw',
			'value' => 'round($data->CounP23*100/$data->getCounP2(),2)',
			'footer'=>round($sumCounP23*100/$sumCounP2,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
		array(
			'name' => 'tired_P2',
			'type' => 'raw',
			'value' => 'round($data->CounP22*100/$data->getCounP2(),2)',
			'footer'=>round($sumCounP22*100/$sumCounP2,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
		array(
			'name' => 'dislike_P2',
			'type' => 'raw',
			'value' => 'round($data->CounP21*100/$data->getCounP2(),2)',
			'footer'=>round($sumCounP21*100/$sumCounP2,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),
		array(
			'name' => 'never_P2',
			'type' => 'raw',
			'value' =>  'round($data->neverP2*100/$data->getCounP2(),2)',
			'footer'=> round($sumneverP2*100/$sumCounP2,2),
			'htmlOptions' => array(
				'style'=>'text-align:center'
			),
		),





	))); ?>
<a href="?file=1&type=Excel2007">Download report Excel</a></br>
<a href="?file=1&type=CSV">Download report csv</a>
