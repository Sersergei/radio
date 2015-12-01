<?php
/* @var $this TestSettingsMultController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Test Settings Mults',
);

$this->menu=array(

);
?>

<h1>Test Settings Mults</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
