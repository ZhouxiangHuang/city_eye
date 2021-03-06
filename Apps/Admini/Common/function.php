<?php
use Org\Util\JuheExpress;

/**
 * Created by PhpStorm.
 * User: dyxdw
 * Date: 2016/12/5
 * Time: 15:02
 */

function SearchExpressSchedule($orderid=""){
   if(strlen($orderid)<=0)
       return false;
   $db_expressschedule=D("Expressschedule");
   $data_schedule=$db_expressschedule->where(array("orderid"=>$orderid))->find();
   if(!$data_schedule){//若保存物流信息不存在  则调用接口更新一次   与订单发货状态有关  与订单完成状态无关
       $data_order=D("Promainorder")->field("id,orderstatus,expresstype,expresscode")->where(array("orderid"=>$orderid))->find();
       if(!$data_order)//订单不存在
            return false;
       if($data_order["orderstatus"]<2)//订单尚未发货
            return false;
       //查询快递公司代码
       $data_expresstype=D("Expresstype")->where(array("id"=>$data_order["expresstype"]))->find();
       if(!$data_expresstype)//未得到有效的快递公司
          return false;
       $obj_juhe=new JuheExpress();
       $obj_juhe->setExpressid($data_expresstype["comcode"]);
       $obj_juhe->setExpressno($data_order["expresscode"]);
       $result_primeval=$obj_juhe->Send();//接口返回原始内容
       $result_analysis=$obj_juhe->AnalysisForJSON($result_primeval);//解析后的内容
       if($result_analysis){
           $data["comcode"]=$data_expresstype["comcode"];
           $data["apitype"]=1;
           $data["orderid"]=$orderid;
           $data["expresscode"]=$data_order["expresscode"];
           $data["content"]=serialize($result_analysis);
           $data["expstatus"]=0;
           $data["updatetime"]=time();
           $data["primevalapi"]=serialize($result_primeval);
           $db_expressschedule->add($data);
           return $result_analysis;
       }else{
          return false;//查询快递信息失败
       }
   }else{//物流信息已经存在  则使用已保存的物流信息  需要更新时 调用接口更新  与订单发货状态和订单完成状态有关 
       $updatetime=$data_schedule["updatetime"];//最后一次更新时间
       $express_update_time=GetConfig("express_schedule_update_timeinterval");//更新快递进度时间间隔
       if($updatetime+$express_update_time<time()){//需要更新
           $data_order=D("Promainorder")->field("id,orderstatus,expresstype,expresscode")->where(array("orderid"=>$orderid))->find();
           if($data_order){//订单存在
               if($data_order["orderstatus"]==2){//订单只能是已发货状态
                   $data_expresstype=D("Expresstype")->where(array("id"=>$data_order["expresstype"]))->find();
                   if($data_expresstype){//快递配置信息存在
                       $obj_juhe=new JuheExpress();
                       $obj_juhe->setExpressid($data_expresstype["comcode"]);
                       $obj_juhe->setExpressno($data_order["expresscode"]);
                       $result_primeval=$obj_juhe->Send();//接口返回原始内容
                       $result_analysis=$obj_juhe->AnalysisForJSON($result_primeval);//解析后的内容
                       if($result_analysis){//接口返回信息正常
                           $data_schedule["content"]=serialize($result_analysis);
                           $data_schedule["updatetime"]=time();
                           $data_schedule["primevalapi"]=serialize($result_primeval);
                           $db_expressschedule->save($data_schedule);
                       }
                   }
               }
           }
       }
       $result=unserialize($data_schedule["content"]);
       return $result;
   }
}
/**
 * 管理员是否登录
 * @return bool
 */
function is_login(){
    if(session("?admin"))
        return true;
    else
        return false;
}

/**
 *  商家认证状态标识颜色
 * @param $certified
 * @return string
 */
function GetCertifiedStatusColor($certified){
    if(is_string($certified))
        $certified=intval($certified);
    switch ($certified){
        case 0:return "#EE0000";
        case 1:return "#00CD66";
        case 2:return "#A4D3EE";
        case 3:return "#FFD700";
        default:return "#CCCCCC";
    }
}
/**
 * 建立文件夹
 *
 * @param string $aimUrl
 * @return viod
 */
function createDir($aimUrl) {
    $aimUrl = str_replace('', '/', $aimUrl);
    $aimDir = '';
    $arr = explode('/', $aimUrl);
    $result = true;
    foreach ($arr as $str) {
        $aimDir .= $str . '/';
        if (!file_exists($aimDir)) {
            $result = @mkdir($aimDir,0777);
        }
    }
    return $result;
}

/** 上传图片
 * @param  $filePath    文件上传指定目录，在Uploads下
 * @param  $filename    指定生成的图片文件夹格式，如2016/03/30
 * @return  JSON    编辑器上传图片
 */
function uploads($filePath='',$thumb=false,$maxwidth=150,$maxheight=150,$filename='Y/m/d'){
    $config = array(
        'maxSize'    =>    512000,
        'rootPath'   =>    './Uploads/'.$filePath.'/',
        'savePath'   =>    '',
        'saveName'   =>    array('uniqid',''),
        'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
        'autoSub'    =>    true,
        'subName'    =>    array('date',$filename),
    );
    $upload = new \Think\Upload($config);// 实例化上传类
    // 上传文件
    $info   =   $upload->upload();
    if($info) {
        // 上传成功 获取上传文件信息
        foreach ($info as &$file) {
            //拼接出文件相对路径
            $file['filepath'] =  $file['savepath'] . $file['savename'];
        }
        if($thumb){
            $filepath_m=$file['savepath'] . "m_" .$file['savename'];
            $image=new \Think\Image();
            $image->open($config["rootPath"].$file["filepath"]);
            $image->thumb($maxwidth,$maxheight)->save($config["rootPath"].$filepath_m);
            @unlink($config["rootPath"].$file["filepath"]);
            $file['filepath']=$filepath_m;
            $file['savename']="m_".$file["savename"];
        }
        //返回json数据被百度Umeditor编辑器
        return  json_encode( array(
            'url'=>$file['filepath'],
            'title'=>htmlspecialchars( $_POST['desc'], ENT_QUOTES ),  'original'=>$file['savename'],
            'state'=>'SUCCESS'
        ) );
    }else{
        // 上传失败
        return json_encode( array('state'=>$upload->getError() ) );
    }
}

/**
 *  webuploader,wangEditor 控件上传
 * @param $root  文件存储主目录
 * @param string $targetDir  上传临时目录
 * @param string $uploadDir  自定永久存储目录  为空是按日期
 * @return array
 */
function uploadfile($root,$targetDir='',$uploadDir=''){
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        exit; // finish preflight CORS requests here
    }
    if ( !empty($_REQUEST[ 'debug' ]) ) {
        $random = rand(0, intval($_REQUEST[ 'debug' ]) );
        if ( $random === 0 ) {
            header("HTTP/1.0 500 Internal Server Error");
            exit;
        }
    }
    @set_time_limit(5 * 60);
    if(empty($targetDir)){
        $targetDir=$root.'/upload_temp';//上传缓存目录
    }
    if(empty($uploadDir)){
        $uploadDir=$root.'/'.date('Y').'/'.date('m');//文件永久目录
    }
    $cleanupTargetDir = true; // Remove old files
    $maxFileAge = 5 * 3600; // Temp file age in seconds
    createDir($targetDir);//创建上传缓存目录
    $result=createDir($uploadDir);//创建上传文件夹
    if (isset($_REQUEST["name"])) {
        $fileName = $_REQUEST["name"];
    } elseif (!empty($_FILES)) {
        $fileName = $_FILES["file"]["name"];
    } else {
        $fileName = uniqid("file_");
    }
    //-------------------------------------------------------
    //无论是什么文件名称，先unicode转utf8
    //unicode转utf8
    //注意$str='"..."'，内部双引号，外部单引号
    //对于变量$str='..'，我们需要处理'"'.$str.'"',处理后成一个新变量
    function unicode2utf8($str){
        if(!$str) return $str;
        $decode = json_decode($str);
        if($decode) return $decode;
        $str = '["' . $str . '"]';
        $decode = json_decode($str);
        if(count($decode) == 1){
            return $decode[0];
        }
        return $str;
    }
    $fileName=unicode2utf8('"'.$fileName.'"');
    $fileName= iconv("UTF-8","GBK", $fileName);//防止fopen语句失效
    $md5File = @file('md5list2.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $md5File = $md5File ? $md5File : array();
    if (isset($_REQUEST["md5"]) && array_search($_REQUEST["md5"], $md5File ) !== FALSE ) {
        // die('{"jsonrpc" : "2.0", "result" : null, "id" : "id", "exist": 1}');
        return array('code' =>31099,'message'=>'服务器错误！','tag'=>'' );
    }
    $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
    $ext=pathinfo($fileName,PATHINFO_EXTENSION);
    $fileName=time().GetRandChar(8);
    $fileName=CreateRandom($fileName).".".$ext;
    $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
    // Chunking might be enabled
    $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
    $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
    // Remove old temp files
    if ($cleanupTargetDir) {
        if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
            //die(createResultJSON(31002, L("user.upload.31002")));
            return array('code' =>31002,'message'=>'临时目录创建错误！','tag'=>'' );
        }
        while (($file = readdir($dir)) !== false) {
            $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
            // If temp file is current file proceed to the next
            if ($tmpfilePath == "{$filePath}.part") {
                continue;
            }
            // Remove temp file if it is older than the max age and is not the current file
            if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                @unlink($tmpfilePath);
            }
        }
        closedir($dir);
    }
    // Open temp file
    if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
        return array('code' =>31099,'message'=>"上传数据文件时发生错误！",'tag'=>'' );
    }
    if (!empty($_FILES)) {
        if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
            return array('code' =>31099,'message'=>"上传数据文件时发生错误",'tag'=>'' );
        }
        if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
            return array('code' =>31099,'message'=>"上传数据文件时发生错误",'tag'=>'' );
        }
    } else {
        if (!$in = @fopen("php://input", "rb")) {
            return array('code' =>31099,'message'=>"上传数据文件时发生错误",'tag'=>'' );
        }
    }
    while ($buff = fread($in, 4096)) {
        fwrite($out, $buff);
    }
    @fclose($out);
    @fclose($in);
    // Check if file has been uploaded
    if (!$chunks || $chunk == $chunks - 1) {
        // Strip the temp .part suffix off
        rename("{$filePath}.part", $filePath);
        rename($filePath, $uploadPath);
        array_push($md5File, filemd5($uploadPath));
        $md5File = array_unique($md5File);
        file_put_contents('md5list2.txt', join($md5File, "\n"));
    }
    $usefilepath=$uploadPath;
    $usefilepath=str_replace('\\', '/', $usefilepath);
    return array('code' =>31000,'message'=>'上传数据文件成功！','tag'=>$usefilepath);
}
function filemd5( $file ) {
    $fragment = 65536;
    $rh = fopen($file, 'rb');
    $size = filesize($file);
    $part1 = fread( $rh, $fragment );
    fseek($rh, $size-$fragment);
    $part2 = fread( $rh, $fragment);
    fclose($rh);
    return md5( $part1.$part2 );
}




/**
 *写入一条操作日志
 */
function systemlog($tablename='',$act_id=0,$act_account='',$log=''){
    $data["tablename"]=$tablename;
    $data["type"]=0;
    $data["act_id"]=$act_id;
    $data["act_account"]=$act_account;
    $data["description"]=$log;
    $data["get_parameter"]=serialize($_GET);
    $data["times"]=time();
    M("operationlog")->add($data);
}


function SecurityEditorHtml($str) {
    $farr = array(
        "/\s+/", //过滤多余的空白 
        "/<(\/?)(script|i?frame|style|html|body|title|link|meta|\?|\%)([^>]*?)>/isU",
        "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU"
    );
    $tarr = array(
        " ",
        "<\\1\\2\\3>",
        "\\1\\2",
    );
    $str = preg_replace($farr, $tarr, $str);
    return $str;
}