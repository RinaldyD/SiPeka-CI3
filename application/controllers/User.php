<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')){
			redirect('auth');
		}
	}

	public function index()
	{
		$data['karyawan'] = $this->db->count_all('karyawan');
		$data['divisi'] = $this->db->count_all('divisi');
		$data['kriteria'] = $this->db->count_all('kriteria');
		$data['nilai'] = $this->db->count_all('nilai');
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['title'] = "DASHBOARD";
		$this->load->view('templates/user_header', $data) ;
		$this->load->view('user/dashboard') ;
		$this->load->view('templates/user_footer') ;
	}

	// public function kriteria()
	// {
	// 	$data['title'] = "DATA KRITERIA";
	// 	$data['kriteria'] = $this->db->get('kriteria')->result();
	// 	$this->load->view('templates/user_header', $data) ;
	// 	$this->load->view('user/kriteria') ;
	// 	$this->load->view('templates/user_footer') ;
	// }

	public function kriteria()
		{
			$this->form_validation->set_rules('kriteria', 'kriteria', 'required|trim|is_unique[kriteria.nama_kriteria]', [
			'required'=>'Kolom Kriteria Harus Diisi!!',
			'is_unique'=>'Kriteria Sudah Ada!!'
		]);
			$this->form_validation->set_rules('jeniskriteria', 'jeniskriteria', 'required|trim');
			if($this->form_validation->run() == false){
				$data['username'] = $this->session->userdata('username');
				$data['role'] = $this->session->userdata('role');
				$data['title'] = "DATA KRITERIA";
				$this->db->order_by('nama_kriteria', 'ASC');
				$data['kriteria'] = $this->db->get('kriteria')->result();
				$this->load->view('templates/user_header', $data) ;
				$this->load->view('user/kriteria') ;
				$this->load->view('templates/user_footer') ;
			}
			else{
				$data = [
						'nama_kriteria' => $this->input->post('kriteria'),
						'jenis_kriteria' => $this->input->post('jeniskriteria'),
					];
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Kriteria Berhasil di Tambahkan </div>');
					$this->db->insert('kriteria', $data);
					redirect('user/kriteria');
					}
		}
	public function hapuskriteria($id)
		{
			$this->db->where('id_kriteria', $id);
			$query = $this->db->get('nilai');
			$hitungjumlah = $query->num_rows();
			$this->db->where('id_kriteria', $id);
			$query1 = $this->db->get('bobot');
			$hitungjumlah1 = $query1->num_rows();
			if ($hitungjumlah1 > 0){
				if ($hitungjumlah > 0)
				{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Kriteria Tidak Dapat Di Hapus Karna Memiliki Nilai Pada Menu Nilai </div>');
				redirect('user/kriteria');	
				}
				else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Kriteria Tidak Dapat Di Hapus Karna Memiliki Nilai Pada Menu Bobot </div>');
					redirect('user/kriteria');
				}
			}
			else{
				$this->db->delete('kriteria', array('id' => $id));
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Kriteria Berhasil di Hapus </div>');
				redirect('user/kriteria');
			}
		}
	public function ubahkriteria($id)
		{
			$data = [
						'jenis_kriteria' => $this->input->post('jeniskriteria'),
					];
			$this->db->where('id', $id);
			$this->db->update('kriteria', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kriteria Berhasil di Ubah </div>');
			redirect('user/kriteria');
		}

	// public function bobot()
	// {
	// 	$data['title'] = "DATA BOBOT";
	// 	$this->load->view('templates/user_header', $data) ;
	// 	$this->load->view('user/bobot') ;
	// 	$this->load->view('templates/user_footer') ;
	// }

	public function bobot()
		{
			$this->form_validation->set_rules('kriteria', 'kriteria', 'trim|is_unique[bobot.id_kriteria]', [
			'is_unique'=>'Bobot Kriteria Sudah Ada!!']);
			$this->form_validation->set_rules('jumlah_bobot', 'jumlah_bobot', 'required', [
			'required'=>'Bobot Kriteria Harus Diisi!!',
		]);
			if($this->form_validation->run() == false){
				$data['username'] = $this->session->userdata('username');
				$data['role'] = $this->session->userdata('role');
				$this->db->select('kriteria.nama_kriteria, bobot.id, bobot.id_kriteria, bobot.jumlah_bobot ');
				$this->db->from('bobot');
				$this->db->join('kriteria', 'kriteria.id = bobot.id_kriteria');
				$this->db->order_by('kriteria.nama_kriteria', 'ASC');
				$data['kriteria'] = $this->db->get()->result();	
				$data['title'] = "DATA BOBOT";
				$data['kriteria1'] = $this->db->get('kriteria')->result();
				$this->load->view('templates/user_header', $data) ;
				$this->load->view('user/bobot') ;
				$this->load->view('templates/user_footer') ;
			}
			else{
				$data = [
						'id_kriteria' => $this->input->post('kriteria'),
						'jumlah_bobot' => $this->input->post('jumlah_bobot'),
					];
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bobot Kriteria Berhasil di Tambahkan </div>');
					$this->db->insert('bobot', $data);
					redirect('user/bobot');
					}
		}

	public function hapusbobot($id)
		{
			$this->db->delete('bobot', array('id' => $id));
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bobot Kriteria Berhasil di Hapus </div>');
			redirect('user/bobot');
		}

	public function ubahbobot($id)
		{
			$data = [
						'jumlah_bobot' => $this->input->post('jumlah_bobot'),
					];
			$this->db->where('id', $id);
			$this->db->update('bobot', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bobot Kriteria Berhasil di Ubah </div>');
			redirect('user/bobot');
		}

	// public function karyawan()
	// {
	// 	$data['title'] = "DATA KARYAWAN";
	// 	$this->load->view('templates/user_header', $data) ;
	// 	$this->load->view('user/karyawan') ;
	// 	$this->load->view('templates/user_footer') ;
	// }	

	public function karyawan()
		{
			$this->form_validation->set_rules('namakaryawan', 'namakaryawan', 'required', [
			'required'=>'Nama Harus Diisi!!']);
			$this->form_validation->set_rules('nipkaryawan', 'nipkaryawan', 'required|is_unique[karyawan.nip]|min_length[8]|max_length[8]', [
			'is_unique'=>'NIP Sudah Terdaftar!!',
			'required'=>'NIP Harus Diisi!!',
			'min_length'=>'NIP Terlalu Pendek!!',
			'max_length'=>'NIP Terlalu Panjang!!']);
			if($this->form_validation->run() == false){
				$data['username'] = $this->session->userdata('username');
				$data['role'] = $this->session->userdata('role');
				$this->db->select('karyawan.id, karyawan.nip, karyawan.nama_karyawan, karyawan.jabatan_karyawan, karyawan.id_divisi, divisi.nama_divisi');
				$this->db->from('karyawan');
				$this->db->join('divisi', 'karyawan.id_divisi = divisi.id');
				$this->db->order_by('karyawan.nama_karyawan', 'ASC');
				$data['karyawan'] = $this->db->get()->result();	
				$data['divisi'] = $this->db->get('divisi')->result();	
				$data['title'] = "DATA KARYAWAN";
				$this->load->view('templates/user_header', $data) ;
				$this->load->view('user/karyawan') ;
				$this->load->view('templates/user_footer') ;
			}
			else{
				$data = [
						'nip' => $this->input->post('nipkaryawan'),
						'nama_karyawan' => $this->input->post('namakaryawan'),
						'jabatan_karyawan' => $this->input->post('jabatan_karyawan'),
						'id_divisi' => $this->input->post('id_divisi'),
					];
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Karyawan Berhasil di Tambahkan </div>');
					$this->db->insert('karyawan', $data);
					redirect('user/karyawan');
					}
		}
		
		public function hapuskaryawan($nip)
		{
			$this->db->where('nip', $nip);
			$query = $this->db->get('nilai');
			$hitungjumlah = $query->num_rows();
			if ($hitungjumlah > 1){
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Karyawan Tidak Dapat Di Hapus Karna Memiliki Nilai Pada Menu Nilai </div>');
				redirect('user/karyawan');
			}
			else{
				$this->db->delete('karyawan', array('nip' => $nip));
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Karyawan Berhasil di Hapus </div>');
				redirect('user/karyawan');
			}
		}

		public function ubahkaryawan($id)
		{
			$data = [
						'nama_karyawan' => $this->input->post('namakaryawan'),
						'jabatan_karyawan' => $this->input->post('jabatan_karyawan'),
						'id_divisi' => $this->input->post('id_divisi'),
					];
			$this->db->where('id', $id);
			$this->db->update('karyawan', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Karyawan Berhasil di Ubah </div>');
			redirect('user/karyawan');
		}


	// public function nilai()
	// {
	// 	$data['title'] = "DATA NILAI KARYAWAN";
	// 	$data['username'] = $this->session->userdata('username');
	// 	$this->load->view('templates/user_header', $data) ;
	// 	$this->load->view('user/nilai') ;
	// 	$this->load->view('templates/user_footer') ;
	// }

	public function nilai()
		{
			$this->form_validation->set_rules('nilaikaryawan', 'nilaikaryawan', 'required', [
			'required'=>'Nilai Harus Diisi!!',]);
			if($this->form_validation->run() == false){
				$data['username'] = $this->session->userdata('username');
				$data['role'] = $this->session->userdata('role');
				$this->db->select('nilai.id, karyawan.nama_karyawan, kriteria.nama_kriteria, karyawan.nip, nilai.nilai, nilai.id_kriteria');
				$this->db->from('nilai');
				$this->db->order_by("karyawan.nama_karyawan", "asc");
				$this->db->join('Karyawan', 'Nilai.nip=karyawan.nip');
				$this->db->join('Kriteria', 'Nilai.id_kriteria=kriteria.id');
				$data['nilai'] = $this->db->get()->result();
				$data['karyawan'] = $this->db->get('karyawan')->result();	
				$data['kriteria'] = $this->db->get('kriteria')->result();	
				$data['title'] = "DATA NILAI KARYAWAN";
				$data['username'] = $this->session->userdata('username');
				$this->load->view('templates/user_header', $data) ;
				$this->load->view('user/nilai') ;
				$this->load->view('templates/user_footer') ;
			}
			else{
				$data = [
						'nip' => $this->input->post('nip'),
						'id_kriteria' => $this->input->post('namakriteria'),
						'nilai' => $this->input->post('nilaikaryawan'),
					];
					$nip = $this->input->post('nip');
					$id_kriteria =$this->input->post('namakriteria');
					$this->db->where('nip', $nip);
					$this->db->where('id_kriteria', $id_kriteria);
					$hitung = $this->db->count_all_results('nilai');
					if ($hitung > 0){
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nilai Karyawan Sudah Ada </div>');
						redirect('user/nilai');
					}
					else{
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Nilai Karyawan Berhasil di Tambahkan </div>');
						$this->db->insert('nilai', $data);
						redirect('user/nilai');
					}
					}
		}
		
		public function hapusnilai($id)
		{
			$this->db->delete('nilai', array('id' => $id));
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Nilai Karyawan Berhasil di Hapus </div>');
			redirect('user/nilai');
		}

		public function ubahnilai($id)
		{
			$data = [
						'nilai' => $this->input->post('nilaikaryawan'),
					];
			$this->db->where('id', $id);
			$this->db->update('nilai', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Nilai Karyawan Berhasil di Ubah </div>');
			redirect('user/nilai');
		}

		public function hitung()
		{
			$data['username'] = $this->session->userdata('username');
			$data['title'] = "HITUNG DATA";
			$this->load->view('templates/user_header', $data) ;
			$this->load->view('user/hitung') ;
			$this->load->view('templates/user_footer') ;
		}

		public function hasil()
		{
			$data['username'] = $this->session->userdata('username');
			$data['role'] = $this->session->userdata('role');
			$data['title'] = "HASIL PERHITUNGAN";
			$this->load->view('templates/user_header', $data) ;
			$this->load->view('user/hasil') ;
			$this->load->view('templates/user_footer') ;
		}
}