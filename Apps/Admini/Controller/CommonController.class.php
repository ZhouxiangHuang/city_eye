<?php
/**
 * Created by PhpStorm.
 * User: dyxdw
 * Date: 2016/12/5
 * Time: 15:05
 */

namespace Admini\Controller;
use Think\Auth;
use Think\Controller;
use Think\Model;

class CommonController extends Controller
{
    public  $table = "";
    public function _initialize(){
        $this->table = C("DB_PREFIX");
        if(!is_login()){
            $this->redirect("Public/login");
        }
        $this->uid=session("admin.id");
        $this->account=session("admin.account");
        $this->auth=new Auth();
    }

    /**
     * 验证页面权限
     * @param bool $ajax
     * @param string $name
     * @param int $type
     * @return mixed
     */
    public function CheckAuth($ajax=false,$name='',$type=1){
        if(empty($name)){
            $name=MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
        }
        if(session('admin.id')==1) return true;
        $r = $this->auth->check($name,$this->uid,$type);
        if($ajax){
            return $r;
        }else{
            if(!$r){
                $this->redirect("Public/error_permission");
            }
        }
    }

    /**记录操作日志
     * @param string $tableName
     * @param string $log
     * @internal param string $tablename
     */
    public function writelog($tableName='',$log=''){
        systemlog($tableName,$this->uid,$this->account,$log);
    }


    /**
     * 获取列表
     *
     * @param $table
     * @param int $page 页码
     * @param int $limit 每页显示条数
     * @param string $where 条件
     * @param string $order 排序字段
     * @param string $by 排序值
     * @param int $limit
     * @param string $where
     * @param string $order
     * @param string $by
     * @return array
     */
    public function getList($table,$page=1,$limit=200,$where='',$order='id',$by='desc'){
        $tableQ = C('DB_PREFIX');
        $condition = 'WHERE 1 = 1 ';
        $Model = new Model();
        if($where != ''){
            $condition .= $where;
        }
        if($limit == 0){
            $limit = 200;
        }
        //总行数
        $query = "SELECT COUNT(1)  AS `numrows`  FROM `{$tableQ}{$table}` {$condition}";

        $total_arr = $Model->query($query);
        $total = $total_arr[0]['numrows'];
        $total_page = ceil($total / $limit);//总页数
        if($page <= 1){
            $page = 1;
        }elseif($page >= $total_page){
            $page = $total_page;
        }
        $offset = ($page - 1 ) * $limit;
//        var_dump($page);die();
        $_RE = array('total'=>$total);
        //查询字段
        $fields = $this->getListFields();
        $sql = "SELECT {$fields} FROM {$tableQ}{$table} {$condition} ORDER BY {$order} {$by} LIMIT {$offset} ,{$limit} ";
//        var_dump($sql);die();
        $rs = $Model->query($sql);
        if(!$rs){
            $_RE['rows'] = '';
            return $_RE;
        }else{
            $_RE['rows'] = $rs;
        }

//        若存在方法preprocess，将返回数据交给preprocess处理
        if(method_exists($this,'preprocess')){
            $stime = $this->query_stime;
            $etime = $this->query_etime;
            $_RE['rows'] = $this->preprocess($rs,$stime,$etime);
        }

        return $_RE;
    }

    /**
     * 将属性list_fields转为字符串
     */
    protected function getListFields(){
        if(property_exists(get_class($this),'list_fields')){
            $fields = '*';
            if(!empty($this->list_fields)){
                $fields = implode(',',$this->list_fields);
            }
        }else{
            $fields = '*';
        }
        return $fields;
    }
    //返回固定格式数组
    public function returnArr($code=200,$msg='操作成功',$href=''){
        $now_ac = CONTROLLER_NAME . '/' . ACTION_NAME;
        $href = empty($href) ? 'Home/index' : $now_ac;
        return array('code'=>$code,'message'=>$msg,'href'=>$href);
    }


    /**
     * 树形数据生成
     * @param array $items 原始数据
     * @param int|string $id 主键字段（默认：id）
     * @param int|string $pid 父节点标识（默认：pid）
     * @param string $textFiled
     * @param bool $closed
     * @param string $iconCls
     * @param string $son 子节点标识（默认：children）
     * @return array 树形数据
     * @internal param string $attributes 是否添加attributes属性
     * @internal param bool $close 超过二级是否不显示
     */
    function genTree($items, $id = 'id', $pid = 'pid', $textFiled = 'name', $closed = false, $iconCls = 'icon_cls', $son = 'nodes')
    {

        $tree = array(); // 格式化的树
        $tmpMap = array(); // 临时扁平数据
        foreach ($items as $item) {
            if (!isset($item['id'])) {
                $item['id'] = $item[$id];
            }
            if (!isset($item['text'])) {
                $item['text'] = $item[$textFiled];
                unset($item[$textFiled]);
            }
            if (!isset($item['iconCls'])) {
                $item['iconCls'] = $item[$iconCls];
            }

            if (isset($item['auth_path']) && $closed == true) {
                $count = substr_count($item['auth_path'], ',');
                if ($count > 2) {
                    //是否存在子节点
                    foreach ($items as $k => $v) {
                        if ($item[$id] == $v[$pid]) {
                            $item['state'] = 'closed';
                        }
                    }
                }
            }
            $tmpMap[$item[$id]] = $item;
        }
        foreach ($items as $item) {
            if (isset($tmpMap[$item[$pid]])) {
                $tmpMap[$item[$pid]][$son][] = &$tmpMap[$item[$id]];
            } else {
                $tree[] = &$tmpMap[$item[$id]];
            }
        }
        return $tree;
    }

    /**
     * bootstrap列表ajax返回信息
     * @row 查询结果
     * @correct 正确返回信息 @error 错误返回信息
     * @param $row
     * @param $correct
     * @param $error
     */
    public function myReturnAjax($row,$correct,$error){
        if($row['row'] !== false){
            $data = $row['row'] != false ? array('success'=>200,'message'=>$correct,'data'=>array('total'=>$row['total'],'rows'=>$row['row'])) : array('success'=>400,'message'=>$error,'data'=>array('total'=>0,'rows'=>[]));
        }else{
            $data = array('success'=>400,'message'=>'数据库错误！');
        }
        echo json_encode($data);
    }

    /**
     * ajax返回状态信息
     * @param $code
     * @param $msg
     * @param array $data
     */
    public function myAjaxReturn($code,$msg,$data=array()){
        echo $data!==array() ?
            json_encode(array('code'=>$code,'msg'=>$msg,'data'=>$data))
            :
            json_encode(array('code'=>$code,'msg'=>$msg));
    }

}