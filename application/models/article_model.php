<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Article_model extends CI_Model{

	public function getarticles($perpage,$offset,$genreid = '0',$yearid = '0'){

		if($genreid == '0' && $yearid == '0' ){

			// return '1';

			return $this->db->limit($perpage, $offset)->order_by('createtime', 'desc')->get('article_list')->result_array();
		}

		if($genreid == '0' ){

			// return '2';
			return $this->db->limit($perpage, $offset)->order_by('createtime', 'desc')->get_where('article_list', array('yearid' => $yearid))->result_array();
		}

		if($yearid=='0' ){

			// return '3';
			return $this->db->limit($perpage, $offset)->order_by('createtime', 'desc')->get_where('article_list', array('genreid'=>$genreid))->result_array();
		}

		// return $genre . "gg" . $year;

		return $this->db->limit($perpage, $offset)->order_by('createtime', 'desc')->get_where('article_list', array('genreid'=>$genreid,'yearid' => $yearid))->result_array();
	}

		public function getarticlesrows($genreid = '0',$yearid = '0'){

		if($genreid == '0' && $yearid == '0' ){

			// return '1';

			return $this->db->count_all_results('article_list');
		}

		if($genreid == '0' ){

			// return '2';
			return $this->db->where( array('yearid' => $yearid))->count_all_results('article_list');
		}

		if($yearid=='0' ){

			// return '3';
			return $this->db->where( array('genreid'=>$genreid))->count_all_results('article_list');
		}

		// return $genre . "gg" . $year;

		return $this->db->where(array('genreid'=>$genreid,'yearid' => $yearid))->count_all_results('article_list');
	}


}