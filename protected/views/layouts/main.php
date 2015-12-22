
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="language" content="en">
	<title></title>
	<!-- blueprint CSS framework -->
	<?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/prettyPhoto.css" >
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '433471736844421',
				xfbml      : true,
				version    : 'v2.5'
			});
		};

		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/player.js', CClientScript::POS_HEAD); ?>
	<!--[if lt IE 8]>

	<![endif]-->


</head>
<body id="page6">
<div id="main">
	<header>
		<div id="lang"><a class="by" href="?lang=ru"></a><a class="en" href="?lang=en"></a><a class="uk" href="?lang=uk"></a> <a class="et" href="?lang=et"></a></div>
	</header>
	<div
		class="fb-like"
		data-share="true"
		data-width="450"
		data-show-faces="true">
	</div>
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