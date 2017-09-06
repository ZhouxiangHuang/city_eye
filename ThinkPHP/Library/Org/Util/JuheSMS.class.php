<?php

/**
 * Created by PhpStorm.
 * User: dyxdw
 * Date: 2016/12/28
 * Time: 11:54
 */
namespace Org\Util;
/**
 * 聚合接口
 * Class JuheSMS
 */
class JuheSMS
{
    /**
     * 用户注册验证码
     * 【翡丝】您的注册验证码是#code#。如非本人操作，请忽略本短信
     */
    const SMS_MODEL_REGISTER="26255";
    /**
     * 用户找回密码
     * 【翡丝】正在找回密码，您的验证码是#code#。如非本人操作，请忽略本短信
     */
    const SMS_MODEL_PETPWD  ="26304";

    private $apiurl="";
    private $appkey="";//接口APPKEY
    private $type="json";//接口返回类型
    private $phone="";//手机号码
    private $param=array();//模版对应的参数数组
    private $sms_model="";//信息模版ID
    function __construct($phone,$param){
        $this->apiurl=C("JUHE_URL");
        $this->appkey=C("JUHE_APPKEY");
        $this->type=C("JUHE_TYPE");
        if(empty($this->type))
            $this->type="json";
    }

    /**设置接收短信的手机号
     * @param $phone
     */
    public function setPhone($phone){
        $this->phone=$phone;
    }

    /**
     * 设置短信模版里面的参数
     * @param $params
     */
    public function setParams($params){
        $this->param=$params;
    }

    /**
     * 设置短息模版
     * @param $smsmodel
     */
    public function setSmsModel($smsmodel){
        $this->sms_model=$smsmodel;
    }

    /**
     * 发送短信
     * @param $phone
     * @param $params
     * @param $smsmodel
     */
    public function Send($phone="",$params=array(),$smsmodel=0){
        if($phone){
            $this->phone=$phone;
        }
        if($params){
            $this->param=$params;
        }
        if($smsmodel){
            $this->sms_model=$smsmodel;
        }
        $arr["key"]=$this->appkey;
        $arr["mobile"]=$this->phone;
        $arr["tpl_id"]=$this->sms_model;
        $arr["tpl_value"]=$this->ArrayToString($this->param);
        $arr["dtype"]=$this->type;
        $result=$this->juhecurl($this->apiurl,$arr,1);
        if($result){
            $content=json_decode($result,true);
            $error_code=$content["error_code"];
            if($error_code==0){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    /**
     * 将数组 转成  #key1#=#value1#&#key2#=#value2#
     * @param $params
     */
    private function ArrayToString($params){
        if(count($params)>0){
            $v="";
            foreach ($params as $key=>$value) {
                $v.="#".$key."#=".$value."&";
            }
            $v=rtrim($v,'&');
            return $v;
        }
        return "";
    }
    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    private function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }
}