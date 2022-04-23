<?php
class Auth extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Model_user');
        $this->load->model('Model_guru');
        $this->load->model('Model_rombel');
    }
    function index(){
        $this->load->view('auth/login');
    }

    function chek_login(){
        if(isset($_POST['submit'])) {
            //proses login disini

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $loginUser   = $this->Model_user->chekLogin($username,$password);
            $loginGuru   = $this->Model_guru->chekLogin($username,$password);
            $loginSiswa   = $this->Model_rombel->chekLogin($username,$password);
            
            if(!empty($loginUser)){
                $this->session->set_userdata($loginUser);
                redirect('');
            }elseif (!empty($loginGuru)) {
               
                $session = array('nama_lengkap'=>$loginGuru['nama_guru'],
                                 'id_level_user'=>3,
                                 'id_guru'=>$loginGuru['id_guru'],
                                 'id_rombel'=>$loginGuru['id_rombel'],
                                 'id_jurusan'=>$loginGuru['id_jurusan']
                                );
                $this->session->set_userdata($session);
                
                
                redirect('');
                //redirect('jadwal');
            }elseif (!empty($loginSiswa)) {
               
                $session = array('nama_lengkap'=>$loginSiswa['nama_rombel'],
                                 'id_level_user'=>5,
                                 'id_jurusan'=>$loginSiswa['id_jurusan'],
                                 'id_rombel'=>$loginSiswa['id_rombel'],
                                 'jurusan'=>$loginSiswa['nama_jurusan']
                                );
                $this->session->set_userdata($session);
                
                
                redirect('');
                //redirect('jadwal');

            }else{
                redirect('auth');
            }
        }else{
            redirect('auth');
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('auth');
    }
}
?>
