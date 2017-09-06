<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Home</title>

    <!-- Styles -->
    <link href="/Public/home/css/googleapis.css" rel="stylesheet">


    <!-- favicon and touch icons -->
    <link rel="shortcut icon" href="/Public/home/assets/images/favicon.png">

    <!-- Bootstrap -->
    <link href="/Public/home/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/home/plugins/slick/slick.css" rel="stylesheet">
    <link href="/Public/home/plugins/slick-nav/slicknav.css" rel="stylesheet">
    <link href="/Public/home/plugins/wow/animate.css" rel="stylesheet">
    <link href="/Public/home/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/Public/home/assets/css/theme.css" rel="stylesheet">

</head>
<body class="" ng-app="myApp" ng-controller="IndexController">
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
                    <a href="/"><img style="width: 135px; height: 52px;" src="/Public/home/assets/images/logo.png"
                                     alt="Logo"></a>
                </figure>
            </div>
            <div class="col-md-6 col-sm-8">
                <nav id="site-nav" class="nav navbar-default">
                    <ul class="nav navbar-nav">
                        <li><a href="/"><?php echo (L("home_page")); ?></a></li>
                        <li><a href="/home/index/lists.html"><?php echo (L("house_property")); ?></a></li>
                        <li><a href="single-property.html"><?php echo (L("housing_trust")); ?></a></li>
                        <li><a href="/home/index/serviceItems"><?php echo (L("service_items")); ?></a></li>
                        <li><a href="/home/index/tourism"><?php echo (L("tourism")); ?></a></li>
                        <li><a href="contact.html"><?php echo (L("about_us")); ?></a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="contact-in-header clearfix">
                    <i class="fa fa-mobile"></i>
                    <span>
                        <?php echo (L("call_us_now")); ?>
                        <br>
                    <strong>+ 3630 8892125</strong>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="main-slider-wrapper clearfix">
    <div id="main-slider">
        <div class="slide"><img src="/Public/home/assets/images/slider/12.jpg" alt="Slide"></div>
        <div class="slide"><img src="/Public/home/assets/images/slider/13.jpg" alt="Slide"></div>
        <div class="slide"><img src="/Public/home/assets/images/slider/14.jpg" alt="Slide"></div>
        <div class="slide"><img src="/Public/home/assets/images/slider/4.jpg" alt="Slide"></div>
    </div>
    <div id="slider-contents">
        <div class="container text-center">
            <div class="jumbotron">
                <h1><?php echo (L("dream_house")); ?></h1>
                <div class="contents clearfix">
                    <p>If you dream of designing a new home that takes full advantage of <br>
                        the unique geography and views of land that you love</p>
                </div>
                <!--<a class="btn btn-warning btn-lg btn-3d" data-hover="Our Services" href="#" role="button">Our Services</a>-->
                <!--<a class="btn btn-default btn-border btn-lg" href="#" role="button">Get a Quote</a>-->
            </div>
        </div>
    </div>
</div>
<div id="advance-search" class="main-page clearfix">
    <div class="container">
        <button class="btn top-btn"><?php echo (L("find_place")); ?></button>
        <form action="" id="adv-search-form" class="clearfix">
            <fieldset>
                <input type="hidden" id="lan-val" value="<?php echo ($lan); ?>">
                <select ng-model="location_area" name="location_area" id="main-location">
                    <option value=""><?php echo (L("area")); ?></option>
                    <option ng-if="lan !='hu-hu'" ng-repeat="area in area_list" value="{{ area.id }}">{{ area.city_name }}</option>
                    <option ng-if="lan =='hu-hu'" ng-repeat="area in area_list" value="{{ area.id }}">{{ area.city_name_hun }}</option>
                </select>
                <select ng-model="type" name="type" id="property-sub-location">
                    <option value=""><?php echo (L("type")); ?></option>
                    <option value="rent"><?php echo (L("rent")); ?></option>
                    <option value="sale"><?php echo (L("sale")); ?></option>
                </select>
                <select ng-model="bedrooms" name="bedrooms" id="property-beds">
                    <option value=""><?php echo (L("room_num")); ?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <select ng-model="bathrooms" name="bathrooms" id="property-baths">
                    <option value=""><?php echo (L("bathroom_num")); ?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <input ng-model="min_area" type="text" name="min-area" id="property-min-area" placeholder="<?php echo (L("min_area")); ?> (m²)">
                <input ng-model="max_area" type="text" name="max-area" id="property-max-area" placeholder="<?php echo (L("max_area")); ?> (m²)">
                <select ng-model="min_price" name="min-price" id="property-min-price">
                    <option value=""><?php echo (L("min_price")); ?></option>
                    <option value="1000">HUF 1000</option>
                    <option value="5000">HUF 5000</option>
                    <option value="10000">HUF 10000</option>
                    <option value="50000">HUF 50000</option>
                    <option value="100000">HUF 100000</option>
                    <option value="200000">HUF 200000</option>
                    <option value="300000">HUF 300000</option>
                    <option value="400000">HUF 400000</option>
                    <option value="500000">HUF 500000</option>
                    <option value="600000">HUF 600000</option>
                    <option value="700000">HUF 700000</option>
                    <option value="800000">HUF 800000</option>
                    <option value="900000">HUF 900000</option>
                    <option value="1000000">HUF 1000000</option>
                    <option value="1500000">HUF 1500000</option>
                    <option value="2000000">HUF 2000000</option>
                    <option value="2500000">HUF 2500000</option>
                    <option value="5000000">HUF 5000000</option>
                </select>
                <select ng-model="max_price" name="max-price" id="property-max-price">
                    <option value=""><?php echo (L("max_price")); ?></option>
                    <option value="5000">HUF 5000</option>
                    <option value="10000">HUF 10000</option>
                    <option value="50000">HUF 50000</option>
                    <option value="100000">HUF 100000</option>
                    <option value="200000">HUF 200000</option>
                    <option value="300000">HUF 300000</option>
                    <option value="400000">HUF 400000</option>
                    <option value="500000">HUF 500000</option>
                    <option value="600000">HUF 600000</option>
                    <option value="700000">HUF 700000</option>
                    <option value="800000">HUF 800000</option>
                    <option value="900000">HUF 900000</option>
                    <option value="1000000">HUF 1000000</option>
                    <option value="1500000">HUF 1500000</option>
                    <option value="2000000">HUF 2000000</option>
                    <option value="2500000">HUF 2500000</option>
                    <option value="5000000">HUF 5000000</option>
                    <option value="10000000">HUF 10000000</option>
                </select>
            </fieldset>
            <div type="submit"  ng-click="jumpToLists()" class="btn btn-default btn-lg text-center"><?php echo (L("search")); ?> <br class="hidden-sm hidden-xs"> <?php echo (L("housing_resources")); ?>
            </div>
        </form>
    </div>
</div>
<section id="home-property-listing">
    <header class="section-header home-section-header text-center">
        <div class="container">
            <h2 class="wow slideInRight"><?php echo (L("recent_listings")); ?></h2>
           <!-- <p class="wow slideInLeft">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut <br>
                labore et dolore magna aliquan ut enim ad minim veniam.</p>-->
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div id="property-for-rent-slider">
                <?php if(is_array($houseInfoMsg)): $i = 0; $__LIST__ = $houseInfoMsg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$house): $mod = ($i % 2 );++$i;?><div class="col-lg-4 col-md-6">
                        <article class="property clearfix">
                            <figure class="feature-image">
                                <a class="clearfix" href="/home/index/detail/id/<?php echo ($house["id"]); ?>"> <img
                                        src="/<?php echo ($house["filepath"]); ?>" alt="Property Image"></a>
                            </figure>
                            <div class="property-contents">
                                <header class="property-header clearfix">
                                    <div class="pull-left">
                                        <h6 ng-show="{{ lan != 'hu-hu' }}" class="entry-title"><a href="/home/index/detail/id/<?php echo ($house["id"]); ?>"><?php echo ($house["title"]); ?></a></h6>
                                        <h6 ng-show="{{ lan == 'hu-hu' }}" class="entry-title"><a href="/home/index/detail/id/<?php echo ($house["id"]); ?>"><?php echo ($house["title_hun"]); ?></a></h6>
                                        <span ng-show="{{ lan != 'hu-hu' }}" class="property-location"><i class="fa fa-map-marker"></i><?php echo ($house["address"]); ?></span>
                                        <span ng-show="{{ lan == 'hu-hu' }}" class="property-location"><i class="fa fa-map-marker"></i><?php echo ($house["address_hun"]); ?></span>
                                    </div>
                                    <button class="btn btn-default btn-price pull-right btn-3d" data-hover="HUF<?php echo ($house["price"]); ?>"><strong>HUF <?php echo ($house["price"]); ?></strong>
                                    </button>
                                </header>
                                <div class="property-meta clearfix">
                                    <span><i class="fa fa-arrows-alt"></i> <?php echo ($house["proportion"]); ?> m²</span>
                                    <?php if($house["room_num"] > 0): ?><span><i class="fa fa-bed"></i> <?php echo ($house["room_num"]); ?> Beds</span><?php endif; ?>
                                    <?php if($house["wc_num"] > 0): ?><span><i class="fa fa-bed"></i> <?php echo ($house["wc_num"]); ?> Baths</span><?php endif; ?>
                                    <?php if($house["garage_area"] > 0): ?><span><i class="fa fa-bed"></i> Yes</span>
                                        <?php else: ?>
                                        <span><i class="fa fa-cab"></i> No</span><?php endif; ?>
                                </div>
                            </div>
                        </article>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <!--<div class="col-lg-4 col-md-6">-->
                    <!--<article class="property clearfix">-->
                        <!--<figure class="feature-image">-->
                            <!--<a class="clearfix" href="single-property.html"> <img-->
                                    <!--src="/Public/home/assets/images/property/1.jpg" alt="Property Image"></a>-->
                        <!--</figure>-->
                        <!--<div class="property-contents">-->
                            <!--<header class="property-header clearfix">-->
                                <!--<div class="pull-left">-->
                                    <!--<h6 class="entry-title"><a href="single-property.html">Guaranteed modern home</a></h6>-->
                                    <!--<span class="property-location"><i class="fa fa-map-marker"></i> 14 Tottenham Road, London</span>-->
                                <!--</div>-->
                                <!--<button class="btn btn-default btn-price pull-right btn-3d" data-hover="$389.000"><strong>$389.000</strong>-->
                                <!--</button>-->
                            <!--</header>-->
                            <!--<div class="property-meta clearfix">-->
                                <!--<span><i class="fa fa-arrows-alt"></i> 3060 SqFt</span>-->
                                <!--<span><i class="fa fa-bed"></i> 3 Beds</span>-->
                                <!--<span><i class="fa fa-bathtub"></i> 3 Baths</span>-->
                                <!--<span><i class="fa fa-cab"></i> Yes</span>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</article>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</section>
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
                        <h4 class="title"><?php echo (L("our_service")); ?></h4>
                        <div id="twitter-feeds" class="clearfix"><?php echo (L("company_desc")); ?></div>
                    </section>
                </div>
                <div class="col-md-4 col-sm-6">
                    <section class="widget address-widget clearfix">
                        <h4 class="title"><?php echo (L("office")); ?></h4>
                        <ul>
                            <li><i class="fa fa-map-marker"></i> Szallas u 47/b 2emelet 202szoba.</li>
                            <li><i class="fa fa-phone"></i> + 3630 8892125</li>
                            <li><i class="fa fa-envelope"></i> info@cityeyebp.com</li>
                            <li><i class="fa fa-weixin"></i> cityeye888</li>
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
<script src="/Public/home/js/index.js"></script>
</body>
</html>