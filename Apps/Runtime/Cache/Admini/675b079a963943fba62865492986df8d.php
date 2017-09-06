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
        <h5>管理员列表</h5>
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
<div >
    <form id="list_search">
        <fieldset>
            账户: <input type="text" id="account" style="width: 80px;">&nbsp;&nbsp;&nbsp;&nbsp;
            昵称: <input type="text" id="nickname" style="width: 80px;">&nbsp;&nbsp;&nbsp;&nbsp;
            电话: <input type="text" id="phone" style="width: 80px;">&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" onclick="p_search();" class="btn">查询</button>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php if(check_auth(85) == 1): ?><a class="glyphicon glyphicon-plus" style="font-size: 20px" data_from="editUser" onclick="addUser(this);">添加</a><?php endif; ?>
        </fieldset>
    </form>
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
<script src="/Public/js/admin/bootstrapValidator.js"></script>
<script src="/Public/js/admin/bootstrapValidator.min.js"></script>
<script src="/Public/js/admin/index.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        validator_user();
    });

    function initTable() {
        //先销毁表格
        $('#userListTable').bootstrapTable('destroy');
        //初始化表格,动态从服务器加载数据
        $("#userListTable").bootstrapTable({
            url: '<?php echo U("User/userListAjax");?>', //获取数据的Servlet地址
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
                    account : $('#account').val(),
                    nickname : $('#nickname').val(),
                    phone : $('#phone').val()
                    };
                return param;
            },
        onLoadSuccess: function(data){  //加载成功时执行
            if(data.success==400){
                layer.msg(data.message, {time : 1500, icon : 2});
            }
        },
        onLoadError: function(){  //加载失败时执行
            layer.msg("加载数据失败", {time : 1500, icon : 2});
        },
        columns: [
            {
                field: 'state',
                checkbox: true,
                align: 'center',
                valign: 'middle'
            }, {
                title: 'ID',
                field: 'id',
                align: 'center',
                valign: 'middle'
            },
            {
                field: 'account',
                title: '账户名',
                sortable: true,
                align: 'center'
            },
            {
                field: 'title',
                title: '角色',
                sortable: true,
                align: 'center'
            },
            {
                field: 'nickname',
                title: '昵称',
                sortable: true,
                align: 'center'
            },
            {
                field: 'realname',
                title: '姓名',
                sortable: true,
                align: 'center'
            },
            {
                field: 'phone',
                title: '电话',
                sortable: true,
                align: 'center'
            },
            {
                field: 'status',
                title: '状态',
                sortable: true,
                align: 'center',
                formatter: function(value,row,index){
                    <?php if(check_auth(84) == 1): ?>if(value==1){
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
                    <?php if(check_auth(85) == 1 ): ?>e = '<a href="#" mce_href="#" data_from="editUser" data_id="'+row.id+'"  onclick="edit(this)" >编辑</a> ';<?php endif; ?>
                    <?php if(check_auth(85) == 1): ?>if(row.id!=1){
                            d = '<a href="#" mce_href="#" onclick="del(\''+ row.id +'\')">删除</a> ';
                        }<?php endif; ?>
                    <?php if(check_auth(108) == 1): ?>f = '<a href="#" mce_href="#" data_from="editUserPassword" data_id="'+row.id+'" onclick="editPassword(this)">修改密码</a> ';<?php endif; ?>
                    return e+f+d;
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
    });
    //搜索
    function p_search() {

        $("#userListTable").bootstrapTable('refresh');
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
                url: '<?php echo U('User/editAdminiStatus');?>',
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
    * 编辑详细信息
    * */
    function edit(obj){
        var id = $(obj).attr('data_id');
        var from = $(obj).attr('data_from');
        $.ajax({
            method: "post",
            url: '<?php echo U("User/editUser",array("act"=>display));?>',
            data:{ 'id':id, 'from' : $('#'+from).toJson() },
            dataType: 'JSON',
            success: function(data){
                if (data.code == 200) {
                    $('#edit_account').val(data.row.account);
                    $('#edit_account').attr("disabled",true);
                    $('#edit_role option').each(function () {
                        if($(this).val()==data['row']['role_id']){
                            $(this).attr('selected',true);
                        }
                    });
//                    $('#edit_role').append("<option value='"+data['row']['role_id']+"'>"+data['row']['title']+"</option>");
                    $('#edit_nickname').val(data.row.nickname);
                    $('#edit_realname').val(data.row.realname);
                    $('#edit_phone').val(data.row.phone);
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
            area: ['70%', '65%'],
            content: $('#'+from),
            btn: ['确定', '取消'], // 按钮
            yes: function(index, layero){
                $('#editUser').data('bootstrapValidator').destroy();
                $('#editUser').data('bootstrapValidator', null);
                $('#editUser').bootstrapValidator('validate');
                var verify = $('#editUser').data('bootstrapValidator').isValid();
                if(verify){
                    layer.msg('确定编辑？', {
                        time: 0 //不自动关闭
                        ,btn: ['确定', '取消']
                        ,yes: function(index){
                            $.ajax({
                                method: "post",
                                url: '<?php echo U("User/editUser",array("act"=>submit,"action"=>edit));?>',
                                data:{ 'id':id, 'from' : $('#'+from).toJson() },
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

            }
//            content: '<?php echo U("User/editUser",array("id"=>'+id+',"act"=>display));?>' //iframe的url
        });
    }


    /**
    * 加载角色下拉框
    * */
    function roleType(obj){
        var select = $(obj).val();
        if(select==null||select=='null'){
            $.ajax({
                method: "post",
                url: '<?php echo U("Role/getRoleAjax");?>',
                data:{ },
                dataType: 'JSON',
                success: function(data){
                    if (data.code == 200) {
                        $('#edit_role').empty();
                        for(var i=0;i<data.num;i++){
                            if(select != data['row'][i]['id']){
                                $(obj).append("<option value='"+data['row'][i]['id']+"'>"+data['row'][i]['title']+"</option>");
                            }
                        }
                    } else {
                        layer.msg('数据错误！');
                    }
                },
                error:function(){
                    layer.msg('数据错误！');
                }
            });
        }

    }
    //表单验证
    function validator_user(){
        $('#editUser').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                edit_account: {
                    message: '账户名验证失败',
                    validators: {
                        notEmpty: {
                            message: '账户名不能为空'
                        },
                        stringLength: {
                            min: 4,
                            max: 18,
                            message: '账户名长度必须在6到18位之间'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: '账户名只能包含大写、小写、数字和下划线'
                        }
                    }
                },
                edit_role: {
                    validators: {
                        notEmpty: {
                            message: '角色不能为空'
                        }
                    }
                },
                edit_nickname: {
                    validators: {
                        notEmpty: {
                            message: '昵称不能为空'
                        }
                    }
                },
                edit_realname: {
                    validators: {
                        notEmpty: {
                            message: '姓名不能为空'
                        }
                    }
                },
                edit_phone: {
                    message: '手机号验证失败',
                    validators: {
                        notEmpty: {
                            message: '手机号不能为空'
                        },
                        regexp: {
                            regexp: /(13\d|14[57]|15[^4,\D]|17[678]|18\d)\d{8}|170\d{8}/,
                            message: '请填写正确手机号'
                        }
                    }
                }
            }
        });
    }

    /**
    * 修改管理员密码
    * */
    function editPassword(obj){
        var user_id = $(obj).attr('data_id');
        var from = $(obj).attr('data_from');
        layer.open({
            type: 1,
            title: '修改密码',
            shadeClose: true,
            shade: 0.8,
            area: ['40%', '25%'],
            content: $('#'+from),
            btn: ['确定', '取消'], // 按钮
            yes: function(index, layero){
                layer.msg('确定修改？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        $.ajax({
                            method: "post",
                            url: '<?php echo U("User/editPassword");?>',
                            data:{ 'user_id':user_id, 'password' : $('#edit_password').val() },
                            dataType: 'JSON',
                            success: function(data){
                                if (data.code == 200) {
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
    * 添加管理员
    * */
    function addUser(obj){
        $('#edit_account').val('');
        $('#edit_account').attr("disabled",false);
//        $('#edit_role').empty();
        $('#edit_nickname').val('');
        $('#edit_realname').val('');
        $('#edit_phone').val('');
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
                $('#editUser').bootstrapValidator(null);
                $('#editUser').bootstrapValidator('validate');
                var verify = $('#editUser').data('bootstrapValidator').isValid();
                if(verify){
                    layer.msg('确定添加？', {
                        time: 0 //不自动关闭
                        ,btn: ['确定', '取消']
                        ,yes: function(index){
                            $.ajax({
                                method: "post",
                                url: '<?php echo U("User/editUser",array("act"=>submit,"action"=>add));?>',
                                data:{  'from' : $('#'+from).toJson() },
                                dataType: 'JSON',
                                success: function(data){
                                    if (data.code == 200) {
                                        $("#userListTable").bootstrapTable('refresh');
                                        layer.close(index);
                                        layer.closeAll();
                                        layer.msg('添加成功!');
                                    } else {
                                        layer.msg('添加失败!');
                                    }
                                },
                                error:function(){
                                    layer.msg('数据错误！');
                                }
                            });
                        }
                    });

                }

            }
//            content: '<?php echo U("User/editUser",array("id"=>'+id+',"act"=>display));?>' //iframe的url
        });
    }

    /**
    * 删除管理员
    * */
    function del(id){
        layer.msg('确定删除？', {
            time: 0 //不自动关闭
            ,btn: ['确定', '取消']
            ,yes: function(index){
                $.ajax({
                    method: "post",
                    url: '<?php echo U("User/editUser",array("act"=>submit,"action"=>del));?>',
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

<form id="editUser" class="form-horizontal m-t" style="display: none;" >
    <div class="form-group" style="width: 100%;">
        <label class="col-sm-3 control-label">账户名 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_account" name="edit_account" value=""  required="" aria-required="true" />
        </div>
        <label class="col-sm-3 control-label">角色 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <select  name="edit_role" id="edit_role" class="form-control">
                <?php if(is_array($auth_all)): $i = 0; $__LIST__ = $auth_all;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
        <label class="col-sm-3 control-label">昵称 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_nickname" name="edit_nickname" value=""  required="" aria-required="true" />
        </div>
        <label class="col-sm-3 control-label">姓名 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_realname" name="edit_realname" value=""  required="" aria-required="true" />
        </div>
        <label class="col-sm-3 control-label">电话 :</label>
        <div class="col-sm-7" style="margin-bottom: 2%;height: 50px;">
            <input type="text" class="form-control" id="edit_phone" name="edit_phone" value=""  required="" aria-required="true" />
        </div>
    </div>

</form>

<form id="editUserPassword" class="form-horizontal m-t" style="display: none;" >
    <label class="col-sm-3 control-label">新密码 :</label>
    <div class="col-sm-6" style="margin-bottom: 2%;height: 50px;">
        <input type="password" class="form-control" id="edit_password" name="edit_password" value="" />
    </div>
</form>
</body>

</html>