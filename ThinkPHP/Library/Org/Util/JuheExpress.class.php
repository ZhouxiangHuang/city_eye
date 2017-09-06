<?php
namespace Org\Util;

/**
 * 聚合快递查询接口
 * @author dyxdw
 *
 */
class JuheExpress{
    
    private $apiurl="";//接口地址
    private $appkey="";//APPKEY
    private $expressid="";//快递公司代码
    private $expressno="";//快递单号
    private $type="json";
    
    
    /**
     * 
     * @param string $expressid 快递公司代码
     * @param string $expressno 快递单号
     */
    function __construct($expressid="",$expressno=""){
        $this->apiurl=C("JUHE_EXPRESS_URL");
        $this->appkey=C("JUHE_EXPRESS_KEY");
        $this->type=C("JUHE_EXPRESS_TYPE");
        if($expressid){
            $this->expressid=$expressid;
        }
        if($expressno){
            $this->expressno=$expressno;
        }
    }
    /**
     *  设置快递公司代码
     * @param unknown $expressid
     */
    public function setExpressid($expressid){
        $this->expressid=$expressid;
    }
    /**
     * 设置快递单号
     * @param unknown $expressno
     */
    public function setExpressno($expressno){
        $this->expressno=$expressno;
    }
    /**
     * 查询快递接口
     * @param  $expressid
     * @param  $expressno
     */
    public function Send($expressid="",$expressno=""){
        if($expressid){
            $this->expressid=$expressid;
        }
        if($expressno){
            $this->expressno=$expressno;
        }
        $param["key"]=$this->appkey;
        $param["com"]=$this->expressid;
        $param["no"]=$this->expressno;
        $param["dtype"]=$this->type;
        $result=$this->juhecurl($this->apiurl,$param,1);
        return $result;
    }
    /**
     * 解析接口查询结果
     * @param $result
     */
    public function AnalysisForJSON($result){
        if(!$result)
            return false;
        $content=json_decode($result,true);
        if($content["error_code"]==0){
            $list=$content["result"]["list"];
            $list=array_reverse($list);
            $content["result"]["list"]=$list;
            //将接口返回的字段 解析为 本地字段 防止接口字段变动造成 客户端更改问题
            $result=array();
            $result["company"]=$content["result"]["company"];
            $result["com"]=$content["result"]["com"];
            $result["no"]=$content["result"]["no"];
            $temp_list=array();
            foreach ($content["result"]["list"] as $key=>$value){
                $item["datetime"]=$value["datetime"];
                $item["remark"]=$value["remark"];
                $temp_list[]=$item;
            }
            $result["list"]=$temp_list;
            return $result;
        }else{
            return false;
        }
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