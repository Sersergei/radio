<?php
/* @var $this LicenseController */
/* @var $data License */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_radiostation')); ?>:</b>
	<?php echo CHtml::encode($data->id_radiostation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('test_count')); ?>:</b>
	<?php echo CHtml::encode($data->test_count); ?>
	<br />


</div>