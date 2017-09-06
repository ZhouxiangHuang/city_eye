<?php 
namespace Common\ext;

/* 
	include "clsUpload.php";
	$DB_base = new clsUpload('config/','',200,1);
	$DB_base->thumb=true;
	$DB_base->thumbHeight=100;
	$DB_base->run('File_pic');//上传图片用的input的名子
	print_r($DB_base->returnArray);//返回上传信息数组
	echo $DB_base->errmsg();//错误信息提示
 */  
class Upload{  
	public $saveName;// 保存名 
	public $savePath;// 保存路径  
	public $filePath;// 保存路径  
	public $fileFormat = array('gif','jpg','doc','png','gz','application/octet-stream');// 文件格式&MIME限定  
	public $overwrite = 0;// 覆盖模式  
	public $maxSize = 0;// 文件最大字节  
	public $ext;// 文件扩展名  
	public $thumb = 0;// 是否生成缩略图  
	public $thumbWidth = 130;// 缩略图宽  
	public $thumbHeight = 130;// 缩略图高  
	public $thumbPrefix = "_thumb_";// 缩略图前缀  
	public $thumbsavePath;	//缩略图存放地址
	public $errno;// 错误代号  
	public $returnArray= array();// 所有文件的返回信息  
	public $returninfo= array();// 每个文件返回信息
	    
	// 构造函数 
	// @param $savePath 文件保存路径  
	// @param $fileFormat 文件格式限制数组 
	// @param $maxSize 文件最大尺寸 kb为单位
	// @param $overwriet 是否覆盖 1 允许覆盖 0 禁止覆盖  
	function __construct($savePath='upload', $fileFormat='',$maxSize = 2000, $overwrite = 1) {   
		$this->setSavepath($savePath);
		$this->thumbsavePath=$savePath.'thumb/'; 
		$this->setFileformat($fileFormat);   
		$this->setMaxsize($maxSize);   
		$this->setOverwrite($overwrite);   
		$this->setThumb($this->thumb, $this->thumbWidth,$this->thumbHeight);   
		$this->errno = 0;   
		}   
		// 上传  
		// @param $fileInput 网页Form(表单)中input的名称 
		// @param $changeName 是否更改文件名  
	function run($fileInput,$changeName = 1){
		if(isset($_FILES[$fileInput])){    
			$fileArr = $_FILES[$fileInput];
			if(is_array($fileArr['name'])){//上传同文件域名称多个文件  
			   if(!$fileArr['name'][0]){return null;};
			   for($i = 0; $i < count($fileArr['name']); $i++){      
			   		$ar['tmp_name'] = $fileArr['tmp_name'][$i];      
					$ar['name'] = $fileArr['name'][$i];      
					$ar['type'] = $fileArr['type'][$i];
					$ar['size'] = $fileArr['size'][$i];      
					$ar['error'] = $fileArr['error'][$i];      
					$this->getExt($ar['name']);//取得扩展名，赋给$this->ext，下次循环会更新      
					$this->setSavename($changeName == 1 ? '' : $ar['name']);//设置保存文件名    
					if($this->copyfile($ar)){       
						$this->returnArray[$fileInput][] =  $this->returninfo;      
					}else{       
						$this->returninfo[$fileInput]['error'][$ar['name']] = $this->errmsg();       
						$this->returnArray[$fileInput][] =  $this->returninfo;      
						}     
					}     
					return $this->errno ?  false :  true;    
			}else{//上传单个文件   
			    if(!$fileArr['name']){return null;};
				$this->getExt($fileArr['name']);//取得扩展名   
				$this->setSavename($changeName == 1 ? '' : $fileArr['name']);//设置保存文件名   
					if($this->copyfile($fileArr)){      
						$this->returnArray[$fileInput][] =  $this->returninfo;     
					}else{     
						$this->returninfo[$fileInput]['error'][$fileArr['name']]= $this->errmsg();      
						$this->returnArray[$fileInput][] =  $this->returninfo;     
						}     
						return $this->errno ?  false :  true;    
					}   
						return false;   
				}else{   
					$this->errno = 10;    
					return false;   
					}  
			}  
					
		// 单个文件上传
		// @param $fileArray 文件信息数组  
	function copyfile($fileArray){   
		$this->returninfo = array();   // 返回信息   
		$this->returninfo['name'] = $fileArray['name'];   
		$this->returninfo['saveName'] = str_replace('..','',$this->savePath.$this->saveName);
		$this->returninfo['filePath'] = str_replace('..','',$this->filePath.$this->saveName);   
		$this->returninfo['size'] = number_format( ($fileArray['size'])/1024 , 0, '.', ' ');//以KB为单位  
		$this->returninfo['type'] = $fileArray['type'];   // 检查文件格式
		if (!$this->validateFormat()){    
			$this->errno = 11;    return false;   
		}    
		// 检查目录是否可写    
		if(!@is_writable($this->savePath)){
			mkdir($this->savePath,0777,true);
			//$this->errno = 12;    return false;   
		}   
		// 如果不允许覆盖，检查文件是否已经存在    
		if($this->overwrite == 0 && @file_exists($this->savePath.$fileArray['name'])){   
			$this->errno = 13;    return false;   
		}   
		// 如果有大小限制，检查文件是否超过限制   
		if ($this->maxSize != 0 ){    
			if ($fileArray["size"] > $this->maxSize){     
			$this->errno = 14;     
			return false;    
			}   
		}    
		// 文件上传   
		if(!@copy($fileArray["tmp_name"], $this->savePath.$this->saveName)){    
			$this->errno = $fileArray["error"];    
			return false;    
		}elseif( $this->thumb ){// 创建缩略图  
			$CreateFunction = "imagecreatefrom".($this->ext == 'jpg' ? 'jpeg' : $this->ext);    
			$SaveFunction = "image".($this->ext == 'jpg' ? 'jpeg' : $this->ext);    
			if (strtolower($CreateFunction) == "imagecreatefromgif"      && !function_exists("imagecreatefromgif")) {     
			$this->errno = 16;     
			return false;    
			} elseif (strtolower($CreateFunction) == "imagecreatefromjpeg"      && !function_exists("imagecreatefromjpeg")) {     
				$this->errno = 17;     
				return false;    
			} elseif (!function_exists($CreateFunction)) {     
				$this->errno = 18;     return false;    
			}         
			$Original = @$CreateFunction($this->savePath.$this->saveName);    
			if (!$Original) {$this->errno = 19; return false;
			}
			$originalHeight = ImageSY($Original);
			$originalWidth = ImageSX($Original);    
			$this->returninfo['originalHeight'] = $originalHeight;    
			$this->returninfo['originalWidth'] = $originalWidth;    
			if (($originalHeight < $this->thumbHeight      && $originalWidth < $this->thumbWidth)) {     // 如果比期望的缩略图小，那只Copy     
				copy($this->savePath.$this->saveName,       
				$this->savePath.$this->thumbPrefix.$this->saveName);    
			} else {     
				if( $originalWidth > $this->thumbWidth ){// 宽 > 设定宽度     
				$thumbWidth = $this->thumbWidth;      
				$thumbHeight = $this->thumbWidth * ( $originalHeight /  $originalWidth );      
				if($thumbHeight > $this->thumbHeight){// 高 > 设定高度     
				$thumbWidth = $this->thumbHeight * ( $thumbWidth /  $thumbHeight );       
				$thumbHeight = $this->thumbHeight;    
				}     
			}elseif( $originalHeight > $this->thumbHeight ){// 高 > 设定高度     
				$thumbHeight = $this->thumbHeight;       
				$thumbWidth = $this->thumbHeight * ( $originalWidth /  $originalHeight );      
				if($thumbWidth > $this->thumbWidth){// 宽 > 设定宽度       
				$thumbHeight = $this->thumbWidth * ( $thumbHeight /  $thumbWidth );       
				$thumbWidth = $this->thumbWidth;    
				}     
			}     
			if ($thumbWidth == 0) $thumbWidth = 1;     
			if ($thumbHeight == 0) $thumbHeight = 1;     
			$createdThumb = imagecreatetruecolor($thumbWidth, $thumbHeight);     
			if ( !$createdThumb ) {$this->errno = 20; return false;}     
			if ( !imagecopyresampled($createdThumb, $Original, 0, 0, 0, 0,$thumbWidth, $thumbHeight, $originalWidth, $originalHeight) ) {
				$this->errno = 21; return false;}     
				if (!$SaveFunction($createdThumb,$this->thumbsavePath.$this->thumbPrefix.$this->saveName) ){
				$this->errno = 22; return false;
				}    
			 }   
			}  
			 // 删除临时文件 
			/* if(!@$this->del($fileArray["tmp_name"])){    
			 	return false;   
			}*/
			return true;  
		}   
		
		// 文件格式检查,MIME检测  
		function validateFormat(){   
			if(!is_array($this->fileFormat)|| in_array(strtolower($this->ext), $this->fileFormat)|| in_array(strtolower($this->returninfo['type']), $this->fileFormat) ){
			    return true;
			}else{
			     return false;  
			}
		}  
		// 获取文件扩展名
		// @param $fileName 上传文件的原文件名  
		function getExt($fileName){   
			$ext = explode(".", $fileName);   
			$ext = $ext[count($ext) - 1];   
			$this->ext = strtolower($ext);  
		}   
		// 设置上传文件的最大字节限制  
		// @param $maxSize 文件大小(kb) 0:表示无限制
		function setMaxsize($maxSize){   
			$this->maxSize = $maxSize*1024;  
		} 
		
		// 设置文件格式限定  
		// @param $fileFormat 文件格式数组  
		function setFileformat($fileFormat){   
			if(is_array($fileFormat)){
			$this->fileFormat = $fileFormat;
			}  
		}  
		
		// 设置覆盖模式  
		// @param overwrite 覆盖模式 1:允许覆盖 0:禁止覆盖  
		function setOverwrite($overwrite){   
			$this->overwrite = $overwrite;  
		}   
		
		 // 设置保存路径
		 // @param $savePath 文件保存路径：以 "/" 结尾，若没有 "/"，则补上  
		function setSavepath($savePath){   
		 	$this->filePath = substr( str_replace("\\","/", $savePath) , -1) == "/"    ? $savePath : $savePath."/";
		 	//$this->filePath='/'.$this->filePath;
			$this->savePath=$_SERVER['DOCUMENT_ROOT'].'/'.ltrim($this->filePath,'/');
		} 
		
		// 设置缩略图 
		// @param $thumb = 1 产生缩略图 $thumbWidth,$thumbHeight 是缩略图的宽和高  
		function setThumb($thumb, $thumbWidth = 0,$thumbHeight = 0){   
			$this->thumb = $thumb;   
			if($thumbWidth) $this->thumbWidth = $thumbWidth;   
			if($thumbHeight) $this->thumbHeight = $thumbHeight;  
		}   
		
		// 设置文件保存名  
		// @param $saveName 保存名，如果为空，则系统自动生成一个随机的文件名  
		function setSavename($saveName){   
			if ($saveName == ''){  // 如果未设置文件名，则生成一个随机文件名    
				$name = date('YmdHis')."_".rand(100,999).'.'.$this->ext;   
			} else {    
				$name = $saveName;   
				}   
				$this->saveName = $name;  
			}   
			
			// 删除文件 
			// @param $fileName 所要删除的文件名
		function del($fileName){   
			if(!@unlink($fileName)){    
				$this->errno = 15;    
				return false;   
			}   
			return true;  
		}   
		
		// 返回上传文件的信息  
		function getInfo(){   
			return $this->returnArray;  
		}   
		
		// 得到错误信息  
		function errmsg(){   
			$uploadClassError = array(0 =>'没有错误,文件上传成功！',1 =>'上传文件过大！',2 =>'上传文件超过最大限定！',3 =>'上传文件只是部分上传！ ',4 =>'没有上传文件！', 6 =>'缺少一个临时文件夹！',    7 =>'未能将文件写入磁盘！ ',    10 =>'输入的名字不可用！',    11 =>'上传的文件格式不正确！',    12 =>'目录不可写！',    13 =>'文件已经存在！',    14 =>'文件太大了！',    15 =>'删除文件失败！',    16 =>'您的PHP版本似乎没有GIF thumbnailing支持！',    17 =>'您的PHP版本似乎没有JPEG thumbnailing支持！',    18 =>'您的PHP版本似乎并没有照片thumbnailing支持！',    19 =>'试图复制源图像时发生错误      您的php版本 ('.phpversion().') 可能没有这张图片类型的支持',    20 =>'试图创建一个新的形象发生错误',    21 =>'复制源图像的缩略图时发生错误',    22 =>'一个错误发生而缩略图图像保存到文件系统。你确定PHP配置了读写访问这个文件夹吗?',    );   
			if ($this->errno == 0)    return false;   
			else    
			return $uploadClassError[$this->errno];  
		} 
	} 
?>   