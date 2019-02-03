<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meja extends CI_Controller {

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
		$this->load->model('m_meja','meja');
	}

	public function index()
	{
		$data['view'] = 'page/meja/index';	
		$data['dataAll'] = $this->meja->getAll();		
		$data['judul'] = "<h2>Meja</h2>";	
		$data['data_status_meja']	= array('Terisi','Kosong','Rusak');
		$data['validation'] = 'validation';
		$this->load->view('layout/index', $data);
		
	}

	public function add()
	{		
		if(isset($_POST) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->meja->rules());			
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = $this->meja->error_msg();
			}else{
				$object = array(		      	
					'no_meja' => $this->input->post('no_meja',true),		      	
					'kapasitas' => $this->input->post('kapasitas',true),		      	
					'status_meja' => 'Kosong',		      	
				);
				$this->meja->add($object);
				$data['success'] = true;
				$data['redirect'] = 'meja';
			}
			echo json_encode($data);
		}else{
			redirect('meja','refresh');
		}
	}

	public function edit_data($id)
	{
		$data = $this->meja->getById($id);
		echo json_encode($data);
	}

	public function ubah()
	{		
		if(isset($_POST['id_meja']) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->meja->rules());
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = $this->meja->error_msg();
			}else{
				$object = array(		      	
					'no_meja' => $this->input->post('no_meja',true),		      	
					'kapasitas' => $this->input->post('kapasitas',true),		      	
					'status_meja' => $this->input->post('status_meja',true),		      	 
				);
				$this->meja->update($object,$this->input->post('id_meja'));
				$data['success'] = true;
				$data['redirect'] = 'meja';
			}
			echo json_encode($data);
		}else{
			redirect('meja','refresh');
		}
	}

	public function delete($id)
	{		
		if ($this->meja->delete($id)) {						
			redirect('meja/index','refresh');
		}else{
			echo '<script>alert("Data tidak dapat dihapus");</script>';
			redirect('meja','refresh');
		}
	}

	public function checkNoMeja($str)
	{
		if (isset($_POST['id_meja'])) {
			$a = $this->db->select('no_meja')->where('id_meja',$_POST['id_meja'])->get('meja')->row();
			if ($a->no_meja == $str) {
				return true;
			}else{
				if ($this->db->get_where('meja',array('no_meja'=>$str))->num_rows()) {
					return false;
				}else{
					return true;
				}
			}
		}
		else{
			if ($this->meja->checkNoMeja($str)) {
			return false;
			}else{
				return true;
			}
		}
	}

}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */