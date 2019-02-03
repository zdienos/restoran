<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('login')){
			redirect('error/error_401','refresh');
		}
		if ($this->session->userdata('user_id_level') != 1) {
			redirect('error/error_403','refresh');
		}
		$this->load->library('form_validation');
		$this->load->model('m_user','user');
	}

	public function index()
	{
		$data['view'] = 'page/user/index';	
		$data['dataAll'] = $this->user->getAll();
		$data['judul'] = "<h2>User</h2>";
		$data['data_level'] = $this->user->getlevel();
		$data['validation'] = 'validation';
		$data['active'] = array(
			0 => 'Not Active', 
			1 => 'Active', 
		);
		$this->load->view('layout/index', $data);
		
	}

	public function add()
	{		
		if(isset($_POST) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->user->rules());
			$this->form_validation->set_message('checkUsername','Username Sudah Dipakai');			
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = $this->user->error_msg();
			}else{
				$object = array(	
					'active' => 1,
					'nama_user' => $this->input->post('nama_user',true),		      	
					'password' => md5($this->input->post('password',true)),		      	
					'username' => $this->input->post('username',true),
					'id_level' => $this->input->post('id_level',true), 
				);
				$this->user->add($object);
				$data['success'] = true;
				$data['redirect'] = 'user';
			}
			echo json_encode($data);
		}else{
			redirect('user','refresh');
		}
	}

	public function edit_data($id)
	{
		$data = $this->user->getById($id);
		echo json_encode($data);
	}

	public function ubah()
	{		
		if(isset($_POST['id_level']) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->user->rulesEdit());
			$this->form_validation->set_message('checkUsername','Username Sudah Dipakai');			
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = $this->user->error_msg();
			}else{
				$object = array(		      	
					'nama_user' => $this->input->post('nama_user',true),		      	
					'password' => $this->input->post('password',true),		      	
					'username' => $this->input->post('username',true),
					'id_level' => $this->input->post('id_level',true), 
					'active' => $this->input->post('active',true)
				);
				$this->user->update($object,$this->input->post('id_user'));
				$data['success'] = true;
				$data['redirect'] = 'user';
			}
			echo json_encode($data);
		}else{
			redirect('user','refresh');
		}
	}

	public function delete($id)
	{		
		if ($this->user->delete($id)) {						
			redirect('user/index','refresh');
		}else{
			echo '<script>alert("Data tidak dapat dihapus");</script>';
			redirect('user','refresh');
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

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */