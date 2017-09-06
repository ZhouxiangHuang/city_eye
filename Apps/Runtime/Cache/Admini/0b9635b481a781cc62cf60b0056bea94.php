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


</head>
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>添加地区</h5>
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
                <form class="form-horizontal m-t" action="<?php echo U('AreaNew/add');?>" id="" method="post" onsubmit="mySubmit()" >
                    <input type="hidden" value="1" name="submit">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">地区名称(zh)：</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name = 'city_name'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">地区名称(hun)：</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name = 'city_name_hun'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">状态 :</label>
                        <div class="col-sm-8">
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="status1"  checked="checked"  value="1" name="status"  />
                                <label for="status1"> 正常 </label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="status2"    value="2" name="status"   />
                                <label for="status2"> 禁用 </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">排序：</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name = 'sort'>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-3">
                            <input type="submit" class="btn btn-primary" class="col-sm-12" value="确认添加">
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
<script type="text/javascript">
    $(function () {
    })
    function mySubmit() {
        return true;
    }
</script>
</body>
</html>