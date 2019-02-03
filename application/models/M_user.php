<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function rules()
	{
		return [      	    
	    ['field' => 'nama_user',
	      'label' => 'Nama User',
	      'rules' => 'required'],
		['field' => 'username',
	      'label' => 'Username',
	      'rules' => 'required|callback_checkUsername'],
	    ['field' => 'password',
	      'label' => 'Password',
	      'rules' => 'required'],	      	    
	    ['field' => 'id_level',
	      'label' => 'Level',
	      'rules' => 'required'],
	    ['field' => 'active',
	      'label' => 'Status',
	      'rules' => ''],
	  ];
	}

	public function rulesEdit()
	{
		return [      	    
	    ['field' => 'nama_user',
	      'label' => 'Nama User',
	      'rules' => 'required'],
		['field' => 'username',
	      'label' => 'Username',
	      'rules' => 'required|callback_checkUsername'],
	    ['field' => 'password',
	      'label' => 'Password',
	      'rules' => ''],	      	    
	    ['field' => 'id_level',
	      'label' => 'Level',
	      'rules' => 'required'],
	    ['field' => 'active',
	      'label' => 'Status',
	      'rules' => 'required'],
	  ];
	}

	public function error_msg()
	{
		return array(               	      
	      'nama_user' => form_error('nama_user'),
	      'username' => form_error('username'),
	      'password' => form_error('password'),
	      'id_level' => form_error('id_level'),	      
	      'active' => form_error('active'),
	    );
	}

	public function getAll()
	{
		return $this->db->join('level','level.id_level=user.id_level')->get("user")->result();
	}

	public function getById($id)
	{
		return $this->db->where('id_user',$id)->get('user')->row();
	}

	public function add($object)
	{
		$this->db->insert('user', $object);
	}

	public function update($object,$id_user)
	{
		$this->db->where('id_user',$id_user)->update('user', $object);		
	}

	public function delete($id)
	{
		return $this->db->where('id_user', $id)->delete('user');
	}

	public function getLevel()
	{
		return $this->db->get('level')->result();
	}

}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */