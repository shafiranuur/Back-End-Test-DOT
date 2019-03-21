<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Home extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	public function index(){
		if ($this->session->userdata('logged_in')==TRUE) {
			$data['main_view']='dashboard';
			$this->load->view('template',$data);
		} else {
			$this->load->view('login');
		}
		//$this->output->enable_profiler(TRUE);
	}
	public function register()
	{
		if ($this->session->userdata('logged_in')==TRUE) {
		 	$this->form_validation->set_rules('insert_admin_fullname', 'Fullname', 'trim|required');
		 	$this->form_validation->set_rules('insert_admin_username', 'Username', 'trim|required');
 			$this->form_validation->set_rules('insert_admin_password', 'Password', 'trim|required');

 			if ($this->form_validation->run()==TRUE) {
 				$data = array(
 					'fullname' => $this->input->post('insert_admin_fullname'),
 					'username' => $this->input->post('insert_admin_username'),
 					'password' => $this->input->post('insert_admin_password'),
 					);
 				if ($this->home_model->insert_admin($data) == TRUE) {
 					$this->session->set_flashdata('notif1', 'Berhasil Register');
 					redirect('home/index');
 				} else {
 					$this->session->set_flashdata('notif2', 'Gagal Register');
 					redirect('home/register');
 				}	
 			}
 		} else{
 			redirect('home/register');
 		}
	}

	public function do_login()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if ($this->home_model->check_user()) { /*check user -> dari model*/
					redirect('home/index');
				} else {
					$this->session->set_flashdata('notif', 'Username atau Password salah!!!!!');
					redirect('');	
				}
			} else {
				$this->session->flashdata('notif',validation_errors());
				redirect('');
			}
			
		} else {
			# code...
			redirect('home');
		}
		
	}
	public function logout()
	{
		 $data = array(
		 	'id_admin'=>"",
		 	'username'=>"",
		 	'logged_in'=>FALSE
		 	);
		 $this->session->unset_userdata($data);
		 $this->session->sess_destroy();

		 redirect('home');
	}
	public function admin_view()
	{
		$data['data']=$this->home_model->get_admin();
		$data['main_view']='admin_view'; /*admin view itu nama view*/
			$this->load->view('template',$data);
	}
	public function kategori_view()
	{
		$data['data']=$this->home_model->get_kategori_buku();
		$data['main_view']='kategori_view';
		$this->load->view('template',$data);
	}
	public function buku_view()
	{
		$data['kategori']=$this->home_model->get_kategori_buku();
		$data['data']=$this->home_model->get_buku();
		//$data['data']=$this->home_model->get_bukus();
		$data['main_view']='buku_view';
		$this->load->view('template',$data);

	}
	public function insert_admin()
	{
		if ($this->session->userdata('logged_in')==TRUE) {
		 	$this->form_validation->set_rules('insert_admin_username', 'Username', 'trim|required');
 			$this->form_validation->set_rules('insert_admin_password', 'Password', 'trim|required');
 			$this->form_validation->set_rules('insert_admin_level', 'Level', 'trim|required');

 			if ($this->form_validation->run()==TRUE) {
 				$data = array(
 					'username' => $this->input->post('insert_admin_username'),
 					'password' => $this->input->post('insert_admin_password'),
 					'level' => $this->input->post('insert_admin_level')
 					);
 				if ($this->home_model->insert_admin($data) == TRUE) {
 					$this->session->set_flashdata('notif1', 'Berhasil Insert');
 					redirect('home/admin_view');
 				} else {
 					$this->session->set_flashdata('notif2', 'Gagal Insert');
 					redirect('home/admin_view');
 				}	
 			}
 		} else{
 			redirect('home/admin_view');
 		}
	}
	public function delete_admin($id_admin)
 	{
 		if ($this->session->userdata('logged_in')==TRUE) {
 			if ($this->home_model->delete_admin($id_admin)==TRUE) {
 				$this->session->set_flashdata('notif1', 'Berhasil Dihapus');
 				redirect('home/admin_view');
 			} else{
 				$this->session->set_flashdata('notif2', 'Gagal Menghapus');
 				redirect('home/admin_view');
 			}
 		} else{
 			redirect('home/admin_view');
 		}
 	}
 	public function edit_admin()
 	{
 		if ($this->session->userdata('logged_in')==TRUE) {
 			
 			$data = array(
 					'username' => $this->input->post('edit_admin_username'),
 					'password' => $this->input->post('edit_admin_password'),
 					'level' => $this->input->post('edit_admin_level')
 					);
 				if ($this->home_model->edit_admin($data,$this->input->post('edit_admin_id')) == TRUE) {
 					$this->session->set_flashdata('notif1', 'Berhasil Ubah');
 					redirect('home/admin_view');
 				} else {
 					$this->session->set_flashdata('notif2', 'Gagal Ubah');
 					redirect('home/admin_view');
 				}
 		} else{
 			redirect('home/admin_view');
 		} 
 	}
 	public function get_admin_by_id($id)
 	{
 		if ($this->session->userdata('logged_in')==TRUE) {
 			$data_admin = $this->home_model->get_admin_by_id($id);
 			echo json_encode($data_admin);
 		} else{
 			redirect('home/admin_view');
 		}
 	}


 	//buku
 	public function insert_buku()
 	{	

 		if ($this->session->userdata('logged_in')==TRUE) {	
 				$data = array(
 					'judul_buku' => $this->input->post('judul_buku'),
 					'tahun' => $this->input->post('tahun'),
 					'id_kategori' => $this->input->post('kategori'),
 					'harga' => $this->input->post('harga'),
 					'foto_cover' => $this->input->post('foto_cover'),
 					'penerbit' => $this->input->post('penerbit'),
 					'penulis' => $this->input->post('penulis'),
 					'stok' => $this->input->post('stok')
 					);
 				if ($this->home_model->insert_buku($data) == TRUE) {
 					$this->session->set_flashdata('notif1', 'Berhasil Insert');
 					redirect('home/buku_view');
 				} else {
 					$this->session->set_flashdata('notif2', 'Gagal Insert');
 					redirect('home/buku_view');
 				}	
 			}  
 		else {
 			redirect('home/buku_view');
 		}
 	}
 	public function delete_buku($id_buku)
 	{
 		if ($this->session->userdata('logged_in')==TRUE) {
 			if ($this->home_model->delete_buku($id_buku)==TRUE) {
 				$this->session->set_flashdata('notif1', 'Berhasil Dihapus');
 				redirect('home/buku_view');
 			} else{
 				$this->session->set_flashdata('notif2', 'Gagal Menghapus');
 				redirect('home/buku_view');
 			}
 		} else{
 			redirect('home/buku_view');
 		}
 	}
 	public function edit_buku()
 	{
 		if ($this->session->userdata('logged_in')==TRUE) {
 			
 			$data = array(
 					'judul_buku' => $this->input->post('edit_judul'),
 					'tahun' => $this->input->post('edit_tahun'),
 					'id_kategori' => $this->input->post('edit_kategori'),
 					'harga' => $this->input->post('edit_harga'),
 					'foto_cover'=>$this->input->post('edit_foto_cover'),
 					'penerbit'=>$this->input->post('edit_penerbit'),
 					'penulis'=>$this->input->post('edit_penulis'),
 					'stok'=>$this->input->post('edit_stok')
 					);
 				if ($this->home_model->edit_buku($data,$this->input->post('edit_id_buku	')) == TRUE) {
 					$this->session->set_flashdata('notif1', 'Berhasil Ubah');
 					redirect('home/buku_view');
 				} else {
 					$this->session->set_flashdata('notif2', 'Gagal Ubah');
 					redirect('home/buku_view');
 				}
 		} else{
 			redirect('home/buku_view');
 		}
 	}
 	public function get_buku_by_id($id)
 	{
 		if ($this->session->userdata('logged_in')==TRUE) {
 			$data_buku = $this->home_model->get_buku_by_id($id);
 			echo json_encode($data_buku);
 		} else{
 			redirect('home/buku_view');
 		}
 	}
 	public function insert_kategori()
 	{
 		if ($this->session->userdata('logged_in')==TRUE) {
		 	$this->form_validation->set_rules('insert_kategori', 'Kategori', 'trim|required');

 			if ($this->form_validation->run()==TRUE) {
 				$data = array(
 					'nama_kategori' => $this->input->post('insert_kategori')
 					);
 				if ($this->home_model->insert_kategori($data) == TRUE) {
 					$this->session->set_flashdata('notif1', 'Berhasil Insert');
 					redirect('home/kategori_view');
 				} else {
 					$this->session->set_flashdata('notif2', 'Gagal Insert');
 					redirect('home/kategori_view');
 				}	
 			}
 		} else{
 			redirect('home/admin_view');
 		}
 	}
 	public function delete_kategori($id_kategori)
 	{
 		if ($this->session->userdata('logged_in')==TRUE) {
 			if ($this->home_model->delete_kategori($id_kategori)==TRUE) {
 				$this->session->set_flashdata('notif1', 'Berhasil Dihapus');
 				redirect('home/kategori_view');
 			} else{
 				$this->session->set_flashdata('notif2', 'Gagal Menghapus');
 				redirect('home/kategori_view');
 			}
 		} else{
 			redirect('home/kategori_view');
 		}
 	}
 	public function get_kategori_by_id($id)
 	{
 		if ($this->session->userdata('logged_in')==TRUE) {
 			$data_kategori = $this->home_model->get_kategori_by_id($id);
 			echo json_encode($data_kategori);
 		} else{
 			redirect('home/kategori_view');
 		}
 	}
 	public function edit_kategori()
 	{
 		if ($this->session->userdata('logged_in')==TRUE) {
 			
 			$data = array(
 					'nama_kategori' => $this->input->post('edit_kategori')
 					);
 				if ($this->home_model->edit_kategori($data,$this->input->post('edit_id_kategori')) == TRUE) {
 					$this->session->set_flashdata('notif1', 'Berhasil Ubah');
 					redirect('home/kategori_view');
 				} else {
 					$this->session->set_flashdata('notif2', 'Gagal Ubah');
 					redirect('home/kategori_view');
 				}
 		} else{
 			redirect('home/kategori_view');
 		}
 	}
 	public function transaksi_view()
 	{
 		$data['data']=$this->home_model->get_buku();
		$data['main_view']='transaksi_view'; /*admin view itu nama view*/
			$this->load->view('template',$data);
 	}

}


?>