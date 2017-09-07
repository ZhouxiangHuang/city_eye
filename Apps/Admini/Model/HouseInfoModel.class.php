<?php
/**
 * Created by PhpStorm.
 * User: yara
 * Date: 2017/7/11
 * Time: 09:30
 */
namespace Admini\Model;

use Think\Model;

class HouseInfoModel extends Model
{
    private $table = '';
    public function __construct()
    {
        parent::__construct();
        $this->table = C("DB_PREFIX");
    }

    /**
     * 房屋列表ajax
     * */
    public function houseInfoListAjax(){
        $where = '';
        $page = I('get.pageNumber','','trim');
        $limit = I('get.pageSize','','trim');
        $sort = I('get.sortName','','trim');
        $sort_by = I('get.sortOrder','','trim');
        if(!empty($_GET['find_title'])){
            $where .= " and t.title like '%".I('get.find_title','','trim')."%'";
        }
        if(!empty($_GET['find_title_hun'])){
            $where .= " and t.title_hun like '%".I('get.find_title_hun','','trim')."%'";
        }
        if(!empty($_GET['find_status'])){
            $where .= " and t.status = ".I('get.find_status',1,'trim');
        }
        if(!empty($_GET['find_is_sale'])){
            $where .= " and t.is_sale = ".I('get.find_is_sale',1,'trim');
        }
        $article_count = "
            select COUNT(1)  AS `numrows` 
            from {$this->table}house_info t 
            WHERE 1=1 {$where}
        ";
        $total_arr =  $this->query($article_count);
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

        $article_sql = "
            select t.*,t1.city_name,t1.city_name_hun
            from {$this->table}house_info t 
            LEFT JOIN {$this->table}area_new t1 
            ON t.area_id = t1.id
            WHERE 1=1 {$where}
        ";
        $row = $this->query($article_sql);
        return array('row'=>$row,'total'=>$total);


    }

    /**
     * 房屋类型
     * */
    public function getArticleCate(){
        $articleCate = M('article_cate');
        return $articleCate->where('status = 1')->order(' orderby desc')->select();
    }

    /**
     * 添加房屋
     * */
    public function addHouseInfo($url){
        $data = $this->setPost();
        $data['addtime'] = time();
        $data['coder'] = CreateIdentifyNum();
        $row = $this->data($data)->add();
        if($row!==false){
            $id = $this->getLastInsID();
            if($_POST['from']['img[']!==''){
                $row = $this->uploadImg($_POST['from']['img['],$id);
                if($row==false){
                    return array('code'=>600,'图片上传失败!');
                }
            }
            return array('code'=>200,'id'=>$id);
        }else{
            return array('code'=>500);
        }
    }

    /**
     * 修改房屋
     * */
    public  function updateHouseInfo($url,$id){
        $data = $this->setPost();
        $row = $this->where('id = '.$id)->save($data);
        if($row!==false){
            if($_POST['from']['img[']!==''){
                $row = $this->uploadImg($_POST['from']['img['],$id);
                if($row==false){
                    return array('code'=>600,'图片上传失败!');
                }
            }
            return array('code'=>200);
        }else{
            return array('code'=>500);
        }
    }

    /**
     * 处理post参数
     * */
    private function setPost(){
        $from = $_POST['from'];
        if(isset($from['edit_area_new'])){
            $data['area_id'] = trim($from['edit_area_new']);
        }else{
            $data['area_id'] = 0;
        }
        $data['title'] = !empty($from['edit_title']) ? strval(trim($from['edit_title'])) : '';
        $data['title_hun'] = !empty($from['edit_title_hun']) ? strval(trim($from['edit_title_hun'])) : '';
        $data['price'] = !empty($from['edit_price']) ? trim($from['edit_price']) : 0;
        $data['address'] = !empty($from['edit_address']) ? strval(trim($from['edit_address'])) : '';
        $data['address_hun'] = !empty($from['edit_address_hun']) ? strval(trim($from['edit_address_hun'])) : '';
        $data['is_lift'] = !empty($from['edit_is_lift']) ? trim($from['edit_is_lift']) : '';
        $data['is_sale'] = !empty($from['edit_is_sale']) ? trim($from['edit_is_sale']) : '';
        $data['proportion'] = !empty($from['edit_proportion']) ? trim($from['edit_proportion']) : '';
        $data['floor_num'] = !empty($from['edit_floor_num']) ? trim($from['edit_floor_num']) : '';
        $data['build_type'] = !empty($from['edit_build_type']) ? trim($from['edit_build_type']) : '';
        $data['build_type_hun'] = !empty($from['edit_build_type_hun']) ? trim($from['edit_build_type_hun']) : '';
        $data['creat_house_time'] = !empty($from['edit_creat_house_time']) ? trim(strtotime($from['edit_creat_house_time'])) : '';
        $data['garden_area'] = !empty($from['edit_garden_area']) ? trim($from['edit_garden_area']) : '';
        $data['garage_area'] = !empty($from['edit_garage_area']) ? trim($from['edit_garage_area']) : '';
        $data['num'] = !empty($from['edit_num']) ? trim($from['edit_num']) : '';
        $data['wc_num'] = !empty($from['edit_wc_num']) ? trim($from['edit_wc_num']) : '';
        $data['status'] = !empty($from['edit_status']) ? trim($from['edit_status']) : '';
        $data['is_dulilinyu'] = !empty($from['edit_is_dulilinyu']) ? trim($from['edit_is_dulilinyu']) : '';
        $data['is_floor_heat'] = !empty($from['edit_is_floor_heat']) ? trim($from['edit_is_floor_heat']) : '';
        $data['memo'] = !empty($from['edit_memo']) ? trim($from['edit_memo']) : '';
        $data['memo_hun'] = !empty($from['edit_memo_hun']) ? trim($from['edit_memo_hun']) : '';

        return $data;
    }

    /**
     * 添加房屋图册
     * */
    protected function uploadImg($url,$id){
        $url_arr = explode(',',$url);
        foreach($url_arr as $k => $v){
            $data[] = array(
                'house_id' => $id,
                'filepath' => $v,
                'status' => 1,
                'sort' => 0
            );
        }
        $house_photo = M('house_photo');
        $row = $house_photo->addAll($data);
        return $row;
    }

    /**
     * 通过info id 获取信息
     * @param $id
     * @return mixed
     */
    public static function getPhotoAndModelById($id) {
        /** @var HouseInfoModel $houseInfoModel */
        $houseInfoModel = M('house_info');
        $where['id'] = $id;
        $where['status'] = 1;
        $data = $houseInfoModel->where($where)->find();
        if ($data) {
            $condition['id'] = $data['area_id'];
            $condition['status'] = 1;
            $areaNewModel = M('area_new');
            $areaNewModel = $areaNewModel->where($condition)->find();
            $data['city_name'] = $areaNewModel['city_name'];
            $data['city_name_hun'] = $areaNewModel['city_name_hun'];
            $housePhotoModel = M('house_photo');
            $conditions['house_id'] = $data['id'];
            $conditions['status'] = 1;
            $photoModel = $housePhotoModel->where($conditions)->select();
            if ($photoModel) {
                foreach ($photoModel as $v) {
                    $data['file_path'][] = $v['filepath'];
                }
            }
        }
        return $data;
    }

    /**
     * 获取最新添加的6条记录
     * @param int $limit
     * @return mixed
     */
    public static function getNewHouseInfo($limit = 6){
        $houseInfoModel = M('house_info');
        $map['city_house_info.status'] = 1;
        $houseInfoMsg = $houseInfoModel->limit(0, $limit)->join('left join city_house_photo ON city_house_info.id = city_house_photo.house_id')->where($map)->group('city_house_photo.house_id')->order('city_house_info.id DESC')->field('city_house_info.*, city_house_photo.filepath')->select();
        return $houseInfoMsg;
    }

    /**
     * 获取随机的几个房屋数据
     * @param int $limit
     * @return mixed
     */
    public static function getRandHouseInfo($limit = 2) {
        $houseInfoModel = M('house_info');
        $count = $houseInfoModel->count();
        $id = [];
        while (count($id) < $limit) {
            $newId = rand(1, $count);
            if (!in_array($newId, $id)) {
                $id[] = $newId;
            }
        }
        $map['city_house_info.id'] = ['in', $id];
        $map['city_house_info.status'] = 1;
        $houseInfoMsg = $houseInfoModel->where($map)->join('left join city_house_photo ON city_house_info.id = city_house_photo.house_id')->group('city_house_photo.house_id')->order('city_house_info.id DESC')->field('city_house_info.*, city_house_photo.filepath')->select();
        return $houseInfoMsg;

    }



}