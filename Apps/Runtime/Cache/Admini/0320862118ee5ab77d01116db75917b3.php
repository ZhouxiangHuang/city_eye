<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>cityeye后台管理系统</title>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico">
    <link href="/Public/css/admin/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/css/admin/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/css/admin/animate.min.css" rel="stylesheet">
    <link href="/Public/css/admin/style.min862f.css?v=4.1.0" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span><img alt="logo" class="img-circle" style="border-radius: 0;height: 70%;width: 70%;" src="/Public/img/admin/logo2.png" /></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"><?php echo ($admin["account"]); ?></strong><b class="caret"></b></span>
                               <span class="text-muted text-xs block"><?php echo ($groupname); ?></span>
                                </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="J_menuItem" href="<?php echo U('Index/updatePersonalInfo',array('act'=>display));?>">修改个人信息</a>
                            </li>
                            <!--<li><a class="J_menuItem" href="profile.html">个人资料</a>
                            </li>
                            <li><a class="J_menuItem" href="contacts.html">联系我们</a>
                            </li>
                            <li><a class="J_menuItem" href="mailbox.html">信箱</a>
                            </li>-->
                            <li class="divider"></li>
                            <li><a href="<?php echo U('Public/loginout');?>">安全退出</a>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">

                    </div>
                </li>
                <?php if(is_array($auth_rule)): $i = 0; $__LIST__ = $auth_rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$all_rule): $mod = ($i % 2 );++$i;?><!--<?php dump($all_rule['type']) ?>-->
                    <?php if(empty($all_rule['navtype'])): ?><li>
                            <a class="J_menuItem" href="<?php echo U($all_rule['name']);?>"><i class="<?php echo ($all_rule['icon']); ?>"></i> <span class="nav-label"><?php echo ($all_rule['title']); ?></span></a>
                        </li>
                        <?php elseif($all_rule['navtype'] == 2): ?>
                        <li>
                            <a href="#"><i class="<?php echo ($all_rule['icon']); ?>"></i> <span class="nav-label"><?php echo ($all_rule['title']); ?></span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <?php if($all_rule['_child']): if(is_array($all_rule['_child'])): $i = 0; $__LIST__ = $all_rule['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$all_child): $mod = ($i % 2 );++$i; if($all_child['navtype'] == 2): ?><a class="J_menuItem" href="<?php echo U($all_child['name']);?>"><i class="<?php echo ($all_child['icon']); ?>"></i> <?php echo ($all_child['title']); ?> </a><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                                </li>
                            </ul>
                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <!--<form role="search" class="navbar-form-custom" method="post" action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>-->
                </div>
                </li>
                </ul>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="<?php echo U('Index/main');?>">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>
                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="<?php echo U('Public/loginout');?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo U('Index/main');?>" frameborder="0" data-id="<?php echo U('Index/main');?>" seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">&copy; 2017-2017 <a href="http://shen.shen-td.com/" target="_blank">河南八里铺弄啥嘞科技信息技术有限公司</a>
            </div>
        </div>
    </div>
    <!--右侧部分结束-->
</div>
<script src="/Public/js/admin/jquery-1.12.1.min.js"></script>
<script src="/Public/js/admin/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/js/admin/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/Public/js/admin/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/Public/js/admin/plugins/layer/layer.min.js"></script>
<script src="/Public/js/admin/hplus.min.js?v=4.1.0"></script>
<script type="text/javascript" src="/Public/js/admin/contabs.min.js"></script>
<script src="/Public/js/admin/plugins/pace/pace.min.js"></script>

</body>
</html>