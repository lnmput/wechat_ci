<?php 
/**
 * 自定义配置文件
 */
//自定义token值
$config['token'] = 'weixin';

//是否开启错误调试，默认开启
$config['debug']=TRUE;

//是否开启自定义菜单，默认关闭
$config['ismenu']=FALSE;
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
							'name' => urlencode ( "全时测试" ),
							'sub_button' => array (
									array (
											'name' => urlencode ( "报名培训" ),
											'type' => 'view',
                                        'url' => 'http://www.baidu.com' 
									),
									array (
											'name' => urlencode ( "帐号申请" ),
											'type' => 'view',
											'key' => 'max.quanshi.com/www/wechat/showview/apply' 
									),
                                    array (
											'name' => urlencode ( "帐号查询" ),
											'type' => 'view',
											'key' => 'max.quanshi.com/www/wechat/showview/query' 
									) 
							) 
					),
					array (
							'name' => urlencode ( "等一分钟" ),
							'sub_button' => array (
									array (
											'name' => urlencode ( "孤独患者" ),
											'type' => 'view',
											'url' => 'http://www.baidu.com' 
									),
									array (
											'name' => urlencode ( "好久不见" ),
											'type' => 'click',
											'key' => 'CLICK_TWO' 
									) 
							) 
					),
					array (
							'name' => urlencode ( "不够成熟" ),
							'sub_button' => array (
									array (
											'name' => urlencode ( "画地为牢" ),
											'type' => 'click',
											'key' => 'CLICK_MESSAGE' 
									),
									array (
											'name' => urlencode ( "并非故意" ),
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

//自定义图文消息
$config['arr']=array(
		array(
				"title"=>"关于爱情",
				"description"=>"测试消息",
				"picurl"=>"http://wechat1192.qiniudn.com/1.jpg",
				"url"=>"http://happy.lenovo-idea.com/act/2014_Qixi/?from=groupmessage&isappinstalled=0#rd"
			
		),
		array(
				"title"=>"百度以下",
				"description"=>"我是标题二",
				"picurl"=>"http://wechat1192.qiniudn.com/2.jpg",
				"url"=>"http://www.baidu.com"
		
		),
		array(
				"title"=>"给我留言",
				"description"=>"我是标题三",
				"picurl"=>"http://wechat1192.qiniudn.com/3.jpg",
				"url"=>"http://sexapp.sinaapp.com/index.php/jumplink/gotoleavemessage"
		)
);
//可以定义多组图文消息，发送的时候加载不同的结构就可以了
$config['arr1']=array(
		array(
				"title"=>"标题一",
				"description"=>"我是标题一",
				"picurl"=>"http://wechat1192.qiniudn.com/1.jpg",
				"url"=>"http://www.baidu.com"
		
		),
		array(
				"title"=>"标题二",
				"description"=>"我是标题二",
				"picurl"=>"http://wechat1192.qiniudn.com/2.jpg",
				"url"=>"http://www.qq.com"

		),
		array(
				"title"=>"标题三",
				"description"=>"我是标题三",
				"picurl"=>"http://wechat1192.qiniudn.com/3.jpg",
				"url"=>"http://www.yangguoqi.com"
		)
);
//这里只有一条
$config['arr2']=array(
		array(
				"title"=>"测试文件",
				"description"=>"两个人的努力",
				"picurl"=>"http://wechat1192.qiniudn.com/1.jpg",
				"url"=>"http://1.webapp1192.sinaapp.com/baoming.html"
		
		)
);





?>