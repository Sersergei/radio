<?php
/**
 * Created by PhpStorm.
 * User: ������
 * Date: 02.11.2015
 * Time: 16:11
 */
class LanguageSelector extends CWidget
{
    public function run()
    {
        $currentLang = Yii::app()->language;
        $languages = Yii::app()->params->languages;
        $this->render('languageSelector', array('currentLang' => $currentLang, 'languages'=>$languages));
    }
}
?>