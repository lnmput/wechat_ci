<?php
   class Ceshi extends SAE_Controller{
   	    //初始化
   	    public function __construct(){
   	   	  parent::__construct();
   	   	  //接入验证  	   	  
   	   	  valid_link(); 
   	   	  //调用run方法根据不同的消息类型做出不同的回应
          $this->run();  	  
   	   }
   	   

/*
 * ---------------------------------------------------------------
 * 根据接收到的消息的类型的不同，自定义回复响应消息的类型的类型   	
 * ---------------------------------------------------------------
 */    	   
   	/*
   	 * 响应用户的文字消息
   	 */
    public function responseTextMessage($content){
    	//在此可以自定义响应文字消息，或是图文消息
    	//调用父类的方法并传入适当的参数
    	$this->sendTextMessage($content); 
    	
     }
     
     /*
      * 响应用户的图片消息
      */
    public function responseImageMessage($picurl,$mediaid){
     	
     	$this->sendImageMessage($mediaid);
     	
     	
     }
     
     /*
      * 响应用户的语音消息
      */
     public function responseVoiceMessage($mediaid,$format){
     	
         $this->sendVoiceMessage($mediaid);
     	
     }
     
     /*
      * 响应用户视频消息
      */
     public function responseVideoMessage(){
     	
     }
     /*
      * 响应用户位置消息
      */
     public function responseLocationMessage($location_x,$location_y,$scale,$label){
     	
     	$content=$location_x.'A'.$location_y.'A'.$scale.'A'.$label;
     	
     	$this->sendTextMessage($content);
     }
     /*
      * 响应用户链接消息
      */
     public function responseLinkMessage(){
     	
     }
     
     
     
/*
* 响应用户关注事件
*/
public function responseSubscribeEvent(){
     	
     	$content="欢迎关注";
     	
     	$this->sendTextMessage($content);
     }
     
     
     
          
     /*
      * 响应用户取消关注事件，无法响应
      */
     public function responseUnsubscribeEvent(){
     
     	sendEmail();
     }
     
     //不同菜单点击事件
     public function responseClickMenuEvent($eventKey){
     	
        $flag=sendEmail("yangzie1192@163.com","测试邮件","金叶");
     	   
     	if($flag){
     		$content="邮件发送成功".$eventKey;
     	}else{
     		$content="邮件发送失败".$eventKey;
     	}

     	
     	 
     	$this->sendTextMessage($content);
     }
     
     //响应未知消息
     
     public function responseUnknownMessage(){
     	
     	$this->sendTextMessage("这是神马？");
     	
     }
     
     
     
     
     
     
     
     
     
     
//////////////////////////////////////////////////////

   	   

   	
   	   
   	   
   	   
   	   
   	   
   	   
   	   
   }
?>