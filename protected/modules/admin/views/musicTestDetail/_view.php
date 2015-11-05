<?php
/* @var $this MusicTestDetailController */
/* @var $data MusicTestDetail */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_test_det')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_test_det), array('view', 'id'=>$data->id_test_det)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_test')); ?>:</b>
	<?php echo CHtml::encode($data->id_test); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_last')); ?>:</b>
	<?php echo CHtml::encode($data->date_last); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finaly')); ?>:</b>
	<?php echo CHtml::encode($data->finaly); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_song')); ?>:</b>
	<?php echo CHtml::encode($data->id_song); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_like')); ?>:</b>
	<?php echo CHtml::encode($data->id_like); ?>
	<br />


</div>