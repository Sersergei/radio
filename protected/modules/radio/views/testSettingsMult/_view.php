<?php
/* @var $this TestSettingsMultController */
/* @var $data TestSettingsMult */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_test_mult')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_test_mult), array('view', 'id'=>$data->id_test_mult)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_radiostations')); ?>:</b>
	<?php echo CHtml::encode($data->id_radiostations); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_before_test')); ?>:</b>
	<?php echo CHtml::encode($data->text_before_test); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_after_test')); ?>:</b>
	<?php echo CHtml::encode($data->text_after_test); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invitation_topic')); ?>:</b>
	<?php echo CHtml::encode($data->invitation_topic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invitation_text')); ?>:</b>
	<?php echo CHtml::encode($data->invitation_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('test_song')); ?>:</b>
	<?php echo CHtml::encode($data->test_song); ?>
	<br />


</div>