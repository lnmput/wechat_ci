<?php 
/**
 * 自定义配置文件
 */
//自定义token值
$config['token'] = 'weixin';

//是否开启错误调试，默认开启
$config['debug']=TRUE;

//是否开启自定义菜单，默认关闭
$config['ismenu']=TRUE;
//发件人地址
$config['fromemail']='ceshi1192@163.com';

/*
 * 自定义菜单结构
 * ------------特别说明----------------
 * 目前自定义菜单最多包括3个一级菜单
 * 每个一级菜单最多包含5个二级菜单
 * 一级菜单最多4个汉字，二级菜单最多7个汉字
 * 多出来的部分将会以“...”代替
 * 请注意，创建自定义菜单后
 * 由于微信客户端缓存 需要24小时微信客户端才会展现出来
 * 建议测试时可以尝试取消关注公众账号后再次关注
 * 则可以看到创建后的效果
 * 请按照以下格式修改菜单内容 
 * ----------------------------------
 */
$config['menu']= array (
			'button' => array (
					array (
							'name' => urlencode ( "喜欢金叶" ),
							'sub_button' => array (
									array (
											'name' => urlencode ( "链接跳转" ),
											'type' => 'view',
											'url' => 'http://www.baidu.com' 
									),
									array (
											'name' => urlencode ( "点击事件" ),
											'type' => 'click',
											'key' => 'CLICK_ONE' 
									) 
							) 
					),
					array (
							'name' => urlencode ( "一级菜单" ),
							'sub_button' => array (
									array (
											'name' => urlencode ( "链接跳转" ),
											'type' => 'view',
											'url' => 'http://www.baidu.com' 
									),
									array (
											'name' => urlencode ( "点击事件" ),
											'type' => 'click',
											'key' => 'CLICK_TWO' 
									) 
							) 
					),
					array (
							'name' => urlencode ( "一级菜单" ),
							'sub_button' => array (
									array (
											'name' => urlencode ( "链接跳转" ),
											'type' => 'view',
											'url' => 'http://www.baidu.com' 
									),
									array (
											'name' => urlencode ( "点击事件" ),
											'type' => 'click',
											'key' => 'CLICK_THREE' 
									) 
							) 
					) 
			) 
	);
/*
 * ----------------------------------------------------------------------------------------
 */










?>