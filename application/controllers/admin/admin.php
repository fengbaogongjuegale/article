<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 后台默认控制器
 */
class Admin extends CI_Controller{

	public function index(){

		

		$this->load->view('admin/header.html');
		$this->load->view('admin/index.html');
		$this->load->view('admin/footer.html');


	}

	public function arlist(){

		//载入分页类
		$this->load->library('pagination');

		$perPage = 3;

		//配置项设置
		$config['base_url'] = site_url('admin/admin/arlist');
		$config['total_rows'] = $this->db->count_all_results('article_list');
		$config['per_page'] = $perPage;
		$config['uri_segment'] = 4;
		$config['cur_tag_open'] = '<li><a class = "active" >';
		$config['cur_tag_close'] = '</a></li>';
		$config['first_link'] = '第一页';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '上一页';
		$config['next_link'] = '下一页';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_link'] = '最后一页';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$data['links'] = $this->pagination->create_links();

		// print_r($data);die;

		$offset = $this->uri->segment(4);
		
		$this->load->model('admin_model','admin');

		$data['articles'] = $this->admin->getlist($perPage,$offset);		

		if((bool)$data){
			$this->load->view('admin/header.html',$data);
			$this->load->view('admin/article_list.html');
			$this->load->view('admin/footer.html');
		}else{
			redirect('admin/admin/index');
		}



		
	}

	public function publish(){

		$data = $this->input->post();

		// if($data){
		// 	print_r($data);die;
		// }

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', '标题', 'required',array('required' => '%s 不能为空 '));
        $this->form_validation->set_rules('author', '作者', 'required',
            array('required' => '%s 不能为空 .')
        );
        $this->form_validation->set_rules('year', '年级', 'required|greater_than[0]',
            array('greater_than' => '请选择 %s.'));
        $this->form_validation->set_rules('genre', '体裁', 'required|greater_than[0]',
            array('greater_than' => '请选择 %s.'));

        $this->form_validation->set_rules('content', '内容', 'required|min_length[3]',
            array('required' => ' %s 不能为空','min_length' => '%s不能少与100字')
        );

        $data['isSussess'] = false;
		if ($this->form_validation->run() == FALSE)
		{
			// $this->load->view('myform');
			
			$this->load->view('admin/header.html',$data);
			$this->load->view('admin/article_publish.html');
			$this->load->view('admin/footer.html');
		}
		else
		{
			
			// var_dump($data);
			// die;
			$this->load->model('admin_model','admin');

			$idata['title'] = $data['title'];
			$idata['authorid'] = 0;
			$idata['yearid'] = $data['year'];
			$idata['genreid'] = $data['genre'];
			$idata['content'] = $data['content'];

			
			if($this->admin->add_article($idata)){
				$data['isSussess'] = true;
			}

			$this->load->view('admin/header.html',$data);
			$this->load->view('admin/article_publish.html');
			$this->load->view('admin/footer.html');


		}


		
	}

	public function conman(){
		$this->load->view('admin/header.html');
		$this->load->view('admin/contribution_manage.html');
		$this->load->view('admin/footer.html');
	}


}