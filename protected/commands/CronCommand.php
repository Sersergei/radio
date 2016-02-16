<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 15.02.2016
 * Time: 13:16
 */
class CronCommand extends CConsoleCommand
{
    public function run($args)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('id_status',1);
        $criteria->addCondition('date_started <=NOW()');
        $started=MusicTest::model()->findall($criteria);
        foreach($started as $model){
            $model->id_status=2;
        }
        $criteria=new CDbCriteria;
        $criteria->compare('id_status',2);
        $criteria->addBetweenCondition('date_finished','0000-00-00 00:00:01',date(" Y-m-d H:i:s") );
        //$criteria->addCondition("date_finished<=NOW() AND data_finished IS NOT NULL");
        $finish=MusicTest::model()->findall($criteria);
        foreach($finish as $model){
            $model->id_status=3;
            $model->save();
        }
    }

}
?>