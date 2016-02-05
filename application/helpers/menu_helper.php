<?php

define ( 'APP_ID', 'wxea1de0dcc2060868' ); // 改成自己的APPID
define ( 'APP_SECRET', '0517dbebc2dc32c3dff1d370390f77b1' ); // 改成自己的APPSECRET
/*
 * 获取access_token
 */
function get_access_token() {
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . APP_ID . "&secret=" . APP_SECRET;
	$data = json_decode ( file_get_contents ( $url ), true );
	if ($data ['access_token']) {
		return $data ['access_token'];
	} else {
		return "获取access_token错误";
	}
}

/*
 * 创建菜单 @parma $access_token 
 */
function createmenu($access_token) {
	$CI =& get_instance();
	$menu=$CI->config->item('menu');
	$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $access_token;
	$jsondata = urldecode ( json_encode ( $menu ) );
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $jsondata );
	curl_exec ( $ch );
	curl_close ( $ch );
}

/**
 * 查询菜单
 * 
 * @param $access_token 已获取的ACCESS_TOKEN        	
 *
 */
function getmenu($access_token) {
	// code...
	$url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=" . $access_token;
	$data = file_get_contents ( $url );
	return $data;
}
/**
 * 删除菜单
 * 
 * @param $access_token 已获取的ACCESS_TOKEN        	
 *
 */
function delmenu($access_token) {
	// code...
	$url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=" . $access_token;
	$data = json_decode ( file_get_contents ( $url ), true );
	if ($data ['errcode'] == 0) {
		// code...
		return true;
	} else {
		return false;
	}
}

?>