<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_meja extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->form_validation->set_message('checkNoMeja','No Meja Sudah Dipakai');
	}


	public function rules()
	{		
		return [      	    
	    ['field' => 'no_meja',
	      'label' => 'No Meja',
	      'rules' => 'required|callback_checkNoMeja'],		
	    ['field' => 'kapasitas',
	      'label' => 'kapasitas',
	      'rules' => 'required|numeric'],	      	    
	    ['field' => 'status_meja',
	      'label' => 'Status',
	      'rules' => '']
	  ];
	}


	public function error_msg()
	{
		return array(               	      
	      'no_meja' => form_error('no_meja'),	      
	      'kapasitas' => form_error('kapasitas'),
	      'status_meja' => form_error('status_meja'),	      
	    );
	}

	public function getAll()
	{
		return $this->db->get("meja")->result();
	}

	public function getById($id)
	{
		return $this->db->where('id_meja',$id)->get('meja')->row();
	}

	public function add($object)
	{
		$this->db->insert('meja', $object);
	}

	public function update($object,$id_meja)
	{
		$this->db->where('id_meja',$id_meja)->update('meja', $object);		
	}

	public function delete($id)
	{
		return $this->db->where('id_meja', $id)->delete('meja');
	}		

	public function checkNoMeja($no_meja)
	{
		return $this->db->select('no_meja')->where('no_meja',$no_meja)->get('meja')->num_rows();
	}
}

/* End of file M_meja.php */
/* Location: ./application/models/M_meja.php */