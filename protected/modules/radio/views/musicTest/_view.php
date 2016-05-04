<?php
/* @var $this MusicTestController */
/* @var $data MusicTest */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_test')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_test), array('view', 'id'=>$data->id_test)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_radiostation')); ?>:</b>
	<?php echo CHtml::encode($data->id_radiostation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_type')); ?>:</b>
	<?php echo CHtml::encode($data->type->type_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_add')); ?>:</b>
	<?php echo CHtml::encode($data->date_add); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_started')); ?>:</b>
	<?php echo CHtml::encode($data->date_started); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_status')); ?>:</b>
	<?php echo CHtml::encode($data->id_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_listeners')); ?>:</b>
	<?php echo CHtml::encode($data->max_listeners); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('test_number')); ?>:</b>
	<?php echo CHtml::encode($data->test_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_finished')); ?>:</b>
	<?php echo CHtml::encode($data->date_finished); ?>
	<br />

	*/ ?>

</div>