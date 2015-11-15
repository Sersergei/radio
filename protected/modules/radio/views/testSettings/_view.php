<?php
/* @var $this TestSettingsController */
/* @var $data TestSettings */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_test_settings')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_test_settings), array('view', 'id'=>$data->id_test_settings)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_radiostation')); ?>:</b>
	<?php echo CHtml::encode($data->id_radiostation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode($data->sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('age_from')); ?>:</b>
	<?php echo CHtml::encode($data->age_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('after_age')); ?>:</b>
	<?php echo CHtml::encode($data->after_age); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_education')); ?>:</b>
	<?php echo CHtml::encode($data->id_education); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Invitations')); ?>:</b>
	<?php echo CHtml::encode($data->Invitations); ?>
	<br />


</div>