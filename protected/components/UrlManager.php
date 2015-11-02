<?php
/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 02.11.2015
 * Time: 16:21
 */
class UrlManager extends CUrlManager
{
    public function createUrl($route, $params=array(), $ampersand='&')
    {
        if (empty($params['language'])) {
            $params['language'] = Yii::app()->language;
        }
        return parent::createUrl($route, $params, $ampersand);
    }
}