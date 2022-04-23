<?php

class Sekolah extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('model_sekolah');
    }


    function index(){
        $data['info'] = $this->db->get_where('tb_sekolah_info',array('id_sekolah'=>1))->row_array();
        if($this->session->userdata('id_level_user')!=1){
            $this->template->load('template','sekolah/info_sekolah_no_admin',$data);
        }else{
            if (isset($_POST['submit'])) {
                $this->model_sekolah->update();
                redirect('sekolah');
            } else {
                $this->template->load('template','sekolah/info_sekolah',$data);
            }
        }

        

    }

}


?>