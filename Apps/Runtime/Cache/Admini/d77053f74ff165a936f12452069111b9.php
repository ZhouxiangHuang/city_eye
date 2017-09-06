<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
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
        <h5>用户列表</h5>

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

                        <table class="table table-hover" id="userListTable"
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
        <?php if(check_auth(96) == 1): ?><a class="glyphicon glyphicon-plus" style="curosr: pointer;font-size: 20px" data_from="editUserInfo"
               onclick="addUser(this);">添加</a><?php endif; ?>
        <div class="input-group " style="width: 15%;float: left;margin-right: 1%">
            <span class="input-group-addon">用户昵称</span>
            <input type="text" class=" form-control" id="find_nickname">
        </div>
        <div class="input-group " style="width: 17%;float: left;margin-right: 1%">
            <span class="input-group-addon">用户电话</span>
            <input type="text" class=" form-control" id="find_phone">
        </div>
        <div class="input-group " style="width: 15%;float: left;margin-right: 1%">
            <span class="input-group-addon">用户性别</span>
            <select name="" id="find_gender" class=" form-control">
                <option value="">全部</option>
                <option value="1">男</option>
                <option value="0">女</option>
            </select>
        </div>
        <div class="input-group " style="width: 15%;float: left;margin-right: 1%">
            <span class="input-group-addon">用户性别</span>
            <select name="" id="find_status" class=" form-control">
                <option value="">全部</option>
                <option value="1">正常</option>
                <option value="0">禁用</option>
            </select>
        </div>
        <div style="float: left;margin-right: 1%">
            <button type="button" onclick="p_search();" class="btn">查询</button>
        </div>
    </form>
</div>


<form id="editUserInfo" class="form-horizontal m-t" style="display: none;">
    <div class="form-group" style="width: 100%;">
        <label class="col-sm-3 control-label">用户手机号 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="member_phone" name="member_phone" value="" required=""
                   aria-required="true"/>
            <input type="hidden" id="hidden_phone">
        </div>
        <label class="col-sm-3 control-label">密码 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="password" class="form-control" id="member_password" name="member_password" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">关注票据类型:</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <select name="member_drafttype" id="member_drafttype">
                <option value="">无</option>
                <option value="0">全部</option>
            </select>
        </div>
        <label class="col-sm-3 control-label">用户昵称 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="member_nickname" name="member_nickname" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">用户头像 :</label>
        <div class="col-sm-7" style="height: 50px;">
            <span id="member_heaimg"></span>
            <input type="hidden" id="hidden_heaimg" name="hidden_heaimg" value="">
        </div>
        <label class="col-sm-3 control-label">用户头像预览 :</label>
        <div class="col-sm-7" style="height: 150px;">
            <img id="hedimg_img" src="" alt="" style="display: block;padding-left: 15px;width: 40%;height: 90%;">
            <!--<input type="file" name="member_heaimg" id="member_heaimg">-->
        </div>
        <!--<input type="hidden" name="hidden_phone" id="hidden_phone">-->

        <label class="col-sm-3 control-label">真实姓名 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="member_realname" name="member_realname" value="" required=""
                   aria-required="true"/>
        </div>
        <label class="col-sm-3 control-label">身份证号 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="member_cardnumber" name="member_cardnumber" value=""
                   required=""
                   aria-required="true"/>
            <input type="hidden" name="hidden_cardnumber" id="hidden_cardnumber">
        </div>
        <label class="col-sm-3 control-label">手持身份证照片 :</label>
        <div class="col-sm-7" style="height: 50px;">
            <span id="member_cardfilepathhand"></span>
            <input type="hidden" id="hidden_cardfilepathhand" name="hidden_cardfilepathhand" value="">
            <!--<input type="file" name="member_cardfilepathn" id="member_cardfilepathn">-->
        </div>
        <label class="col-sm-3 control-label">手持身份证照片预览 :</label>
        <div class="col-sm-7" style="height: 150px;">
            <img id="cardfilepathhand_img" src="" alt="" style="display: block;padding-left: 15px;width: 30%;height: 90%;">
            <!--<input type="file" name="member_heaimg" id="member_heaimg">-->
        </div>
        <label class="col-sm-3 control-label">身份证正面照 :</label>
        <div class="col-sm-7" style="height: 50px;">
            <span id="member_cardfilepathn"></span>
            <input type="hidden" id="hidden_cardfilepathn" name="hidden_cardfilepathn" value="">
            <!--<input type="file" name="member_cardfilepathn" id="member_cardfilepathn">-->
        </div>
        <label class="col-sm-3 control-label">身份证正面照预览 :</label>
        <div class="col-sm-7" style="height: 150px;">
            <img id="cardfilepathn_img" src="" alt="" style="display: block;padding-left: 15px;width: 30%;height: 90%;">
            <!--<input type="file" name="member_heaimg" id="member_heaimg">-->
        </div>
        <label class="col-sm-3 control-label">身份证反面照片 :</label>
        <div class="col-sm-7" style="height: 50px;">
            <span id="member_cardfilepathf"></span>
            <input type="hidden" id="hidden_cardfilepathf" name="hidden_cardfilepathf" value="">
            <!--<input type="file" name="member_cardfilepathf" id="member_cardfilepathf">-->
        </div>
        <label class="col-sm-3 control-label">身份证反面照预览 :</label>
        <div class="col-sm-7" style="height: 150px;">
            <img id="cardfilepathf_img" src="" alt="" style="display: block;padding-left: 15px;width: 30%;height: 90%;">
            <!--<input type="file" name="member_heaimg" id="member_heaimg">-->
        </div>
        <label class="col-sm-3 control-label">是否已实名认证 :</label>
        <div class="col-sm-7" style="height: 50px;">
            <select name="member_isrealnameauth" id="member_isrealnameauth">
                <option value="0">未认证</option>
                <option value="1">认证通过</option>
                <option value="2">认证失败</option>
            </select>
        </div>
        <label class="col-sm-3 control-label">保证金 :</label>
        <div class="col-sm-7" style="height: 50px;">
            <input type="text" name="member_deposit" id="member_deposit">
        </div>
        <label class="col-sm-3 control-label">总计可用贷款额度 :</label>
        <div class="col-sm-7" style="height: 50px;">
            <input type="text" name="member_loanlimit" id="member_loanlimit">
        </div>
        <label class="col-sm-2 control-label" style="float: left;margin-left: 7%;">性别：</label>
        <div class="radio radio-info radio-inline" style="float: left">
            <input type="radio" id="member_gender1" value="1" checked="checked" name="member_gender">
            <label for="member_gender1"> 男 </label>
        </div>
        <div class="radio radio-inline" style="float: left">
            <input type="radio" id="member_gender2" value="0" name="member_gender">
            <label for="member_gender2"> 女 </label>
        </div>
        <br style="clear: both"/>
        <label class="col-sm-2 control-label" style="float: left;margin-left: 7%;">状态：</label>
        <div class="radio radio-info radio-inline" style="float: left">
            <input type="radio" id="member_status1" value="1" checked="checked" name="member_status">
            <label for="member_status1"> 开 </label>
        </div>
        <div class="radio radio-inline" style="float: left">
            <input type="radio" id="member_status2" value="0" name="member_status">
            <label for="member_status2"> 关 </label>
        </div>
        <br style="clear: both"/>
        <label class="col-sm-2 control-label" style="float: left;margin-left: 7%;">是否可以出价：</label>
        <div class="radio radio-info radio-inline" style="float: left">
            <input type="radio" id="member_isbid1" value="1" checked="checked" name="member_isbid">
            <label for="member_isbid1"> 开 </label>
        </div>
        <div class="radio radio-inline" style="float: left">
            <input type="radio" id="member_isbid2" value="0" name="member_isbid">
            <label for="member_isbid2"> 关 </label>
        </div>
    </div>
</form>
<div id = 'showCard' style="display: none">
    <div>
        <span>手持身份证照片：</span>
        <img src="" alt="" id="showCard_h" style="display: block;padding-left: 15px;width: 60%;">
    </div>
    <hr/>
    <div>
        <span>身份证正面照片：</span>
        <img src="" alt="" id="showCard_n" style="display: block;padding-left: 15px;width: 60%">
    </div>
    <hr/>
    <div>
        <span>身份证反面照片：</span>
        <img src="" alt="" id="showCard_f" style="display: block;padding-left: 15px;width: 60%">
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
        $('#userListTable').bootstrapTable('destroy');
        //初始化表格,动态从服务器加载数据
        $("#userListTable").bootstrapTable({
            url: '<?php echo U("UserInfo/getUserInfoAjax");?>', //获取数据的Servlet地址
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
                    find_nickname : $('#find_nickname').val(),
                    find_phone : $('#find_phone').val(),
                    find_status : $('#find_status').val(),
                    find_gender : $('#find_gender').val(),
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
                    valign: 'middle'
                },
                {
                    field: 'phone',
                    title: '电话',
                    sortable: true,
                    align: 'center'
                },
                {
                    field: 'drafttype',
                    title: '关注汇票类型',
                    sortable: true,
                    align: 'left',
                    formatter: function (value,row) {
                        if(value == 0){
                            return '全部';
                        }
                    }
                },
                {
                    field: 'nickname',
                    title: '昵称',
                    sortable: true,
                    align: 'center'
                },
                {
                    field: 'realname',
                    title: '真实姓名',
                    sortable: true,
                    align: 'center'
                },
                {
                    field: 'gender',
                    title: '性别',
                    sortable: true,
                    formatter: function(value,row,index){
                        if(value == 1 ){
                            return '男';
                        }else{
                            return '女';
                        }
                    }
                },
                {
                    field: 'cardnumber',
                    title: '身份证号',
                    sortable: true,
                    align: 'center',
                    formatter: function (value,row) {
                        return '<a onclick="getCard(this)" data_cardf = "/'+row.cardfilepathf+'" data_cardn = "/'+row.cardfilepathn+'" data_cardh = "/'+row.handheldidentcard+'"  >'+value+'</a>';
                    }
                },
                {
                    field: 'isrealnameauth',
                    title: '是否实名认证',
                    sortable: true,
                    align: 'center',
                    formatter: function (value,row) {
                        if(value == 0){
                            return '未认证';
                        }else if(value == 1){
                            return '认证通过';
                        }else if(value == 2){
                            return '认证失败';
                        }else if(value == 3){
                            return '认证中';
                        }else {
                            return '未知';
                        }
                    }
                },
                {
                    field: 'isbid',
                    title: '是否可以出价',
                    sortable: true,
                    align: 'center',
                    formatter: function (value,row) {
                        if(value == 1){
                            return '可以出价';
                        }else {
                            return '不可出价';
                        }
                    }
                },
                {
                    field: 'deposit',
                    title: '保证金',
                    sortable: true,
                    align: 'left'
                },
                {
                    field: 'loanlimit',
                    title: '总计可用贷款额度',
                    sortable: true,
                    align: 'left',
                },
                {
                    field: 'surplusloanlimit',
                    title: '当前剩余额度',
                    sortable: true,
                    align: 'center',
                },
                {
                    field: 'status',
                    title: '状态',
                    sortable: true,
                    align: 'center',
                    formatter: function(value,row,index){
                        <?php if(check_auth(95) == 1): ?>if(value==1){
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
                        <?php if(check_auth(116) == 1): ?>e = '<a href="#" mce_href="#" data_from="editUserInfo" data_id="'+row.id+'"  onclick="edit(this)" >编辑</a> '  ;<?php endif; ?>
                        <?php if(check_auth(117) == 1): ?>d = '<a href="#" mce_href="#" onclick="del('+row.id+')">删除</a> ';<?php endif; ?>
                        return e+d;
                    }
                }
            ]
        });
    }

    $(document).ready(function () {
        //调用函数，初始化表格
        initTable();
        //当点击查询按钮的时候执行
        $("#search").bind("click", initTable);
        uploadHeaing();
        uploadCardfilepathf();
        uploadCardfilepathn();
        uploadCardfilepathHand();
    });
    //搜索
    function p_search() {
        $("#userListTable").bootstrapTable('refresh');
    }


    /**
     * 编辑详细信息
     * */
    function edit(obj){
        var id = $(obj).attr('data_id');
        var from = $(obj).attr('data_from');
        $.ajax({
            method: "post",
            url: '<?php echo U("UserInfo/updateUserInfo");?>',
            data:{ 'id':id,'act':'display'},
            dataType: 'JSON',
            success: function(data){
                if (data.code == 200) {
                    $('#member_phone').val(data.data.phone);
                    $('#hidden_phone').val(data.data.phone);
                    $('#member_drafttype').val(data.data.drafttype);
                    $('#member_nickname').val(data.data.nickname);
                    $('#hedimg_img').attr('src','/'+data.data.heaimg);
                    $('#member_realname').val(data.data.realname);
                    $('#member_cardnumber').val(data.data.cardnumber);
                    $('#hidden_cardnumber').val(data.data.cardnumber);
                    $('#cardfilepathn_img').attr('src','/'+data.data.cardfilepathn);
                    $('#cardfilepathf_img').attr('src','/'+data.data.cardfilepathf);
                    $('#cardfilepathhand_img').attr('src','/'+data.data.handheldidentcard);
                    $('#member_isrealnameauth').val(data.data.isrealnameauth);
                    $('#member_deposit').val(data.data.deposit);
                    $('#member_loanlimit').val(data.data.loanlimit);
                    if(data.data.gender==1){
                        $('#member_gender1').prop('checked','checked');
                        $('#member_gender2').prop('checked','');
                    }else {
                        $('#member_gender1').prop('checked','');
                        $('#member_gender2').prop('checked','checked');
                    }
                    if(data.data.status==1){
                        $('#member_status1').prop('checked','checked');
                        $('#member_status2').prop('checked','');
                    }else {
                        $('#member_status1').prop('checked','');
                        $('#member_status2').prop('checked','checked');
                    }
                    if(data.data.isbid==1){
                        $('#member_isbid1').prop('checked','checked');
                        $('#member_isbid2').prop('checked','');
                    }else {
                        $('#member_isbid1').prop('checked','');
                        $('#member_isbid2').prop('checked','checked');
                    }
//                    $('#member_isrealnameauth').val(data.data.isrealnameauth);

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
//                if(from_data.member_password == ''){
//                    layer.msg('请填写密码！');
//                    return false;
//                }
                if(from_data.member_nickname == ''){
                    layer.msg('请填写昵称！');
                    return false;
                }
                if(from_data.member_cardnumber == ''){
//                    layer.msg('请填写身份证号！');
//                    return false;
                }else{
                    var pattern = /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/;
                    if(!pattern.test(from_data.member_cardnumber)){
                        layer.msg('请填写正确身份证号！');
                        return false;
                    }
                }
                if(from_data.member_phone == ''){
                    layer.msg('请填写手机号码！');
                    return false;
                }else{
                    var pattern = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-9]{1}))+\d{8})$/;
                    if(!pattern.test(from_data.member_phone)){
                        layer.msg('请填写正确手机号码！');
                        return false;
                    }
                }
                layer.msg('确定编辑？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        $.ajax({
                            method: "post",
                            url: '<?php echo U("UserInfo/updateUserInfo");?>',
                            data:{
                                'id':id,
                                'hidden_phone':$('#hidden_phone').val(),
                                'hidden_cardnumber':$('#hidden_cardnumber').val(),
                                'from' : $('#'+from).toJson()
                            },
                            dataType: 'JSON',
                            success: function(data){
                                if (data.code == 200) {
                                    $("#userListTable").bootstrapTable('refresh');
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
     * 查看身份证图片
     * */
    function getCard(obj) {
        var cardn = $(obj).attr('data_cardn');
        $('#showCard_n').attr('src',cardn);
        var cardh = $(obj).attr('data_cardh');
        $('#showCard_h').attr('src',cardh);
        var cardf = $(obj).attr('data_cardf');
        $('#showCard_f').attr('src',cardf);
        layer.open({
            type: 1,
            title: '身份证信息',
            shadeClose: true,
            shade: 0.8,
            area: ['70%', '65%'],
            content: $('#showCard'),
            btn: ['确定'] // 按钮
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
                url: '<?php echo U("UserInfo/editUserStatus");?>',
                data:{ 'id':id, 'status' : status },
                dataType: 'JSON',
                success: function(data){
                    if (data.code == 200) {
                        $("#userListTable").bootstrapTable('refresh');
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
     * 上传头像
     * */
    function uploadHeaing() {

        var uploadUrl = '<?php echo U("UserInfo/uploadImg");?>';
        $('#member_heaimg').Huploadify({
            'auto':true,
            'fileTypeExts':'*.jpg;*.png;*.jpeg',
            'buttonText':'选择文件[仅支持jpg，png，jpeg]',
            'multi':false,
            'formData':{key:'heaing',action:'upload'},
            'fileSizeLimit':4096,
            'showUploadedPercent':true,//是否实时显示上传的百分比，如20%
            'showUploadedSize':true,
            'removeTimeout':15,
            'uploader':uploadUrl,
            onUploadComplete:function(file,responseText){
                var data = jQuery.parseJSON(responseText);
                if(data.code == 200){
                    $('#hedimg_img').attr('src','/'+data.src);
                    $('#hidden_heaimg').val(data.src);
                }else {
                    layer.msg(data.msg);
                }
            }
        });

    }

    /**
     * 上传身份证正面照
     * */
    function uploadCardfilepathn() {
        var uploadUrl = '<?php echo U("UserInfo/uploadImg");?>';
        $('#member_cardfilepathn').Huploadify({
            'auto':true,
            'fileTypeExts':'*.jpg;*.png;*.jpeg',
            'buttonText':'选择文件[仅支持jpg，png，jpeg]',
            'multi':false,
            'formData':{key:'cardn',action:'upload'},
            'fileSizeLimit':4096,
            'showUploadedPercent':true,//是否实时显示上传的百分比，如20%
            'showUploadedSize':true,
            'removeTimeout':15,
            'uploader':uploadUrl,
            onUploadComplete:function(file,responseText){
                var data = jQuery.parseJSON(responseText);
                if(data.code == 200){
                    $('#cardfilepathn_img').attr('src','/'+data.src);
                    $('#hidden_cardfilepathn').val(data.src);
                }else {
                    layer.msg(data.msg);
                }
            }
        });

    }

    /**
     * 上传身份证反面照
     * */
    function uploadCardfilepathf() {
        var uploadUrl = '<?php echo U("UserInfo/uploadImg");?>';
        $('#member_cardfilepathf').Huploadify({
            'auto':true,
            'fileTypeExts':'*.jpg;*.png;*.jpeg',
            'buttonText':'选择文件[仅支持jpg，png，jpeg]',
            'multi':false,
            'formData':{key:'cardf',action:'upload'},
            'fileSizeLimit':4096,
            'showUploadedPercent':true,//是否实时显示上传的百分比，如20%
            'showUploadedSize':true,
            'removeTimeout':15,
            'uploader':uploadUrl,
            onUploadComplete:function(file,responseText){
                var data = jQuery.parseJSON(responseText);
                if(data.code == 200){
                    $('#cardfilepathf_img').attr('src','/'+data.src);
                    $('#hidden_cardfilepathf').val(data.src);
                }else {
                    layer.msg(data.msg);
                }
            }
        });

    }

    /**
     * 上传手持身份证照片
     * */
    function uploadCardfilepathHand() {
        var uploadUrl = '<?php echo U("UserInfo/uploadImg");?>';
        $('#member_cardfilepathhand').Huploadify({
            'auto':true,
            'fileTypeExts':'*.jpg;*.png;*.jpeg',
            'buttonText':'选择文件[仅支持jpg，png，jpeg]',
            'multi':false,
            'formData':{key:'hand',action:'upload'},
            'fileSizeLimit':4096,
            'showUploadedPercent':true,//是否实时显示上传的百分比，如20%
            'showUploadedSize':true,
            'removeTimeout':15,
            'uploader':uploadUrl,
            onUploadComplete:function(file,responseText){
                var data = jQuery.parseJSON(responseText);
                if(data.code == 200){
                    $('#cardfilepathhand_img').attr('src','/'+data.src);
                    $('#hidden_cardfilepathhand').val(data.src);
                }else {
                    layer.msg(data.msg);
                }
            }
        });

    }

    /**
     * 添加用户
     * */
    function addUser(obj){
        $('#member_phone').val('');
        $('#member_password').val();
        $('#edit_district').empty();
        $('#member_nickname').val('');
        $('#member_realname').val('');
        $('#member_cardnumber').val('');
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

                if(from_data.member_password == ''){
                    layer.msg('请填写密码！');
                    return false;
                }
                if(from_data.member_nickname == ''){
                    layer.msg('请填写昵称！');
                    return false;
                }
                if(from_data.member_cardnumber == ''){
//                    layer.msg('请填写身份证号！');
//                    return false;
                }else{
                    var pattern = /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/;
                    if(!pattern.test(from_data.member_cardnumber)){
                        layer.msg('请填写正确身份证号！');
                        return false;
                    }
                }
                if(from_data.member_phone == ''){
                    layer.msg('请填写手机号码！');
                    return false;
                }else{
                    var pattern = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-9]{1}))+\d{8})$/;
                    if(!pattern.test(from_data.member_phone)){
                        layer.msg('请填写正确手机号码！');
                        return false;
                    }
                }
                layer.msg('确定添加？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        $.ajax({
                            method: "post",
                            url: '<?php echo U("UserInfo/addUserInfo");?>',
                            data:{  'from' : $('#'+from).toJson() },
                            dataType: 'JSON',
                            success: function(data){
                                if (data.code == 200) {
                                    $("#userListTable").bootstrapTable('refresh');
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
                    url: '<?php echo U("UserInfo/delete");?>',
                    data:{'id':id},
                    dataType: 'JSON',
                    success: function(data){
                        if (data.code == 200) {
                            $("#userListTable").bootstrapTable('refresh');
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


</script>


</body>

</html>