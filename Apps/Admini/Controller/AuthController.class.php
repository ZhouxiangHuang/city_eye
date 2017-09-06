<?php
/**
 * Created by PhpStorm.
 * User: dyxdw
 * Date: 2016/12/5
 * Time: 16:54
 */

namespace Admini\Controller;


class AuthController extends CommonController
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }
    /**
     * 执行编辑已个管理员
     */
    public function do_editmanager(){
        if(!$this->CheckAuth(true,"Admini/Auth/editmanager")){
            $result["code"]=20001;
            $result["messpuage"]="没有使用该功能的权限！";
            $this->ajaxReturn($result);
            die;
        }
        $id=I("id","0","int");
        $account=I("account","","trim");
        $password=I("password","");
        $nickname=I("nickname","","trim");
        $phone=I("phone","","trim");
        $status=I("status","0","int");
        $group=I("group_id","0","int");
        $result=array();
        if(empty($id)){
            $result["code"]=20001;
            $result["message"]="修改表示错误！";
        }else{
            $data["id"]=$id;
            if(strlen($password)>0){
                $data["password"]=mymd5($password);
            }
            $data["nickname"]=$nickname;
            $data["phone"]=$phone;
            $data["status"]=$status;
            $administrator=D("administrator");
            $administrator->save($data);
            $auth_group_access=M("auth_group_access");
            $auth_group_access->where(array("uid"=>$id))->delete();
            if($group>0){
                $auth_group_access->add(array("uid"=>$id,"group_id"=>$group));
            }
            $log="编辑了管理员[".$account."(".$id.")]。";
            $this->writelog("userinfo",$log);
            $result["code"]=20000;
            $result["message"]="保存成功！";
        }
        $this->ajaxReturn($result);
    }
    /**
     * 获取一条管理员的详细信息
     */
    public function do_getmanager(){
        if(!$this->CheckAuth(true,"Admini/Auth/editmanager")){
            $result["code"]=20001;
            $result["message"]="没有使用该功能的权限！";
            $this->ajaxReturn($result);
            die;
        }
        $id=I("id","0","int");
        $result=array();
        if(empty($id)){
            $result["code"]=20001;
            $result["message"]="编辑标识错误！";
        }else{
            $administrator=D("administrator");
            $data_admins = $administrator->alias("adm")
                ->join(C('DB_PREFIX')."auth_group_access aga on adm.id=aga.uid","LEFT")
                ->field("adm.id,adm.account,adm.nickname,adm.phone,adm.lasttime,adm.lastip,adm.status,ifnull(aga.group_id,0) as group_id")
                ->where(array("adm.id"=>$id))
                ->order("id asc")
                ->find();
            if($data_admins){
                $result["code"]=20000;
                $result["message"]="获取成功！";
                $result["data"]=$data_admins;
            }else{
                $result["code"]=20001;
                $result["message"]="管理员不存在！";
            }
        }
        $this->ajaxReturn($result);
    }
    /**
     * 添加一个管理员
     */
    public function do_addmanager(){
        $result=array();
        if(!$this->CheckAuth(true)){
            $result["code"]=20001;
            $result["message"]="没有使用该功能的权限！";
            $this->ajaxReturn($result);
            die;
        }
        $account=I("account","","trim");
        $password=I("password","");
        $nickname=I("nickname","","trim");
        $phone=I("phone","","trim");
        $group=I("group","0","int");
        $status=I("status","0","int");
        if(strlen($account)<=0){
            $result["code"]=20001;
            $result["message"]="账号不能为空！";
        }elseif(strlen($password)<=0){
            $result["code"]=20001;
            $result["message"]="密码不能为空！";
        }else{
            $administrator=D("Administrator");
            if($administrator->ExistAccount($account)){
                $result["code"]=20001;
                $result["message"]="管理账号已经存在！";
            }else{
                $data["account"]=$account;
                $data["password"]=mymd5($password);
                $data["nickname"]=$nickname;
                $data["phone"]=$phone;
                $data["status"]=$status;
                $r=D("Administrator")->add($data);
                if($r){
                    if(empty($group)){
                        $result["code"]=20000;
                        $result["message"]="添加管理员(无权限)成功！";
                    }else{
                        $r2=M("auth_group_access")->add(array("uid"=>$r,"group_id"=>$group));
                        if($r2){
                            $result["code"]=20000;
                            $result["message"]="添加管理员成功！";
                        }else{
                            $result["code"]=20000;
                            $result["message"]="管理员添加成功，但权限信息写入失败！";
                        }
                    }
                    $log="增加了管理员[".$account."]。";
                    $this->writelog("administrator",$log);
                }else{
                    $result["code"]=20001;
                    $result["message"]="添加管理员失败！";
                }
            }
        }
        $this->ajaxReturn($result);
    }
    /**
     * 删除一个管理员
     */
    public function do_delmanager(){
        $result=array();
        if(!$this->CheckAuth(true)){
            $result["code"]=20001;
            $result["message"]="没有使用该功能的权限！";
            $this->ajaxReturn($result);
            die;
        }
        $aid=I("aid","0","int");
        if(empty($aid)){
            $result["code"]=20001;
            $result["message"]="删除标识不正确！";
        }elseif($aid==1){
            $result["code"]=20001;
            $result["message"]="超级管理员无法删除！";
        }elseif ($aid==$this->uid){
            $result["code"]=20001;
            $result["message"]="不能删除自己！";
        }else{
            $admini=D("Administrator");
            $data_admin=$admini->where(array("id"=>$aid))->find();
            if($data_admin){
                $log="删除了管理员[".$data_admin["account"]."]。";
            }else{
                $log="删除了未知的管理员，删除标识为：".$aid;
            }
            $admini->deladmin($aid);
            $this->writelog("administrator",$log);
            $result["code"]=20000;
            $result["message"]="删除成功！";
        }
        $this->ajaxReturn($result);
    }
    /**
     *  管理员列表
     */
    public function manager(){
        $this->CheckAuth();
        $where=array();
        $administrator=D("administrator");
        $pages=$administrator->alias("adm")->where($where)->count();
        $data_admins = $administrator->alias("adm")
            ->join(C('DB_PREFIX')."auth_group_access aga on adm.id=aga.uid","LEFT")
            ->limit($pages[0]->firstRow.",".$pages[0]->listRows)
            ->where($where)
            ->order("id asc")
            ->select();
        if($data_admins){
            $data_groups=D("AuthGroup")->getlist();
            foreach ($data_admins as $key=>$value){
                $value["group"]=$data_groups[$value["group_id"]];
                $data_admins[$key]=$value;
            }
        }
        //权限列表
        $data_groups=D("AuthGroup")->getlist(1,true);
        unset($data_groups[1]);
        $this->assign("groups",$data_groups);
        $this->assign("list",$data_admins);
        $this->assign("page",$pages[1]);
        $this->display();
    }
    /**
     * 执行编辑角色
     */
    public function do_editrole(){
        $result=array();
        if(!$this->CheckAuth(true,"Admini/Auth/editrole")){
            $result["code"]=20001;
            $result["message"]="没有使用该功能的权限！";
            $this->ajaxReturn($result);
            die;
        }
        $id=I("id","0","int");
        $title=I("title","","trim");
        $status=I("status","0","int");
        $desc=I("desc");
        $radmin=I("radmin");
        $rule="";
        if(is_array($radmin)){
            $rule=join(",",$radmin);
        }
        if(empty($id)){
            $result["code"]=20001;
            $result["message"]="修改标识错误！";
        }elseif (strlen($title)<=0){
            $result["code"]=20001;
            $result["message"]="角色名不能为空！";
        }else{
            $data["id"]=$id;
            $data["title"]=$title;
            $data["status"]=$status;
            $data["rules"]=$rule;
            $data["description"]=$desc;
            $AuthGroup=D("AuthGroup");
            $r=$AuthGroup->save($data);
            if($r){
                $log="更新了角色[".$title."]。";
                $this->writelog("auth_group",$log);
                $result["code"]=20000;
                $result["message"]="修改成功！";
                $result["todo"]=U("Auth/role");
            }else{
                $result["code"]=20001;
                $result["message"]="修改失败！";
            }
        }
        $this->ajaxReturn($result);
    }
    /**
     * 编辑角色页面
     */
    public function editrole(){
        $this->CheckAuth();
        $rid=I("id","0","int");
        if(empty($rid)){
            $this->redirect("Auth/role");
        }else{
            $authrule=D("AuthRule");
            $data_rule=$authrule->GetRuleList();
            $data_rule=list_to_tree($data_rule);
            $authgroup=D("AuthGroup");
            $data_group=$authgroup->getGroupinfo($rid);
            $this->assign("role",$data_group);
            $this->assign("rulelist",$data_rule);
            $this->display();
        }
    }
    /**
     * 执行增加角色
     */
    public function do_addrole(){
        $result=array();
        if(!$this->CheckAuth(true,"Admini/Auth/addrole")){
            $result["code"]=20001;
            $result["message"]="没有使用该功能的权限！";
            $this->ajaxReturn($result);
            die;
        }
        $title=I("title","","trim");
        $status=I("status","0","int");
        $desc=I("desc");
        $radmin=I("radmin");
        $rule="";
        if(is_array($radmin)){
            $rule=join(",",$radmin);
        }
        if(empty($title)){
            $result["code"]=20001;
            $result["message"]="角色名不能为空！";
        }else{
            $data["title"]=$title;
            $data["status"]=$status;
            $data["rules"]=$rule;
            $data["description"]=$desc;
            $AuthGroup=D("AuthGroup");
            $r=$AuthGroup->add($data);
            if($r){
                $log="添加了角色[".$title."]";
                $this->writelog("auth_group",$log);
                $result["code"]=20000;
                $result["message"]="添加成功！";
            }else{
                $result["code"]=20001;
                $result["message"]="添加失败，请稍后再试！";
            }
        }
        $this->ajaxReturn($result);
    }
    /**
     * 增加角色页面
     */
    public function addrole(){
        $this->CheckAuth();
        $authrule=D("AuthRule");
        $data_rule=$authrule->GetRuleList();
        $data_rule=list_to_tree($data_rule);
        $this->assign("rulelist",$data_rule);
        $this->display();
    }
    /**
     * 删除角色
     */
    public function do_delrole(){
        $result=array();
        if(!$this->CheckAuth(true)){
            $result["code"]=20001;
            $result["message"]="没有使用该功能的权限！";
            $this->ajaxReturn($result);
            die;
        }
        $rid=I("rid","0","int");
        if(empty($rid)){
            $result["code"]=20001;
            $result["message"]="删除标识错误！";
        }elseif ($rid==1){
            $result["code"]=20001;
            $result["message"]="此角色权限不能删除！";
        }else{
            $auth_group=D("auth_group");
            $data_group=$auth_group->getGroupinfo($rid);
            if($data_group){
                $log="删除角色[".$data_group["title"]."]";
            }else{
                $log="删除了未知角色,标识ID为：".$rid;
            }
            $this->writelog("auth_group",$log);
            $auth_group->delRole($rid);
            $result["code"]=20000;
            $result["message"]="删除角色成功！";
        }
        $this->ajaxReturn($result);
    }
    /**
     * 角色列表
     */
    public function role(){
        $this->CheckAuth();
        $auth_group=D("auth_group");
        $where=array();
        $data_group = $auth_group->where($where)->select();
        $this->assign("authgroups",$data_group);
        $this->display();
    }
    /**
     * 规则列表
     */
    public function index(){
        $this->CheckAuth();
        $auth=D("auth_rule");
        $data=$auth->GetRuleList();
        $data=list_to_tree($data);
        $this->assign("authlist",$data);
        $this->display();
    }

    /**
     * 修改规则状态
     */
    public function do_rulestatus(){
        $result=array();
        if(!$this->CheckAuth(true)){
            $result["code"]=20001;
            $result["message"]="没有使用该功能的权限！";
            $this->ajaxReturn($result);
            die;
        }
        $id=I("aid","0","int");
        $status=I("status","n");
        if(empty($id)){
            $result["code"]=20001;
            $result["message"]="修改标识错误！";
        }else{
            $int_status=$status=="y"?1:0;
            $auth=D("auth_rule");
            $r=$auth->amendstatus($id,$int_status);
            if($r){
                if($int_status){
                    $log="启用了标识ID为：".$id."的规则。";
                }else{
                    $log="禁用了标识ID为：".$id."的规则。";
                }
                $this->writelog("auth_rule",$log);
                $result["code"]=20000;
                $result["message"]="修改成功！";
            }else{
                $result["code"]=20001;
                $result["message"]="修改失败！";
            }
        }
        $this->ajaxReturn($result);
    }

    /**
     *   角色列表
     */
    public function getGroups(){
        $authGroup  =  D('AuthGroup');
        $this->authgroups  =  $authGroup->getGroups();
        $this->display();
    }
    /**
     *   添加组级别
     */
    public function selGroup(){
        $authGroup  =  D('AuthGroup');
        $auth = M("auth_group");
        $auth_access = M("auth_group_access");
        if(I("action")=="display"){
            if(I('get.act')=="edit"){
                $id = I("get.id");
                $info = $auth->where("id = {$id}")->find();
                $info["rules"] = explode(",",$info["rules"]);
                $this->assign("auth_info",$info);
            }
            $this->grouplist   =  $authGroup->selGroup();
//            echo "<pre>";
//            var_dump(list_to_tree($authGroup->getRule()));die();
//            $this->rulelist  =   ;
            $this->assign("rulelist",list_to_tree($authGroup->getRule()));
            $this->display();die();
        }
        if(I("get.act")=="add"){
            $data["title"]  = I("post.title");
            $data["status"] = I("post.status");
            $data["desc"]   = I("post.desc");
            $data["rules"]  = implode(",",I("post.radmin")).",2";
            $data['times']  = time();
            $row = $auth->data($data)->add();
            $data_access['uid'] = $auth->getLastInsID();
            $data_access['group_id'] = $auth->getLastInsID();
            $auth_access->data($data_access)->add();
            $row!==false ? $this->success('添加成功!'): $this->error('添加失败!');
        }
        else if(I("get.act")=="edit"){
            $id = I("post.id");
            $data["title"]  = I("post.title");
            $data["status"] = I("post.status");
            $data["desc"]   = I("post.desc");
            $data["rules"]  = implode(",",I("post.radmin")).",2";
            $data['times']  = time();
            $row = $auth->where("id = {$id}")->save($data);
            $row!==false ? $this->success('修改成功!'): $this->error('修改失败!');
        }else{
            $id = I("get.id");
            $row = $auth->where("id = {$id}")->delete();
            $row!==false ? $this->success('删除成功!'): $this->error('删除失败!');
        }
    }

}