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
        <h5>地区列表</h5>
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
                            <?php if(check_auth(150) == 1): ?><a class="glyphicon glyphicon-plus" style="curosr: pointer;font-size: 20px" href="<?php echo U('AreaNew/add');?>">添加</a><?php endif; ?>
                        </div>
                        <table id="exampleTableToolbar" data-mobile-responsive="false">
                            <thead>
                            <tr>
                                <th data-field="id">标识ID</th>
                                <th data-field="city_name">名称(zh)</th>
                                <th data-field="city_name_hun">名称(hun)</th>
                                <!--  <th data-field="name">模型动作</th>-->
                                <th data-field="sort">排序</th>
                                <th data-field="status">状态</th>
                                <th data-field="actions">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($articleCateList)): $i = 0; $__LIST__ = $articleCateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$aclist): $mod = ($i % 2 );++$i;?><tr title="<?php echo ($aclist["cate_id"]); ?>" class="bgcolor">
                                    <td><?php echo ($aclist["id"]); ?></td>
                                    <td><?php echo ($aclist["city_name"]); ?></td>
                                    <td><?php echo ($aclist["city_name_hun"]); ?></td>
                                    <!-- <td><?php echo ($aclist["name"]); ?></td>-->
                                    <td><?php echo ($aclist["sort"]); ?></td>
                                    <td id="btnstatus">
                                        <?php if($aclist["status"] == 1): ?><span class="btn btn-info btn-circle btn-sm"> <i class="fa fa-check"></i> </span>
                                            <?php else: ?>
                                            <span class="btn btn-warning btn-circle btn-xs"> <i class="fa fa-close"></i> </span><?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(check_auth(151) == 1): ?><a href='<?php echo U("AreaNew/update",array("id"=>$aclist["id"]));?>'>编辑</a><?php endif; ?>
                                        <?php if(check_auth(149) == 1): ?><a href="#" data_name="<?php echo ($aclist["cate_name"]); ?>" data_id = "<?php echo ($aclist["id"]); ?>" onclick="del(this)">删除</a><?php endif; ?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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

    })
    function del(obj) {
        layer.confirm("确定删除？",function () {
            var id = $(obj).attr('data_id');
            var del_id = new Array();
            del_id[0] = id;
            $.ajax({
                method: "post",
                url: '<?php echo U("AreaNew/delete");?>',
                data:{ 'id':id, 'status' : status },
                dataType: 'JSON',
                success: function(data){
                    if (data.code == 200) {
                        $("#exampleTableToolbar").bootstrapTable('remove',{
                            field:'id',
                            values: del_id
                        });
                        layer.msg(data.msg);
                    } else {
                        layer.msg(data.msg);
                    }
                },
                error:function(){
                    layer.msg('数据错误！');
                }
            });
        });

    }
</script>
</body>
</html>