<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */

$this->breadcrumbs=array(
	'Radiostation Settings'=>array('index'),
	'Create',
);


?>

<h1>Create RadiostationSettings</h1>


<?php

		$this->renderPartial('_form', array('model' => $model));

		?>