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
    <link href="/Public/css/home/detail.css" rel="stylesheet">
    <script type="text/javascript" src="/Public/js/home/js.js"></script>
    <script src="/Public/static/layer/layer.js"></script>

    <!--select2-->
    <link href="/Public/js/home/select2/css/select2.min.css" rel="stylesheet" />
    <script src="/Public/js/home/select2/js/select2.min.js"></script>
    <script src="/Public/js/home/angularJs/js/angular.min.js"></script>
    <script src="/Public/js/home/angularJs/js/angular-cookie.min.js"></script>
    <script src="/Public/js/home/infiniteScroll/js/infinite-scroll.js"></script>
    <script src="/Public/js/home/detail.js"></script>

</head>
<body ng-app="myApp" ng-controller="DetailController">
<div style="background: rgba(34,34,34,1); height: 32px; width: 100%;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12"></div>
            <div class="col-lg-4 col-md-12"></div>
            <div class="col-lg-4 col-md-12 phone right">
                <i class="fa fa-phone"></i> +36 30 902 2221,&nbsp;&nbsp;+36 30 588 6035
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-center">
                <div style="position: relative; height: 50px; width: 140px; ">
                    <a href="/">
                        <img src="/Public/img/home/logo.png"
                             style="width: 130px; position:absolute; left: 0px; bottom: -20px; margin-right: 10px;"></a>
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
                <!--<li class="dropdown ">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        生活指南 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../hungary-services/">
                                生活助手 </a>
                        </li>
                        <li>
                            <a href="../course/">
                                课程 </a>
                        </li>
                    </ul>
                </li>-->
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

<div class="container" style="width: 100%;">
   <div class="row">
       <div class="col-md-12" style="padding-left: 0; padding-right: 0;">
           <img style="width: 100%;" src="http://pic.58pic.com/58pic/13/12/24/21E58PICfx8_1024.jpg">
       </div>
   </div>
</div>
<div class="container" style="width: 100%; padding: 30px 0;">
    <div class="visible-md-3 col-md-3"></div>
    <div class="col-md-6" >
        <h3>baiti</h3>
        三月，醉一场青春的流年。慢步在三月的春光里，走走停停，看花开嫣然，看春雨绵绵，感受春风拂面，春天，就是青春的流年。青春，是人生中最美的风景。青春，是一场花开的遇见；青春，是一场痛并快乐着的旅行；青春，是一场轰轰烈烈的比赛；青春，是一场鲜衣奴马的争荣岁月；青春，是一场风花雪月的光阴。

        　　青春往事，多么甜蜜；青春岁月，多么靓丽；青春流年，如火如荼。青春里，我们向着梦想前进。跌倒过，伤心过，快乐过，痛苦过，孤独过，彷徨过，迷茫过。总是，在悠悠的岁月中徘徊；总是，在如春的生命中成长；总是，在季节的交替中感悟人生四季的美妙与韵律；总是，在多愁善感中体悟青春的美好与无奈。</div>
    <div class="visible-md-3 col-md-3"></div>
</div>
<div class="container" style="padding: 30px 0" >

        <div class="col-md-4">

            <div class="media">
                <div class="media-left media-middle">
                    <i class="fa fa-motorcycle"></i>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Brand & Graphics Design</h4>
                    <p>Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                </div>
            </div>

        </div>

        <div class="col-md-4">

            <div class="media">
                <div class="media-left media-middle">
                    <i class="fa fa-gears"></i>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Web Designer & Developer</h4>
                    <p>Cras sit amet nibh libero, in gravida nulla. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                </div>
            </div>

        </div>

        <div class="col-md-4">

            <div class="media">
                <div class="media-left media-middle">
                    <i class="fa fa-heartbeat"></i>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Business Consultant</h4>
                    <p>Metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                </div>
            </div>

        </div>

    </div>


<div class="container" style="width: 100%; padding: 0; margin: 0">
    <footer>
        <div class="">
            <div class="container">
                <div class="col-md-3">
                    <div class="footer-padding">
                        <h4> 关于我们 </h4>
                        <p>S.A. 希维亚综合服务公司
                            S.A.是一家位于匈牙利布达佩斯的综合服务公司。
                            专注为海外华人提供全方位的服务与资讯，满足不同客户的多层次需求。
                            坚持“以人为本，以信立业，以质取胜，持续改进”的经营理念。
                            发展战略
                            将S.A.打造成为核心竞争力突出，为客户提供最优质的全方位服务。
                            努力成为布达佩斯最具价值的综合服务商。
                        </p>

                    </div>
                </div>
                <div class="col-md-3">
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
                </div>
                <div class="col-md-3">
                    <div class="footer-padding message">
                        <h4> 发送信息</h4>
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
                            <button type="submit" class="btn btn-primary">发送</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-padding">
                        <h4> 联系方式 </h4>
                        <ul class="contact has-bg">
                            <li>
                                <p>S.A. Integrated Services Company</p>
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
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="col-xs-10 font-small no-right-paddings">
                                        电话 中: +36 30 902 2221<br>
                                        电话: +36 30 588 6035
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-2 no-right-paddings width-20">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="col-xs-10 font-small no-right-paddings">
                                        <a class="__cf_email__" href="">[email&#160;protected]</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-2 no-right-paddings width-20">
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-xs-10 font-small no-right-paddings">
                                        www.sabudapest.com
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-2 no-right-paddings width-20">
                                        <i class="fa fa-weixin" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-xs-10 font-small no-right-paddings">
                                        <a href="http://weixin.qq.com/r/S-b07NbEBIt7rZKP96NZ" target="_blank">http://weixin.qq.com/r/S-b07NbEBIt7rZKP96NZ</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright">
        <div class="container">
            <div class="copyright-content">
                <div class="row">
                    <div class="col-md-4">
                        Copyright <i class="fa fa-copyright" aria-hidden="true"></i> SaBudapest, Designed by <span>APX soft</span><br>
                        Assembled in <span>Budapest, Hungary</span>
                    </div>
                    <div class="col-md-4 text-center">
                    </div>
                    <div class="col-md-4 text-right">
                        <img src="http://www.sabudapest.com/plugins/images/payments.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="/Public/css/home/sidenavi-left.css">
    <!--<script src="/Public/common/js/jquery-1.9.1.js"></script>-->
    <script src="/Public/js/home/SideNavi.js"></script>
    <div class="clear"></div>
</div>
</body>
</html>