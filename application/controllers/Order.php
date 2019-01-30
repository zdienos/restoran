<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('login')){
			redirect('error/error_401','refresh');
		}		
		if (!$this->session->userdata('user_id_level') == 1 || 
			!$this->session->userdata('user_id_level') == 2 ||
		    !$this->session->userdata('user_id_level') == 5) {
			redirect('error/error_403','refresh');
		}
		$this->load->library('form_validation');
		$this->load->model('m_order','order');
	}

	public function index()
	{
		if ($this->session->userdata('user_id_level') == 1) {
			$data['dataAll'] = $this->order->getAll();
			$data['data_meja'] = $this->order->getMeja();
			$data['data_user'] = $this->order->getUser();
			$data['view'] = 'page/order/index';
		}else{
			$data['view'] = 'page/order/pelanggan';
		}
		$data['dataAll'] = $this->order->getAll();		
		$data['judul'] = "<h2>Order</h2>";		
		$data['validation'] = 'validation';
		$this->load->view('layout/index', $data);
	}

	public function add()
	{		
		if(isset($_POST) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->order->rules());			
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = $this->order->error_msg();
			}else{
				$object = array(		      	
					'id_meja' => $this->input->post('id_meja',true),		      	
					'id_user' => $this->input->post('id_user',true),		      	
					'tanggal' => $this->input->post('tanggal',true),		      	
					'keterangan' => $this->input->post('keterangan',true),		      						
					'status_order' => $this->input->post('status_order',true),		      	
				);
				$this->order->add($object);
				$data['success'] = true;
				$data['redirect'] = 'order';
			}
			echo json_encode($data);
		}else{
			redirect('order','refresh');
		}
	}

	public function edit_data($id)
	{
		$data = $this->order->getById($id);
		echo json_encode($data);
	}

	public function ubah()
	{		
		if(isset($_POST['id_masakan']) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->order->rules());
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = $this->order->error_msg();
			}else{
				$object = array(		      	
					'nama_masakan' => $this->input->post('nama_masakan',true),		      	
					'harga' => $this->input->post('harga',true),		      	
					'status' => $this->input->post('status',true),		      	 
				);
				$this->order->update($object,$this->input->post('id_masakan'));
				$data['success'] = true;
				$data['redirect'] = 'order';
			}
			echo json_encode($data);
		}else{
			redirect('order','refresh');
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

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */