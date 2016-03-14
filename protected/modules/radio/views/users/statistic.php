<div id="statistic">


    <span><?php if($statistic['count_all']) {echo Yii::t('radio','Registered users')." ".$statistic['count_all']; ?> </span>

    <table id="stat">
        <tr>
            <td width="80px"><?php echo Yii::t('radio','Man')." ".$statistic['count_all_man']."(".round($statistic['count_all_man']*100/$statistic['count_all'],2)."%)";?></td>
            <td width="292px"> <?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                    'id'=>'progress',
                    'value'=>$statistic['count_all_man']*100/$statistic['count_all'],
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
                                    'value'=>$statistic['count_0_14']*100/$statistic['count_all'],
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
                    if($statistic['count_25_29']){?>
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
                                    'value'=>$statistic['count_45_49']*100/$statistic['count_all'],
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
                        if(isset($region)){ ?>
                            <tr>
                                <td width="80px"><?php echo $statistic['regions'][$key]." ".$region."(".round($region*100/$statistic['count_all'],2)."%)" ?> </td>

                                <td width="292px"><?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                                        'id'=>'region'.$key ,
                                        'value'=>$region*100/$statistic['count_all'],
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
                                <td width="80px"><?php echo $statistic['educations'][$key]." ".$education."(".round($education*100/$statistic['count_all'],2)."%)" ?> </td>

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
    <table id="stat">
        <tr>
            <td>
                <span><?php echo Yii::t('radio','Statistic users')." ".$statistic['all']; ?> </span>
            </td>
        <tr>
            <td>All the time</td>
            <td width="80px"><?php echo Yii::t('radio','Active')." ".$statistic['count_all']."(".round($statistic['count_all']*100/$statistic['all'],2)."%)";?></td>
            <td width="292px"> <?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                    'id'=>'baned_all',
                    'value'=>$statistic['count_all']*100/$statistic['all'],
                    'htmlOptions'=>array(
                        'style'=>'width:292px; height:30px; float:left;'
                    ),
                ));?></td>
            <td> <?php echo Yii::t('radio','unsubscribing')." ".$statistic['ban']."(".round($statistic['ban']*100/$statistic['all'],2)."%)" ?></td>
        </tr>
        <tr>
            <td>Last week</td>
            <td width="80px"><?php if($statistic['all_week']){echo Yii::t('radio','Active')." ".($statistic['all_week']-$statistic['ban_week'])."(".round(($statistic['all_week']-$statistic['ban_week'])*100/$statistic['all_week'],2)."%)";?></td>
            <td width="292px"> <?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                    'id'=>'baned_week',
                    'value'=>($statistic['all_week']-$statistic['ban_week'])*100/$statistic['all_week'],
                    'htmlOptions'=>array(
                        'style'=>'width:292px; height:30px; float:left;'
                    ),
                ));?></td>
            <td> <?php echo Yii::t('radio','unsubscribing')." ".$statistic['ban_week']."(".round($statistic['ban_week']*100/$statistic['all_week'],2)."%)";} ?></td>
        </tr>
        <tr>
            <td>Last month</td>
            <td width="80px"><?php if($statistic['all_month']){ echo Yii::t('radio','Active')." ".($statistic['all_month']-$statistic['ban_month'])."(".round(($statistic['all_month']-$statistic['ban_month'])*100/$statistic['all_month'],2)."%)";?></td>
            <td width="292px"> <?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                    'id'=>'baned_month',
                    'value'=>($statistic['all_month']-$statistic['ban_month'])*100/$statistic['all_month'],
                    'htmlOptions'=>array(
                        'style'=>'width:292px; height:30px; float:left;'
                    ),
                ));?></td>
            <td> <?php echo Yii::t('radio','unsubscribing')." ".$statistic['ban_month']."(".round($statistic['ban_month']*100/$statistic['all_month'],2)."%)";} ?></td>
        </tr>
        <tr>
            <td>Last year</td>
            <td width="80px"><?php if($statistic['all_year']){ echo Yii::t('radio','Active')." ".($statistic['all_year']-$statistic['ban_year'])."(".round(($statistic['all_year']-$statistic['ban_year'])*100/$statistic['all_year'],2)."%)";?></td>
            <td width="292px"> <?php  $this->widget('zii.widgets.jui.CJuiProgressBar', array(
                    'id'=>'baned_year',
                    'value'=>($statistic['all_year']-$statistic['ban_year'])*100/$statistic['all_year'],
                    'htmlOptions'=>array(
                        'style'=>'width:292px; height:30px; float:left;'
                    ),
                ));?></td>
            <td> <?php echo Yii::t('radio','unsubscribing')." ".$statistic['ban_year']."(".round($statistic['ban_year']*100/$statistic['all_year'],2)."%)";} ?></td>
        </tr>
    </table>
    <?php } ?>
</div>
