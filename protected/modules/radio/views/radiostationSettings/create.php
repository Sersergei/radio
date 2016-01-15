<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */

$this->breadcrumbs=array(
	'Radiostation Settings'=>array('index'),
	'Create',
);
?>
<div id="header-setting"></div>
<h1><?php echo Yii::t('radio','Create Radiostation Settings') ?>  </h1>


<?php

		$this->renderPartial('_form', array('model' => $model));

		?>