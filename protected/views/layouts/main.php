
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="language" content="en">
	<title></title>
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/prettyPhoto.css" >
	<!--[if lt IE 8]>

	<![endif]-->


</head>
<body id="page6">
<div id="main">
	<header>
		<div id="lang"><a href="?lang=en">English</a><a href="?lang=ua">Українська</a> <a href="?lang=кг">Русский</a></div>
	</header>

	<article id="content">
		<div class="col-1">
		</div>
		<div class="col-2">
<?php echo $content ?>
			</div>
		</article>
	<div class="af clear"></div>
</div>

<footer>

</footer>

</body>
</html>