<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */

$this->breadcrumbs=array(
    'Radiostation Settings'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'List RadiostationSettings', 'url'=>array('index')),
    array('label'=>'Manage RadiostationSettings', 'url'=>array('admin')),
);
?>

    <h1></h1>
<?php
echo CHtml::beginForm('','post',array('enctype'=>'multipart/form-data'));
echo CHtml::error($model,'file');
//$i=0;
//do{
    echo Chtml::activeFileField($model,'file[]',['multiple'=>true]);
   // $i++;
//}
//while($i<$_GET['id']);
echo CHtml::submitButton('Upload');
echo CHtml::endForm();
?>