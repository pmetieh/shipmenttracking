<?php
	include_once('headerpage.php');
?>
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '',
                xfbml      : true,
                version    : 'v2.0'
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
<script type="text/javascript" src="http://localhost/wacaflibinc/jQuery/switchImage.js"></script>

<div class="main" id="main">
    <div class="rightCol">
    <h3>Welcome to West African Clearing And Forwarding Liberia Inc</h3>
    <p>
      <b>West African Clearing And Forwarding Liberia Inc</b>. is one of Liberia's newest, but most innovative and
        fastest growing Logistic services company.
        We provide all logistics and related services in Liberia. We are very professional in our business activities,
        deploying the most cutting edge technology in our service delivery to our clients.
        Our services are affordable, highly competitive, and very efficient.
    </p>
    </div>

    <div class="leftCol">
    <h3>Register as customer</h3>
    <p>
      <a href="../admin/customer.php" style="text-decoration: none;"><h3>Register</h3></a>
    </p>
    </div>
</div>
<script type="text/javascript">
moveImage();
</script>
<?php
	include_once('footerpage.php');
?>