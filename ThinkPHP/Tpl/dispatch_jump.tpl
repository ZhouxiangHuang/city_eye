<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Home</title>

    <!-- Styles -->
    <link href="__HOME__/css/googleapis.css" rel="stylesheet">


    <!-- favicon and touch icons -->
    <link rel="shortcut icon" href="__HOME__/assets/images/favicon.png">

    <!-- Bootstrap -->
    <link href="__HOME__/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="__HOME__/plugins/slick/slick.css" rel="stylesheet">
    <link href="__HOME__/plugins/slick-nav/slicknav.css" rel="stylesheet">
    <link href="__HOME__/plugins/wow/animate.css" rel="stylesheet">
    <link href="__HOME__/assets/css/bootstrap.css" rel="stylesheet">
    <link href="__HOME__/assets/css/theme.css" rel="stylesheet">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="__HOME__/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script src="__HOME__/js/modernizr.custom.js"></script>

</head>
<body>
<div id="page-loader">
    <div class="loaders">
        <img src="__HOME__/assets/images/loader/3.gif" alt="First Loader">
        <img src="__HOME__/assets/images/loader/4.gif" alt="First Loader">
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
                            <select ng-model="lan" ng-change="changeLan(model)" name="currency" id="language-dropdown">
                                <option value="zh-CN">zh-cn</option>
                                <option value="hu-hu">hu-hu</option>
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
                    <a href="/"><img style="width: 135px; height: 52px;" src="__HOME__/assets/images/logo.png"
                                     alt="Logo"></a>
                </figure>
            </div>
            <div class="col-md-6 col-sm-8">
                <nav id="site-nav" class="nav navbar-default">
                    <ul class="nav navbar-nav">
                        <li><a href="/">{$Think.lang.home_page}</a></li>
                        <li><a href="/home/index/lists.html">{$Think.lang.house_property}</a></li>
                        <li><a href="single-property.html">{$Think.lang.housing_trust}</a></li>
                        <li><a href="gallery.html">{$Think.lang.service_items}</a></li>
                        <li><a href="gallery.html">{$Think.lang.tourism}</a></li>
                        <li><a href="contact.html">{$Think.lang.about_us}</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="contact-in-header clearfix">
                    <i class="fa fa-mobile"></i>
                    <span>
                        {$Think.lang.call_us_now}
                        <br>
                    <strong>+ 3630 8892125</strong>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<h1 class="header-w3ls w3l w3">Swanky Error Page</h1>
<div class="container-w3layouts agileinfo w3-agileits agileits-w3layouts w3-agile">
    <svg version="1.1" viewbox="0 0 800 400">
        <title>Adding Background to Text using SVG clipPath</title>
        <defs>
            <clippath id="my-path">
                <text x="50" y="350">404</text>
            </clippath>
        </defs>
        <image xlink:href="__HOME__/images/content.jpg" clip-path="url(#my-path)" width="100%" height="100%" id="filler" preserveAspectRatio="none" />
    </svg>
</div>
<p class="error-agileits wthree">Sorry! This Page Doesn't Exist.</p>
<footer id="footer">
    <div class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <section class="widget about-widget clearfix">
                        <h4 class="title hide">About Us</h4>
                        <a class="footer-logo" href="#"><img src="__HOME__/assets/images/footer-logo.png"
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
<!-- jQuery (necessary for Bootstrap's JavaScript __HOME__/plugins) -->
<script src="__HOME__/assets/js/jquery.min.js"></script>
<script src="__HOME__/assets/js/jquery.migrate.js"></script>
<script src="__HOME__/assets/js/bootstrap.min.js"></script>
<script src="__HOME__/plugins/slick-nav/jquery.slicknav.min.js"></script>
<script src="__HOME__/plugins/slick/slick.min.js"></script>
<script src="__HOME__/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="__HOME__/plugins/tweetie/tweetie.js"></script>
<script src="__HOME__/plugins/forms/jquery.form.min.js"></script>
<script src="__HOME__/plugins/forms/jquery.validate.min.js"></script>
<script src="__HOME__/plugins/modernizr/modernizr.custom.js"></script>
<script src="__HOME__/plugins/wow/wow.min.js"></script>
<script src="__HOME__/plugins/zoom/zoom.js"></script>
<script src="__HOME__/plugins/mixitup/mixitup.min.js"></script>
<!---<script src="http://ditu.google.cn/maps/api/js?key=AIzaSyD2MtZynhsvwI2B40juK6SifR_OSyj4aBA&libraries=places"></script>--->
<script src="__HOME__/plugins/whats-nearby/source/WhatsNearby.js"></script>
<script src="__HOME__/assets/js/theme.js"></script>
<script src="__HOME__/js/angular.min.js"></script>
<script src="__HOME__/js/angular-cookie.min.js"></script>
<script src="__STATIC__/layer/layer.js"></script>
<script src="__HOME__/js/index.js"></script>
</body>
</html>