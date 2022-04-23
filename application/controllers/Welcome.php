<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
        parent:: __construct();
        $this->load->model('Model_welcome');
    }

	public function index() {
		chekAksesModule();
		if ($this->session->userdata('id_level_user')==5) {
			$siswa = $this->Model_welcome->jml_siswa_rombel();
			$p = $this->Model_welcome->jml_siswa_rombel_p();
			$l = $this->Model_welcome->jml_siswa_rombel_l();
			//$lk = $this->Model_welcome->jml_gender();

			$data = array('siswa' => $siswa, 'p' => $p, 'l' => $l);
			$this->template->load('template','welcome-siswa',$data);
		} else if ($this->session->userdata('id_level_user')==3) {
			$siswa = $this->Model_welcome->jml_siswa_rombel();
			$p = $this->Model_welcome->jml_siswa_rombel_p();
			$l = $this->Model_welcome->jml_siswa_rombel_l();
			//$lk = $this->Model_welcome->jml_gender();

			$data = array('siswa' => $siswa, 'p' => $p, 'l' => $l);
			$this->template->load('template','welcome-guru',$data);
		} else {
			$siswa = $this->Model_welcome->jml_siswa();
			$guru = $this->Model_welcome->jml_guru();
			$ruang = $this->Model_welcome->jml_ruang();
			$jurusan = $this->Model_welcome->jml_jurusan();
			$rombel = $this->Model_welcome->jml_rombel();

			$data = array(
				'siswa' => $siswa, 
				'guru' => $guru, 
				'ruang' => $ruang,
				'jurusan' => $jurusan,
				'rombel' => $rombel
			);
			$this->template->load('template','welcome',$data);
		}
	}

}
