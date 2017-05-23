<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show extends CI_Controller {

	public function index(){

		// echo $this->config->item('year')['1'];die;



		//分类路由处理
		//参数段: /[a年级代号]3/b体裁代号]4/[分页]5

		$yearid = $offset = $this->uri->segment(3);
		$genreid = $offset = $this->uri->segment(4);

		// echo $genreid;
	 //    echo $yearid;

		if(empty($yearid)){
			$yearid = '0';
		}

		if(empty($genreid)){
			$genreid = '0';
		}

		$data['yearid'] = $yearid;
		$data['genreid'] = $genreid;

		//载入分页类
		$this->load->library('pagination');

		$perPage = 2;



		$offset = $this->uri->segment(5);


		$this->load->model('article_model','article');

		// echo $genreid;
	 //    echo $yearid;

		$data['articles'] = $this->article->getarticles($perPage,$offset,$genreid,$yearid);		

		//配置项设置
		$config['base_url'] = site_url('show/index/'.$yearid.'/'.$genreid);
		$config['total_rows'] = $this->article->getarticlesrows($genreid,$yearid);
		$config['per_page'] = $perPage;
		$config['uri_segment'] = 5;
		$config['num_links'] = 4;
		$config['cur_tag_open'] = '<a class = "action" >';
		$config['cur_tag_close'] = '</a>';
		$config['first_link'] = '第一页';
		$config['first_tag_open'] = '';
		$config['first_tag_close'] = '';
		$config['prev_link'] = '上一页';
		$config['next_link'] = '下一页';
		$config['next_tag_open'] = '';
		$config['next_tag_close'] = '';
		$config['last_link'] = '最后一页';
		$config['prev_tag_open'] = '';
		$config['prev_tag_close'] = '';
		$config['last_tag_open'] = '';
		$config['last_tag_close'] = '';
		$config['num_tag_open'] = '';
		$config['num_tag_close'] = '';


		$this->pagination->initialize($config);

		$data['links'] = $this->pagination->create_links();

		// echo '</br>';
		// echo var_dump($data['articles']);die;

	    // echo $genreid;
	    // echo $yearid;

		$this->load->view('index/articlelist.html',$data);	

	}

}