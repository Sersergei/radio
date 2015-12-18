<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/mini_player.js', CClientScript::POS_HEAD); ?>
<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */

$this->breadcrumbs=array(
	'Radiostation Settings'=>array('index'),
	$model->id_radio_settings=>array('view','id'=>$model->id_radio_settings),
	'Update',
);

$this->menu=array(
	array('label'=>'List RadiostationSettings', 'url'=>array('index')),

);
?>

<h1>Update RadiostationSettings <?php echo $model->id_radio_settings; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>