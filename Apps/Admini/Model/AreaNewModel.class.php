<?php
/**
 * Created by PhpStorm.
 * User: yara
 * Date: 2017/7/28
 * Time: 15:17
 */
namespace Admini\Model;

use Think\Model;

class AreaNewModel extends Model
{
    private $table = '';
    public function __construct()
    {
        parent::__construct();
        $this->table = C("DB_PREFIX");
    }

    /**
     * 添加新闻类型
     * */
    public function addArticleCate(){
        $data = $this->setPost();
        $row = $this->data($data)->add();
        if($row!==false){
            $id = $this->getLastInsID();
            return array('code'=>200,'id'=>$id);
        }else{
            return array('code'=>500);
        }

    }

    /**
     * 处理参数
     * */
    private function setPost(){
        if(!empty($_POST['city_name'])){
            $data['city_name'] = strval(trim($_POST['city_name']));
        }else{
            $data['city_name'] = '';
        }
        if(!empty($_POST['city_name_hun'])){
            $data['city_name_hun'] = trim($_POST['city_name_hun']);
        }else{
            $data['city_name_hun'] = '';
        }

        if(!empty($_POST['sort'])){
            $data['sort'] = trim($_POST['sort']);
        }
        if(!empty($_POST['status'])){
            $data['status'] = trim($_POST['status']);
        }else{
            $data['status'] = 1;
        }
        return $data;
    }

    /**
     * 编辑
     * */
    public function updateArticleCate(){
        $data = $this->setPost();
        $id = I('post.id','','trim');
        $row = $this->where('id = '.$id)->save($data);
        if($row!==false){
            return array('code'=>200,'id'=>$id);
        }else{
            return array('code'=>500);
        }
    }

    /**
     * 获取所有地区
     * @return \Model|Model
     */
    public static function getArea() {
        $areaNewModel = M('area_new');
        $condition['status'] = 1;
        $data = $areaNewModel->where($condition)->select();
        return $data;
    }

}