<?php

class Rombel extends CI_Controller {

    private $filename = "import_data_rombel";
    
    function __construct() {
        parent::__construct();
        $this->load->library('ssp');
        
        $this->load->model('Model_rombel');
    }

    function data(){
        $table = 'v_master_rombel';
        $primaryKey = 'id_rombel';
        $columns = array(
            array('db' => 'id_rombel', 'dt' => 'id_rombel'),
            array('db' => 'nama_rombel', 'dt' => 'nama_rombel'),
            array('db' => 'kelas', 'dt' => 'kelas'),
            array('db' => 'nama_jurusan', 'dt' => 'nama_jurusan'),
            array(
                'db' => 'id_rombel',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    return anchor('rombel/edit/'.$d, '<i class="fa fa-pencil"></i>','class="btn btn-primary" title="Edit"')."&nbsp;&nbsp;&nbsp;"
                          .anchor('rombel/delete/'.$d, '<i class="fa fa-trash"></i>','class="btn btn-danger" title="Delete"');
                }
            )
        );
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );
 
        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    function index() {
        $data['rombel'] = $this->Model_rombel->view_rombel();
        if($this->session->userdata('id_level_user')!=1){
            $this->template->load('template', 'rombel/list_no_admin');
        }else{
            $this->template->load('template', 'rombel/list');
        }
    }

    function add() {
        chekAksesModule();
        if(isset($_POST['submit'])) {
            echo $this->Model_rombel->save();
            redirect('rombel');
        } else {
            $infoSekolah = "SELECT js.jumlah_kelas FROM tb_jenjang_sekolah as js,tb_sekolah_info as si WHERE js.id_jenjang=si.id_jenjang";
            $data['info'] = $this->db->query($infoSekolah)->row_array();
            $this->template->load('template', 'rombel/add', $data);
        }
    }

    function edit() {
        chekAksesModule();
        if(isset($_POST['submit'])) {
            echo $this->Model_rombel->update();
            redirect('rombel');
        } else {
            $infoSekolah = "SELECT js.jumlah_kelas FROM tb_jenjang_sekolah as js,tb_sekolah_info as si WHERE js.id_jenjang=si.id_jenjang";
            $data['info'] = $this->db->query($infoSekolah)->row_array();
            $id_rombel = $this->uri->segment(3);
            $data['rombel'] = $this->db->get_where('tb_rombel', array('id_rombel'=>$id_rombel))->row_array();
            $this->template->load('template', 'rombel/edit',$data);
        }
    }

    function delete() {
        chekAksesModule();
        $id_rombel = $this->uri->segment(3);
        if(!empty($id_rombel)){
            $this->db->where('id_rombel',$id_rombel);
            $this->db->delete('tb_rombel');
        }
        redirect('rombel');
    }

    function show_combobox_rombel_by_jurusan(){
        
        $jurusan = $_GET['jurusan'];
        echo "<select name='rombel' id='rombel2' class='form-control' onchange='loadSiswa()'>";
        $this->db->where('id_jurusan',$jurusan);
        $rombel = $this->db->get('tb_rombel');
        foreach ($rombel->result() as $row){
            echo "<option value='$row->id_rombel'>$row->nama_rombel</option>";
        }
        echo "</select>";
    }

    public function form(){
        chekAksesModule();
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
            // lakukan upload file dengan memanggil function upload yang ada di Model_tahun_ajaran.php
            
            
			$upload = $this->Model_rombel->upload_file_rombel($this->filename);
            
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
                include APPPATH.'third_party/PHPExcel/PHPExcel.php';
                
                
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('assets/upload/import_data_rombel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		
		$this->template->load('template','rombel/form',$data);
	}
	
	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('assets/upload/import_data_rombel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				array_push($data, array(
					'nama_rombel'=>$row['A'], // Insert data nis dari kolom A di excel
                    'kelas'=>$row['B'], // Insert data nama dari kolom B di excel
                    'id_jurusan'=>$row['D'],
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->Model_rombel->insert_multiple($data);
		
		redirect("rombel"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

}



?>