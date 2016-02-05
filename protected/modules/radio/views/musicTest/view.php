<?php
/* @var $this MusicTestController */
/* @var $model MusicTest */

$this->breadcrumbs=array(
	'Music Tests'=>array('index'),
	$model->id_test,
);

$this->menu=array(
	array('label'=>'Create MusicTest', 'url'=>array('create')),
	array('label'=>'Update MusicTest', 'url'=>array('update', 'id'=>$model->id_test)),

	array('label'=>'Manage MusicTest', 'url'=>array('index')),
);
?>

<h1>View MusicTest #<?php echo $model->id_test; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_test',
		array(
			'label' => 'id_radiostation',
			'type' => 'raw',
			'value' => $model->radio->name,
		),
		array(
			'label' => 'id_type',
			'type' => 'raw',
			'value' => $model->type->type_name,
		),
		'date_add',
		'date_started',
		'date_finished',
		array(
			'name' => 'id_status',
			'type' => 'raw',
			'value' => $model->getStatus(),
		),
		array(
			'name' => 'max_listeners',
			'type' => 'raw',
			'value' => $model->getMaxLisners(),
		),

	),
)); ?>
<br><br>

<?php
if($statistic and $statistic['count_all']){ //Если нету открытого теста то невыводим статистику
?>
<div id="statistic">


	<span><?php echo Yii::t('radio','Respondents done test')." ".$statistic['count_all']; ?> </span>

	<table id="stat">
		<tr>
			<td width="80px"><?php echo Yii::t('radio','Man')." ".$model['count_all_man']."(".round($statistic['count_all_man']*100/$statistic['count_all'],2)."%)";?></td>
			<td width="292px"> <?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
					'id'=>'progress',
					'value'=>$model['count_all_man']*100/$model['count_all'],
					'htmlOptions'=>array(
						'style'=>'width:292px; height:30px; float:left;'
					),
				));?></td>
			<td> <?php echo Yii::t('radio','Woman')." ".$statistic['count_all_woman']."(".round($statistic['count_all_woman']*100/$statistic['count_all'],2)."%)" ?></td>
		</tr>

	</table>
	<br>
	<br>
	<table>
		<tr>
			<td style=" vertical-align: top; ">
				<span style="font-weight:bold; font-size:18px"><?php echo Yii::t('radio','Age') ?></span>
				<table id="stat">
					<?php if ($statistic['count_0_14']){ ?>
						<tr>
							<td width="80px"><14 <?php echo $statistic['count_0_14']."(".round($statistic['count_0_14']*100/$statistic['count_all'],2)."%)"  ?> </td>
							<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
									'id'=>'ears1',
									'value'=>$model['count_0_14']*100/$model['count_all'],
									'htmlOptions'=>array(
										'style'=>'width:292px; height:30px; float:left;'
									),
								));?></td>
						</tr>
					<?php }
					if($statistic['count_15_19']){ ?>
						<tr>
							<td width="80px">15-19 <?php echo $statistic['count_15_19']."(".round($statistic['count_15_19']*100/$statistic['count_all'],2)."%)"  ?> </td>
							<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
									'id'=>'ears2',
									'value'=>$statistic['count_15_19']*100/$statistic['count_all'],
									'htmlOptions'=>array(
										'style'=>'width:292px; height:30px; float:left;'
									),
								));?></td>
						</tr>
					<?php }
					if ($statistic['count_20_24']){ ?>
						<tr>
							<td width="80px">20-24 <?php echo $statistic['count_20_24']."(".round($statistic['count_20_24']*100/$statistic['count_all'],2)."%)"  ?> </td>
							<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
									'id'=>'ears3',
									'value'=>$statistic['count_20_24']*100/$statistic['count_all'],
									'htmlOptions'=>array(
										'style'=>'width:292px; height:30px; float:left;'
									),
								));?></td>
						</tr>
					<?php }
					if($model['count_25_29']){?>
						<tr>
							<td width="80px">25-29 <?php echo $statistic['count_25_29']."(".round($statistic['count_25_29']*100/$statistic['count_all'],2)."%)"  ?> </td>
							<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
									'id'=>'ears4',
									'value'=>$statistic['count_25_29']*100/$statistic['count_all'],
									'htmlOptions'=>array(
										'style'=>'width:292px; height:30px; float:left;'
									),
								));?></td>
						</tr>
					<?php }
					if($statistic['count_30_34']){ ?>
						<tr>
							<td width="80px">30-34 <?php echo $statistic['count_30_34']."(".round($statistic['count_30_34']*100/$statistic['count_all'],2)."%)"  ?> </td>
							<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
									'id'=>'ears5',
									'value'=>$statistic['count_30_34']*100/$statistic['count_all'],
									'htmlOptions'=>array(
										'style'=>'width:292px; height:30px; float:left;'
									),
								));?></td>
						</tr>
					<?php } if($statistic['count_35_39']) { ?>
						<tr>
							<td width="80px">35-39 <?php echo $statistic['count_35_39']."(".round($statistic['count_35_39']*100/$statistic['count_all'],2)."%)"  ?> </td>
							<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
									'id'=>'ears6',
									'value'=>$statistic['count_35_39']*100/$statistic['count_all'],
									'htmlOptions'=>array(
										'style'=>'width:292px; height:30px; float:left;'
									),
								));?></td>
						</tr>
					<?php }
					if($statistic['count_40_44']) { ?>
						<tr>
							<td width="80px">40-44 <?php echo $statistic['count_40_44']."(".round($statistic['count_40_44']*100/$statistic['count_all'],2)."%)"  ?> </td>
							<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
									'id'=>'ears7',
									'value'=>$statistic['count_40_44']*100/$statistic['count_all'],
									'htmlOptions'=>array(
										'style'=>'width:292px; height:30px; float:left;'
									),
								));?></td>
						</tr>
					<?php }
					if($statistic['count_45_49']){ ?>
						<tr>
							<td width="80px">45-49 <?php echo $statistic['count_45_49']."(".round($statistic['count_45_49']*100/$statistic['count_all'],2)."%)"  ?> </td>
							<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
									'id'=>'ears8',
									'value'=>$model['count_45_49']*100/$statistic['count_all'],
									'htmlOptions'=>array(
										'style'=>'width:292px; height:30px; float:left;'
									),
								));?></td>
						</tr>
					<?php }
					if($statistic['count_50']){ ?>
						<tr>
							<td width="80px">50+ <?php echo $statistic['count_50']."(".round($statistic['count_50']*100/$statistic['count_all'],2)."%)"  ?> </td>
							<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
									'id'=>'ears9',
									'value'=>$statistic['count_50']*100/$statistic['count_all'],
									'htmlOptions'=>array(
										'style'=>'width:292px; height:30px; float:left;'
									),
								));?></td>
						</tr>
					<?php } ?>
				</table>

			</td>
			<td style=" vertical-align: top; ">

				<span><?php echo Yii::t('radio','Regions') ?></span>
				<table id="stat">
					<?php
					arsort($statistic['region']);
					foreach($statistic['region'] as $key=>$region){
						if($region){ ?>
							<tr>
								<td width="80px"><?php echo $statistic['regions'][$key]." ".$region."(".round($region*100/$statistic['count_all'],2)."%)" ?> </td>

								<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
										'id'=>'region'.$key ,
										'value'=>$region*100/$model['count_all'],
										'htmlOptions'=>array(
											'style'=>'width:292px; height:30px; float:left;'
										),
									));?></td>
							</tr>
						<?php  }} ?>

				</table>
			</td>
		</tr>
		<tr>
			<td style=" vertical-align: top; ">
				<span><?php echo Yii::t('radio','Education') ?></span>
				<table id="stat">
					<?php
					foreach($statistic['education'] as $key=>$education){
						if($education ) {?>

							<tr>
								<td width="80px"><?php echo $model['educations'][$key]." ".$education."(".round($education*100/$statistic['count_all'],2)."%)" ?> </td>

								<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
										'id'=>'education'.$key ,
										'value'=>$education*100/$statistic['count_all'],
										'htmlOptions'=>array(
											'style'=>'width:292px; height:30px; float:left;'
										),
									));?></td>
							</tr>
						<?php  }} ?>

				</table>
			</td>
			<td>

			</td>
		</tr>
		<tr>
			<td style=" vertical-align: top; ">
				<span><?php echo Yii::t('radio','P1') ?></span>
				<table id="stat">
					<?php
					arsort($statistic['P1']);
					foreach($statistic['P1'] as $key=>$P1){
						if($P1){ ?>
							<tr>
								<td width="80px"><?php echo $statistic['radiostations'][$key]." ".$P1."(".round($P1*100/$statistic['count_all'],2)."%)" ?> </td>

								<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
										'id'=>'P1'.$key ,
										'value'=>$P1*100/$statistic['count_all'],
										'htmlOptions'=>array(
											'style'=>'width:292px; height:30px; float:left;'
										),
									));?></td>
							</tr>
						<?php  }} ?>

				</table>

			</td>
			<td style=" vertical-align: top; ">
				<span><?php echo Yii::t('radio','P2') ?></span>
				<table id="stat">
					<?php
					arsort($statistic['P2']);
					foreach($statistic['P2'] as $key=>$P2){
						if($P2){ ?>
							<tr>
								<td width="80px"><?php echo $statistic['radiostations'][$key]." ".$P2."(".round($P2*100/$statistic['count_all'],2)."%)" ?> </td>

								<td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
										'id'=>'P2'.$key ,
										'value'=>$P2*100/$statistic['count_all'],
										'htmlOptions'=>array(
											'style'=>'width:292px; height:30px; float:left;'
										),
									));?></td>
							</tr>
						<?php  } }?>

				</table>
			</td>
		</tr>
	</table>

