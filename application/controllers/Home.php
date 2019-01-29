<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('login')) {
			redirect('login','refresh');
		}
	}

	public function index()
	{
		$data['view'] = 'page/home/index';
		$this->load->view('layout/index',$data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */