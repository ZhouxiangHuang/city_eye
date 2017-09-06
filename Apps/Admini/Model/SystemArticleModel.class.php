<?php
/**
 * Created by PhpStorm.
 * User: yara
 * Date: 2017/7/25
 * Time: 10:32
 */
namespace Admini\Model;

use Think\Model;

class SystemArticleModel extends Model
{
    private $table = '';
    public function __construct()
    {
        parent::__construct();
        $this->table = C("DB_PREFIX");
    }

    public function getListAjax(){
        $where = '';
        $page = I('get.pageNumber','','trim');
        $limit = I('get.pageSize','','trim');
        $sort = I('get.sortName','','trim');
        $sort_by = I('get.sortOrder','','trim');
        if(!empty($_GET['find_title']))
            $where .= " and t.title like '%".I('get.find_title','','trim')."%'";
        $draft_count = "select COUNT(1)  AS `numrows`
                     from {$this->table}system_article t
                     WHERE 1=1 {$where}";
        $total_arr =  $this->query($draft_count);
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
        $draft_sql = "
            select t.*
            from {$this->table}system_article t
            WHERE 1=1 {$where}
        ";
//        var_dump($draft_sql);die();
        $row = $this->query($draft_sql);
        return array('row'=>$row,'total'=>$total);
    }

    /**
     * 添加系统新闻
     * */
    public function addSystemArticle(){
        $data = $this->setPost();
//        echo '<pre>';
//        var_dump($_POST);die();
        $data['addtime'] = time();
        $row = $this->data($data)->add();
        if($row !== false){
            $return = $row;
        }else{
            $return = 400;
        }
        return $return;
    }

    /**
     * 处理post参数
     * */
    private function setPost(){
        if(!empty($_POST['title'])){
            $data['title'] = I('post.title','','trim');
        }else{
            die('非法操作!');
        }
        if(!empty($_POST['summary'])){
            $data['summary'] = I('post.summary','','trim');
        }else{
            die('非法操作!');
        }
        if(!empty($_POST['detail'])){
            $data['detail'] = I('post.detail','','trim');
        }
        if(!empty($_POST['listorder'])){
            $data['listorder'] = I('post.listorder','','trim');
        }
        if(!empty($_POST['status'])){
            $data['status'] = I('post.status','','trim');
        }
        if(!empty($_POST['stype'])){
            $data['stype'] = I('post.stype','','trim');
        }
        return $data;
    }

    /**
     * 修改系统新闻
     * */
    public function updateSystem(){
        if(empty($_POST['hidden_id'])){
            die('非法操作!');
        }
        $id = I('post.hidden_id','','trim');
        $data = $this->setPost();
        $row = $this->where('id = '.$id)->save($data);
//        var_dump($this->_sql());die();
        if($row!==false){
            return array('code'=>200,'id'=>$id);
        }else{
            return array('code'=>500);
        }
    }

}