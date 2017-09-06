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
    .bgcolor {
        background: #F2F2F2;
    }
</style>
<!-- Panel Other -->
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>系统日志列表</h5>

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
                        <div class="btn-group hidden-xs" id="logListToolbar" role="group">

                        </div>
                        <table class="table table-hover" id="logList"
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
<div>
    <form id="list_search">
        <fieldset>
            表名: <input type="text" id="tablename" style="width: 80px;">&nbsp;&nbsp;
            管理员账号: <input type="text" id="act_account" style="width: 80px;">&nbsp;&nbsp;
            时间: <input type="text" class="laydate-icon" id="Q_times" style="width: 80px;width: 160px">&nbsp;&nbsp;
            到: <input type="text" class="laydate-icon" id="E_times" style="width: 80px;width: 160px">&nbsp;&nbsp;
            <button type="button" onclick="p_search();" class="btn">查询</button>
            &nbsp;&nbsp;&nbsp;&nbsp;
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
<script src="/Public/js/admin/demo/laydate/laydate.js"></script>
<script src="/Public/js/admin/bootstrapValidator.js"></script>
<script src="/Public/js/admin/bootstrapValidator.min.js"></script>
<script src="/Public/js/admin/index.js"></script>
<script type="text/javascript">
    var $logList = $('#logList');
    $(document).ready(function() {
    });
    function initTable() {
        //先销毁表格
        $logList.bootstrapTable('destroy');
        //初始化表格,动态从服务器加载数据
        $logList.bootstrapTable({
            url: '<?php echo U("Log/logList",array("act"=>ajax));?>', //获取数据的Servlet地址
            striped: true,  //表格显示条纹
            pagination: true, //启动分页
            sortName: 'id',
            sortOrder: 'desc',
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
                    tablename : $('#tablename').val(),
                    act_account : $('#act_account').val(),
                    Q_time: $('#Q_times').val(),
                    E_time: $('#E_times').val(),
                };
                return param;
            },
            onLoadSuccess: function(data){  //加载成功时执行
//            alert("加载成功"+data);
                if(data.success==400){
                    layer.msg(data.message, {time : 1500, icon : 2});
                }
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
                    field: 'tablename',
                    title: '操作表名',
                    sortable: true,
                    align: 'center'
                },
                {
                    field: 'act_id',
                    title: '管理员ID',
                    sortable: true,
                    align: 'center',
                    width: '2%'
                },
                {
                    field: 'act_account',
                    title: '管理员帐号',
                    sortable: true,
                    align: 'center',
                    width: '2%'
                },
                {
                    field: 'description',
                    title: '操作记录说明',
                    sortable: true,
                    align: 'left',
                    width: '30%'
                },
                {
                    field: 'get_parameter',
                    title: 'get参数',
                    sortable: true,
                    align: 'left',
                    width: '45%'
                },
                {
                    field: 'times',
                    title: '时间',
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
                    },
                    width: '9%'
                },
                {
                    field: 'operate',
                    title: '操作',
                    align: 'center',
                    formatter: function(value,row,index){
                        var e='';
                        var d = '';
                        <?php if(check_auth(92) == 1): ?>d = '<a href="#" mce_href="#" onclick="del(\''+ row.id +'\')">删除</a> ';<?php endif; ?>
                        return e+d;
                    },
                    width: '3%'
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

        $logList.bootstrapTable('refresh');
    }

    /**
     * 删除日志
     * */
    function del(id){
        layer.msg('确定删除？', {
            time: 0 //不自动关闭
            ,btn: ['确定', '取消']
            ,yes: function(index){
                $.ajax({
                    method: "post",
                    url: '<?php echo U("Log/delLog");?>',
                    data:{'id':id},
                    dataType: 'JSON',
                    success: function(data){
                        if (data.code == 200) {
                            $logList.bootstrapTable('refresh');
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
<script>
    laydate({
        elem: '#Q_times',
        format: 'YYYY-MM-DD hh:mm:ss', //日期格式
        istime: true,
        istoday: false,
        min: '2016-01-01 00:00:00', //最小日期
    });
    laydate({
        elem: '#E_times',
        format: 'YYYY-MM-DD hh:mm:ss', //日期格式
        istime: true,
        istoday: false,
        min: '2016-01-01 00:00:00', //最小日期
    });
</script>
</html>