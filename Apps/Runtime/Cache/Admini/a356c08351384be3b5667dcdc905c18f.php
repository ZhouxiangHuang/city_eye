<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>河南八里铺弄啥嘞信息技术有限公司</title>
<link href="/Public/css/admin/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
<link href="/Public/css/admin/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
<link href="/Public/css/admin/animate.min.css" rel="stylesheet">
<link href="/Public/css/admin/style.min862f.css?v=4.1.0" rel="stylesheet">
<link href="/Public/css/admin/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="/Public/css/admin/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">


</head>
<body class="gray-bg">
    <!-- Panel Other -->
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>管理组列表</h5>
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
                <div class="row row-lg">
                    <div class="col-sm-12">
                        <!-- Example Toolbar -->
                        <div class="example-wrap">
                            <div class="example">
                                <div class="btn-group hidden-xs" id="exampleToolbar" role="group">
                                    <a  class="btn btn-outline btn-default" title="添加新组别" href="<?php echo U('Auth/selGroup',array('act'=>add,'action'=>display));?>">
                                        <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-condensed table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th data-field="title">标题</th>
                                                <th data-field="desc">描述</th>
                                                <th data-field="status">可用状态</th>
                                                <th data-field="action">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($authgroups)): if(is_array($authgroups)): $i = 0; $__LIST__ = $authgroups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gplist): $mod = ($i % 2 );++$i;?><tr title="<?php echo ($gplist["id"]); ?>">
                                                <td><?php echo ($gplist["title"]); ?></td>
                                                <td><?php echo ($gplist["desc"]); ?></td>
                                                <td>
                                                    <?php if($gplist["status"] == 1): ?><span class="btn btn-info btn-circle btn-sm"> <i class="fa fa-check"></i> </span>
                                                    <?php else: ?>
                                                    <span class="btn btn-warning btn-circle btn-xs"> <i class="fa fa-close"></i> </span><?php endif; ?>
                                                </td>
                                                <td>
                                                    <a class="label label-primary label-xs" href="<?php echo U('Auth/selGroup',array('id'=>$gplist['id'],'act'=>edit,'action'=>display));?>"><i class="fa fa-edit"></i>编辑</a>
                                                    <?php if($gplist["id"] != 1): ?><a class="label label-danger label-xs" href="<?php echo U('Auth/selGroup',array('id'=>$gplist['id'],'act'=>del));?>"><i class="fa fa-times"></i>删除</a><?php endif; ?>

                                                </td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- End Example Toolbar -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Panel Other -->
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