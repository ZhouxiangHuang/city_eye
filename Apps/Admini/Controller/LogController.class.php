<?php
/**
 * Created by PhpStorm.
 * User: yara
 * Date: 2017/5/24
 * Time: 9:19
 */
namespace Admini\Controller;

use Think\Model;

class LogController extends CommonController
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    /**
     * 日志列表
     * */
    public function logList(){
        if(I('act')!='ajax'){
            $this->CheckAuth();
            $this->display();
        }else{
            $this->logListAjax();
        }
    }
    /**
     * 日志列表AJAX
     * */
    public function logListAjax(){
        if(!$this->CheckAuth(true,"Admini/Log/logList")){
            $result['code']=400;
            $result['msg']='没有使用该功能的权限！';
            $this->ajaxReturn($result);
            die;
        }
        $logList = D('operationlog');
        $row = $logList->getLogListAjax();
        echo json_encode($row);
        die();
    }

    /**
     * 删除日志
     * */
    public function delLog(){
        if(!$this->CheckAuth(true,"Admini/Log/delLog")){
            $result['code']=400;
            $result['msg']='没有使用该功能的权限！';
            $this->ajaxReturn($result);
            die;
        }
        $id = I('post.id','','trim');
        $logList = M('operationlog');
        $row = $logList->where('id = '.$id)->delete();
        if($row!==false){
            $data['code'] = 200;
            $data['msg'] = '删除成功!';
//            $log="{$_SESSION['admin']['account']}删除了日志,ID为[$id]";
//            $this->writelog("operationlog",$log);
        }else{
            $data['code'] = 400;
            $data['msg'] = '删除失败!';
        }
        echo json_encode($data);
        die();
    }


}