<?php
class Controller extends CController
{
/**
* @var string the default layout for the controller view. Defaults to '//layouts/column1',
* meaning using a single column layout. See 'protected/views/layouts/column1.php'.
*/
public $layout='/layouts/column2';
/**
* @var array context menu items. This property will be assigned to {@link CMenu::items}.
*/
public $menu=array();
/**
* @var array the breadcrumbs of the current page. The value of this property will
* be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
* for more details on how to specify this property.
*/
public $breadcrumbs=array();
    function init () {

        parent::init();

        $app = Yii::app();
        if ( isset($_GET['lang']) ) {

            $app->setLanguage($_GET['lang']);
            $app->session['lang'] = $app->getLanguage();

        } else if ( isset($app->session['lang']) ) {
            $app->setLanguage($app->session['lang']);
        } else {
            $user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
            $lang=$user->radio->lang->lang;
            $app->setLanguage('en');
            $app->session['lang'] = $app->getLanguage();
        }

    }
}