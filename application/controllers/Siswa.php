<?php

Class Siswa extends CI_Controller {

    private $filename = "import_data_siswa";

	function __construct() {
        parent:: __construct();
//        chekAksesModule();
        $this->load->library('ssp');
        $this->load->model('Model_siswa');
    }



    function data() {
        $table = 'v_show_siswa';
        $primaryKey = 'nis';
        $columns = array(
            array('db' => 'nis', 'dt' => 'nis'),
            array('db' => 'nama', 'dt' => 'nama'),
            array('db' => 'gender', 'dt' => 'gender'),
            array('db' => 'tanggal_lahir', 'dt' => 'tanggal_lahir'),
            array('db' => 'tempat_lahir', 'dt' => 'tempat_lahir'),
            array('db' => 'id_agama', 'dt' => 'id_agama'),
            array('db' => 'id_rombel', 'dt' => 'id_rombel'),
            array('db' => 'nama_rombel', 'dt' => 'nama_rombel'),
            array(
                'db' => 'nis',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    return anchor('siswa/edit/'.$d, '<i class="fa fa-pencil"></i>','class="btn btn-primary" title="Edit"')."&nbsp;&nbsp;&nbsp;"
                          .anchor('siswa/delete/'.$d, '<i class="fa fa-trash"></i>','class="btn btn-danger" title="Delete"');
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
                SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    //Menampilkan data
    function index() {
        chekAksesModule();
        $data['siswa'] = $this->Model_siswa->view_siswa();

        if ($this->session->userdata('id_level_user')==5 ) {
            $sql = "SELECT * FROM tb_siswa WHERE tb_siswa.id_rombel=".$this->session->userdata('id_rombel');
            $data['list'] = $this->db->query($sql);

            $this->template->load('template','siswa/list_siswa', $data);
			
			
        } else if ($this->session->userdata('id_level_user') == 1) {
             $this->template->load('template','siswa/list');
        }else{
			$sql = "SELECT * FROM tb_siswa WHERE tb_siswa.id_rombel=".$this->session->userdata('id_rombel');
            $data['list'] = $this->db->query($sql);

            $this->template->load('template','siswa/list_siswa', $data);
			
			
		}
        
    }

    //Menambahkan data
    function add() { 
        chekAksesModule();      
        if(isset($_POST['submit'])) {
            //chekAksesModule();
            echo $this->Model_siswa->save();
            redirect('siswa');
        } else {
            $this->template->load('template','siswa/add');
        }
    }

    //Mengedit data
    function edit() {
        chekAksesModule();
        if(isset($_POST['submit'])) {
            echo $this->Model_siswa->update();
            redirect('siswa');
        } else {
            $nis    = $this->uri->segment(3);
            $data['siswa'] = $this->db->get_where('tb_siswa', array('nis'=>$nis))->row_array();
            $this->template->load('template','siswa/edit',$data);
        }
    }

    //Menghapus data
    function delete() {
        chekAksesModule();
        $nis    = $this->uri->segment(3);
        if(!empty($nis)) {
            //memproses delete data
            $this->db->where('nis', $nis);
            $this->db->delete('tb_siswa');
        }
        redirect('siswa');
    }

    //upload foto siswa
    function upload_foto_siswa(){
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = 1024; //imb
        $this->load->library('upload', $config);
        //proses upload
        $this->upload->do_upload('userfile');
        $upload = $this->upload->data();
        return $upload['file_name'];
    }

    function siswa_aktif() {
        $this->template->load('template', 'siswa/siswa_aktif');
    }

    function load_data_siswa_by_rombel() {
        $rombel = $_GET['rombel'];
        echo    "<table class='table table-bordered'>
                    <tr><th width='100'>NIS</th><th>NAMA</th></tr>";
        $this->db->where('id_rombel',$rombel); 
        $siswa = $this->db->get('tb_siswa');
        foreach($siswa->result() as $row){
            echo "<tr><td>$row->nis</td><td>$row->nama</td></tr>";
        }
        echo    "</table>";
    }


    function data_by_rombel_excel() {
		
        $this->load->library('CPHP_excel');
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'NIS');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'NAMA');

        $rombel = $_POST['rombel'];
        $this->db->where('id_rombel',$rombel);

        $siswa = $this->db->get('tb_siswa');
        $no=2;
        foreach($siswa->result() as $row){
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$no, $row->nis);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $row->nama);
            $no++;
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        $objWriter->save("data-siswa-rombel.xlsx");

        $redirek = base_url("data-siswa-rombel.xlsx");
        redirect($redirek);
    }

    //import excel
    public function form(){
        chekAksesModule();
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
            // lakukan upload file dengan memanggil function upload yang ada di Model_tahun_ajaran.php
            
            
			$upload = $this->Model_siswa->upload_file_siswa($this->filename);
            
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('assets/upload/import_data_siswa/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		
		$this->template->load('template','siswa/form',$data);
	}
	
	public function import(){
		// Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        

;		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('assets/upload/import_data_siswa/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
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
					'nis'=>$row['A'], // Insert data nis dari kolom A di excel
                    'nama'=>$row['B'], // Insert data nama dari kolom B di excel
                    'gender'=>$row['C'],
                    'tanggal_lahir'=>$row['D'],
                    'tempat_lahir'=>$row['E'],
                    'id_agama'=>$row['G'],
                    'id_rombel'=>$row['I'],
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->Model_siswa->insert_multiple($data);
		
		redirect("siswa"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}


    
}

?>
