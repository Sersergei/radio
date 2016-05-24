<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '433471736844421',
            xfbml      : true,
            version    : 'v2.6'
        });

        // ADD ADDITIONAL FACEBOOK CODE HERE
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<header>
    <div id="lang"><a class="by" href="?lang=ru"></a><a class="en" href="?lang=en"></a><a class="uk" href="?lang=uk"></a> <a class="et" href="?lang=et"></a></div>
</header>

<div class="message">




    <?php echo $message; ?><br>
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>

</div>