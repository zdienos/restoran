<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');		
		$this->load->model('m_daftar','user');
	}

	public function index()
	{		
		if (!$this->session->userdata('login')) {
			$data['validation'] = 'validation';
			$data['action'] = base_url()."login/validate";
			$this->load->view('page/login/index',$data);	
		}else{
			redirect('home','refresh');
		}
	}

	public function validate()
	{
		if(isset($_POST) && count($_POST) > 0){	
			$this->form_validation->set_rules($this->user->rules());		
			if (!$this->form_validation->run()) {
				$data['error']=true;
				$data['error_msg']=$this->user->error_msg();
			} else {
				if ($this->user->get_login()->num_rows()) {
					$data_user = $this->user->get_login()->row();
					$array = array(
						'login' => TRUE,
						'user_id_user' => $data_user->id_user,
						'user_username' => $data_user->username,
						'user_password' => $data_user->password,
						'user_nama_user' => $data_user->nama_user,						
						'user_id_level' => $data_user->id_level,
					);			
					$this->session->set_userdata( $array );
					$data['redirect'] = 'home';
					$data['success'] = true;
				}else{
					$data['false']=true;
					$data['false_msg']='Username/Password Salah';
				}
			}
			echo json_encode($data);
		}
	}

	public function logout()
	{
		$array = array(
			'login' => FALSE,
			'user_id_user' => '',
			'user_username' => '',
			'user_nama_user' => '',
			'user_email' => '',						
			'user_id_level' => '',
		);			
		$this->session->set_userdata( $array );	
		redirect('login','refresh');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */