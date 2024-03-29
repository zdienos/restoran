<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_masakan extends CI_Model {

	public function rules()
	{
		return [      	    
	    ['field' => 'nama_masakan',
	      'label' => 'Nama Masakan',
	      'rules' => 'required'],		
	    ['field' => 'harga',
	      'label' => 'Harga',
	      'rules' => 'required|numeric'],	      	    
	    ['field' => 'id_status_masakan',
	      'label' => 'Status',
	      'rules' => 'required']
	  ];
	}


	public function error_msg()
	{
		return array(               	      
	      'nama_masakan' => form_error('nama_masakan'),	      
	      'harga' => form_error('harga'),
	      'id_status_masakan' => form_error('id_status_masakan'),	      
	    );
	}

	public function getAll()
	{
		return $this->db->join('status_masakan','status_masakan.id_status_masakan=masakan.id_status_masakan')->get("masakan")->result();
	}

	public function getById($id)
	{
		return $this->db->where('id_masakan',$id)->get('masakan')->row();
	}

	public function add($object)
	{
		$this->db->insert('masakan', $object);
	}

	public function update($object,$id_masakan)
	{
		$this->db->where('id_masakan',$id_masakan)->update('masakan', $object);		
	}

	public function delete($id)
	{
		return $this->db->where('id_masakan', $id)->delete('masakan');
	}	

	public function getStatus()
	{
		return $this->db->get('status_masakan')->result();
	}

}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */