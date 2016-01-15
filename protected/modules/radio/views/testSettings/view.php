

<h1>View TestSettings #<?php echo $model->id_test_settings; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_test_settings',
		'id_radiostation',
		'sex',
		'age_from',
		'after_age',
		'id_education',
		'Invitations',
	),
)); ?>
