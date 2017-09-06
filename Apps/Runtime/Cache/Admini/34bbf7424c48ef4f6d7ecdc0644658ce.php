<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>恒天润景后台管理系统-郑州八角信息技术有限公司</title>
<link href="/Public/css/admin/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
<link href="/Public/css/admin/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
<link href="/Public/css/admin/animate.min.css" rel="stylesheet">
<link href="/Public/css/admin/style.min862f.css?v=4.1.0" rel="stylesheet">
<link href="/Public/css/admin/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="/Public/css/admin/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">


<link href="/Public/static/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>管理组信息</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="commentForm" method="post" action='<?php echo U('Auth/selGroup',array('id'=>$gplist['id'],'act'=>$_GET['act'],'action'=>submit));?>' >
                        <input type="hidden" name="id" value="<?php echo ($auth_info["id"]); ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">组名 :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="title" value="<?php echo ($auth_info["title"]); ?>"  required="" aria-required="true" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否可用 :</label>
                            <div class="col-sm-8">
                                <div class="radio radio-danger radio-inline">
                                    <input type="radio" id="status1"  value="1" name="status" <?php if(isset($auth_info['status'])): if(($auth_info['status']) == "1"): ?>checked<?php else: ?>checked<?php endif; ?>
                                    <?php else: ?>checked<?php endif; ?> />
                                    <label for="status1"> 是 </label>
                                </div>
                                <div class="radio radio-danger radio-inline">
                                    <input type="radio" id="status2"    value="0" name="status"  <?php if(isset($auth_info['status'])): if(($auth_info['status']) == "0"): ?>checked<?php endif; ?>
                                    <?php else: ?>checked<?php endif; ?>  />
                                    <label for="status2"> 否 </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">说明：</label>
                            <div class="col-sm-8">
                                <textarea id="desc" name="desc" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">包含规则 :</label>
                            <div class="col-sm-8">
                                <div class="tabs-container">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> 后台</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab-1" class="tab-pane active">
                                            <div class="panel-body">
                                                <dl class="dl-horizontal">
                                                <?php if(is_array($rulelist)): $i = 0; $__LIST__ = $rulelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rulesadmin): $mod = ($i % 2 );++$i; if(($rulesadmin['module']) == "Admini"): ?><hr /><p/>
                                                <dt><label> <?php echo ($rulesadmin['title']); ?> <input type="checkbox" class="" name="radmin[]" value="<?php echo ($rulesadmin['id']); ?>" <?php if(in_array($rulesadmin['id'],$auth_info['rules'])): ?>checked="checked"<?php endif; ?> /></label></dt>

                                                <?php if(is_array($rulesadmin['_child'])): $i = 0; $__LIST__ = $rulesadmin['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rachild): $mod = ($i % 2 );++$i;?><dd><label><input type="checkbox" class="" name="radmin[]" value="<?php echo ($rachild['id']); ?>"  <?php if(in_array($rachild['id'],$auth_info['rules'])): ?>checked="checked"<?php endif; ?> /> <?php echo ($rachild['title']); ?> </label></dd><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
                                                </dl>
                                            </div>
                                        </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" class="col-sm-12" type="submit">确认<?php switch($auth_act): case "edit": ?>编辑<?php break;?>
            <?php default: ?>添加<?php endswitch;?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	<script src="/Public/js/admin/jquery.min.js?v=2.1.4"></script>
<script src="/Public/js/admin/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/static/layer/layer.js"></script>
<script src="/Public/js/admin/content.min.js"></script>
<script src="/Public/js/admin/demo/laydate/laydate.js"></script>
<script>
    var _UPLOADS_ = '/Uploads';
</script>

</body>
</html>