<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>cityeye管理系统</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="/Public/css/admin/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/css/admin/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/css/admin/animate.min.css" rel="stylesheet">
    <link href="/Public/css/admin/style.min.css" rel="stylesheet">
    <link href="/Public/css/admin/login.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>

</head>

<body class="signin">
<div class="signinpanel">
    <div class="row">
        <div class="col-sm-7">
            <div class="signin-info">
                <div class="logopanel m-b">
                    <h1>cityeye</h1>
                </div>
                <div class="m-b"></div>
                <h4>欢迎使用 <strong>cityeye后台管理系统</strong></h4>
                <ul>
                    <li>
                        <img border="0" style="width: 60%;height: 60%;" src="/Public/img/admin/logo2.png" />
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-5">
            <form id="fromSubmit" method="post" onsubmit="" action="<?php echo U('Public/do_login');?>">
                <h4 class="no-margins">登录：</h4>
                <p class="m-t-md">cityeye后台管理系统</p>
                <input type="text" name="account" maxlength="22" class="form-control uname" placeholder="用户名" />
                <input type="password" name="password" maxlength="32" class="form-control pword m-b" placeholder="密码" />
                <input type="text" name="verity" maxlength="6" class="form-control pword m-b" placeholder="验证码" />
                <img id="btnVerity" style="cursor: pointer;" title="点击换一张" alt="点击换一张" src="<?php echo U('Public/verifyimg/');?>">
                <button type="submit" class="btn btn-success btn-block">登录</button>
            </form>
        </div>
    </div>
    <div class="signup-footer">
        <div class="pull-left">
            &copy; 2017 All Rights Reserved. 河南八里铺弄啥嘞科技信息技术有限公司
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/js/admin/jquery-1.12.1.min.js"></script>
<script type="text/javascript" src="/Public/static/layer/layer.js"></script>
<script type="text/javascript">
    $(function () {
        $btnVerity=$("#btnVerity").on("click",function () {
            $(this).attr("src","<?php echo U('Public/verifyimg');?>?r="+Math.random());
        })
        $form=$("#fromSubmit").on("submit",function () {
            submit();
            return false;
        })
        function submit(){
            if(validate()){
                var index_load=layer.load();
                var option={
                    timeout:20000,
                    type:"POST",
                    url:$form.attr("action"),
                    data:$form.serialize(),
                    dataType:"json",
                    success:function (result) {
                        layer.close(index_load);
                        if(result.code==10000){
                            layer.msg(result.message);
                            window.top.location.href=result.todo;
                        }else{
                            layer.msg(result.message);
                            $btnVerity.click();
                        }
                    },
                    error:function () {
                        layer.close(index_load);
                        layer.alert("登录超时，请稍后再试！");
                        $btnVerity.click();
                    }
                };
                $.ajax(option);
            }
        }
        function validate(){
            $account=$form.find("input:text[name='account']");
            if($account.val()==""){
                layer.tips("请输入登录账号！" ,$account,{
                    tips:[2,'#1C84C6']
                });
                return false;
            }
            $password=$form.find("input:password[name='password']");
            if($password.val()==""){
                layer.tips("请输入密码！",$password,{
                    tips:[2,"#1C84C6"]
                })
                return false;
            }
            $verity=$form.find("input:text[name='verity']");
            if($verity.val()==""){
                layer.tips("请输入验证码！",$verity,{
                    tips:[2,"#1C84C6"]
                })
                return false;
            }
            return true;
        }
    })
</script>
</body>
</html>