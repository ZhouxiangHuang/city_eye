<?php
/**
 * Created by PhpStorm.
 * User: dyxdw
 * Date: 2016/12/6
 * Time: 13:53
 */

namespace Admini\Model;


use Think\Model;

class AreaModel extends Model
{
    /**
     * 根据地区ID，获取地区  以及其父级
     * @param $id   地区ID
     * @return array
     * @internal param int $level 地区的层级
     */
    public function GetAreaAndParents($id){
        $result=array();
        while ($id>0){
            $where["id"]=$id;
            $r = $this->where($where)->find();
            if($r){
                $result[]=$r;
                if($r["parentid"]<=0){
                    break;
                }
                $id=$r["parentid"];
            }else{
                break;
            }
        }
        return $result;
    }
    /**
     * 获取省份列表
     * @param int $status
     */
    public function GetProvince($status=1,$field="id,areaname"){
        $where["status"]=$status;
        $where["parentid"]=0;
        return $this->where($where)->order("sort asc")->field($field)->select();
    }

    /**
     * 获取省份下的地级市
     * @param $provinceid
     * @param int $status
     * @param string $field
     * @return
     * @internal param int $stats
     */
    public function GetCity($provinceid,$status=1,$field="id,areaname"){
        $where["status"]=$status;
        $where["parentid"]=$provinceid;
        return $this->where($where)->order("sort asc")->field($field)->select();
    }

    /**
     * 获取地级市下面的区县
     * @param $cityid
     * @param int $status
     */
    public function GetArea($cityid,$status=1,$field="id,areaname"){
        $where["status"]=$status;
        $where["parentid"]=$cityid;
        return $this->where($where)->order("sort asc")->field($field)->select();
    }
}