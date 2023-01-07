<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->userdata('username')){
			redirect('user');
		}

		$data['title'] = "LOGIN PAGE";
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'trim|required',[
			'required'=>'Password Harus Diisi'
		]);
		
		if($this->form_validation->run() == false){
			$this->load->view('templates/auth_header', $data) ;
			$this->load->view('auth/login') ;
			$this->load->view('templates/auth_footer') ;
	}
		else{
			$this->_login();
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');
		redirect('auth');
	}

	private function _login()
	{ 
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->db->get_where('user', ['username' => $username])->row_array();
		if($user){
			if($user['is_active'] == 1){
				if(password_verify($password, $user['password'])){
					$data = [
						'username' => $user['username'],
						'role' => $user['role']
					];
					$this->session->set_userdata($data);
					redirect('user');
				}
				else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password Salah </div>');
					redirect('auth/');
				}
			}
			else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Akun Belum Di Aktivasi </div>');
				redirect('auth/');
			}
		}
		else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Akun Tidak Terdaftar </div>');
			redirect('auth/');
		}
	}

	public function registration()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
		$this->form_validation->set_rules('divisi', 'Divisi', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]', [
			'matches'=>'Password Tidak Sama',
			'min_length'=>'Password Terlalu Pendek',
			'required'=>'Password Harus Diisi'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|min_length[3]|matches[password1]', [
			'matches'=>'Password Tidak Sama',
			'min_length'=>'Password Terlalu Pendek',
			'required'=>'Password Harus Diisi'
		]);
		
		if($this->form_validation->run() == false){
			$data['title'] = "REGISTRATION PAGE";
			$data['divisi'] = $this->db->get('divisi')->result();
			$this->load->view('templates/auth_header', $data) ;
			$this->load->view('auth/register') ;
			$this->load->view('templates/auth_footer') ;	
		}
		else{
			$data = [
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role' => $this->input->post('role'),
				'id_divisi' => $this->input->post('divisi'),
				'is_active' => '1',
			];
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Akun Berhasil di Tambahkan </div>');
			$this->db->insert('user', $data);
			redirect('auth');
		}
	}
}
