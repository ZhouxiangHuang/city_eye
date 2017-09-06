<?php
/**
 * Created by PhpStorm.
 * User: yara
 * Date: 2017/7/10
 * Time: 09:20
 */
namespace Admini\Model;

use Think\Model;

class MemberModel extends Model
{
    private $table = '';
    public function __construct()
    {
        parent::__construct();
        $this->table = C("DB_PREFIX");
    }

    /**
     * 列表数据
     * */
    public function memberListAjax(){
//        echo '<pre>';
//        var_dump($_GET);die();
        $where = '';
        $page = I('get.pageNumber','','trim');
        $limit = I('get.pageSize','','trim');
        $sort = I('get.sortName','','trim');
        $sort_by = I('get.sortOrder','','trim');
        if(!empty($_GET['find_phone'])){
            $where .= " and t.phone like '%".I('get.find_phone','','trim')."%'";
        }
        if(!empty($_GET['find_nickname'])){
            $where .= " and t.nickname like '%".I('get.find_nickname','','trim')."%'";
        }
        if(!empty($_GET['find_gender'])){
            $where .= " and t.gender = ".I('get.find_gender',1,'trim');
        }
        if(!empty($_GET['find_status'])){
            $where .= " and t.status = ".I('get.find_status',1,'trim');
        }
        $member_count = "select COUNT(1)  AS `numrows`
                     from {$this->table}member t
                     WHERE 1=1 {$where}";
        $total_arr =  $this->query($member_count);
        $total = $total_arr[0]['numrows'];
        $total_page = ceil($total / $limit);//总页数
        if($page <= 1){
            $page = 1;
        }elseif($page >= $total_page){
            $page = $total_page;
        }
        $offset = ($page - 1 ) * $limit;
        if (!empty($sort)) $where .= " order by t.{$sort} {$sort_by}";
        if (!empty($page)) $where .= " LIMIT  {$offset},{$limit} ";
        $member_sql = "
            select t.*
            from {$this->table}member t
            WHERE 1=1 {$where}
        ";
        $row = $this->query($member_sql);
        return array('row'=>$row,'total'=>$total);
    }

    /**
     * 添加新用户
     * */
    public function addUserAjax(){
        $data = $this->getParameter();
//        echo '<pre>';
//        var_dump($data);die();
        $this->data($data)->add();
        $row = $this->getLastInsID();
        return $row;
    }

    /**
     * 修改用户信息
     * */
    public function updateUserInfo(){
        $id = I('post.id','','trim');
        $data = $this->getParameter();
        $row = $this->where('id = '.$id)->save($data);
        return $row;
    }

    /**
     * 添加修改接收相同的参数处理
     * */
    private function getParameter(){
        $from = $_POST['from'];
//        echo '<pre>';
//        var_dump($from);die();
        if(!empty($_POST['hidden_phone'])){
            if($from['member_phone'] != $_POST['hidden_phone']){
                $is_phone = $this->where('phone = '.trim($from['member_phone']))->find();
                if($is_phone != false){
                    echo json_encode(array('code'=>400,'msg'=>'手机号已存在！'));die();
                }
                $data['phone'] = trim($from['member_phone']);
            }
        }else{
            $is_phone = $this->where('phone = '.trim($from['member_phone']))->find();
            if($is_phone != false){
                echo json_encode(array('code'=>400,'msg'=>'手机号已存在！'));die();
            }
            $data['phone'] = trim($from['member_phone']);
        }
        if(!empty($from['member_cardnumber'])){
//            var_dump($_POST['member_cardnumber']);
//            var_dump();
//            die();
            if(!empty($_POST['hidden_cardnumber'])){
                if($from['member_cardnumber'] != $from['hidden_cardnumber']){
                    $is_card = $this->where('cardnumber = '.trim($from['member_cardnumber']))->find();
                    if($is_card != false){
                        echo json_encode(array('code'=>400,'msg'=>'身份证号已存在!'));die();
                    }
                    $data['cardnumber'] = trim($from['member_cardnumber']);
                }
            }else{
                $is_card = $this->where('cardnumber = "'.trim($from['member_cardnumber']).'"')->find();
//            var_dump($this->_sql());die();
                if($is_card != false){
                    echo json_encode(array('code'=>400,'msg'=>'身份证号已存在!'));die();
                }
                $data['cardnumber'] = trim($from['member_cardnumber']);
            }
        }
        if(!empty($from['member_password'])){
            $data['password'] = mymd5(trim($from['member_password']));
        }
        if(isset($from['member_drafttype'])){
            $data['drfttype'] = trim($from['member_drfttype']);
        }
        if(!empty($from['member_nickname'])){
            $data['nickname'] = trim($from['member_nickname']);
        }
        if(!empty($from['member_realname'])){
            $data['realname'] = trim($from['member_realname']);
        }
        if(isset($from['member_isrealnameauth'])){
            $data['isrealnameauth'] = trim($from['member_isrealnameauth']);
        }
        if(!empty($from['member_deposit'])){
            $data['deposit'] = trim($from['member_deposit']);
        }
        if(!empty($from['member_loanlimit'])){
            $data['loanlimit'] = trim($from['member_loanlimit']);
        }
        if(isset($from['member_gender'])){
            $data['gender'] = trim($from['member_gender']);
        }
        if(isset($from['member_status'])){
            $data['status'] = trim($from['member_status']);
        }
        if(isset($from['member_isbid'])){
            $data['isbid'] = trim($from['member_isbid']);
        }
        if(!empty($from['hidden_heaimg'])){
            $data['heaimg'] = trim($from['hidden_heaimg']);
        }
        if(!empty($from['hidden_cardfilepathn'])){
            $data['cardfilepathn'] = trim($from['hidden_cardfilepathn']);
        }
        if(!empty($from['hidden_cardfilepathf'])){
            $data['cardfilepathf'] = trim($from['hidden_cardfilepathf']);
        }
        if(!empty($from['hidden_cardfilepathhand'])){
            $data['handheldidentcard'] = trim($from['hidden_cardfilepathhand']);
        }
//        echo '<pre>';
//        var_dump($data);die();
        return $data;
    }



}