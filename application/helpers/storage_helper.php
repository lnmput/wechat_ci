<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Storage Helper For SAE
 *
 * @package		SAE
 * @subpackage	Helpers
 * @category	Helpers
 * @author		@��ҹ��KeN
 * @link		http://apidoc.sinaapp.com/sae/SaeStorage.html
 */
 
// ------------------------------------------------------------------------

/**
 * Delete File in Storage
 * ɾ��Storage���ļ�
 *
 * @access	public
 * @return	bool 
 */
if ( ! function_exists('s_delete'))
{
	function s_delete($filepath)
	{
		$_s = new SaeStorage();  //��ʼ��Storage����
		$_f = _s_get_path($filepath);
		return $_s->delete($_f['domain'], $_f['filename']);
	}
}

// ------------------------------------------------------------------------

/**
 * Get the URL of File in Storage
 * ��ȡStorage���ļ���URL
 *
 * @access	public
 * @return	string 
 */
if ( ! function_exists('s_get_url'))
{
	function s_get_url($filepath)
	{
		$_s = new SaeStorage();  //��ʼ��Storage����
		$_f = _s_get_path($filepath);
		return $_s->getUrl($_f['domain'], $_f['filename']);
	}
}

// ------------------------------------------------------------------------

/**
 * Get the File List by Path in Storage
 * ��ȡStorage���ļ���URL
 *
 * @access	public
 * @return	array 
 */
if ( ! function_exists('s_get_dir_file_info'))
{
	function s_get_dir_file_info($filepath)
	{
		$_s = new SaeStorage();  //��ʼ��Storage����
		$_f = _s_get_path($filepath);
		$_f['filename'] = rtrim($_f['filename'], '/');
		return $_s->getListByPath($_f['domain'], $_f['filename']);
	}
}

// ------------------------------------------------------------------------

/**
 * Check File Exists in Storage
 * ���Storage���Ƿ�����ļ�
 *
 * @access	public
 * @return	bool 
 */
if ( ! function_exists('s_file_exists'))
{
	function s_file_exists($filepath)
	{
		$_s = new SaeStorage();  //��ʼ��Storage����
		$_f = _s_get_path($filepath);
		return $_s->fileExists($_f['domain'], $_f['filename']);
	}
}

// ------------------------------------------------------------------------

/**
 * Read File in Storage
 * ��ȡStorage���ļ�
 *
 * @access	public
 * @return	string 
 */
if ( ! function_exists('s_read'))
{
	function s_read($filepath)
	{
		$_s = new SaeStorage();  //��ʼ��Storage����
		$_f = _s_get_path($filepath);
		return $_s->read($_f['domain'], $_f['filename']);
	}
}

// ------------------------------------------------------------------------
/**
 * Write File in Storage
 * д���ļ���Storage, �����ļ���URL
 *
 * @access	public
 * @return	string 
 */
if ( ! function_exists('s_write'))
{
	function s_write($filepath, $content)
	{
		$_s = new SaeStorage();  //��ʼ��Storage����
		$_f = _s_get_path($filepath);
		return $_s->write($_f['domain'], $_f['filename'], $content);
	}
}

// ------------------------------------------------------------------------
/**
 * analyse the domain and filename of filepath 
 * ����filepath, ��ȡStorage��Ҫ��domain �� filename
 *
 * @access	public
 * @return	array 
 */
if ( ! function_exists('_s_get_path'))
{
	function _s_get_path($path) 
	{
		$s_index = strpos($path, '/');
		return array('domain'=>substr($path,0,$s_index), 'filename'=>substr($path,$s_index+1));
	}
}



// ------------------------------------------------------------------------

/* End of file storage_helper.php */
/* Location: ./application/helpers/storage_helper.php */