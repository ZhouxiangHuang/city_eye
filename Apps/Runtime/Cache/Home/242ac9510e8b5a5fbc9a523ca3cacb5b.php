<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>City Night</title>

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
<body class="listing-template" ng-app="myApp" ng-controller="ListController">
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
<div id="site-banner" class="text-center clearfix">
    <div class="container">
        <h1 class="title wow slideInLeft"><?php echo (L("listings_listings")); ?></h1>
        <!--<ol class="breadcrumb wow slideInRight">
            <li><a href="index.html">Home</a></li>
            <li><a href="property-map-view.html">Listing</a></li>
            <li class="active">Properties Grid</li>
        </ol>-->
    </div>
</div>
<div id="advance-search" class="main-page clearfix">
    <div class="container">
        <button class="btn top-btn">Find Your Place</button>
        <form action="#" id="adv-search-form" class="clearfix">
            <fieldset>
                <input type="hidden" id="lan-val" value="<?php echo ($lan); ?>">
                <select ng-model="location_area" name="location_area" >
                    <option value=""><?php echo (L("area")); ?></option>
                    <option ng-if="lan !='hu-hu'" ng-selected="{{ location_area == area.id }}" ng-repeat="area in area_list" value="{{ area.id }}">{{ area.city_name }}</option>
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
                <select ng-click="choosePrice()"   ng-model="min_price" name="min-price" id="property-min-price">
                    <option  value=""><?php echo (L("min_price")); ?></option>
                    <option ng-if="type == 'rent'" ng-repeat="(index, price) in rent_price_min" value="{{ index }}">{{ price }}</option>
                    <option ng-if="type == 'sale'" ng-repeat="(index, price) in sale_price_min" value="{{ index }}">{{ price }}</option>
                </select>
                <select ng-click="choosePrice()" ng-model="max_price" name="max-price" id="property-max-price">
                    <option value=""><?php echo (L("max_price")); ?></option>
                    <option ng-if="type == 'rent'" ng-repeat="(index, price) in rent_price_max" value="{{ index }}">{{ price }}</option>
                    <option ng-if="type == 'sale'" ng-repeat="(index, price) in sale_price_max" value="{{ index }}">{{ price }}</option>
                </select>
            </fieldset>
            <div type="submit" ng-click="jumpToLists()" class="btn btn-default btn-lg text-center"><?php echo (L("search")); ?> <br class="hidden-sm hidden-xs"> <?php echo (L("housing_resources")); ?>
            </div>
        </form>
    </div>
</div>
<section id="property-listing">
    <header class="section-header text-center" id="titleHeader">
        <div class="container">
            <h2 ng-show="p != countPage" class="pull-left">Showing {{ ((p - 1) * 9 + 1) }} - {{ p * 9 }} of {{ countHouse }} items</h2>
            <h2 ng-show="p == countPage" class="pull-left">Showing {{ ((p - 1) * 9 + 1) }} - {{ countHouse }} of {{ countHouse }} items</h2>
        </div>
    </header>
    <div class="container section-layout">
        <div class="row">
            <div class="col-lg-4 col-sm-6 layout-item-wrap" ng-repeat="house in house_list">
                <article class="property layout-item clearfix">
                    <figure class="feature-image">
                        <a class="clearfix zoom" href="javascript:;"><img data-action="zoom"
                                                                                  ng-src="/{{ house.filepath }}"
                                                                                  alt="Property Image"></a>
                        <span ng-if="lan == 'hu-hu'" class="btn btn-warning btn-sale">{{ house.is_sale == 1 ? 'magadat' : 'kiadó' }}</span>
                        <span ng-if="lan != 'hu-hu'" class="btn btn-warning btn-sale">{{ house.is_sale == 1 ? '售卖' : '出租' }}</span>
                    </figure>
                    <div class="property-contents clearfix">
                        <a href="/home/index/detail/id/{{ house.id }}">
                        <header class="property-header clearfix">
                            <div class="pull-left">
                                <h6 class="entry-title"><a href="/home/index/detail/id/{{ house.id }}">{{ lan != 'hu-hu' ? house.title : house.title_hun }}</a></h6>
                                <span class="property-location"><i class="fa fa-map-marker"></i>{{ lan != 'hu-hu' ? house.address : house.address_hun }} </span>
                            </div>
                            <button class="btn btn-default btn-price pull-right btn-3d" data-hover="HFU {{ house.price }}"><strong>HFU {{ house.price }}</strong>
                            </button>
                        </header>
                        </a>
                        <div class="property-meta clearfix">
                            <span><i class="fa fa-arrows-alt"></i> {{ house.proportion }} m²</span>
                            <span ng-show="house.room_num > 0"><i class="fa fa-bed"></i> {{ house.room_num }} Beds</span>
                            <span ng-show="house.wc_num > 0"><i class="fa fa-bathtub"></i> {{ house.wc_num }} Baths</span>
                            <span ng-if="house.garage_area > 0"><i class="fa fa-cab"></i> Yes</span>
                            <span ng-if="house.garage_area <= 0"><i class="fa fa-cab"></i> No</span>
                        </div>
                    </div>
                </article>
            </div>
            <!--<div class="col-lg-4 col-sm-6 layout-item-wrap">-->
                <!--<article class="property layout-item clearfix">-->
                    <!--<figure class="feature-image">-->
                        <!--<a class="clearfix zoom" href="single-property.html"><img data-action="zoom"-->
                                                                                  <!--src="/Public/home/assets/images/property/2.jpg"-->
                                                                                  <!--alt="Property Image"></a>-->
                        <!--<span class="btn btn-warning btn-sale">for sale</span>-->
                    <!--</figure>-->
                    <!--<div class="property-contents clearfix">-->
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
                        <!--<div class="contents clearfix">-->
                            <!--<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor-->
                                <!--invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et-->
                                <!--accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata-->
                                <!--sanctus est Lorem ipsum dolor sit amet. </p>-->
                        <!--</div>-->
                        <!--<div class="author-box clearfix">-->
                            <!--<a href="#" class="author-img"><img src="/Public/home/assets/images/agents/1.jpg"-->
                                                                <!--alt="Agent Image"></a>-->
                            <!--<cite class="author-name">Personal Seller: <a href="#">Linda Garret</a></cite>-->
                            <!--<span class="phone"><i class="fa fa-phone"></i> 00894 692-49-22</span>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</article>-->
            <!--</div>-->
        </div>
        <ul id="pagination" class="text-center clearfix" ng-if="countPage > 1">
            <li ng-show="p != 1" ng-click="getMore(1)"><a href="javascript:;">首页</a></li>
            <li ng-show="p > 1" ng-click="getMore(p-1)"><a href="javascript:;">{{ p - 1 }}</a></li>
            <li class="disabled" ng-click="getMore(p)"><a href="javascript:;">{{ p }}</a></li>
            <li ng-if=" (p + 1) <= countPage" ng-click="getMore(p+1)"><a href="javascript:;">{{ p + 1 }}</a></li>
            <li ng-show="p != countPage" ng-click="getMore(countPage)"><a href="javascript:;">尾页</a></li>
        </ul>
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
<script src="/Public/home/js/list.js"></script>
</body>
</html>