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
			$data['status_order'] = array(
				1=>'Baru Pesan',
				2=>'Sedang Diproses',
				3=>'Selesai',
			);			
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
					'status_order' => 1,		      	
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
		$data['data'] = $this->order->getById($id);
		$meja = $this->order->getSelectedMeja($id);
		$data['data_meja'] = "<option selected value=".$meja->id_meja.">".$meja->no_meja." - (".$meja->kapasitas." orang ) Terisi</option>";
		echo json_encode($data);
	}

	public function ubah()
	{		
		if(isset($_POST['id_order']) && count($_POST) > 0){			
			$this->form_validation->set_rules($this->order->rules());
			if (!$this->form_validation->run()) {
				$data['error'] = true;
				$data['error_msg'] = $this->order->error_msg();
			}else{
				$id_meja = $this->input->post('id_meja',true);
				$id = $this->input->post('id_order');
				if ($id_meja == $this->order->getById($id)->id_meja) {					
					$object = array(		      							
						'tanggal' => $this->input->post('tanggal',true),		      	
						'keterangan' => $this->input->post('keterangan',true),			      	 
					);
				}else{
					$object = array(		
						'id_meja' => $this->input->post('id_meja',true),
						'tanggal' => $this->input->post('tanggal',true),		      	
						'keterangan' => $this->input->post('keterangan',true),			      	 
					);
					$object2 = array(
						'status_meja' => 'Terisi'
					);
					$this->order->updateMeja($object2,$id_meja);
					$object3 = array(
						'status_meja' => 'Kosong'
					);
					$this->order->updateMeja($object3,$this->order->getById($id)->id_meja);
				}
				$this->order->update($object,$id);
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
		if ($this->order->delete($id)) {						
			redirect('order/index','refresh');
		}else{
			echo '<script>alert("Data tidak dapat dihapus");</script>';
			redirect('order','refresh');
		}
	}

}

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */