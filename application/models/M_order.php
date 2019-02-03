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
	      'rules' => ''],
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

	public function getSelectedMeja($id)
	{
		$meja = $this->db->select('id_meja')->where('id_order',$id)->get('order')->row();
		return $this->db->where('id_meja',$meja->id_meja)->get('meja')->row();
	}

	public function getById($id)
	{
		return $this->db->where('id_order',$id)->get('order')->row();
	}

	public function getUser()
	{
		return $this->db->where('id_level','5')->where('active',1)->get('user')->result();
	}

	public function add($object)
	{
		$meja = array(
			'status_meja' => 'Terisi', 
		);
		$this->db->where('id_meja',$object['id_meja'])->update('meja', $meja);
		return $this->db->insert('order', $object);
	}

	public function delete($id)
	{
		return $this->db->where('id_order',$id)->delete('order');
	}

	public function updateMeja($object,$id_meja)
	{
		return $this->db->where('id_meja',$id_meja)->update('meja', $object);
	}

	public function update($object,$id_order)
	{
		return $this->db->where('id_order',$id_order)->update('order', $object);
	}
}

/* End of file M_order.php */
/* Location: ./application/models/M_order.php */