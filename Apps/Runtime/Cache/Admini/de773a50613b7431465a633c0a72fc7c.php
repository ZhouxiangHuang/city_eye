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
    <link href="/Public/css/admin/Huploadify.css" rel="stylesheet">
</head>
<body>
<style>
    .bgcolor {
        background: #F2F2F2;
    }
</style>
<!-- Panel Other -->
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>房源列表</h5>

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

                        <table class="table table-hover" id="houseInfolistTable"
                               data-pagination="true"
                               data-show-refresh="true"
                               data-show-toggle="true"
                               data-showColumns="true">
                        </table>
                    </div>
                </div>
                <!-- End Example Toolbar -->
            </div>
        </div>
    </div>
</div>
<div class="">
    <form id="list_search" class="bs-example bs-example-form">
        <?php if(check_auth(156) == 1): ?><a class="glyphicon glyphicon-plus" style="curosr: pointer;font-size: 20px" data_from="editUserInfo"
               onclick="addUser(this);">添加</a><?php endif; ?>
        <div class="input-group " style="width: 15%;float: left;margin-right: 1%">
            <span class="input-group-addon">标题(zh)</span>
            <input type="text" class=" form-control" id="find_title">
        </div>
        <div class="input-group " style="width: 17%;float: left;margin-right: 1%">
            <span class="input-group-addon">标题(hun)</span>
            <input type="text" class=" form-control" id="find_title_hun">
        </div>
        <div class="input-group " style="width: 15%;float: left;margin-right: 1%">
            <span class="input-group-addon">状态</span>
            <select name="" id="find_status" class=" form-control">
                <option value="0">全部</option>
                <option value="1">正常</option>
                <option value="2">禁用</option>
            </select>
        </div>
        <div class="input-group " style="width: 15%;float: left;margin-right: 1%">
            <span class="input-group-addon">售卖/出租</span>
            <select name="" id="find_is_sale" class=" form-control">
                <option value="0">全部</option>
                <option value="1">售卖</option>
                <option value="2">出租</option>
            </select>
        </div>
        <div style="float: left;margin-right: 1%">
            <button type="button" onclick="p_search();" class="btn">查询</button>
        </div>
    </form>
</div>


<form id="editUserInfo" class="form-horizontal m-t" style="display: none;">
    <div class="form-group" style="width: 100%;">
        <label class="col-sm-3 control-label">标题(zh) :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_title" name="edit_title" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">标题(hun) :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_title_hun" name="edit_title_hun" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">价格:</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_price" name="edit_price" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">地址(zh) :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_address" name="edit_address" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">地址(hun) :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_address_hun" name="edit_address_hun" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">有无电梯 :</label>
        <div class="col-sm-7" style="height: 50px;">
            <select name="edit_is_lift" id="edit_is_lift">
                <option value="1">有电梯</option>
                <option value="2">无电梯</option>
            </select>
        </div>
        <label class="col-sm-3 control-label">售卖/出租 :</label>
        <div class="col-sm-7" style="height: 50px;">
            <select name="edit_is_sale" id="edit_is_sale">
                <option value="1">售卖</option>
                <option value="2">出租</option>
            </select>
        </div>
        <label class="col-sm-3 control-label">房屋面积 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_proportion" name="edit_proportion" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">花园面积 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_garden_area" name="edit_garden_area" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">车库面积 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_garage_area" name="edit_garage_area" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">房间数目 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_num" name="edit_num" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">卫生间数目 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_wc_num" name="edit_wc_num" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">所在楼层 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_floor_num" name="edit_floor_num" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">建筑类型 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_build_type" name="edit_build_type" value="" required=""
                   aria-required="true"/>
        </div>

        <label class="col-sm-3 control-label">房屋建造时间 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input id="edit_creat_house_time" class="laydate-icon" name="edit_creat_house_time">
        </div>
        <label class="col-sm-3 control-label">区域(zh) :</label>
        <div class="col-sm-7" style="height: 50px;">
            <select name="edit_area_new" id="edit_area_new" onchange="zhTohunArea(this)">
                <?php if(is_array($area_info)): $i = 0; $__LIST__ = $area_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zh_info): $mod = ($i % 2 );++$i;?><option value="<?php echo ($zh_info["id"]); ?>"><?php echo ($zh_info["city_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
        <label class="col-sm-3 control-label">区域(hun) :</label>
        <div class="col-sm-7" style="height: 50px;">
            <select name="edit_area_new_hun" id="edit_area_new_hun" onchange="hunTozhArea(this)">
                <?php if(is_array($area_info)): $i = 0; $__LIST__ = $area_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zh_info_hun): $mod = ($i % 2 );++$i;?><option value="<?php echo ($zh_info_hun["id"]); ?>"><?php echo ($zh_info_hun["city_name_hun"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>

        <br style="clear: both"/>
        <label class="col-sm-2 control-label" style="float: left;margin-left: 7%;">状态：</label>
        <div class="radio radio-info radio-inline" style="float: left">
            <input type="radio" id="edit_status1" value="1" checked="checked" name="edit_status">
            <label for="edit_status1"> 开 </label>
        </div>
        <div class="radio radio-inline" style="float: left">
            <input type="radio" id="edit_status2" value="0" name="edit_status">
            <label for="edit_status2"> 关 </label>
        </div>
        <br style="clear: both"/>
        <label class="col-sm-2 control-label" style="float: left;margin-left: 7%;">地暖：</label>
        <div class="radio radio-info radio-inline" style="float: left">
            <input type="radio" id="edit_is_floor_heat1" value="1" checked="checked" name="edit_is_floor_heat">
            <label for="edit_is_floor_heat1"> 有 </label>
        </div>
        <div class="radio radio-inline" style="float: left">
            <input type="radio" id="edit_is_floor_heat2" value="2" name="edit_is_floor_heat">
            <label for="edit_is_floor_heat2"> 无 </label>
        </div>
        <br style="clear: both"/>
        <label class="col-sm-2 control-label" style="float: left;margin-left: 7%;">独立淋浴：</label>
        <div class="radio radio-info radio-inline" style="float: left">
            <input type="radio" id="edit_is_dulilinyu1" value="1" checked="checked" name="edit_is_dulilinyu">
            <label for="edit_is_dulilinyu1"> 有 </label>
        </div>
        <div class="radio radio-inline" style="float: left">
            <input type="radio" id="edit_is_dulilinyu2" value="2" name="edit_is_dulilinyu">
            <label for="edit_is_dulilinyu2"> 关 </label>
        </div>
        <br style="clear: both"/>
        <div class="form-group">
            <label class="col-sm-3 control-label">房源照片 :</label>
            <div class="col-sm-7" style="height: 50px;">
                <span id="filepath"></span>
                <input type="hidden" id="hidden_filepath" value="2" >
                <!--<input type="file" name="member_cardfilepathn" id="member_cardfilepathn">-->

            </div>
        </div>
        <div id="hidden_filepath_div" style="margin-left:17%;height: 100px;width: auto">

        </div>
        <br style="clear: both"/>
        <label class="col-sm-3 control-label">简介 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <textarea name="edit_memo" id="edit_memo" cols="30" rows="10"></textarea>
        </div>
    </div>
</form>
<div id = 'showImg' style="display: none">

</div>
<script src="/Public/js/admin/jquery.min.js?v=2.1.4"></script>
<script src="/Public/js/admin/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/static/layer/layer.js"></script>
<script src="/Public/js/admin/content.min.js"></script>
<script src="/Public/js/admin/demo/laydate/laydate.js"></script>
<script>
    var _UPLOADS_ = '/Uploads';
</script>
<script src="/Public/js/admin/uploadify/jquery.Huploadify.js"></script>
<script src="/Public/js/admin/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<script src="/Public/js/admin/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="/Public/js/admin/demo/bootstrap-table-demo.min.js"></script>
<script src="/Public/js/admin/demo/laydate/laydate.js"></script>
<script src="/Public/js/admin/bootstrapValidator.js"></script>
<script src="/Public/js/admin/bootstrapValidator.min.js"></script>
<script src="/Public/js/admin/index.js"></script>
<script type="text/javascript">
    var _UPLOADS_ = '/Uploads';

    function initTable() {
        //先销毁表格
        $('#houseInfolistTable').bootstrapTable('destroy');
        //初始化表格,动态从服务器加载数据
        $("#houseInfolistTable").bootstrapTable({
            url: '<?php echo U("HouseInfo/getHouseInfoAjax");?>', //获取数据的Servlet地址
            striped: true,  //表格显示条纹
            pagination: true, //启动分页
            sortName: 'id',
            pageSize: 15,  //每页显示的记录数
            pageNumber:1, //当前第几页
            pageList: [10, 15, 20, 25],  //记录数可选列表
            search: false,
            toolbar: '#list_search',
            showColumns: true,  //显示下拉框勾选要显示的列
            showRefresh: true,  //显示刷新按钮
            sidePagination: "server", //表示服务端请求
            //设置为undefined可以获取pageNumber，pageSize，searchText，sortName，sortOrder
            //设置为limit可以获取limit, offset, search, sort, order
            responseHandler:function(res){
                //远程数据加载之前,处理程序响应数据格式,对象包含的参数: 我们可以对返回的数据格式进行处理
                //在ajax后我们可以在这里进行一些事件的处理
                return res.data;
            },
            queryParamsType : "undefined",
            queryParams: function queryParams(params) {   //设置查询参数
                var param = {
                    //这里是在ajax发送请求的时候设置一些参数 params有什么东西，自己看看源码就知道了
                    pageNumber: params.pageNumber,
                    pageSize: params.pageSize,
                    sortName: params.sortName,
                    sortOrder: params.sortOrder,
                    find_title_hun : $('#find_title_hun').val(),
                    find_title : $('#find_title').val(),
                    find_status : $('#find_status').val(),
                    find_is_sale : $('#find_is_sale').val()
                };
                return param;
            },
            onLoadSuccess: function(data){  //加载成功时执行
            },
            onLoadError: function(){  //加载失败时执行
                layer.msg("加载数据失败", {time : 1500, icon : 2});
            },
            columns: [
                {
                    title: 'ID',
                    field: 'id',
                    align: 'center',
                    sortable: true,
                    valign: 'middle'
                },
                {
                    field: 'coder',
                    title: '唯一编码',
                    align: 'left'
                },
                {
                    field: 'title',
                    title: '标题(zh)',
                    align: 'left'
                },
                {
                    field: 'title_hun',
                    title: '标题(hun)',
                    align: 'left'
                },
                {
                    field: 'price',
                    title: '价格',
                    sortable: true,
                    align: 'left'
                },
                {
                    field: 'address',
                    title: '地址(zh)',
                    align: 'left'
                },
                {
                    field: 'address_hun',
                    title: '地址(hun)',
                    align: 'left'
                },
                {
                    field: 'is_lift',
                    title: '有无电梯',
                    sortable: true,
                    formatter: function(value,row,index){
                        if(value == 1 ){
                            return '有电梯';
                        }else if(value == 2){
                            return '无电梯';
                        }else {
                            return '未知';
                        }
                    }
                },
                {
                    field: 'is_sale',
                    title: '售卖/出租',
                    sortable: true,
                    formatter: function(value,row,index){
                        if(value == 1 ){
                            return '售卖';
                        }else if(value == 2){
                            return '出租';
                        }else {
                            return '未知';
                        }
                    }
                },
                {
                    field: 'proportion',
                    title: '房屋面积',
                    align: 'left',
                },
                {
                    field: 'garden_area',
                    title: '花园面积',
                    align: 'left',
                },
                {
                    field: 'garage_area',
                    title: '车库面积',
                    align: 'left',
                },
                {
                    field: 'num',
                    title: '房屋数目',
                    align: 'left',
                },
                {
                    field: 'wc_num',
                    title: '卫生间数目',
                    align: 'left',
                },
                {
                    field: 'floor_num',
                    title: '所在楼层',
                    align: 'left',
                },
                {
                    field: 'build_type',
                    title: '建筑类型',
                    align: 'left',
                },
                {
                    field: 'city_name',
                    title: '区域(zh)',
                    align: 'left',
                },
                {
                    field: 'city_name_hun',
                    title: '区域(hun)',
                    align: 'left',
                },
                {
                    field: 'is_floor_heat',
                    title: '地暖',
                    align: 'left',
                    formatter: function(value,row,index){
                        if(value==1){
                            return '有地暖';
                        }else if(value==2){
                            return '无地暖';
                        }
                    }
                },
                {
                    field: 'is_dulilinyu',
                    title: '独立卫浴',
                    align: 'left',
                    formatter: function(value,row,index){
                        if(value==1){
                            return '有独立卫浴';
                        }else if(value==2){
                            return '无独立卫浴';
                        }else {
                            return '未知';
                        }
                    }
                },
                {
                    field: 'creat_house_time',
                    title: '房屋建造时间',
                    sortable: true,
                    align: 'left',
                    formatter: function(value,row,index){
                        if (value) {
                            var value_time = parseInt(value);
                            var time = new Date(value_time * 1000);
                            var ymdhis = "";
                            ymdhis += time.getUTCFullYear() + "-";
                            ymdhis += (time.getUTCMonth() + 1) + "-";
                            ymdhis += time.getUTCDate();

                            ymdhis += " " + time.getUTCHours() + ":";
                            ymdhis += time.getUTCMinutes() + ":";
                            ymdhis += time.getUTCSeconds();

                            return ymdhis;
                        }
                    }
                },
                {
                    field: 'addtime',
                    title: '添加时间',
                    sortable: true,
                    align: 'left',
                    formatter: function(value,row,index){
                        if (value) {
                            var value_time = parseInt(value);
                            var time = new Date(value_time * 1000);
                            var ymdhis = "";
                            ymdhis += time.getUTCFullYear() + "-";
                            ymdhis += (time.getUTCMonth() + 1) + "-";
                            ymdhis += time.getUTCDate();

                            ymdhis += " " + time.getUTCHours() + ":";
                            ymdhis += time.getUTCMinutes() + ":";
                            ymdhis += time.getUTCSeconds();

                            return ymdhis;
                        }
                    }
                },
                {
                    field: 'status',
                    title: '状态',
                    sortable: true,
                    align: 'center',
                    formatter: function(value,row,index){
                        <?php if(check_auth(154) == 1): ?>if(value==1){
                                var a = '<span class="btn btn-info btn-circle btn-sm"> <i class="fa fa-check" data_id="'+row.id+'" data_status="'+row.status+'" onclick="updeteStatus(this);"></i> </span>';
                            }else {
                                var a = '<span class="btn btn-warning btn-circle btn-xs"> <i class="fa fa-close" data_id="'+row.id+'" data_status="'+row.status+'" onclick="updeteStatus(this);"></i> </span>';
                            }
                        <?php else: ?>
                        if(value==1){
                            var a = '<span class="btn btn-info btn-circle btn-sm"> <i class="fa fa-check"  ></i> </span>';
                        }else {
                            var a = '<span class="btn btn-warning btn-circle btn-xs"> <i class="fa fa-close" ></i> </span>';
                        }<?php endif; ?>
                        return a;
                    }
                },{
                    field: 'operate',
                    title: '操作',
                    align: 'center',
                    formatter: function(value,row,index){
                        var e = '';
                        var d = '';
                        var f = '';
                        <?php if(check_auth(158) == 1): ?>f = '<a  onclick="lookImg(this)" data_id = "'+row.id+'">查看图册</a> ';<?php endif; ?>
                        <?php if(check_auth(157) == 1): ?>e = '<a href="#" mce_href="#" data_from="editUserInfo" data_id="'+row.id+'"  onclick="edit(this)" >编辑</a> '  ;<?php endif; ?>
                        <?php if(check_auth(155) == 1): ?>d = '<a href="#" mce_href="#" onclick="del('+row.id+')">删除</a> ';<?php endif; ?>
                        return e+f+d;
                    }
                }
            ]
        });
    }

    /**
     * 查看房屋图册
     * */
    function lookImg(obj){
        var id = $(obj).attr('data_id');
        $.ajax({
            method: "post",
            url: '<?php echo U("HouseInfo/lookImg");?>',
            data:{ 'id':id},
            dataType: 'JSON',
            success: function(data){
                if(data.code == 200){
                    $('#showImg').empty();
                    $.each(data.data,function (value,obj) {
                        $('#showImg').append("<img src='/"+obj.filepath+"'>");
                    });

                    layer.open({
                        type: 1,
                        title: '房源图册',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['70%', '65%'],
                        content: $('#showImg'),
                        btn: ['确定'] // 按钮
                    });
                }else {
                    layer.msg(data.msg);
                }

            },
            error: function(){
                layer.msg('请填写昵称！');
            }
        });
    }

    $(document).ready(function () {
        //调用函数，初始化表格
        initTable();
        //当点击查询按钮的时候执行
        $("#search").bind("click", initTable);
        uploadFilepath();
    });
    //搜索
    function p_search() {
        $("#houseInfolistTable").bootstrapTable('refresh');
    }

    /**
     * 上传房源图片
     * */
    function uploadFilepath() {
        var uploadUrl = '<?php echo U("HouseInfo/uploadImg");?>';
        $('#filepath').Huploadify({
            'auto':true,
            'fileTypeExts':'*.jpg;*.png;*.jpeg',
            'buttonText':'选择文件[仅支持jpg，png，jpeg]',
            'multi':true,
            'formData':{key:'info',action:'upload'},
            'queueSizeLimit' : 10,
            'fileSizeLimit':4096,
            'showUploadedPercent':true,//是否实时显示上传的百分比，如20%
            'showUploadedSize':true,
            'removeTimeout':15,
            'uploader':uploadUrl,
            onUploadComplete:function(file,responseText){
                var data = jQuery.parseJSON(responseText);
                if(data.code == 200){
                    $('#hidden_filepath_div').prepend("<img  src='/"+data.src+"' style='width: 100px;height: 100px;'>");
                    $('#hidden_filepath_div').prepend("<input type='hidden' style='width: 100px;height: 80px;' name='img[]' value = '"+data.src+"' >");
                }else {
                    layer.msg(data.msg);
                }
            }
        });

    }
    /**
     * 编辑详细信息
     * */
    function edit(obj){
        var id = $(obj).attr('data_id');
        var from = $(obj).attr('data_from');
        $.ajax({
            method: "post",
            url: '<?php echo U("HouseInfo/updateHouseInfo");?>',
            data:{ 'id':id},
            dataType: 'JSON',
            success: function(data){
                if (data.code == 200) {
                    $('#edit_title').val(data.data.info.title);
                    $('#edit_title_hun').val(data.data.info.title_hun);
//                    $('#edit_status').val(data.data.info.status);
                    $('#edit_proportion').val(data.data.info.proportion);
                    $('#edit_price').val(data.data.info.price);
                    $('#edit_num').val(data.data.info.num);
                    $('#edit_is_lift').val(data.data.info.is_lift);
                    $('#edit_is_sale').val(data.data.info.is_sale);
                    $('#edit_address').val(data.data.info.address);
                    $('#edit_address_hun').val(data.data.info.address_hun);
                    $('#edit_area_id').val(data.data.info.area_id);
                    $('#edit_garden_area').val(data.data.info.garden_area);
                    $('#edit_floor_num').val(data.data.info.floor_num);
                    $('#edit_build_type').val(data.data.info.build_type);
                    $('#edit_wc_num').val(data.data.info.wc_num);
                    $('#edit_garage_area').val(data.data.info.garage_area);
                    $('#edit_memo').text(data.data.info.memo);
                    $('#edit_creat_house_time').val(data.data.info.creat_house_time);

                    if(data.data.info.status==1){
                        $('#edit_status1').prop('checked','checked');
                        $('#edit_status2').prop('checked','');
                    }else {
                        $('#edit_status1').prop('checked','');
                        $('#edit_status2').prop('checked','checked');
                    }
                    if(data.data.info.is_floor_heat==1){
                        $('#edit_is_floor_heat1').prop('checked','checked');
                        $('#edit_is_floor_heat2').prop('checked','');
                    }else {
                        $('#edit_is_floor_heat1').prop('checked','');
                        $('#edit_is_floor_heat2').prop('checked','checked');
                    }
                    if(data.data.info.is_dulilinyu==1){
                        $('#edit_is_dulilinyu1').prop('checked','checked');
                        $('#edit_is_dulilinyu2').prop('checked','');
                    }else {
                        $('#edit_is_dulilinyu1').prop('checked','');
                        $('#edit_is_dulilinyu2').prop('checked','checked');
                    }
                        <?php if(check_auth(153) == 1): ?>$.each(data.data.photo_list,function (value,obj) {
                            if(obj.filepath!=''){
                                $('#hidden_filepath_div').append("<img style='width: 25%' onclick='delImg(this)' src='/"+obj.filepath+"' data_id = '"+obj.id+"'>");
                            }
                        });

                        <?php else: ?>
                    $.each(data.data.photo_list,function (value,obj) {
                        $('#showImg').append("<img src='/"+obj.photo_list.filepath+"'>");
                    });<?php endif; ?>

                } else {
                    layer.msg(data.msg);
                }
            },
            error:function(){
                layer.msg('数据错误！');
            }
        });
        layer.open({
            type: 1,
            title: '编辑',
            shadeClose: true,
            shade: 0.8,
            area: ['75%', '70%'],
            content: $('#'+from),
            btn: ['确定', '取消'], // 按钮
            yes: function(index, layero){
                var from_data = $('#'+from).toJson();
                if(from_data.edit_title == ''){
                    layer.msg('请填写标题(zh)！');
                    return false;
                }
                if(from_data.edit_title == ''){
                    layer.msg('请填写标题(hun)！');
                    return false;
                }
                if(from_data.edit_price == ''){
                    layer.msg('请填写价格！');
                    return false;
                }
                if(from_data.edit_address == ''){
                    layer.msg('请填写地址(zh)！');
                    return false;
                }
                if(from_data.edit_address_hun == ''){
                    layer.msg('请填写地址(hun)！');
                    return false;
                }
                if(from_data.edit_proportion == ''){
                    layer.msg('请填写房屋面积！');
                    return false;
                }
                if(from_data.edit_num == ''){
                    layer.msg('请填写房屋数量！');
                    return false;
                }
                if(from_data.edit_wc_num == ''){
                    layer.msg('请填写卫生间数量！');
                    return false;
                }
                if(from_data.edit_garden_area == ''){
                    layer.msg('请填写花园面积！');
                    return false;
                }
                if(from_data.edit_floor_num == ''){
                    layer.msg('请填写所在楼层！');
                    return false;
                }
                if(from_data.edit_build_type == ''){
                    layer.msg('请填写建筑类型！');
                    return false;
                }
                if(from_data.edit_garage_area == ''){
                    layer.msg('请填写车库面积！');
                    return false;
                }
                if(from_data.edit_creat_house_time == ''){
                    layer.msg('请填写房屋建筑时间！');
                    return false;
                }


                layer.msg('确定编辑？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        $.ajax({
                            method: "post",
                            url: '<?php echo U("HouseInfo/updateHouseInfo");?>',
                            data:{
                                'id':id,
                                'submit':'yes',
                                'from' : $('#'+from).toJson()
                            },
                            dataType: 'JSON',
                            success: function(data){
                                if (data.code == 200) {
                                    $("#houseInfolistTable").bootstrapTable('refresh');
                                    layer.close(index);
                                    layer.closeAll();
                                    layer.msg(data.msg);
                                } else {
                                    layer.msg(data.msg);
                                }
                            },
                            error:function(){
                                layer.msg('数据错误！');
                            }
                        });
                    }
                });
            }
        });
    }


    /**
     * 修改状态
     * */
    function updeteStatus(obj){
        var id = $(obj).attr('data_id');
        var status = $(obj).attr('data_status');

        layer.confirm("确定修改？",function () {
            $.ajax({
                method: "post",
                url: '<?php echo U("HouseInfo/editHouseStatus");?>',
                data:{ 'id':id, 'status' : status },
                dataType: 'JSON',
                success: function(data){
                    if (data.code == 200) {
                        $("#houseInfolistTable").bootstrapTable('refresh');
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




    /**
     * 添加用户
     * */
    function addUser(obj){
        $('#edit_title').val('');
        $('#edit_title_hun').val();
        $('#edit_price').val('');
        $('#edit_address').val('');
        $('#edit_address_hun').val('');
        $('#edit_proportion').val('');
        $('#edit_num').val('');
        $('#hidden_filepath_div').empty();
//        $('#member_cardnumber').val('');
        var from = $(obj).attr('data_from');
        layer.open({
            type: 1,
            title: '添加',
            shadeClose: true,
            shade: 0.8,
            area: ['70%', '65%'],
            content: $('#'+from),
            btn: ['确定', '取消'], // 按钮
            yes: function(index, layero){
                var from_data = $('#'+from).toJson();

                if(from_data.edit_title == ''){
                    layer.msg('请填写标题(zh)！');
                    return false;
                }
                if(from_data.edit_title == ''){
                    layer.msg('请填写标题(hun)！');
                    return false;
                }
                if(from_data.edit_price == ''){
                    layer.msg('请填写价格！');
                    return false;
                }
                if(from_data.edit_address == ''){
                    layer.msg('请填写地址(zh)！');
                    return false;
                }
                if(from_data.edit_address_hun == ''){
                    layer.msg('请填写地址(hun)！');
                    return false;
                }
                if(from_data.edit_proportion == ''){
                    layer.msg('请填写面积！');
                    return false;
                }
                if(from_data.edit_num == ''){
                    layer.msg('请填写房屋数量！');
                    return false;
                }
                layer.msg('确定添加？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        $.ajax({
                            method: "post",
                            url: '<?php echo U("HouseInfo/add");?>',
                            data:{ 'submit':'submit', 'from' : $('#'+from).toJson() },
                            dataType: 'JSON',
                            success: function(data){
                                if (data.code == 200) {
                                    $("#houseInfolistTable").bootstrapTable('refresh');
                                    layer.close(index);
                                    layer.closeAll();
                                    layer.msg('添加成功!');
                                } else {
                                    layer.msg(data.msg);
                                }
                            },
                            error:function(){
                                layer.msg('数据错误！');
                            }
                        });
                    }
                });
            }
        });
    }

    /**
     * 删除用户
     * */
    function del(id){
        layer.msg('确定删除？', {
            time: 0 //不自动关闭
            ,btn: ['确定', '取消']
            ,yes: function(index){
                $.ajax({
                    method: "post",
                    url: '<?php echo U("HouseInfo/delete");?>',
                    data:{'id':id},
                    dataType: 'JSON',
                    success: function(data){
                        if (data.code == 200) {
                            $("#houseInfolistTable").bootstrapTable('refresh');
//                            $("#houseInfolistTable").bootstrapTable('remove',{
//                                field: 'id',
//                                values: id
//                            });
                            layer.msg('删除成功!');
                        } else {
                            layer.msg('删除失败!');
                        }
                    },
                    error:function(){
                        layer.msg('数据错误！');
                    }
                });
            }
        });
    }

    /**
     * 同一选择的区域
     * */
    function zhTohunArea(obj){
        $('#edit_area_new_hun').val($(obj).val());
    }

    function hunTozhArea(obj){
        $('#edit_area_new').val($(obj).val());
    }

    /**
     * 删除单个图片
     * */
    function delImg(obj){
        var id = $(obj).attr('data_id');
        layer.confirm("确定删除图片？",function () {
            $.ajax({
                method: "post",
                url: '<?php echo U("HouseInfo/delImg");?>',
                data:{ 'id':id},
                dataType: 'JSON',
                success: function(data){
                    if (data.code == 200) {
                        $(obj).remove();
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

<script>
    var start = {
        elem: '#edit_creat_house_time',
        format: 'YYYY-MM-DD',
        max: laydate.now(),
        istime: false,
        istoday: false,
        choose: function (datas) {
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    laydate(start);

    //给input赋值
    $('#edit_creat_house_time').val(laydate.now(0, 'YYYY-MM-DD'));
</script>
</body>

</html>