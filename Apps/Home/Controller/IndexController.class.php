<?php
namespace Home\Controller;

use Admini\Model\AreaNewModel;
use Admini\Model\HouseInfoModel;
use Think\Controller;
use Think\Page;

class IndexController extends Controller {
    public function index(){
        $houseInfoMsg = HouseInfoModel::getNewHouseInfo();
        $areaList = AreaNewModel::getArea();
        $this->assign('area_list', json_encode($areaList));
        $this->assign('lan', self::checkLan());
        $this->assign('houseInfoMsg', $houseInfoMsg);
    	$this->display();
    }

    public function lists(){
        $areaList = AreaNewModel::getArea();
        $this->assign('area_list', json_encode($areaList));
        $this->assign('lan', self::checkLan());
        $this->display();
    }

    public function getAreaList() {
        $areaList = AreaNewModel::getArea();
        myAjaxReturn(200, '', $areaList);
    }

    public function getList(){
        $currentPage = I('post.p') ? I('post.p') : 1;
        $area = I('post.location_area');
        if (I('post.type') != '') {
            $type = I('post.type') == 'sale' ? 1 : 2;
            $map['city_house_info.is_sale'] = $type;
        }
        if (I('post.bedrooms') != '') {
            $map['city_house_info.room_num'] = I('post.bedrooms');
        }
        if (I('post.bathrooms') != '') {
            $map['city_house_info.wc_num'] = I('post.bathrooms');
        }
        $priceMin = I('post.min_price') ? I('post.min_price') : 0;
        $priceMax = I('post.max_price') ? I('post.max_price') : 9999999999;
        $sizeMin = I('post.min_area') ? I('post.min_area') : 0;
        $sizeMax = I('post.max_area') ? I('post.max_area') : 999999;
        $data = M('house_info'); // 实例化Data数据对象
        if (!empty($area)) $map['city_house_info.area_id'] = ['in', $area];
        $map['city_house_info.price'] = ['between', [$priceMin, $priceMax]];
        $map['city_house_info.proportion'] = ['between', [$sizeMin, $sizeMax]];
        $count = $data->where($map)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count, 9);// 实例化分页类 传入总记录数
        $show = $Page->show();// 分页显示输出
        $offset = ($currentPage - 1) * $Page->listRows;
        // 进行分页数据查询
        $list = $data->where($map)->limit($offset, $Page->listRows)->join('city_house_photo ON city_house_info.id = city_house_photo.house_id')->group('city_house_photo.house_id')->order('city_house_info.id DESC')->field('city_house_info.*, city_house_photo.filepath')->select();
        /*$this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count', $count);*/
        if ($count % $Page->listRows === 0) {
            $countPage = ($count / $Page->listRows);
        } else {
            $countPage = ceil(($count / $Page->listRows));
        }
        $data = ['content' => $list, 'count' => $count, 'countPage' => $countPage];
        if ($list !== false) myAjaxReturn(200, '', $data);
        else myAjaxReturn(400, '请求失败', []);
    }

    public function detail() {
        $id = I('get.id');
        $data = [];
        if ($id) $data = HouseInfoModel::getPhotoAndModelById($id);
        if(!$data) {
            $this->error('');
        }
        $areaList = AreaNewModel::getArea();
        $randData = HouseInfoModel::getRandHouseInfo();
        $this->assign('area_list', $areaList);
        $this->assign('lan', self::checkLan());
        $this->assign('randData', $randData);
        $this->assign('data', $data);
        $this->display();
    }

    public static function checkLan(){
        $lan = cookie('think_language') ? cookie('think_language') : 'zh-CN';
        return $lan;
    }

    public function contact(){
        $this->assign('lan', self::checkLan());
        $this->display();
    }

    public function gallery(){
        $this->assign('lan', self::checkLan());
        $this->display();
    }

    public function getMail() {
        $name = I('post.name');
        $email = I('post.email');
        $phone = I('post.phone');
        $message = I('post.message');
        $subject = I('post.subject');
        $body = "name: $name <br/> phone: $phone <br/> message: $message";
        $data = sendMail('1024814942@qq.com', $subject, $body, $email, $name);
        if ($data === true) {
            myAjaxReturn(200, '', []);
        } else myAjaxReturn(400, $data, []);
    }
    public function errors() {
        $this->assign('lan', self::checkLan());
        $this->display();
    }

    public function serviceItems() {
        $this->assign('lan', self::checkLan());
        $this->display();
    }
    public function tourism(){
        $this->assign('lan', self::checkLan());
        $this->display();
    }


    
}