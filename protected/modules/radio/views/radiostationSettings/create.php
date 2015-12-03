<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */

$this->breadcrumbs=array(
	'Radiostation Settings'=>array('index'),
	'Create',
);


?>

<h1><?php echo Yii::t('radio','Create Radiostation Settings') ?>  </h1>


<?php

		$this->renderPartial('_form', array('model' => $model));

		?>