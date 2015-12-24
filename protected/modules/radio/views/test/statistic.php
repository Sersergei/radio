
<span><?php echo Yii::t('radio','Всего прошло тест')." ".$model['count_all']; ?> </span>
<table>
    <tr>
        <td width="80px"><?php echo Yii::t('radio','Man')." ".$model['count_all_man']."(".$model['count_all_man']*100/$model['count_all']."%)";?></td>
        <td width="292px"> <?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                'id'=>'progress',
                'value'=>$model['count_all_man']*100/$model['count_all'],
                'htmlOptions'=>array(
                    'style'=>'width:292px; height:30px; float:left;'
                ),
            ));?></td>
        <td> <?php echo Yii::t('radio','Woman')." ".$model['count_all_woman']."(".$model['count_all_woman']*100/$model['count_all']."%)" ?></td>
    </tr>

</table>
<br>
<br>
<span><?php echo Yii::t('radio','Рзабивка по возростным категориям') ?></span>
<table>
    <tr>
        <td width="80px"><14 <?php echo $model['count_0_14']."(".$model['count_0_14']*100/$model['count_all']."%)"  ?> </td>
        <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                'id'=>'ears1',
                'value'=>$model['count_0_14']*100/$model['count_all'],
                'htmlOptions'=>array(
                    'style'=>'width:292px; height:30px; float:left;'
                ),
            ));?></td>
    </tr>
    <tr>
        <td width="80px">15-19 <?php echo $model['count_15_19']."(".$model['count_15_19']*100/$model['count_all']."%)"  ?> </td>
        <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                'id'=>'ears2',
                'value'=>$model['count_15_19']*100/$model['count_all'],
                'htmlOptions'=>array(
                    'style'=>'width:292px; height:30px; float:left;'
                ),
            ));?></td>
    </tr>
    <tr>
        <td width="80px">20-24 <?php echo $model['count_20_24']."(".$model['count_20_24']*100/$model['count_all']."%)"  ?> </td>
        <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                'id'=>'ears3',
                'value'=>$model['count_20_24']*100/$model['count_all'],
                'htmlOptions'=>array(
                    'style'=>'width:292px; height:30px; float:left;'
                ),
            ));?></td>
    </tr>
    <tr>
        <td width="80px">25-29 <?php echo $model['count_25_29']."(".$model['count_25_29']*100/$model['count_all']."%)"  ?> </td>
        <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                'id'=>'ears4',
                'value'=>$model['count_25_29']*100/$model['count_all'],
                'htmlOptions'=>array(
                    'style'=>'width:292px; height:30px; float:left;'
                ),
            ));?></td>
    </tr>
    <tr>
        <td width="80px">30-34 <?php echo $model['count_30_34']."(".$model['count_30_34']*100/$model['count_all']."%)"  ?> </td>
        <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                'id'=>'ears5',
                'value'=>$model['count_30_34']*100/$model['count_all'],
                'htmlOptions'=>array(
                    'style'=>'width:292px; height:30px; float:left;'
                ),
            ));?></td>
    </tr>
    <tr>
        <td width="80px">35-39 <?php echo $model['count_35_39']."(".$model['count_35_39']*100/$model['count_all']."%)"  ?> </td>
        <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                'id'=>'ears6',
                'value'=>$model['count_35_39']*100/$model['count_all'],
                'htmlOptions'=>array(
                    'style'=>'width:292px; height:30px; float:left;'
                ),
            ));?></td>
    </tr>
    <tr>
        <td width="80px">40-44 <?php echo $model['count_40_44']."(".$model['count_40_44']*100/$model['count_all']."%)"  ?> </td>
        <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                'id'=>'ears7',
                'value'=>$model['count_40_44']*100/$model['count_all'],
                'htmlOptions'=>array(
                    'style'=>'width:292px; height:30px; float:left;'
                ),
            ));?></td>
    </tr>
    <tr>
        <td width="80px">45-49 <?php echo $model['count_45_49']."(".$model['count_45_49']*100/$model['count_all']."%)"  ?> </td>
        <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                'id'=>'ears8',
                'value'=>$model['count_45_49']*100/$model['count_all'],
                'htmlOptions'=>array(
                    'style'=>'width:292px; height:30px; float:left;'
                ),
            ));?></td>
    </tr>
    <tr>
        <td width="80px">50+ <?php echo $model['count_50']."(".$model['count_50']*100/$model['count_all']."%)"  ?> </td>
        <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                'id'=>'ears9',
                'value'=>$model['count_50']*100/$model['count_all'],
                'htmlOptions'=>array(
                    'style'=>'width:292px; height:30px; float:left;'
                ),
            ));?></td>
    </tr>
</table>
<span><?php echo Yii::t('radio','Рзабивка по образованию') ?></span>
<table>
    <?php
    foreach($model['education'] as $key=>$education){ ?>
    <tr>
        <td width="80px"><?php echo $model['educations'][$key]." ".$education."(".$education*100/$model['count_all']."%)" ?> </td>

    <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
            'id'=>'education'.$key ,
            'value'=>$education*100/$model['count_all'],
            'htmlOptions'=>array(
                'style'=>'width:292px; height:30px; float:left;'
            ),
        ));?></td>
    </tr>
  <?php  } ?>

</table>

<span><?php echo Yii::t('radio','Рзабивка по P1') ?></span>
<table>
    <?php
    foreach($model['P1'] as $key=>$P1){ ?>
        <tr>
            <td width="80px"><?php echo $model['radiostations'][$key]." ".$P1."(".$P1*100/$model['count_all']."%)" ?> </td>

            <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                    'id'=>'P1'.$key ,
                    'value'=>$P1*100/$model['count_all'],
                    'htmlOptions'=>array(
                        'style'=>'width:292px; height:30px; float:left;'
                    ),
                ));?></td>
        </tr>
    <?php  } ?>

</table>

<span><?php echo Yii::t('radio','Рзабивка по P2') ?></span>
<table>
    <?php
    foreach($model['P2'] as $key=>$P2){ ?>
        <tr>
            <td width="80px"><?php echo $model['radiostations'][$key]." ".$P2."(".$P2*100/$model['count_all']."%)" ?> </td>

            <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                    'id'=>'P2'.$key ,
                    'value'=>$P2*100/$model['count_all'],
                    'htmlOptions'=>array(
                        'style'=>'width:292px; height:30px; float:left;'
                    ),
                ));?></td>
        </tr>
    <?php  } ?>

</table>