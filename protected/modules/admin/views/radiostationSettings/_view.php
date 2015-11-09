<?php
/* @var $this RadiostationSettingsController */
/* @var $data RadiostationSettings */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_radio_settings')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_radio_settings), array('view', 'id'=>$data->id_radio_settings)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lang')); ?>:</b>
	<?php echo CHtml::encode($data->id_lang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('test_song')); ?>:</b>
	<?php echo CHtml::encode($data->test_song); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('not_use_music_marker')); ?>:</b>
	<?php echo CHtml::encode($data->not_use_music_marker); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('not_register_users')); ?>:</b>
	<?php echo CHtml::encode($data->not_register_users); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('not_invite_users')); ?>:</b>
	<?php echo CHtml::encode($data->not_invite_users); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('mix_marker_1')); ?>:</b>
	<?php echo CHtml::encode($data->mix_marker_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mix_marker_2')); ?>:</b>
	<?php echo CHtml::encode($data->mix_marker_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mix_marker_3')); ?>:</b>
	<?php echo CHtml::encode($data->mix_marker_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mix_marker_4')); ?>:</b>
	<?php echo CHtml::encode($data->mix_marker_4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mix_marker')); ?>:</b>
	<?php echo CHtml::encode($data->mix_marker); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_radiostation')); ?>:</b>
	<?php echo CHtml::encode($data->id_radiostation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_radiostations')); ?>:</b>
	<?php echo CHtml::encode($data->other_radiostations); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_card_registration')); ?>:</b>
	<?php echo CHtml::encode($data->id_card_registration); ?>
	<br />

	*/ ?>

</div>