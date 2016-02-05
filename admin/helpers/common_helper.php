<?php
/**
 * 公共函数库
 */
/*
 * --------------------start  接入验证-------------------------
 */

  function valid_link(){
  	$CI =& get_instance();
  	$token=$CI->config->item('token');
	if (! validateSignature($token)) {
		exit('签名验证失败');
	}
	
	if (isValid()) {
		// 网址接入验证
		exit($_GET['echostr']);
	}
	
	if (!isset($GLOBALS['HTTP_RAW_POST_DATA'])) {
		exit('缺少数据');
	}
	
}




/**
 * 判断此次请求是否为验证请求
 *
 * @return boolean
 */
function isValid() {
	return isset($_GET['echostr']);
}

/**
 * 验证此次请求的签名信息
 *
 * @param  string $token 验证信息
 * @return boolean
 */
function validateSignature($token) {
	if ( ! (isset($_GET['signature']) && isset($_GET['timestamp']) && isset($_GET['nonce']))) {
		return FALSE;
	}

	$signature = $_GET['signature'];
	$timestamp = $_GET['timestamp'];
	$nonce = $_GET['nonce'];

	$signatureArray = array($token, $timestamp, $nonce);
	sort($signatureArray,SORT_STRING);

	return sha1(implode($signatureArray)) == $signature;
}
/*
 * ------------------------ end 接入验证-------------------------
*/

/*
 * 获得解析后的用户消息
 * 将数组的所有的 KEY 都转换为小写
 */
function getRequestMessage(){
	$xml = (array) simplexml_load_string($GLOBALS['HTTP_RAW_POST_DATA'], 'SimpleXMLElement', LIBXML_NOCDATA);
	return  array_change_key_case($xml);
}
/*
 * 获得用户消息中的某一具体值
 * @parma $parma 消息参数
 */
function getRequest($param = FALSE) {
	$requestMessage=getRequestMessage();
	if ($param === FALSE) {
		return $requestMessage;
	}
	$param = strtolower($param);
	if (isset($requestMessage[$param])) {
		return $requestMessage[$param];
	}
	return NULL;
}
/*
 * 
 * 获得消息的基本参数
 * @parma fromusername
 * @parma tousername
 * @parma msgtype
 * @parma event
 * @return array
 */
function getMoreRequestMessage(){
	
	$arrayMessage=array(
 	 		"fromusername"=>getRequest('fromusername'),
 	 		"tousername"=>getRequest('tousername'),
 	 		"msgtype"=>getRequest('msgtype')
 	 		);
	if($arrayMessage['msgtype']=="event"){
		$arrayMessage["event"]=getRequest('event');
	}
	return $arrayMessage;
 }
 
/*
 * 获得文字消息的关键参数
 * @parma Content
 * @parma MsgId
 */
 
 function getKeyRequestTextMessage(){
 	
 	return array(
 			'content'=>getRequest('content'),
 			'msgid'=>getRequest('msgid')
 			);
 }

/*
 * 获得图片消息的关键参数
 * @parma PicUrl
 * @parma MediaId
 * @parma MsgId
 */
function getKeyRequestImageMessage(){
	  return array(
	  		"picurl"=>getRequest('picurl'),
	  		"mediaid"=>getRequest('mediaid'),
	  		'msgid'=>getRequest('msgid')
	  		);
}
/*
 * 获得地理位置消息的关键参数
 * @parma Location_X
 * @parma Location_Y]
 * @parma Scale
 * @parma Label
 * @parma MsgId
 */
function getKeyRequestLocationMessage(){
	return array(
			"location_x"=>getRequest('location_x'),
			"location_y"=>getRequest('location_y'),
			"scale"=>getRequest('scale'),
			"label"=>getRequest('label'),
			'msgid'=>getRequest('msgid')
			);
}
/*
 * 获得点击菜单消息的关键参数
 * @parma EventKey
 */
function getKeyRequestClickMessage(){
	return array(
			  "eventkey"=>getRequest('eventKey')
			);
}

/*
 * 获得语音消息的关键参数
 * @parma mediaid
 * @parma format
 * @parma msgid
 */
function getKeyRequestVoiceMessage(){
	return array(
			"mediaid"=>getRequest('mediaid'),
			"format"=>getRequest('format'),
			"msgid"=>getRequest('msgid')
			);
}

/*
* 获得视频消息的关键参数
*@parma mediaid
*@parma thumbmediaId
*@parma msgid
*/
function getKeyRequestVideoMessage(){
	return array(
			"mediaid"=>getRequest('mediaid'),
			"thumbmediaId"=>getRequest('thumbmediaId'),
			"msgid"=>getRequest('msgid')
	);
}

/*
 * 获得链接消息的关键参数
 * @parma title
 * @parma description
 * @parma url
 * @parma msgid
 */

function getKeyRequestLinkMessage(){
	return array(
			"title"=>getRequest('title'),
			"description"=>getRequest('description'),
			"url"=>getRequest('url'),
			"msgid"=>getRequest('msgid')
	);
}








/*
 * 回复普通文本消息函数
 * 需要参数：$fromusername,$tousername,$content(文本内容)
 */
function sendTextMessage($fromusername,$tousername,$content){
	$tpl="<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
	$resultStr = sprintf($tpl, $fromusername, $tousername, time(),$content);
	echo $resultStr;
}
	
/*
 * 回复图片消息
 * 需要参数：$fromusername, $tousername,$mediaid
 */
function sendImageMessage($fromusername, $tousername,$mediaid){
   $tpl="<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
<Image>
<MediaId><![CDATA[%s]]></MediaId>
</Image>
</xml>";
   
   $resultStr = sprintf($tpl, $fromusername, $tousername, time(),$mediaid);
   echo $resultStr;
}
	
//3 回复语音消息
 function sendVoiceMessage($fromusername, $tousername,$mediaid){
	$tpl="<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
<Voice>
<MediaId><![CDATA[%s]]></MediaId>
</Voice>
</xml>";
	
	$resultStr = sprintf($tpl, $fromusername, $tousername, time(),$mediaid);
	echo $resultStr;
	
	
}
	
//4 回复视频消息
 function sendVideoMessage(){
		
}
	
//5 回复音乐消息
function sendMusicMessage(){
		
}
	


/*
 * 回复图文消息
 * 所需参数：
 * @parma $fromusername
 * @parma $tousername
 * @parma $articlevount 消息个数，这里暂时默认为2个
 * @parma $picurl  图片链接
 * @parma $title   图文消息标题
 * @parma $description  消息描述
 * @parma $url  消息跳转链接,非必须，可选
 * @parma 
 * @parma 
 */
function sendImageTextMessage($fromusername,$tousername){
	$arr=array(
			array(
					"Title"=>"标题一",
					"Description"=>"我是标题一",
					"PicUrl"=>"http://i11.topit.me/l/201001/13/12633542334766.jpg",
					"Url"=>"http://www.baidu.com"
					
					),
			array(
					"Title"=>"标题二",
					"Description"=>"我是标题二",
					"PicUrl"=>"http://i11.topit.me/l/201001/13/12633542334766.jpg",
					"Url"=>"http://www.qq.com"
			
			),
			array(
					"Title"=>"标题三",
					"Description"=>"我是标题三",
					"PicUrl"=>"http://i11.topit.me/l/201001/13/12633542334766.jpg",
					"Url"=>"http://www.yangguoqi.com"
			)
	    );
	//解析数组
	
  //图文消息的个数
  $articlecount=count($arr);
  $tpl_content="";
  $i=0;
  while($i<$articlecount){
  	$tpl_content.=<<<tpl
<item>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
tpl;
  	$i++;
  }
  
  
  $tpl_start=<<<tpl
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
tpl;
  $tpl_end=<<<tpl
</Articles>
</xml>
tpl;
  
  
  
$tpl=$tpl_start.$tpl_content.$tpl_end;

	$resultStr = sprintf($tpl, 
			$fromusername,
			 $tousername,
			 time(),
			 $articlecount,
			// arrToStr($arr)
	        "标题二",
			"woshibiaotie",
			"http://i11.topit.me/l/201001/13/12633542334766.jpg",
			"http://www.baidu.com",
			"标题二",
			"woshibiaotie",
			"http://i11.topit.me/l/201001/13/12633542334766.jpg",
			"http://www.baidu.com",
			"标题二",
			"woshibiaotie",
			"http://i11.topit.me/l/201001/13/12633542334766.jpg",
			"http://www.baidu.com"
			
			);
	echo $resultStr;
}



/**
 * 自定义的错误处理函数，将 PHP 错误通过文本消息回复显示
 * @param  int $level   错误代码
 * @param  string $msg  错误内容
 * @param  string $file 产生错误的文件
 * @param  int $line    产生错误的行数
 * @return void
 */
 function errorHandler($level, $msg, $file, $line) {
	$error_type = array(
			// E_ERROR             => 'Error',
			E_WARNING           => 'Warning',
			// E_PARSE             => 'Parse Error',
			E_NOTICE            => 'Notice',
			// E_CORE_ERROR        => 'Core Error',
			// E_CORE_WARNING      => 'Core Warning',
			// E_COMPILE_ERROR     => 'Compile Error',
			// E_COMPILE_WARNING   => 'Compile Warning',
			E_USER_ERROR        => 'User Error',
			E_USER_WARNING      => 'User Warning',
			E_USER_NOTICE       => 'User Notice',
			E_STRICT            => 'Strict',
			E_RECOVERABLE_ERROR => 'Recoverable Error',
			E_DEPRECATED        => 'Deprecated',
			E_USER_DEPRECATED   => 'User Deprecated',
	);
	$moreRequestMessage =getMoreRequestMessage();
	$fromusername       =$moreRequestMessage["fromusername"];
	$tousername         =$moreRequestMessage["tousername"];
	$errorMessage="PHP报错了：\n".$error_type[$level].":\n".$msg."\nFILE:\n".$file."\nLINE:\n".$line;
	sendTextMessage($fromusername,$tousername,$errorMessage);

}

/*
 * 二维数组转字符串
 * @return 
 */

function arrToStr ($array)
{
	// 定义存储所有字符串的数组
	static $r_arr = array();
	if (is_array($array)) {
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				arrToStr($value);
			} else {
					$r_arr[] = '"'.$value.'"';
			}
		}
	} else if (is_string($array)) {
		$r_arr[] = $array;
	}
	$string = implode(",", $r_arr);

	echo  $string;
}

/*
 * 邮件发送
 * @parma $toemail
 * @parma $object
 * @parma $message
 * 反悔发送状态 成功/失败
 * 
 */
function sendEmail($toemail,$object,$message){
	$CI =& get_instance();
	$CI->load->library('email');      
	$CI->email->from($CI->config->item("fromemail"));
	$CI->email->to($toemail);
	$CI->email->subject($object);
	$CI->email->message($message);
   if($CI->email->send()){
   	  return TRUE;
    }else{
    	return FALSE;
    }
}

















/*
 * 测试发送普通消息函数
 */


function testSendMessage($fromuser,$touser,$con){
	$time=time();
	$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
	
	$resultStr = sprintf($textTpl, $fromuser, $touser, $time,$con);
	echo $resultStr;
	
}

?>