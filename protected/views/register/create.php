<?php
/* @var $this UsersController */
/* @var $model Users */


$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('radio','Registration'); ?></h1>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php  $path=new ServiceUserIdentity();
$path=$path->seturl(); ?>

<a href="<?php echo $path ?>"><?php echo Yii::t('radio','Login with Facebook'); ?></a>

