<?php
namespace Admini\Controller;

use Merchant\Model\ServchildorderModel;
use Merchant\Model\MemberModel;
use Admini\Model\PromainorderModel;
use Admini\Model\ProcommentModel;
use Admini\Model\ProductsModel;
use Admini\Model\ServmainorderModel;
use Org\Util\String;

class IndexController extends CommonController {



    /**
     * 加载框架
     */
    public function index(){
        $this->CheckAuth();
        $admin=session("admin");
        $data_groups=$this->auth->getGroups($this->uid);
        $ids = array();//保存用户所属用户组设置的所有权限规则id
        foreach ($data_groups as $g) {
            $ids = array_merge($ids, explode(',', trim($g['rules'], ',')));
        }
        $ids = array_unique($ids);
        $auth_rule=M("auth_rule");
        $where["type"]=1;
        $where["navtype"]=array("in","0,2");
        if($admin['id']!=1)
        $where["id"]=array("in",$ids);
        $where["status"]=1;
        $data_auth_rule=$auth_rule->where($where)->order("sort asc")->select();
//        echo "<pre>";
//        var_dump($auth_rule->_sql());
//        die();
        $data_auth_rule=list_to_tree($data_auth_rule);
        $this->assign('auth_rule',$data_auth_rule);
        $this->assign("groupname",$data_groups[0]["title"]);
        $this->assign("admin",$admin);
        $this->display();
    }
    /**
     * 首页
     */
    public function main(){
        $this->CheckAuth();
        $this->display();
    }
    
    /* 背景色值 */
    public function myfunction($membertype){
    	$bc=['#1ab394','#FFA500','#ed5565','#79d2c0','#b73636','#3863a3',];
    	foreach($membertype as $key=>$val){
    		$type[$val]=$bc[$key];
    	}
    	return $type;
    }


    /**
     * 修改个人信息
     * */
    public function updatePersonalInfo(){
        $user = M("administrator");
        if(I('get.act')=="display"){
            $this->CheckAuth();
            $id = $_SESSION['admin']['id'];
            $row = $user->where("id = {$id}")->find();
            $this->assign("info",$row);
            $this->display();
        }else{
            if(!$this->CheckAuth(true,"Admini/Index/updatePersonalInfo")){
                $result['code']=400;
                $result['msg']='没有使用该功能的权限！';
                $this->ajaxReturn($result);
                die;
            }
            $id = I("post.id");
            if(!empty($_POST['nickname']))$data['nickname'] = I("post.nickname");
            if(!empty($_POST['password']))$data['password'] = mymd5(I("post.password"));
            if(!empty($_POST['mobile']))$data["phone"] = I("post.mobile");
            if(!empty($_POST['realname']))$data["realname"] = I("post.realname");
            $row = $user->where("id = {$id}")->save($data);
            $row!==false ? $this->success('修改成功!'): $this->error('修改失败!');
        }
    }



}