<?php
/* @var $this RadistationsController */
/* @var $data Radistations */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_radiostation')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_radiostation), array('view', 'id'=>$data->id_radiostation)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('all_tests')); ?>:</b>
	<?php echo CHtml::encode($data->all_tests); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_add')); ?>:</b>
	<?php echo CHtml::encode($data->date_add); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />




</div>