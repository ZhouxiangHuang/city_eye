<?php
/**
 * Created by PhpStorm.
 * User: yara
 * Date: 2017/5/17
 * Time: 14:47
 */

namespace Admini\Controller;

use Think\Model;

class UserInfoController extends CommonController
{
    private $UserInfo = '';
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->UserInfo = D('Member');
    }

    /**
     * 用户管理页面
     * */
    public function index(){
        $this->CheckAuth();
        $this->display();
    }

    /**
     * 用户列表AJAX
     * */
    public function getUserInfoAjax(){
        if(!$this->CheckAuth(true,"Admini/UserInfo/index")){
            $this->myAjaxReturn(400,"没有使用该功能的权限！");
            die;
        }
        $data = $this->UserInfo->memberListAjax();
        $this->myReturnAjax($data,'加载成功','暂无数据');
    }

    /**
     * 添加用户
     * */
    public function addUserInfo(){
        if(!$this->CheckAuth(true,"Admini/UserInfo/index")){
            $this->myAjaxReturn(400,"没有使用该功能的权限！");
            die;
        }
        $data = $this->UserInfo->addUserAjax();
        if($data !==false ){
            $log = "{$_SESSION['admin']['account']}添加新用户，ID为[{$data}]";
            $this->writelog("member",$log);
            $this->myAjaxReturn(200,'添加成功！');
        }else{
            $this->myAjaxReturn(400,'添加失败！');
        }
    }

    /**
     * 上传图片
     * */
    public function uploadImg(){
        if(isset($_FILES["file"]["name"])){
            if(!empty($_POST['key'])){
                $uploadUrl = "userInfo/".$_POST['key'];
                $picurl = uploadOneImage($_FILES['file'],$uploadUrl);
                if($picurl[0]!=1){
                    return array('code'=>400,'msg'=>$picurl);die();
                }
                echo json_encode(array('code'=>200,'src'=> $picurl[1]));
            }else{
                die('非法操作!');
            }
        }
    }


    /**
     * 修改会员状态
     * */
    public function editUserStatus(){
        if(!$this->CheckAuth(true,"Admini/UserInfo/editUserStatus")){
            $this->myAjaxReturn(400,"没有使用该功能的权限！");
            die;
        }
        $id = I('post.id','','trim');
        $data['status'] = I('post.status','','trim') == 1 ? 2 : 1;
        $admin = M('member');
        $row = $admin->where("id = {$id}")->save($data);
        $log="{$_SESSION['admin']['account']}修改了会员[$id]的状态为{$data['status']}。";
        $this->writelog("userinfo",$log);
        $data =  $row !==false ? array('msg'=>'修改成功!','code'=>200) : array('msg'=>'修改失败!','code'=>400);
        echo json_encode($data);
    }

    /**
     * 删除会员
     * */
    public function delete(){
        if(!$this->CheckAuth(true,"Admini/UserInfo/delete")){
            $this->myAjaxReturn(400,"没有使用该功能的权限！");
            die;
        }
        $member = M('member');
        $row = $member->where('id = '.I('post.id','','trim'))->delete();
        if($row!==false){
            $log="{$_SESSION['admin']['account']}删除了会员[".I('post.id','','trim')."]";
            $this->writelog("member",$log);
            $this->myAjaxReturn(200,'删除成功!');
        }else{
            $this->myAjaxReturn(400,'删除失败!');
        }
    }

    /**
     * 修改用户信息
     * */
    public function updateUserInfo(){
        if(!$this->CheckAuth(true,"Admini/UserInfo/updateUserInfo")){
            $this->myAjaxReturn(400,"没有使用该功能的权限！");
            die;
        }
        $member = D('member');
        if($_POST['act'] == 'display'){
            $row = $member->where('id = '.I('post.id','','trim'))->find();
            if($row !== false){
                $this->myAjaxReturn(200,'加载成功!',$row);
            }else{
                $this->myAjaxReturn(400,'暂无用户数据!');
            }
        }else{
            $row = $member->updateUserInfo();
            if($row !== false){
                $log="{$_SESSION['admin']['account']}修改了会员[".I('post.id','','trim')."]";
                $this->writelog("member",$log);
                $this->myAjaxReturn(200,'修改成功!');
            }else{
                $this->myAjaxReturn(400,'修改失败!');
            }
        }
    }

    /**
     * 票据列表设置用户信息
     * */
    public function setUser(){
        if(!$this->CheckAuth(true,"Admini/UserInfo/setUser")){
            $this->myAjaxReturn(400,"没有使用该功能的权限！");
            die;
        }

        $member = M('member');
        $row = $member->where('status = 1')->field('id , realname ')->select();
        if ($row!==false){
            $data = [];
            foreach ($row as $k=>$v){
                $data['value'][$k]['id'] = $v['id'];
                $data['value'][$k]['word'] = $v['realname'];
            }
            $data['value'][] = ['id'=>'0','word'=>'担保公司'];
            echo json_encode($data);die();
            $this->myAjaxReturn(200,'',$data);
        }else{
            $this->myAjaxReturn(400,'数据库错误');
        }
    }

    public function ceshi(){
        echo '<pre>';
        var_dump($_POST);die();
    }

    /**
     * 根据省份获取城市
     * */
    public function getCity(){
        if(!$this->CheckAuth(true,"Admini/Index/main")){
            $result['code']=400;
            $result['msg']='没有使用该功能的权限！';
            $this->ajaxReturn($result);
            die;
        }
        $area = M('area');
        $province_id = I("post.provinceid");
        $row = $area->where('status = 1 and level = 2 and parentid ='.$province_id)->order('sort asc')->select();
        if($row!==false){
            $data['code'] = 200;
            $data['row'] = $row;
        }else{
            $data['code'] = 400;
            $data['msg'] = '数据查询错误!';
        }
        echo json_encode($data);
    }

    /**
     * 根据省份获取城市
     * */
    public function getDistrict(){
        if(!$this->CheckAuth(true,"Admini/Index/main")){
            $result['code']=400;
            $result['msg']='没有使用该功能的权限！';
            $this->ajaxReturn($result);
            die;
        }
        $area = M('area');
        $city_id = I("post.cityid");
        $row = $area->where('status = 1 and level = 3 and parentid ='.$city_id)->order('sort asc')->select();
        if($row!==false){
            $data['code'] = 200;
            $data['row'] = $row;
        }else{
            $data['code'] = 400;
            $data['msg'] = '数据查询错误!';
        }
        echo json_encode($data);
    }


}