<?php
/* @var $this UsersController */
/* @var $model Users */


$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>Create Users</h1>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php  $path=new ServiceUserIdentity();
$path=$path->seturl(); ?>
<a href="<?php echo $path ?>">Перейти на фейсбук</a>

<?php Yii::app()->eauth->renderWidget(); ?>

