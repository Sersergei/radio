<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/*public function init(){
		if(empty(Yii::app()->user->getState('language')))
			Yii::app()->language='en';
		else
			Yii::app()->language=Yii::app()->user->getState('language');
		$this->layout = Yii::app()->controller->module ? $this->layout : 'column1';
		parent::init();
	}
*/
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
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
			$app->setLanguage('en');
			$app->session['lang'] = $app->getLanguage();
		}

	}

}