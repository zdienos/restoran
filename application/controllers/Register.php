<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('m_user','user');
	}

	public function index()
	{
		if (!$this->session->userdata('login')) {
			$data['validation'] = 'validation';			
			$data['data_level'] = $this->user->getLevel();
			$this->load->view('page/register/index',$data);	
		}else{
			redirect('home','refresh');
		}
	}

	public function validate()
	{		
		if(isset($_POST) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->user->rules());
			$this->form_validation->set_message('checkUsername','Username Sudah Dipakai');			
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = $this->user->error_msg();
			}else{
				$object = array(		      	
					'nama_user' => $this->input->post('nama_user',true),		      	
					'password' => md5($this->input->post('password',true)),
					'username' => $this->input->post('username',true),
					'id_level' => $this->input->post('id_level',true), 
				);
				$this->user->add($object);
				$data['success'] = true;
				$data['redirect'] = 'login';
			}
			echo json_encode($data);
		}else{
			redirect('login','refresh');
		}
	}

	public function checkUsername($str)
	{
		$id =  $this->input->post('id_user');
		if ($id) {
			$data_username=$this->db->select('username')->where('id_user',$id)->get('user')->row();
			if ($str == $data_username->username) {
				return true;
			}else{
				$data = $this->db->get_where('user',array('username'=>$str))->num_rows();
				if ($data>0) {
					return false;
				}else{
					return true;
				}
			}
		}else{
			$data = $this->db->get_where('user',array('username'=>$str))->num_rows();
			if ($data>0) {
				return false;
			}else{
				return true;
			}
		}
	}

}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */