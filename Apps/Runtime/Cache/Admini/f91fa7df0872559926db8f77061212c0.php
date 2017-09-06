<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
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


    <link href="/Public/css/admin/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="/Public/css/admin/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
</head>
<body>
<style>
    .bgcolor{background:#F2F2F2;}
</style>
<!-- Panel Other -->
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>规则列表</h5>
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

                        </div>
                        <table id="exampleTableToolbar" data-mobile-responsive="false">
                            <thead>
                            <tr>
                                <th data-field="id">标识ID</th>
                                <th data-field="module">所属模型</th>
                                <!--  <th data-field="name">模型动作</th>-->
                                <th data-field="title">名称</th>
                                <th data-field="type">类型</th>
                                <th data-field="sort">排序</th>
                                <th data-field="icon">图标</th>
                                <th data-field="status">状态</th>
                                <th data-field="actions">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($authlist)): $i = 0; $__LIST__ = $authlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$aulist): $mod = ($i % 2 );++$i;?><tr title="<?php echo ($aulist["id"]); ?>" class="bgcolor">
                                    <td><?php echo ($aulist["id"]); ?></td>
                                    <td><?php echo ($aulist["module"]); ?></td>
                                    <!-- <td><?php echo ($aulist["name"]); ?></td>-->
                                    <td><?php echo ($aulist["title"]); ?></td>
                                    <td>
                                        <?php switch($aulist['navtype']): case "1": ?>URL<?php break;?>
                                            <?php case "2": ?>主菜单<?php break;?>
                                            <?php default: ?>根节点<?php endswitch;?>
                                    </td>
                                    <td><?php echo ($aulist["sort"]); ?></td>
                                    <td>
                                        <?php if(empty($aulist["icon"])): ?>无
                                            <?php else: ?>
                                            <i class="<?php echo ($aulist["icon"]); ?>" /><?php endif; ?>
                                    </td>
                                    <td id="btnstatus">
                                        <?php if($aulist["status"] == 1): ?><span class="btn btn-info btn-circle btn-sm"> <i class="fa fa-check"></i> </span>
                                            <?php else: ?>
                                            <span class="btn btn-warning btn-circle btn-xs"> <i class="fa fa-close"></i> </span><?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(($aulist["status"]) == "1"): ?><a action="rulestatus" data-id="<?php echo ($aulist["id"]); ?>" data-tag="n" class="label label-danger label-xs" href="javascript:;"><i class="fa fa-times"></i>禁用</a>
                                            <?php else: ?>
                                            <a action="rulestatus" data-id="<?php echo ($aulist["id"]); ?>" data-tag="y" class="label label-info label-xs" href="javascript:;"><i class="fa fa-times"></i>启用</a><?php endif; ?>
                                    </td>
                                </tr>
                                <?php if(!empty($aulist['_child'])): if(is_array($aulist['_child'])): $i = 0; $__LIST__ = $aulist['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$auchild): $mod = ($i % 2 );++$i;?><tr title="<?php echo ($auchild['id']); ?>">
                                            <td><?php echo ($auchild["id"]); ?></td>
                                            <td> <?php echo ($zifu=str_repeat('&nbsp;',2)); ?>|-<?php echo ($auchild["module"]); ?></td>
                                            <!--<td><?php echo ($auchild["name"]); ?></td>-->
                                            <td><?php echo ($auchild["title"]); ?></td>
                                            <td>
                                                <?php switch($auchild['type']): case "1": ?>URL<?php break;?>
                                                    <?php case "2": ?>主菜单<?php break; endswitch;?>
                                            </td>
                                            <td><?php echo ($auchild["sort"]); ?></td>
                                            <td>
                                                <?php if(empty($auchild["icon"])): ?>无
                                                    <?php else: ?>
                                                    <i class="<?php echo ($auchild["icon"]); ?>" /><?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($auchild["status"] == 1): ?><span class="btn btn-info btn-circle btn-sm"> <i class="fa fa-check"></i> </span>
                                                    <?php else: ?>
                                                    <span class="btn btn-warning btn-circle btn-xs"> <i class="fa fa-close"></i> </span><?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(($auchild["status"]) == "1"): ?><a action="rulestatus" data-id="<?php echo ($auchild["id"]); ?>" data-tag="n" class="label label-danger label-xs" href="javascript:;"><i class="fa fa-times"></i>禁用</a>
                                                    <?php else: ?>
                                                    <a action="rulestatus" data-id="<?php echo ($auchild["id"]); ?>" data-tag="y" class="label label-info label-xs" href="javascript:;"><i class="fa fa-times"></i>启用</a><?php endif; ?>
                                            </td>
                                        </tr>

                                        <?php if(!empty($auchild['_child'])): if(is_array($auchild['_child'])): $i = 0; $__LIST__ = $auchild['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$achild): $mod = ($i % 2 );++$i;?><tr title="<?php echo ($achild['id']); ?>">
                                                    <td><?php echo ($aachild["id"]); ?></td>
                                                    <td> <?php echo ($zifu=str_repeat('&nbsp;',4)); ?>|-<?php echo ($achild["module"]); ?></td>
                                                    <!--<td><?php echo ($achild["name"]); ?></td>-->
                                                    <td><?php echo ($achild["title"]); ?></td>
                                                    <td>
                                                        <?php switch($achild['type']): case "1": ?>URL<?php break;?>
                                                            <?php case "2": ?>主菜单<?php break; endswitch;?>
                                                    </td>
                                                    <td><?php echo ($achild["sort"]); ?></td>
                                                    <td>
                                                        <?php if(empty($achild["icon"])): ?>无
                                                            <?php else: ?>
                                                            <i class="<?php echo ($achild["icon"]); ?>" /><?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($achild["status"] == 1): ?><span class="btn btn-info btn-circle btn-sm"> <i class="fa fa-check"></i> </span>
                                                            <?php else: ?>
                                                            <span class="btn btn-warning btn-circle btn-xs"> <i class="fa fa-check"></i> </span><?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if(($achild["status"]) == "1"): ?><a action="rulestatus" data-id="<?php echo ($achild["id"]); ?>" data-tag="n" class="label label-danger label-xs" href="javascript:;"><i class="fa fa-times"></i>禁用</a>
                                                            <?php else: ?>
                                                            <a action="rulestatus" data-id="<?php echo ($achild["id"]); ?>" data-tag="y" class="label label-info label-xs" href="javascript:;"><i class="fa fa-times"></i>启用</a><?php endif; ?>
                                                    </td>
                                                </tr><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Example Toolbar -->
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
<script src="/Public/js/admin/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<script src="/Public/js/admin/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="/Public/js/admin/demo/bootstrap-table-demo.min.js"></script>
<script type="text/javascript">
    $(function () {
        $(document).on("click","a[action='rulestatus']",function () {
            $this=$(this);
            layer.confirm("修改此条规则的状态？",function (c_index) {
                layer.close(c_index);
                var index_load=layer.load();
                var id=$this.data("id");
                var status=$this.data("tag");
                $.post("<?php echo U('Auth/do_rulestatus');?>",{aid:id,status:status},function (result) {
                    layer.close(index_load);
                    if(result.code==20000){
                        layer.msg(result.message);
                        if(status=="y"){
                            $this.parent("td").prev("td").html("<span class=\"btn btn-info btn-circle btn-sm\"> <i class=\"fa fa-check\"></i> </span>");
                            $this.replaceWith("<a action=\"rulestatus\" data-id=\""+id+"\" data-tag=\"n\" class=\"label label-danger label-xs\" href=\"javascript:;\"><i class=\"fa fa-times\"></i>禁用</a>");
                        }else{
                            $this.parent("td").prev("td").html("<span class=\"btn btn-warning btn-circle btn-xs\"> <i class=\"fa fa-close\"></i> </span>");
                            $this.replaceWith("<a action=\"rulestatus\" data-id=\""+id+"\" data-tag=\"y\" class=\"label label-info label-xs\" href=\"javascript:;\"><i class=\"fa fa-times\"></i>启用</a>");
                        }
                    }else{
                        layer.msg(result.message);
                    }
                },"json");
            })
        })
    })
</script>
</body>
</html>