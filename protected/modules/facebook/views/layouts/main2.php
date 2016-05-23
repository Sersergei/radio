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
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '433471736844421',
			xfbml      : true,
			version    : 'v2.2'
		});

		// Place following code after FB.init call.

		function onLogin(response) {
			if (response.status == 'connected') {
				FB.api('/me?fields=name,email,birthday,gender', function(data) {
					var welcomeBlock = document.getElementById('fb-welcome');
					
					var a=data.birthday;
					var b=a.split('/');
					var c=b[2]+b[1]+b[0];
					
					
					$("#User_ferst_test_name_listener").val(data.name);
					$("#User_ferst_test_email").val(data.email);
					$("#date_birth").val(c);
					
				});
			}
		}

		FB.getLoginStatus(function(response) {
			// Check login status on load, and if the user is
			// already logged in, go directly to the welcome message.
			if (response.status == 'connected') {
				onLogin(response);
			} else {
				// Otherwise, show Login dialog first.
				FB.login(function(response) {
					onLogin(response);
				}, {scope: 'user_friends, email'});
			}
		});
		// end Place following code after FB.init call.

		// Add a dialog to add this app as a pagetab to any fb page you have administrative access to
		// (and remove it once its added if you don't want it to be added to any further pages)
		// FB.ui({
		//   method: 'pagetab',
		//   redirect_uri: 'https://www.dgm.org/donations'
		// }, function(response){});

	};




	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
function print_r(taV)
{
  alert(getProps(taV));
}

/**
 * возвращает список атрибутов объекта и значения
 * @param {Element/Object} toObj - ссылка на объект
 * @param {String} tcSplit - строка разделитель строк
 * @return {String} - строку со списком атрибутов объекта
 * и значениями атрибутов
 */
function getProps(toObj, tcSplit)
{
  if (!tcSplit) tcSplit = '\n';
  var lcRet = '';
  var lcTab = '    ';

    for (var i in toObj) // обращение к свойствам объекта по индексу
      lcRet += lcTab + i + " : " + toObj[i] + tcSplit;

    lcRet = '{' + tcSplit + lcRet + '}';

  return lcRet;
}
print_r(data);
</script>
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