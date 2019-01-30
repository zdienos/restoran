<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_order extends CI_Model {

	public function rules()
	{
		return [      	    
	    ['field' => 'id_meja',
	      'label' => 'No Meja',
	      'rules' => 'required'],		
	    ['field' => 'id_user',
	      'label' => 'User',
	      'rules' => 'required'],	      	    
	    ['field' => 'tanggal',
	      'label' => 'Tanggal',
	      'rules' => 'required'],	      	    
	    ['field' => 'keterangan',
	      'label' => 'Keterangan',
	      'rules' => ''],
	    ['field' => 'status_order',
	      'label' => 'Status Order',
	      'rules' => 'required'],
	  ];
	}


	public function error_msg()
	{
		return array(               	      
	      'id_meja' => form_error('id_meja'),	      
	      'id_user' => form_error('id_user'),
	      'tanggal' => form_error('tanggal'),	      
	      'keterangan' => form_error('keterangan'),	      
	      'status_order' => form_error('status_order'),	 
	    );
	}

	public function getAll()
	{
		return $this->db
		->join('meja','meja.id_meja=order.id_meja')
		->join('user','user.id_user=order.id_user')
		->get('order')->result();
	}	

	public function getMeja()
	{
		return $this->db->where('status_meja','kosong')->get('meja')->result();
	}

	public function getUser()
	{
		return $this->db->where('id_level','5')->get('user')->result();
	}

	public function add($object)
	{
		$this->db->insert('order', $object);
	}
}

/* End of file M_order.php */
/* Location: ./application/models/M_order.php */