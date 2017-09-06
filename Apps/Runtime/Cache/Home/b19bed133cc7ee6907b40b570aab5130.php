<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>City Night</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Poppins:400,600" rel="stylesheet">


    <!-- favicon and touch icons -->
    <link rel="shortcut icon" href="/Public/home/assets/images/favicon.png" >

    <!-- Bootstrap -->
    <link href="/Public/home/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/home/plugins/slick/slick.css" rel="stylesheet">
    <link href="/Public/home/plugins/slick-nav/slicknav.css" rel="stylesheet">
    <link href="/Public/home/plugins/wow/animate.css" rel="stylesheet">
    <link href="/Public/home/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/Public/home/assets/css/theme.css" rel="stylesheet">

</head>
<body class="contact-template" ng-app="myApp" ng-controller="ContactController">
<div id="page-loader">
    <div class="loaders">
        <img src="/Public/home/assets/images/loader/3.gif" alt="First Loader">
        <img src="/Public/home/assets/images/loader/4.gif" alt="First Loader">
    </div>
</div>
<header id="site-header">
    <div id="site-header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-5">

                </div>
                <div class="col-md-7">
                    <div class="clearfix">
                        <div class="language-in-header">
                            <i class="fa fa-globe"></i>
                            <label for="language-dropdown"> Language:</label>
                            <select name="currency" id="language-dropdown">
                                <option value="ENG">ENG</option>
                                <option value="AR">AR</option>
                                <option value="UR">UR</option>
                                <option value="NEO">NEO</option>
                                <option value="AKA">AKA</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 visible-lg-inline visible-md-inline ">
                <figure id="site-logo">
                    <a href="/"><img style="width: 135px; height: 52px;" src="/Public/home/assets/images/logo.png"
                                     alt="Logo"></a>
                </figure>
            </div>
            <div class="col-md-6 col-sm-8">
                <nav id="site-nav" class="nav navbar-default">
                    <ul class="nav navbar-nav">
                        <li><a href="/">首页</a></li>
                        <li><a href="/home/index/lists.html">房产</a></li>
                        <li><a href="single-property.html">房屋托管</a></li>
                        <li><a href="gallery.html">服务项目</a></li>
                        <li><a href="gallery.html">旅游</a></li>
                        <li><a href="contact.html">关于我们</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="contact-in-header clearfix">
                    <i class="fa fa-mobile"></i>
                    <span>
                        Call Us Now
                        <br>
                    <strong>+ 3630 8892125</strong>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="site-banner" class="text-center clearfix">
    <div class="container">
        <h1 class="title wow slideInLeft">欢迎联系我们</h1>
        <!--<ol class="breadcrumb wow slideInRight">
            <li><a href="index.html">Home</a></li>
            <li class="active">Contact</li>
        </ol>-->
    </div>
</div>
<div id="contact-page" class="contact-page-var-one">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form-wrapper">
                    <h3 class="entry-title">联系我们</h3>
                    <div class="contents">
                        <p>Sed perspiciatis unde natus error sit voluptatem accusantium doloremque  laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.</p>
                    </div>
                    <form action="form-handler.php" method="post" class="contact-form">
                        <p class="form-author common">
                            <input ng-model="name" id="author" name="name" type="text" placeholder="Your Name *" aria-required="true" required="required">
                        </p>
                        <p class="form-email common">
                            <input ng-model="email" id="email" name="email" type="text" placeholder="Your Email *" aria-describedby="email-notes" aria-required="true" required="required">
                        </p>
                        <p class="form-phone common">
                            <input ng-model="phone" id="phone" name="phone" type="text" placeholder="Your Phone Number " aria-required="true" required="required" >
                        </p>
                        <p class="form-subject common">
                            <input ng-model="subject" id="subject" name="subject" type="text" placeholder="subject">
                        </p>
                        <p class="form-comment">
                            <textarea ng-model="message" id="message" name="message" placeholder="Comment" cols="45" rows="7" ></textarea>
                        </p>
                        <p class="form-submit">
                            <div ng-click="sendMail()" type="submit" id="submit-button" class="submit-btn btn btn-default btn-lg btn-3d" data-hover="Post Comment">Post Comment</div>
                            <span id="ajax-loader"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span></span>
                        </p>
                        <div id="error-container"></div>
                        <div id="message-container"></div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-page-contents clearfix">
                    <div class="row">
                        <div class="col-md-6">
                            <i class="fa fa-map-marker"></i>
                            <div class="contents">
                                <h6 class="title">Mailing Address</h6>
                                <address>
                                    95 Amphitheatre Parkway
                                    Mountain View CA,
                                    United States
                                </address>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <i class="fa fa-phone"></i>
                            <div class="contents">
                                <h5 class="title">Contact Info</h5>
                                <ul>
                                    <li>Phone: (123) 45678910</li>
                                    <li>Mail: company@domain.com</li>
                                    <li>Fax: +84 962 216 601</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer id="footer">
    <div class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <section class="widget about-widget clearfix">
                        <h4 class="title hide">About Us</h4>
                        <a class="footer-logo" href="#"><img src="/Public/home/assets/images/footer-logo.png"
                                                             alt="Footer Logo"></a>
                        <p></p>
                        <!--<ul class="social-icons clearfix">
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                        </ul>-->
                    </section>
                </div>
                <div class="col-md-4 col-sm-6">
                    <section class="widget twitter-widget clearfix">
                        <h4 class="title">Latest Tweets</h4>
                        <div id="twitter-feeds" class="clearfix">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi</div>
                    </section>
                </div>
                <div class="col-md-4 col-sm-6">
                    <section class="widget address-widget clearfix">
                        <h4 class="title">OUR OFFICE</h4>
                        <ul>
                            <li><i class="fa fa-map-marker"></i> 4 Tottenham Road, London, England.</li>
                            <li><i class="fa fa-phone"></i> (123) 45678910</li>
                            <li><i class="fa fa-envelope"></i> huycoi.art@gmail.com</li>
                            <li><i class="fa fa-fax"></i> +84 962 216 601</li>
                            <li><i class="fa fa-clock-o"></i> Mon - Sat: 9:00 - 18:00</li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer-bottom">
        <div class="container">
            <p class="copyright pull-left wow slideInRight">Copyright &copy; 2017.Company name All rights reserved
            </p>
        </div>
    </div>
</footer>
<a href="#top" id="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- jQuery (necessary for Bootstrap's JavaScript /Public/home/plugins) -->
<script src="/Public/home/assets/js/jquery.min.js"></script>
<script src="/Public/home/assets/js/jquery.migrate.js"></script>
<script src="/Public/home/assets/js/bootstrap.min.js"></script>
<script src="/Public/home/plugins/slick-nav/jquery.slicknav.min.js"></script>
<script src="/Public/home/plugins/slick/slick.min.js"></script>
<script src="/Public/home/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/Public/home/plugins/tweetie/tweetie.js"></script>
<script src="/Public/home/plugins/forms/jquery.form.min.js"></script>
<script src="/Public/home/plugins/forms/jquery.validate.min.js"></script>
<script src="/Public/home/plugins/modernizr/modernizr.custom.js"></script>
<script src="/Public/home/plugins/wow/wow.min.js"></script>
<script src="/Public/home/plugins/zoom/zoom.js"></script>
<script src="/Public/home/plugins/mixitup/mixitup.min.js"></script>
<!---<script src="http://ditu.google.cn/maps/api/js?key=AIzaSyD2MtZynhsvwI2B40juK6SifR_OSyj4aBA&libraries=places"></script>--->
<script src="/Public/home/plugins/whats-nearby/source/WhatsNearby.js"></script>
<script src="/Public/home/assets/js/theme.js"></script>
<script src="/Public/home/js/angular.min.js"></script>
<script src="/Public/home/js/angular-cookie.min.js"></script>
<script src="/Public/static/layer/layer.js"></script>
<script src="/Public/home/js/contact.js"></script>
</body>
</html>