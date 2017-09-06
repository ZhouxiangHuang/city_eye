<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cityEye</title>
    <script src="/Public/js/home/7d82db857c.js"></script>
    <script src="/Public/js/home/html5shiv.js"></script>
    <script src="/Public/js/home/respond.min.js"></script>
    <link type="text/css" href="/Public/css/home/jquery-ui-1.10.4.custom.css" rel="stylesheet"/>
    <link rel="shortcut icon" href="http://www.sabudapest.com/images/favicon.ico" type="image/icon"/>
    <link rel="stylesheet" href="/Public/css/home/chosen.css" type="text/css">
    <script src="/Public/js/home/jquery.js"></script>
    <script src="/Public/js/home/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/js/home/jquery-1.11.0.js"></script>
    <script type="text/javascript" src="/Public/js/home/jquery-ui-1.10.4.custom.js"></script>
    <script type="text/javascript" src="/Public/js/home/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="/Public/js/home/jquery-nestedsortable.js"></script>
    <script src="/Public/js/home/chosen.jquery.js" type="text/javascript"></script>
    <meta name="robots" content="index, follow"/>
    <meta name="description" content="Ingatlan"/>
    <meta name="keywords" content="Ingatlan"/>
    <link href="/Public/css/home/bootstrap.css" rel="stylesheet">
    <link href="/Public/css/home/style.css?ver=1500986388" rel="stylesheet">
    <script type="text/javascript" src="/Public/js/home/js.js"></script>
    <script src="/Public/static/layer/layer.js"></script>

    <!--select2-->
    <link href="/Public/js/home/select2/css/select2.min.css" rel="stylesheet" />
    <script src="/Public/js/home/select2/js/select2.min.js"></script>
    <script src="/Public/js/home/angularJs/js/angular.min.js"></script>
    <script src="/Public/js/home/angularJs/js/angular-cookie.min.js"></script>
    <script src="/Public/js/home/infiniteScroll/js/infinite-scroll.js"></script>
    <script src="/Public/js/home/offers.js"></script>
    <link href="/Public/css/home/offers.css" rel="stylesheet">


</head>
<body ng-app="myApp" ng-controller="OffersController">
<nav class="navbar navbar-inverse" role="navigation">

    <div class="container">
        <div class="navbar-header">
            <!-- <ul class="nav navbar-nav navbar-center block-litter">
                 <div style="position: relative; height: 50px; width: 140px; ">-->
            <a href="/">
                <img class="img-nav block-litter" src="/Public/img/home/logo.png"></a>
            <!-- </div>
         </ul>-->
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-center hide-litter">
                <div style="position: relative; height: 50px; width: 140px; ">
                    <a href="/">
                        <img class="img-nav" src="/Public/img/home/logo.png"></a>
                </div>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown ">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo (L("house_property")); ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/home/index/offers">
                            <?php echo (L("house_sale")); ?> </a>
                        </li>
                        <li>
                            <a href="../newproperty/">
                                <?php echo (L("house_for_rent")); ?> </a>
                        </li>
                        <li>
                            <a href="../newproperty/">
                                <?php echo (L("house_trust")); ?> </a>
                        </li>
                    </ul>
                </li>
                <li>
                <li class="">
                    <a href="http://www.sabudapest.com/furnishings/">
                        <?php echo (L("tourism")); ?> </a>
                </li>
                <li class="">
                    <a href="http://www.sabudapest.com/活动策划/">
                        <?php echo (L("service_items")); ?> </a>
                </li>
                <li class="">
                    <a href="http://www.sabudapest.com/活动策划/">
                        <?php echo (L("about_us")); ?> </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ lan === 'hu-hu' ? 'active' :'' }}">
                    <a href="/?l=hu-hu">HUN</a>
                </li>
                <li class="{{ lan === 'zh-CN' ? 'active' :'' }}">
                    <a href="/?l=zh-CN">CN</a>
                </li>
            </ul>
        </div>

    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12 form-box">
            <div class="col-md-12">
                    <div class="container fixed-box col-md-12">
                        <form class="form-horizontal center-box" role="form" method="post" action="<?php echo U('home/index/offers');?>" >
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <select class="form-control" ng-model="selectType" name="type" ng-init="selectType">
                                        <option value="{{ type }}" ng-repeat="type in types">{{ type }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group center">
                                <div class="col-sm-12">
                                    <select class="form-control" ng-model="selectArea"  name="area[]"  >
                                        <?php if(is_array($area_list)): $i = 0; $__LIST__ = $area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option ng-if="lan =='zh-CN'" value="<?php echo ($v["id"]); ?>"><?php echo ($v["city_name"]); ?></option>
                                            <option ng-if="lan =='hu-hu'" value="<?php echo ($v["id"]); ?>"><?php echo ($v["city_name_hun"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group center">
                                <div class="col-xs-3 pad-right">
                                    <input class="form-control" ng-model="priceMin" name="price_min"  value="" type="text" placeholder="price min"/>
                                </div>
                                <div class="col-xs-3 pad-left">
                                    <input class="form-control" ng-model="priceMax" name="price_max"  value="" type="text" placeholder="price max"/>
                                </div>
                                <div class="col-xs-3 pad-right">
                                    <input class="form-control" ng-model="sizeMin" name="size_min"  value="" type="text" placeholder="平米min"/>
                                </div>
                                <div class="col-xs-3 pad-left">
                                    <input class="form-control" ng-model="sizeMax" name="size_max"  value="" type="text" placeholder="平米max"/>
                                </div>
                            </div>
                            <button style="float: right" ng-click="changeSearch()"  class="btn btn-success btn-sub"><?php echo (L("search")); ?></button>
                        </form>
                    </div>
                </div>
            <input type="hidden" ng-model="lan" id="lan_value" value="<?php echo ($lan); ?>">
            <h3 id="fangyuan">{{ countHouse }} <?php echo (L("listings")); ?></h3>
            <div class="house-list" >
                <div ng-repeat="house in houseList" class="box-margin col-sm-12 col-lg-12 col-md-12" ng-click="jumpToDetail(house.house_id)">
                        <div class="thumbnail col-sm-12 col-lg-12 col-md-12">
                            <div class="thumb-img col-sm-3 col-sm-3 col-lg-3 col-md-3">
                                <img style="margin: 0 auto"  ng-src="/{{ house.filepath }}" alt="">
                            </div>
                            <div class=" col-sm-1 col-lg-1 col-md-1"></div>
                            <div style="padding-top: 0" class="caption  col-sm-8 col-lg-8 col-md-8">
                                <h4 style="margin-top: 0">{{ lan == 'hu-hu' ? house.title_hun : house.title }}</h4>
                                <div class="dotted">
                                    <div class="row">
                                        <div class="col-xs-6" ><strong><?php echo (L("place")); ?>:</strong></div>
                                        <div class="col-xs-6 text-right">{{ lan == 'hu-hu' ? house.address_hun : house.address }}</div>
                                    </div>
                                </div>
                                <div class="dotted">
                                    <div class="row">
                                        <div class="col-xs-6"><strong><?php echo (L("price")); ?>:</strong></div>
                                        <div class="col-xs-6 text-right">{{ house.price }} HUF</div>
                                    </div>
                                </div>
                                <div class="dotted">
                                    <div class="row">
                                        <div class="col-xs-6"><strong><?php echo (L("price")); ?>:</strong></div>
                                        <div class="col-xs-6 text-right">{{ house.price }} HUF</div>
                                    </div>
                                </div>
                                <div class="dotted">
                                    <div class="row">
                                        <div class="col-xs-6"><strong><?php echo (L("price")); ?>:</strong></div>
                                        <div class="col-xs-6 text-right">{{ house.price }} HUF</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <ul class="pagination" ng-if="pageCount.length > 1">
                    <li ng-if="p > 1" ng-click="getMore(p-1)"><a href="#fangyuan">&laquo;</a></li>
                    <li class="{{p == page ? 'active' : ''}}" ng-click="getMore(page)" ng-repeat="page in pageCount"><a href="#fangyuan">{{ page }}</a></li>
                    <li ng-if="p < pageCount.length" ng-click="getMore(p+1)"><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<footer>
    <div class="">
        <div class="container">
            <div class="col-md-5">
                <div class="footer-padding">
                    <!--<h4 style="border: none">&nbsp;</h4>-->
                    <!--<p>-->
                    <img class="img-footer" src="http://gp-canada.com/templets/demo/statics/bottom_tu2.jpg" alt="">
                    <!--</p>-->

                </div>
                <!--<div class="footer-padding">
                    <h4> 关于我们 </h4>
                    <p>S.A. 希维亚综合服务公司
                        S.A.是一家位于匈牙利布达佩斯的综合服务公司。
                        专注为海外华人提供全方位的服务与资讯，满足不同客户的多层次需求。
                        坚持“以人为本，以信立业，以质取胜，持续改进”的经营理念。
                        发展战略
                        将S.A.打造成为核心竞争力突出，为客户提供最优质的全方位服务。
                        努力成为布达佩斯最具价值的综合服务商。
                    </p>

                </div>-->
            </div>
            <!--<div class="col-md-3">
                <div class="footer-padding">
                    <h4> 分类 </h4>
                    <ul class="menu">
                        <li class="active">
                            <a href="http://www.sabudapest.com/offers/">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>房产
                            </a>
                        </li>
                        <li>
                            <a href="http://www.sabudapest.com/mainpage/">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>室内设计
                            </a>
                        </li>
                        <li>
                            <a href="http://www.sabudapest.com/turism/">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>旅行
                            </a>
                        </li>
                        <li class="no-border-bottom">
                            <a href="http://www.sabudapest.com/about/">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>联系我们
                            </a>
                        </li>
                    </ul>
                </div>
            </div>-->
            <div class="col-md-4">
                <div class="footer-padding">
                    <!--<h4> 与我们联系 </h4>-->
                    <ul class="contact has-bg">
                        <strong style="padding-top: 10px; display: block;">Cityeye Comprehensive Service Company</strong>
                        <li >
                            <div class="row">
                                <div class="col-xs-2 no-right-paddings width-20">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="col-xs-10 font-small no-right-paddings">
                                    H-1107 Budapest Kőbányai u.47/B (一楼右转)
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xs-2 no-right-paddings width-20">
                                    <i class=" fa  fa-weixin"></i>
                                </div>
                                <div class="col-xs-10 font-small no-right-paddings">
                                    微信: cityeye888<br>

                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xs-2 no-right-paddings width-20">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="col-xs-10 font-small no-right-paddings">
                                    <a class="__cf_email__" href=""><p>电话: +36308892125</p></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-padding message">
                    <!--<h4> 发送信息</h4>-->
                    <form method="post" action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Név">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="邮箱">
                        </div>
                        <div class="form-group">
                            <textarea placeholder=信息 class="form-control"></textarea>
                        </div>
                        <button style="float: right" type="submit" class="btn btn-primary">发送</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--<div class="copyright" style="background: #4e5558">-->
    <!--<div class="container">-->
        <!--<div class="copyright-content">-->
            <!--<div class="row">-->
                <!--<div class="col-md-4"><span>Copyright</span>-->
                    <!--<i class="fa fa-copyright" aria-hidden="true"></i> <span>SaBudapest, Designed by APX soft</span><br><span>Assembled in Budapest, Hungary</span>-->
                <!--</div>-->
                <!--<div class="col-md-4 text-center">-->
                <!--</div>-->
                <!--<div class="col-md-4 text-right">-->
                    <!--<img src="http://www.sabudapest.com/plugins/images/payments.png">-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
<!--</div>-->
<link rel="stylesheet" href="/Public/css/home/sidenavi-left.css">
<!--<script src="/Public/common/js/jquery-1.9.1.js"></script>-->
<script src="/Public/js/home/SideNavi.js"></script>
<div class="clear"></div>
</div>
</body>
</html>