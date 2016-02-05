<?php 
/**
 * 用于回复的文本消息类型
 */
include 'wechat.php';
class TextResponse extends WechatResponse {

	protected $content;

	public function __construct($toUserName, $fromUserName, $content, $funcFlag = 0) {
		parent::__construct($toUserName, $fromUserName, $funcFlag);

		$this->content = $content;
		$this->template = <<<XML
<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[text]]></MsgType>
  <Content><![CDATA[%s]]></Content>
  <FuncFlag>%s</FuncFlag>
</xml>
XML;
	}

	public function __toString() {
		return sprintf($this->template,
				$this->toUserName,
				$this->fromUserName,
				time(),
				$this->content,
				$this->funcFlag
		);
	}

}
?>