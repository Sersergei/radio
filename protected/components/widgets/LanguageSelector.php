<?php
/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 02.11.2015
 * Time: 16:11
 */
class LanguageSwitcherWidget extends CWidget
{
    public function run()
    {
        $currentUrl = ltrim(Yii::app()->request->url, '/');
        $links = array();
        foreach (DMultilangHelper::suffixList() as $suffix => $name){
            $url = '/' . ($suffix ? trim($suffix, '_') . '/' : '') . $currentUrl;
            $links[] = CHtml::tag('li', array('class'=>$suffix), CHtml::link($name, $url));
        }
        echo CHtml::tag('ul', array('class'=>'language'), implode("\n", $links));
    }
}