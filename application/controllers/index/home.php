<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){

		echo base_url();


		$this->load->view('index/home.html');

	}





}