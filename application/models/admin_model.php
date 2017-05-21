<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 后台用户管理模型
 */
class Admin_model extends CI_Model{
	/**
	 * 添加文章
	 */
	public function add_article($data){

		return $this->db->insert('article_list',$data);
		
	}

	public function getlist($perpage,$offset){

		return $this->db->select()->limit($perpage, $offset)->order_by('articleid', 'asc')->get('article_list')->result_array();

	}



	/**
	 * 修改密码
	 */
	public function change($uid, $data){
		$this->db->update('admin', $data, array('uid'=>$uid));
	}

	
}