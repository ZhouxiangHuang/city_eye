<?php 
namespace Org\Util;

class WeixinPay{
	private $appid="";
	private $mch_id="";
	private $api_key="";
	private $notify_url="";
	
	function __construct(){
		$this->appid=C("WeiXin_appid");
		$this->mch_id=C("WeiXin_mch_id");
		$this->api_key=C("WeiXin_api_key");
		$this->notify_url=C("WeiXin_Notify_url");
	}
	
	
	
	/**
	 * 获取欲支付订单
	 * @param unknown $orderid   订单号
	 * @param unknown $total_fee  支付金额  单位 ：元
	 */
	public function wxpay($orderid,$total_fee){
		$url="https://api.mch.weixin.qq.com/pay/unifiedorder";
		$out_trade_no=$orderid;
		$total_fee=intval($total_fee*100);
		$onoce_str=$this->getRandChar(32);
		$data["appid"]  = $this->appid;
		$data["body"]   = "支付订单";
		$data["mch_id"] = $this->mch_id;
		$data["nonce_str"]  = $onoce_str;
		$data["notify_url"] = $this->notify_url;
		$data["out_trade_no"] = $out_trade_no;
		$data["spbill_create_ip"] = $this->get_client_ip();
		$data["total_fee"] = $total_fee;
		$data["trade_type"] = "APP";
		$s=$this->getSign($data,false);
		$data["sign"]=$s;
		$xml=$this->arrayToXml($data);
		$response=$this->postXmlCurl($xml, $url);
		$res=$this->xmlstr_to_array($response);
		$sign2=$this->getOrder($res["prepay_id"]);
		return $sign2;
	}
		
	//执行第二次签名，才能返回给客户端使用
	public function getOrder($prepayId){
		$data["appid"] = $this->appid;
		$data["noncestr"] = $this->getRandChar(32);
		$data["package"] = "Sign=WXPay";
		$data["partnerid"] = $this->mch_id;
		$data["prepayid"] = $prepayId;
		$data["timestamp"] = time();
		$s = $this->getSign($data, false);
		$data["sign"] = $s;
		return $data;
	}
	/**
	 xml转成数组
	 */
	function xmlstr_to_array($xmlstr) {
		$doc = new \DOMDocument();
		$doc->loadXML($xmlstr);
		return $this->domnode_to_array($doc->documentElement);
	}
	function domnode_to_array($node) {
		$output = array();
		switch ($node->nodeType) {
			case XML_CDATA_SECTION_NODE:
			case XML_TEXT_NODE:
				$output = trim($node->textContent);
				break;
			case XML_ELEMENT_NODE:
				for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
					$child = $node->childNodes->item($i);
					$v = $this->domnode_to_array($child);
					if(isset($child->tagName)) {
						$t = $child->tagName;
						if(!isset($output[$t])) {
							$output[$t] = array();
						}
						$output[$t][] = $v;
					}
					elseif($v) {
						$output = (string) $v;
					}
				}
				if(is_array($output)) {
					if($node->attributes->length) {
						$a = array();
						foreach($node->attributes as $attrName => $attrNode) {
							$a[$attrName] = (string) $attrNode->value;
						}
						$output['@attributes'] = $a;
					}
					foreach ($output as $t => $v) {
						if(is_array($v) && count($v)==1 && $t!='@attributes') {
							$output[$t] = $v[0];
						}
					}
				}
				break;
		}
		return $output;
	}
	//post https请求，CURLOPT_POSTFIELDS xml格式
	function postXmlCurl($xml,$url,$second=30)
	{
		//初始化curl
		$ch = curl_init();
		//超时时间
		curl_setopt($ch,CURLOPT_TIMEOUT,$second);
		//这里设置代理，如果有的话
		//curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
		//curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		//设置header
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		//要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//post提交方式
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		//运行curl
		$data = curl_exec($ch);
		//返回结果
		if($data)
		{
			curl_close($ch);
			return $data;
		}
		else
		{
			$error = curl_errno($ch);
			echo "curl出错，错误码:$error"."<br>";
			curl_close($ch);
			return false;
		}
	}
	//数组转xml
	function arrayToXml($arr)
	{
		$xml = "<xml>";
		foreach ($arr as $key=>$val)
		{
			if (is_numeric($val))
			{
				$xml.="<".$key.">".$val."</".$key.">";
	
	
			}
			else
				$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
		}
		$xml.="</xml>";
		return $xml;
	}
	/*
	 生成签名
	 */
	function getSign($Obj)
	{
		foreach ($Obj as $k => $v)
		{
			$Parameters[strtolower($k)] = $v;
		}
		//签名步骤一：按字典序排序参数
		ksort($Parameters);
		$String = $this->formatBizQueryParaMap($Parameters, false);
		//echo "【string】 =".$String."</br>";
		//签名步骤二：在string后加入KEY
		$String = $String."&key=".$this->api_key;
		//echo "<textarea style='width: 50%; height: 150px;'>$String</textarea> <br />";
		//签名步骤三：MD5加密
		$result_ = strtoupper(md5($String));
		return $result_;
	}
	//将数组转成uri字符串
	function formatBizQueryParaMap($paraMap, $urlencode)
	{
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v)
		{
			if($urlencode)
			{
				$v = urlencode($v);
			}
			$buff .= strtolower($k) . "=" . $v . "&";
		}
		$reqPar;
		if (strlen($buff) > 0)
		{
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
	/*
	         获取当前服务器的IP
	 */
	function get_client_ip()
	{
		if ($_SERVER['REMOTE_ADDR']) {
			$cip = $_SERVER['REMOTE_ADDR'];
		} elseif (getenv("REMOTE_ADDR")) {
			$cip = getenv("REMOTE_ADDR");
		} elseif (getenv("HTTP_CLIENT_IP")) {
			$cip = getenv("HTTP_CLIENT_IP");
		} else {
			$cip = "unknown";
		}
		return $cip;
	}
	//获取指定长度的随机字符串
	function getRandChar($length){
		$str = null;
		$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$max = strlen($strPol)-1;
		for($i=0;$i<$length;$i++){
			$str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
		}
		return $str;
	}
}
?>