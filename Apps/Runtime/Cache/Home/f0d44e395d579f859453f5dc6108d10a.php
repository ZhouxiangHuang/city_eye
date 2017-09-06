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
<body class="" ng-app="myApp" ng-controller="DetailController">
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
                        <li><a href="gallery.html"><?php echo (L("service_items")); ?></a></li>
                        <li><a href="gallery.html"><?php echo (L("tourism")); ?></a></li>
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
<div id="property-single">
    <div id="main-slider">
        <?php if(is_array($data["file_path"])): $i = 0; $__LIST__ = $data["file_path"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$path): $mod = ($i % 2 );++$i;?><div class="slide"><img src="/<?php echo ($path); ?>" alt="Slide"></div><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="slide"><img src="/Public/home/assets/images/slider/2.jpg" alt="Slide"></div>
        <div class="slide"><img src="/Public/home/assets/images/slider/3.jpg" alt="Slide"></div>
        <div class="slide"><img src="/Public/home/assets/images/slider/4.jpg" alt="Slide"></div>
    </div>
    <input id="lan-val" type="hidden" value="<?php echo ($lan); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <section class="property-meta-wrapper common col-sm-12">
                    <?php if($lan != 'hu-hu'): ?><h3 class="entry-title"><?php echo ($data["title"]); ?></h3>
                        <?php else: ?>
                        <h3 class="entry-title"><?php echo ($data["title_hun"]); ?></h3><?php endif; ?>
                    <div class="property-single-meta col-sm-6">
                        <ul class="clearfix">
                            <li><span><?php echo (L("house_area")); ?> :</span> <?php echo ($data['proportion']); ?> m²</li>
                            <li><span><?php echo (L("house_code")); ?> :</span> <?php echo ($data["coder"]); ?></li>
                            <li><span><?php echo (L("room_num")); ?> :</span> <?php echo ($data["room_num"]); ?> Room</li>
                            <li><span><?php echo (L("bathroom_num")); ?> :</span> <?php echo ($data["wc_num"]); ?> Room</li>
                            <?php if($data["garden_area"] > 0): ?><li><span><?php echo (L("garden_area")); ?> :</span> YES - <?php echo ($data["garden_area"]); ?> m²</li>
                                <?php else: ?>
                                <li><span><?php echo (L("garden_area")); ?> :</span> NO </li><?php endif; ?>
                            <li><span><?php echo (L("build_year")); ?> :</span> <?php echo (date('Y-m-d', $data["creat_house_time"])); ?></li>
                            <li><span><?php echo (L("price")); ?> :</span> HFU <?php echo ($data["price"]); ?></li>
                            <?php if($lan != 'hu-hu'): ?><li><span><?php echo (L("address")); ?> :</span> <?php echo ($data["address"]); ?></li>
                                <?php else: ?>
                                <li><span><?php echo (L("address")); ?> :</span> <?php echo ($data["address_hun"]); ?></li><?php endif; ?>
                        </ul>
                    </div>
                    <div class="property-single-meta col-sm-6">
                        <ul class="clearfix">
                            <li><span><?php echo (L("floor")); ?> :</span> <?php echo ($data["floor_num"]); ?></li>
                            <?php if($data["is_floor_heat"] == 1): ?><li><span><?php echo (L("floor_heating")); ?> :</span> <i style="color: #000" class=" fa fa-check-circle"></i></li>
                                <?php else: ?>
                                <li><span><?php echo (L("floor_heating")); ?> :</span> <i style="color: #000" class=" fa fa-times-circle"></i></li><?php endif; ?>
                            <?php if($data["is_dulilinyu"] == 1): ?><li><span><?php echo (L("independent_shower")); ?> :</span> <i style="color: #000" class=" fa fa-check-circle"></i></li>
                                <?php else: ?>
                                <li><span><?php echo (L("independent_shower")); ?> :</span>  <i style="color: #000" class=" fa fa-times-circle"></i></li><?php endif; ?>
                            <?php if($data["is_lift"] == 1): ?><li><span><?php echo (L("elevator")); ?> :</span> <i style="color: #000" class=" fa fa-check-circle"></i></li>
                                <?php else: ?>
                                <li><span><?php echo (L("elevator")); ?> :</span>  <i style="color: #000" class=" fa fa-times-circle"></i></li><?php endif; ?>
                        </ul>
                    </div>
                </section>
                <?php if($data["memo"] != ''): ?><section class="property-contents common">
                        <div class="entry-title clearfix">
                            <h4 class="pull-left"><?php echo (L("description")); ?> </h4><!--<a class="pull-right print-btn"
                                                                  href="javascript:window.print()">Print This Property
                        <i class="fa fa-print"></i></a>-->
                        </div>
                        <p><?php echo ($data["memo"]); ?></p>
                    </section><?php endif; ?>

            </div>
            <div class="col-lg-4 col-md-5">
                <div id="property-sidebar">
                    <section class="widget adv-search-widget clearfix">
                        <h5 class="title hide"><?php echo (L("find_place")); ?></h5>
                        <div id="advance-search-widget" class="clearfix">
                            <form action="#" id="adv-search-form">
                                <div id="widget-tabs">
                                    <ul class="tab-list clearfix">
                                        <li><a class="btn" ng-click="changeToRent('sale')" href="#tab-1"><?php echo (L("sale")); ?></a></li>
                                        <li><a class="btn" ng-click="changeToRent('rent')" href="#tab-2"><?php echo (L("rent")); ?></a></li>
                                    </ul>
                                    <div id="tab-1" class="tab-content current">
                                        <fieldset class="clearfix">
                                            <div>
                                                <label for="main-location"><?php echo (L("area")); ?></label>
                                                <select ng-model="location_area" name="location" id="main-location-1">
                                                    <option value=""><?php echo (L("area")); ?></option>
                                                    <option ng-if="lan !='hu-hu'" ng-repeat="area in area_list" value="{{ area.id }}">{{ area.city_name }}</option>
                                                    <option ng-if="lan =='hu-hu'" ng-repeat="area in area_list" value="{{ area.id }}">{{ area.city_name_hun }}</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="property-beds-1"><?php echo (L("room_num")); ?></label>
                                                <select ng-model="bedrooms" name="bedrooms" id="property-beds-1">
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
                                            </div>
                                            <div>
                                                <label for="property-min-area-1"><?php echo (L("min_area")); ?>(m²)</label>
                                                <input type="text" name="min-area" ng-model="min_area" id="property-min-area-1">
                                            </div>
                                            <div>
                                                <label for="property-max-area-1"><?php echo (L("max_area")); ?>(m²)</label>
                                                <input type="text" name="max-area" ng-model="max_area" id="property-max-area-1">
                                            </div>
                                            <div>
                                                <label for="property-min-price-1"><?php echo (L("min_price")); ?></label>
                                                <select ng-model="min_price" name="min-price" id="property-min-price-1">
                                                    <option value="1000">$1000</option>
                                                    <option value="5000">$5000</option>
                                                    <option value="10000">$10000</option>
                                                    <option value="50000">$50000</option>
                                                    <option value="100000">$100000</option>
                                                    <option value="200000">$200000</option>
                                                    <option value="300000">$300000</option>
                                                    <option value="400000">$400000</option>
                                                    <option value="500000">$500000</option>
                                                    <option value="600000">$600000</option>
                                                    <option value="700000">$700000</option>
                                                    <option value="800000">$800000</option>
                                                    <option value="900000">$900000</option>
                                                    <option value="1000000">$1000000</option>
                                                    <option value="1500000">$1500000</option>
                                                    <option value="2000000">$2000000</option>
                                                    <option value="2500000">$2500000</option>
                                                    <option value="5000000">$5000000</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="property-max-price-1"><?php echo (L("max_price")); ?></label>
                                                <select ng-model="max_price" name="max-price" id="property-max-price-1">
                                                    <option value="5000">$5000</option>
                                                    <option value="10000">$10000</option>
                                                    <option value="50000">$50000</option>
                                                    <option value="100000">$100000</option>
                                                    <option value="200000">$200000</option>
                                                    <option value="300000">$300000</option>
                                                    <option value="400000">$400000</option>
                                                    <option value="500000">$500000</option>
                                                    <option value="600000">$600000</option>
                                                    <option value="700000">$700000</option>
                                                    <option value="800000">$800000</option>
                                                    <option value="900000">$900000</option>
                                                    <option value="1000000">$1000000</option>
                                                    <option value="1500000">$1500000</option>
                                                    <option value="2000000">$2000000</option>
                                                    <option value="2500000">$2500000</option>
                                                    <option value="5000000">$5000000</option>
                                                    <option value="10000000">$10000000</option>
                                                </select>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div id="tab-2" class="tab-content">
                                        <fieldset class="clearfix">
                                            <div>
                                                <label for="main-location"><?php echo (L("area")); ?></label>
                                                <select ng-model="location_area" name="location" id="main-location">
                                                    <option value=""><?php echo (L("area")); ?></option>
                                                    <option ng-if="lan !='hu-hu'" ng-repeat="area in area_list" value="{{ area.id }}">{{ area.city_name }}</option>
                                                    <option ng-if="lan =='hu-hu'" ng-repeat="area in area_list" value="{{ area.id }}">{{ area.city_name_hun }}</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="property-beds"><?php echo (L("room_num")); ?></label>
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
                                            </div>
                                            <div>
                                                <label for="property-min-area"><?php echo (L("min_area")); ?>(m²)</label>
                                                <input ng-model="min_area" type="text" name="min-area" id="property-min-area">
                                            </div>
                                            <div>
                                                <label for="property-max-area"><?php echo (L("max_area")); ?>(m²)</label>
                                                <input ng-model="max_area" type="text" name="max-area" id="property-max-area">
                                            </div>
                                            <div>
                                                <label for="property-min-price"><?php echo (L("min_price")); ?></label>
                                                <select ng-model="min_price" name="min-price" id="property-min-price">
                                                    <option value="1000">$1000</option>
                                                    <option value="5000">$5000</option>
                                                    <option value="10000">$10000</option>
                                                    <option value="50000">$50000</option>
                                                    <option value="100000">$100000</option>
                                                    <option value="200000">$200000</option>
                                                    <option value="300000">$300000</option>
                                                    <option value="400000">$400000</option>
                                                    <option value="500000">$500000</option>
                                                    <option value="600000">$600000</option>
                                                    <option value="700000">$700000</option>
                                                    <option value="800000">$800000</option>
                                                    <option value="900000">$900000</option>
                                                    <option value="1000000">$1000000</option>
                                                    <option value="1500000">$1500000</option>
                                                    <option value="2000000">$2000000</option>
                                                    <option value="2500000">$2500000</option>
                                                    <option value="5000000">$5000000</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="property-max-price"><?php echo (L("max_price")); ?></label>
                                                <select ng-model="max_price" name="max-price" id="property-max-price">
                                                    <option value="5000">$5000</option>
                                                    <option value="10000">$10000</option>
                                                    <option value="50000">$50000</option>
                                                    <option value="100000">$100000</option>
                                                    <option value="200000">$200000</option>
                                                    <option value="300000">$300000</option>
                                                    <option value="400000">$400000</option>
                                                    <option value="500000">$500000</option>
                                                    <option value="600000">$600000</option>
                                                    <option value="700000">$700000</option>
                                                    <option value="800000">$800000</option>
                                                    <option value="900000">$900000</option>
                                                    <option value="1000000">$1000000</option>
                                                    <option value="1500000">$1500000</option>
                                                    <option value="2000000">$2000000</option>
                                                    <option value="2500000">$2500000</option>
                                                    <option value="5000000">$5000000</option>
                                                    <option value="10000000">$10000000</option>
                                                </select>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div type="submit" ng-click="jumpToLists()" class="btn btn-default btn-lg text-center btn-3d"
                                            data-hover="Search Property"><?php echo (L("search")); ?> <?php echo (L("housing_resources")); ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                    <section class="widget recent-properties clearfix">
                        <h5 class="title"><?php echo (L("recent_listings")); ?></h5>
                        <?php if(is_array($randData)): $i = 0; $__LIST__ = $randData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rentHouse): $mod = ($i % 2 );++$i;?><div class="property clearfix">
                                <a href="#" class="feature-image zoom"><img data-action="zoom"
                                                                            src="/<?php echo ($rentHouse["filepath"]); ?>"
                                                                            alt="Property Image"></a>
                                <div class="property-contents">
                                    <?php if($lan != 'hu-hu'): ?><h6 class="entry-title"><a href="/home/index/detail/id/<?php echo ($rentHouse["id"]); ?>"><?php echo ($rentHouse["title"]); ?></a></h6>
                                        <?php else: ?>
                                        <h6 class="entry-title"><a href="/home/index/detail/id/<?php echo ($rentHouse["id"]); ?>"><?php echo ($rentHouse["title_hun"]); ?></a></h6><?php endif; ?>
                                    <span class="btn-price">HFU <?php echo ($rentHouse["price"]); ?></span>
                                    <div class="property-meta clearfix">
                                        <span><i class="fa fa-arrows-alt"></i> <?php echo ($rentHouse["proportion"]); ?> m²</span>
                                        <?php if($rentHouse["room_num"] > 0): ?><span><i class="fa fa-bed"></i> <?php echo ($rentHouse["room_num"]); ?>  Beds</span><?php endif; ?>
                                        <?php if($rentHouse["wc_num"] > 0): ?><span><i class="fa fa-bathtub"></i> <?php echo ($rentHouse["wc_num"]); ?> Baths</span><?php endif; ?>
                                        <?php if($rentHouse["garage_area"] > 0): ?><span><i class="fa fa-cab"></i> Yes</span>
                                            <?php else: ?>
                                            <span><i class="fa fa-cab"></i> No</span><?php endif; ?>

                                    </div>
                                </div>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>

                        <!--<div class="property clearfix">
                            <a href="#" class="feature-image zoom"><img data-action="zoom"
                                                                        src="/Public/home/assets/images/property/2.jpg"
                                                                        alt="Property Image"></a>
                            <div class="property-contents">
                                <h6 class="entry-title"><a href="single-property.html">Luxury family home</a></h6>
                                <span class="btn-price">$389.000</span>
                                <div class="property-meta clearfix">
                                    <span><i class="fa fa-arrows-alt"></i> 3060 SqFt</span>
                                    <span><i class="fa fa-bed"></i> 3 Beds</span>
                                    <span><i class="fa fa-bathtub"></i> 3 Baths</span>
                                    <span><i class="fa fa-cab"></i> Yes</span>
                                </div>
                            </div>
                        </div>-->
                    </section>
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
<script src="/Public/home/js/detail.js"></script>
</body>
</html>