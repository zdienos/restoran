<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masakan extends CI_Controller {

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
		$this->load->model('m_masakan','masakan');
	}

	public function index()
	{
		$data['view'] = 'page/masakan/index';	
		$data['dataAll'] = $this->masakan->getAll();
		$data['data_status'] = $this->masakan->getStatus();
		$data['judul'] = "<h2>Masakan</h2>";		
		$data['validation'] = 'validation';
		$this->load->view('layout/index', $data);
		
	}

	public function add()
	{		
		if(isset($_POST) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->masakan->rules());			
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = $this->masakan->error_msg();
			}else{
				$object = array(		      	
					'nama_masakan' => $this->input->post('nama_masakan',true),		      	
					'harga' => $this->input->post('harga',true),		      	
					'status' => $this->input->post('status',true),		      	
				);
				$this->masakan->add($object);
				$data['success'] = true;
				$data['redirect'] = 'masakan';
			}
			echo json_encode($data);
		}else{
			redirect('masakan','refresh');
		}
	}

	public function edit_data($id)
	{
		$data = $this->masakan->getById($id);
		echo json_encode($data);
	}

	public function ubah()
	{		
		if(isset($_POST['id_masakan']) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->masakan->rules());
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = $this->masakan->error_msg();
			}else{
				$object = array(		      	
					'nama_masakan' => $this->input->post('nama_masakan',true),		      	
					'harga' => $this->input->post('harga',true),		      	
					'status' => $this->input->post('status',true),		      	 
				);
				$this->masakan->update($object,$this->input->post('id_masakan'));
				$data['success'] = true;
				$data['redirect'] = 'masakan';
			}
			echo json_encode($data);
		}else{
			redirect('masakan','refresh');
		}
	}

	public function delete($id)
	{		
		if ($this->masakan->delete($id)) {						
			redirect('masakan/index','refresh');
		}else{
			echo '<script>alert("Data tidak dapat dihapus");</script>';
			redirect('masakan','refresh');
		}
	}

}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */