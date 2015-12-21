
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="language" content="en">
	<title></title>
	<!-- blueprint CSS framework -->
	<?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/test.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/prettyPhoto.css" >
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/player.js', CClientScript::POS_HEAD); ?>
	<!--[if lt IE 8]>

	<![endif]-->


</head>
<body id="page6">
<div id="main">


		<div class="col-2">
<?php echo $content ?>
			</div>

	<div class="af clear"></div>
</div>

<footer>

</footer>

</body>
</html>