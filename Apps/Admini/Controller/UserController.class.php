<?php
/**
 * Created by PhpStorm.
 * User: yara
 * Date: 2017/5/14
 * Time: 13:39
 */
namespace Admini\Controller;


use Think\Model;

class UserController extends CommonController
{

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    public function userList(){
        $this->CheckAuth();
        $auth_group = M('auth_group');
//        var_dump($auth_group->where('status = 1')->select());
//        die();
        $auth = $auth_group->where('status = 1')->select();
        $this->assign('auth_all',$auth);
        $this->display();
    }
    public function userListAjax(){
        if(!$this->CheckAuth(true,"Admini/User/userList")){
            $result['code']=400;
            $result['msg']='没有使用该功能的权限！';
            $this->ajaxReturn($result);
            die;
        }
        $mysql = new \Think\Model();
        $where = "";
        $page = I('get.pageNumber','','trim');
        $limit = I('get.pageSize','','trim');
        $sort = I('get.sortName','','trim');
        $sort_by = I('get.sortOrder','','trim');
        if(I('get.account')!="") $where.=" and t.account like '%".I('get.account','','trim')."%'";
        if(I('get.nickname')!="") $where.=" and t.nickname like '%".I('get.nickname','','trim')."%'";
        if(I('get.phone')!="") $where.=" and t.phone like '%".I('get.phone','','trim')."%'";
        $user_count = "select COUNT(1)  AS `numrows`
                     from {$this->table}administrator t
                     LEFT JOIN {$this->table}auth_group_access t1
                     ON t.id = t1.uid
                     LEFT JOIN {$this->table}auth_group t2
                     ON t1.group_id = t2.id
                     WHERE 1=1 {$where}";
        $total_arr =  $mysql->query($user_count);
        $total = $total_arr[0]['numrows'];
        $total_page = ceil($total / $limit);//总页数
        if($page <= 1){
            $page = 1;
        }elseif($page >= $total_page){
            $page = $total_page;
        }
        $offset = ($page - 1 ) * $limit;
        if (!empty($sort)) $where .= " order by {$sort} {$sort_by}";
        if (!empty($page)) $where .= " LIMIT  {$offset},{$limit} ";
        $sql_user = "select t.*,t2.title
                     from {$this->table}administrator t
                     LEFT JOIN {$this->table}auth_group_access t1
                     ON t.id = t1.uid
                     LEFT JOIN {$this->table}auth_group t2
                     ON t1.group_id = t2.id
                     WHERE 1=1 {$where}";
        $row_user = $mysql->query($sql_user);

        if($row_user!==false){
            $data['data']['total']=$total;
            $data['data']['rows']=$row_user;
            $data['success']=200;
            $data['message']=null;
        }else{
            $data['success']=400;
            $data['message']="暂无数据!";
        }
//        $row_user = $this->getList("administrator",$page,$limit,"",$sort,$sort_by);
//        $data['data'] = $row_user;
//        $data['success']=200;
//        $data['message']=null;
        echo json_encode($data);die();
    }

    /**
     * 修改管理员状态
     * */
    public function editAdminiStatus(){
        if(!$this->CheckAuth(true,"Admini/User/editAdminiStatus")){
            $result['code']=400;
            $result['msg']='没有使用该功能的权限！';
            $this->ajaxReturn($result);
            die;
        }
        $id = I('post.id','','trim');
        $data['status'] = I('post.status','','trim') == 1 ? 2 : 1;
        $admin = M('administrator');
        $row = $admin->where("id = {$id}")->save($data);
        $log="{$_SESSION['admin']['account']}修改了管理员[$id]的状态为{$data['status']}。";
        $this->writelog("administrator",$log);
        $data =  $row !==false ? array('msg'=>'修改成功!','code'=>200) : array('msg'=>'修改失败!','code'=>400);
        echo json_encode($data);
    }


    /**
     * 编辑管理员
     * */
    public function editUser(){
        if(!$this->CheckAuth(true,"Admini/User/editUser")){
            $result['code']=400;
            $result['msg']='没有使用该功能的权限！';
            $this->ajaxReturn($result);
            die;
        }
        if(I('get.act')=='display'){
            $mysql = new \Think\Model();
            $id = I('post.id','','trim');
            $sql = "select t.*,t2.title,t2.id as role_id
                     from {$this->table}administrator t
                     LEFT JOIN {$this->table}auth_group_access t1
                     ON t.id = t1.uid
                     LEFT JOIN {$this->table}auth_group t2
                     ON t1.group_id = t2.id
                     WHERE 1=1 and  t.id={$id}";
            $row = $mysql->query($sql);
            if($row!==false){
                $data['row'] = $row[0];
                $data['code'] = 200;
            }else{
                $data['msg'] = "暂无数据！";
                $data['code'] = 400;
            }
            echo json_encode($data);
            die();
        }else{
            $admin = D('Administrator');
            if(I('get.action')=='add'){
                $data['account'] = trim($_POST['from']['edit_account']);
                $is_one = $admin->where("account = '{$data['account']}'")->find();
                if($is_one !=false) {echo json_encode(array('code'=>400,'msg'=>'账户名已存在！'));die();}
            }
            $row = $admin->editUser();
            $row['msg'] = I('get.action') == 'add' ? $row['code'] == 200 ? '添加成功!' : '添加失败!' : $row['code'] == 200 ? '修改成功!' : '修改失败!';
            if($row['code']==200){
                if(I('get.action')=='add'){
                    $log="{$_SESSION['admin']['account']}添加了管理员,账户名为".trim($_POST['from']['edit_account']);
                    $this->writelog("administrator",$log);
                }else if(I('get.action')=='edit'){
                    $log="{$_SESSION['admin']['account']}修改了ID为".I('post.id','','trim')."的管理员";
                    $this->writelog("administrator",$log);
                }else if(I('get.action')=='del'){
                    $log="{$_SESSION['admin']['account']}删除了ID为".I('post.id','','trim')."的管理员";
                    $this->writelog("administrator",$log);
                }
            }
            echo json_encode($row);die();
        }
    }

    /**
     * 修改密码
     * */
    public function editPassword(){
        if(!$this->CheckAuth(true,"Admini/User/editPassword")){
            $result['code']=400;
            $result['msg']='没有使用该功能的权限！';
            $this->ajaxReturn($result);
            die;
        }
        $admin = M('administrator');
        $data['password'] = mymd5(I('post.password','','trim'));
        $row = $admin->where('id = '.I('post.user_id','','trim'))->save($data);
        if($row!==false){
            $data = array('code'=>200,'msg'=>'修改成功!');
            $log="{$_SESSION['admin']['account']}修改了ID为".I('post.user_id','','trim')."的管理员的密码";
            $this->writelog("administrator",$log);
        }else{
            $data = array('code'=>400,'msg'=>'修改失败!');
        }
        echo json_encode($data);die();
    }


}