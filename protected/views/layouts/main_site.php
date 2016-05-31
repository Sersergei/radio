<!DOCTYPE html>
<html lang="ru">
<head>
    <title>radiomusictest.com</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/grid.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style_site.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/camera.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/owl-carousel.css">
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.js', CClientScript::POS_HEAD); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-migrate-1.2.1.js', CClientScript::POS_HEAD); ?>
    <!--[if lt IE 9]>
    <html class="lt-ie9">
    <div style="clear: both; text-align:center; position: relative;"><a href="http://windows.microsoft.com/en-US/internet-explorer/.."><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    </html>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/html5shiv.js', CClientScript::POS_HEAD); ?><![endif]-->
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/device.min.js', CClientScript::POS_HEAD); ?>

</head>
<body>
<div class="page">
    <!--
    ========================================================
                                HEADER
    ========================================================
    -->
    <header>
        <div class="container">
            <div class="brand">
                <h1 class="brand_name"><a href="./">radiomusictest.com</a></h1>
                <p class="brand_slogan">Панель тестирования музыки</p>
            </div><a href="callto:#" class="fa-phone">+372 5908 7099</a>
        </div>
        <div id="stuck_container" class="stuck_container">
            <div class="container">
                <nav class="nav">

                    <?php $this->widget('zii.widgets.CMenu',array(
                        'htmlOptions'=>array('class'=>'sf-menu','data-type'=>'navbar'),
                        'items'=>array(
                            array('label'=>'Начало', 'url'=>array('/.')),
                            array('label'=>'Кто мы', 'url'=>array('/about')),
                            array('label'=>'Цены', 'url'=>array('/price')),
                            array('label'=>'Как это работает', 'url'=>array('/how')),
                            array('label'=>'Контакты', 'url'=>array('/contact')),
                            array('label'=>Yii::t('radio','Вход для партнёров'), 'url'=>array('/login'), 'visible'=>Yii::app()->user->isGuest),
                            array('label'=>'Войти в кабинет ('.Yii::app()->user->name.')', 'url'=>array('/radio'), 'visible'=>!Yii::app()->user->isGuest),
                           // array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                        ),
                    )); ?>


                </nav>
            </div>
        </div>
    </header>
    <?php echo $content; ?>
    <!--
    ========================================================
                                FOOTER
    ========================================================
    -->
    <footer>

        <section>
            <div class="container">
                <div class="copyright">RadioMusicTest.com© <span id="copyright-year"></span>
                    .&nbsp;&nbsp;<a href="index-5.html">Privacy Policy</a>More <a rel="nofollow" href="http://www.templatemonster.com/category/business-web-templates/" target="_blank">
                        Business Website Templates at TemplateMonster.com</a>
                </div>
            </div>
        </section>
    </footer>
</div>
<script src="js/script.js"></script>
</body>
</html>