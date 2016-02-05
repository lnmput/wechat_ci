<?php 
 /**
  * 主类
  * @ author yangzie1192@163.com
  */
class SAE_controller extends CI_Controller{
		public $fromusername;  //发信人
		public $tousername;    //收信人
		public $msgtype;       //消息类型
		public $event;         //事件类型
    /*
     * 构造方法，用于初始化一些CI功能调用，站点编码，错误调试
     */
	public function __construct(){
		parent::__construct();
		$this->load->config('wechatconfig');
		$this->load->database();
		$this->load->library('session');		
		$this->load->helper('url');	
		$this->load->helper('common');	
		$this->load->helper('menu'); 
		//自定义错误消息回复
		if(!! $this->config->item('debug')){
		   set_error_handler("errorHandler");
		}
		ignore_user_abort(true);
		//set_time_limit(0);//SAE不支持
		date_default_timezone_set('PRC');//'Asia/Shanghai' 
		//页面编码
		header("Content-type: text/html; charset=utf-8");
 	}
 	
   /*
    * 根据不同类型的消息调用不同的子类方法实现消息的发送
    */
 	public function run() {
 		$moreRequestMessage =getMoreRequestMessage();
 		$this->fromusername       =$moreRequestMessage["fromusername"];
 		$this->tousername         =$moreRequestMessage["tousername"];
 		$this->msgtype            =$moreRequestMessage["msgtype"];
 		//是否开启菜单
 		if(!! $this->config->item("ismenu")){
 			$access_token =get_access_token();
 			createmenu($access_token);
 		}
 		//判断消息类型
 		switch ($this->msgtype) {
 			case 'event':
       		//判断事件类型
 				$this->event=$moreRequestMessage["event"];
 				
 				$this->handleEventMessage($this->event);
 	     
 				break;
 	
 			case 'text':
 				$keyMessage=getKeyRequestTextMessage();
 				$content=$keyMessage['content'];
 				$this->responseTextMessage($content);
 				break;
 	
 			case 'image':
 				$keyMessage=getKeyRequestImageMessage();
 				$picurl=$keyMessage['picurl'];
 				$mediaid=$keyMessage['mediaid'];
 				$this->responseImageMessage($picurl,$mediaid);
 				break;
 	
 			case 'location':
 				$keyMessage=getKeyRequestLocationMessage();
 				$location_x=$keyMessage['location_x'];
 				$location_y=$keyMessage['location_y'];
 				$scale=$keyMessage['scale'];
 				$label=$keyMessage['label'];
 				$this->responseLocationMessage($location_x,$location_y,$scale,$label);
 				break;
 	
 			case 'link':
 				$keyMessage=getKeyRequestLinkMessage();
 				$title=$keyMessage['title'];
 				$description=$keyMessage['description'];
 				$url=$keyMessage['url'];
 				$this->responseLinkMessage($title,$description,$url);
 				break;
 	
 			case 'voice':
 				$keyMessage=getKeyRequestVoiceMessage();
 				$mediaid=$keyMessage['mediaid'];
 				$format=$keyMessage['format'];
 				$this->responseVoiceMessage($mediaid,$format);
 				break;
 	
 			default:
 				$this->responseUnknownMessage();
 				break;
 	
 		}
 	}
 	
 	
/*
 * 处理各种不同类型的事件消息
 * @关注事件
 * @取消关注事件
 * @扫描带参数二维码事件
 * @上报地理位置事件
 * @自定义菜单事件(需要另做判断处理)
 */
 public function handleEventMessage($event){
 	  switch ($event) {
 	        //关注事件
 			case 'subscribe':
 			    $this->responseSubscribeEvent();
 				break;
 	        //取消关注事件
 			case 'unsubscribe':
 				$this->responseUnsubscribeEvent();
 				break;
 	        //二维码扫描
 			case 'SCAN':
 				$this->onScan();
 				break;
 	        //地理位置上报
 			case 'LOCATION':
 				//$this->onEventLocation();
 				//testSendMessage($fromusername,$tousername);
 				break;
 	        //菜单点击
 			case 'CLICK':
                //获得被点击菜单的Eventkey
 				$keyMessage=getKeyRequestClickMessage();
 				$eventKey=$keyMessage['eventkey'];
 				//根据不同类型的Eventkey,做不同的处理
 				$this->responseClickMenuEvent($eventKey);
 				break;
 		}
 	}

 	
 	
/*------------------------------------第一类---------------------------------------
 * 向用户发送不同类型的消息
 * 具体方法由common_helper.php中的函数实现
 * 直接调用common_helper.php中的函数
 * 该方法在ceshi.php中调用
 *--------------------------------------------------------------------------- 
 */
/*
* 向用户发送普通文本消息
* @parma $content
* 要发送的文本内容
 */
public function sendTextMessage($content){		 
   sendTextMessage($this->fromusername,$this->tousername,$content);
}
 	
/*
* 向用户发送图片消息
* @parma $mediaid
*/
public function sendImageMessage($mediaid){
   sendImageMessage($this->fromusername, $this->tousername,$mediaid);
}
/*
* 向用户发送语音消息
* @parma $mediaid
*/
public function sendVoiceMessage($mediaid){
   sendVoiceMessage($this->fromusername, $this->tousername,$mediaid);
}
/*
* 向用户发送图文消息
*/
public function sendImageTextMessage(){
   sendImageTextMessage($this->fromusername,$this->tousername);
}
/*
* 回复视频消息
* 功能未实现
*/
public function sendVideoMessage(){}
/*
* 回复音乐消息
* 功能未实现
*/
public function sendMusicMessage(){}
 		
 

/*
 * ----------------------------------第一类结束-----------------------------------------
 */


/*------------------------------第二类---------------------------------------------
 * 以下方法均在子类ceshi.php中实现
 * 调用第一类中的方法做出相应的反映
 * 用于响应不同类型的消息
 * 以及对消息的内容做出判断
 * 向用户发送视频，音乐消息功能未实现
 * 传入的参数可以用来做判断，也可以放弃不用
 * --------------------------------------------------------------------------
 */
 //用于对用户的普通文本消息做出回复
 //传入参数为用户发送来的文本消息内容
 //主要用来对针对不同的关键词进行不同的回复
 //可以使用，也可以不使用
 public function responseTextMessage($content){}
 //响应用户发送的图片消息
 //默认传入参数为用户发送图片的URL和MediaId
 //可以使用，也可以不使用
 public function responseImageMessage($picurl,$mediaid){}
 //响应用户的语音消息
 //默认传入参数MediaId和Format，即格式
 public function responseVoiceMessage($mediaid,$format){}
 //响应用户视频消息
 public function responseVideoMessage(){}
 // 响应用户位置消息
 //默认传入参数，经度，纬度，缩放，位置信息
 public function responseLocationMessage($location_x,$location_y,$scale,$label){}
//响应用户链接消息
//默认传入参数标题，描述，连接URL
 public function responseLinkMessage($title,$description,$url){}
//响应用户关注事件
//我默认参数
 public function responseSubscribeEvent(){}
//响应用户取消关注事件
//我默认参数
public function responseUnsubscribeEvent(){}
//响应用户点击菜单事件
//传入参数为EventKey
//需要使用者用switch...case结构实现
public function responseClickMenuEvent($eventKey){}
//响应用户的未知消息，主要是一些特殊的表情
//我默认传入参数
public function responseUnknownMessage(){}
/*
 * ----------------------------------第二类结束-----------------------------------------
*/
}
?>