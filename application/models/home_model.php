<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function check_user()
	{		
		# code...
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$query = $this->db->where('username', $username)
							->where('password',$password)
							->get('admin');
		if ($query->num_rows()>0) {
			$data_login = $query->row();

			$data = array(
				'id_user' => $data_login->id_admin,
				'username'=>$data_login->username,
				'level' => $data_login->level,
				'logged_in'=> TRUE
			);
	
			$this->session->set_userdata($data);

			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function get_admin()
	{
		return $this->db->get('admin')->result();
	}
	public function insert_admin($data)
	{
		$this->db->insert('admin',$data);
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function delete_admin($id)
	{
		$this->db->where('id_admin', $id)->delete('admin');
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else{
			return FALSE;
		}
	}
	public function edit_admin($data,$id)
	{
		$this->db->where('id_admin',$id)
				->update('admin',$data);

		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return FALSE;
		}	
	}

	public function get_admin_by_id($id)
	{
		return $this->db->where('id_admin', $id)->get('admin')->row();
	}



	//buku
	/*public function get_bukus(){
		return $this->db->get('buku')
						->result();
	}*/
	public function get_buku()
	{
		//return $this->db->get('buku')->result();
		return $this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori')->get('buku')->result();
	}
	
	public function insert_buku($data)
	{
		$this->db->insert('buku',$data);
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function get_kategori_buku()
	{
		return $this->db->get('kategori')->result();
	}
	public function delete_buku($id_buku)
	{
		$this->db->where('id_buku', $id_buku)->delete('buku');
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else{
			return FALSE;
		}
	}
	public function edit_buku($data,$id)
	{
		$this->db->where('id_buku',$id)
				 ->update('buku',$data);

		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return FALSE;
		}	 
	}
	public function get_buku_by_id($id)
	{
		return $this->db->where('id_buku', $id)
						->get('buku')
						->row();
	}
	public function insert_kategori($data)
	{
		$this->db->insert('kategori',$data);
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function delete_kategori($id)
	{
		$this->db->where('id_kategori', $id)
				 ->delete('kategori');
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else{
			return FALSE;
		}
	}
	public function get_kategori_by_id($id)
	{
		return $this->db->where('id_kategori', $id)
						->get('kategori')
						->row();
	}
	public function edit_kategori($data,$id)
	{
		$this->db->where('id_kategori',$id)
				 ->update('kategori',$data);

		if ($this->db->affected_rows()>0) {
			return true;
		} else {
			return FALSE;
		}	
	}
	public function register($data)
	{
		$this->db->insert('admin',$data);
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}


/* End of file home_model.php */
/* Location: ./application/models/home_model.php */
/* End of file home_model.php */
/* Location: ./application/models/home_model.php */