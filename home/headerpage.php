<?php

/**
 * @author lolkittens
 * @copyright 2014
 */
?>
<!DOCTYPE HTML>
<html>
<head>
<title>
<?php
	echo 'West African Clearing And Forwarding Liberia Inc.';
?>
</title>
<script src="../jQuery/jquery-1.11.0.js" type="text/javascript"></script>
    <!--<link href="../css/lhdi.css" media="all" type="text/css" rel="stylesheet" />-->
        <link href="../css/platinum.css" media="all" type="text/css" rel="stylesheet" />
<!--required for the date picker control-->

<script src="../jQueryUI/jquery-ui.js"></script>
<link rel="stylesheet" href="../jQueryUI/jquery-ui.css" />
<script src="../jQueryUI/script.js"></script>
<script type="text/javascript" src="../jQuery/switchImage.js"></script>
<link rel="stylesheet" href="../css/runnable.css" media="all" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

        ul#shipping{
            display: none;
        }
        /*ul li ul li ul{
            display: none;
        }*/
        ul#shipping li ul li:hover ul {
            display: block;
        }
        /*  ul li ul li{
             display: block;
         }*/
     ul#shipping ul li a{
             background-color: red;
         }

        ul#subNav li > div#shipping  {
            display: none;
        }

        ul#subNav li:hover  div#shipping{

            position: absolute;
            padding: 0;
            margin-top: 0;
            top: 0;
            left: 160px;

            display: inline-block;
            width: 150px;
            height: 30px;
            margin-left: 5px;
            text-align: left;
        }


        div#shipping  a {
            display: block;
            color: white;
            background-color: navy;
            text-decoration: none;
            margin-bottom: 3px;

        }

        div#shipping  a:hover {
            background-color: red;

        }

    </style>
</head>
<body>
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

<div id="top_header">
<!--<img class="changeImage" src="../images/banner/webbanner0.jpg" alt="image1"/>-->
    <img class="changeImage" src="../images/banner/webbanner1.png" alt="image5"/>
    <img class="hidden" src="../images/banner/webbanner2.jpg" alt="image4"/>
    <img  class="hidden" src="../images/banner/webbanner3.jpg" alt="image2"/>
    <img class="hidden" src="../images/banner/webbanner4.jpg" alt="image6"/>
</div>
<!--<img id="logo" alt="logo" src="../images/logo.png"/>-->
<!--<span id="logoText">Logo</span>-->
<div id="menu_wrapper" style="width: 1000px;; height: 57px; background-color: #a9a9a9; padding-top: 3px; margin-top: 10px;">
    <div id="wrapper_inner" style="padding 5px; height: 58px;">
        <div id="menu_div" style="padding-left: 10px; float: left; width: 85%;  padding-top: 17px;">
            <ul id="topNav">
                <li style="position: relative; left: 0;"><a href="index.php">Home</a></li>
                <li><a href="companyprofile.php">Company Profile</a></li>
                <li><a href="#">Services</a>
                    <ul id="subNav">
                        <li  style="position: relative;">
                            <a href="#">Shipping</a>
                            <div id="shipping">
                                <a href="../admin/airfrieght.php">Air</a>
                                <a href="../admin/seafrieght.php">Sea</a>
                                <a href="../admin/landfrieght.php">Land</a>
                            </div>
                        </li>
                        <li><a href="http://localhost/wacaflibinc/admin/login.php">Clearing and Forwarding</a></li>
                        <li><a href="#">Vehicle Rental</a></li>
                        <li><a href="#">Truck Rental</a></li>
                        <li><a href="#">Heavy and Earth Moving Equipment Rental</a></li>
                        <li><a href="#">General Procurement</a></li>
                    </ul>
                </li>
                <li><a href="managementteam.php">Management Team</a>
                </li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
                <!--<li style="padding-bottom: 25px;"><a href="https://emailmg.ipage.com/ox6/ox.html" style="display: inline-block; width: 20px; height: 10px;
                 background-image:  url('../images/tn_email1.jpg'); background-repeat: no-repeat;"></a></li>-->
            </ul>
        </div><!-- end menu-->
        <div id="email" style="float:right; height: 49px; padding-top: 4px; width: 10%; ">
            <a href="https://emailmg.ipage.com/ox6/ox.html" target="_new">
                <img src="../images/tn_email1.jpg" id="emaillink" height="40px" width="50px"/>
            </a>
        </div>
    </div>
<script type="application/javascript">
    $(function() {
       // alert('jQuery works');
       /* $('ul li').hover(function () {
                // alert('Hovering');
                //display the hidden ul element
               // alert('Clearing the queue');
                $('ul', this).css(
                    {
                        'display': 'block',
                         'width': '150',
                         'position': 'absolute',
                         'top': '30px'
                    }
                ).slideDown(1500).clearQueue();
                 // $('ul', this).slideDown(5000);
                *//*$('ul', this).css(
                    {
                        'display': 'block',
                        'zIndex': '10'
                    }
                );*//*
            }, function () {
                //alert('Stop alerting')});
                    $('ul', this).slideUp(1000);//.css('zIndex', '0');
            }
        );*/
    })
</script>
</div><!--end menu wrapper div-->

<!--<div id="main_body" style="height: 100%; width: 1000px; background-color: blue; color: white;">
<h2>Welcome to Land Housing And Development Inc</h2>
    <div id="left_col" style="float:left; width: 73%; border-right:green solid thin;">
        <h3>Left Column</h3>
    </div>

<div id="right_col" style="float: left; width: 25%;">
    <h3>Right Column</h3>
</div>
</div>-->
