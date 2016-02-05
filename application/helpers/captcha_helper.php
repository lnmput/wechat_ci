<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter CAPTCHA Helper For SAE
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		@��ҹ��KeN
 * @link		http://apidoc.sinaapp.com/sae/SaeVCode.html
 */

// ------------------------------------------------------------------------

/**
 * Create CAPTCHA In SAE
 * SAEԭ��Vcode����
 * Ĭ����֤���ɴ�д��ĸ���������. ��������ִ�Сд, ��Ҫ��У��ʱ, �ֶ�ת���ύ����֤��Ϊ��д
 *
 * @access	public
 * @return	array
 */
if ( ! function_exists('create_captcha'))
{
	function create_captcha()
	{
		$vcode = new SaeVCode();
		if ($vcode === false){
			log_message('error',$vcode->errno().': '.$vcode->errmsg());
		}
		$question = $vcode->question();
		return array('word' => $vcode->answer(), 'image' =>$question['img_url'] );
	}
}

// ------------------------------------------------------------------------

/* End of file captcha_helper.php */
/* Location: ./application/helpers/captcha_helper.php */