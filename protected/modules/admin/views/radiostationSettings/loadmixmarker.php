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
if(empty($_GET['id']))
    $id=1;
else
echo CHtml::form('','post',array('enctype'=>'multipart/form-data'));
$i=0;
do{
    ?>
<br><br>
<?php
    echo CHtml::activeFileField($model, 'image');
    ++$i;
}while($i<$_GET['id']);
?>
<br>
<div class="row buttons">
    <?php echo CHtml::submitButton( 'Next'); ?>
</div>
<?php
echo CHtml::endForm();
?>