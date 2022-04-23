<?php

function cmb_dinamis($name, $table, $field, $pk, $selected=null,$extra=null) { 

    $CI =& get_instance();
    $cmb  = "<select name='$name' class='form-control' $extra>";
    $data = $CI->db->get($table)->result();
    foreach ($data as $row) {
        $cmb .= "<option value='".$row->$pk."'";
        $cmb .= $selected==$row->$pk?'selected':'';
        $cmb .= ">".$row->$field."</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}



function get_tahun_ajaran_aktif($field) {
    //$this->load->helper('url');
    $CI =& get_instance();
    $CI->db->where('is_aktif','y');
    $tahun = $CI->db->get('tb_tahun_ajaran')->row_array();
    return $tahun[$field];
}

function chek_nilai($nis,$id_jadwal){
    $CI = & get_instance();
    $nilai = $CI->db->get_where('tb_nilai',array('nis'=>$nis,'id_jadwal'=>$id_jadwal));
	
    $sqlnilai= "SELECT * FROM tb_nilai WHERE nis='$nis' and id_jadwal=$id_jadwal";
    //$nilai = $CI->db->query($sqlnilai)->row_array();
   //$nilai = $sqlnilai->num_rows();
    

    if($nilai->num_rows()>0){
        $row = $nilai->row_array();
        return $row['nilai'];
    }else{
        
        return 0;
        
    }
}



function chekAksesModule() {
    $CI =& get_instance();
    //ambil parameter uri segment untuk control dan method

    
    $controller = $CI->uri->segment(1);
    $method = $CI->uri->segment(2);
    //$method = $CI->uri->segment(2);
   
    //check url
    if (empty($method)) {
        $url = $controller;
    }else {
        $url = $controller ."/". $method;
    }
   
    

    //chek id menu
    $menu = $CI->db->get_where('tb_menu', array('url'=>$url))->row_array();
    $level_user = $CI->session->userdata('id_level_user');
    
   
    if(!empty($level_user)){
        $chek = $CI->db->get_where('tb_user_rule', array('id_level_user' => $level_user, 'id_menu' => $menu['id_menu']));
        
        //if($chek->num_rows()<1 and $method!='data' and $method!='add' and $method!='edit' and $method!='delete' and $method!='form' and $controller!='' and $method!='load_data_siswa_by_rombel'){
            if($chek->num_rows()<1 and $controller!=''){
            //echo"HAYOLOO!";
            echo $CI->load->view('403/403.php','',TRUE);
            die;
        }
        
    }else{
        redirect('auth');
    }
}

    function Terbilang($n) {
        $huruf = array("", "Satu ", "Dua ", "Tiga ", "Empat ", "Lima ", "Enam ", "Tujuh ", "Delapan ", "Sembilan ", "Sepuluh ", "Sebelas ");
        if($n < 12){
            return " " . $huruf[$n];
        }elseif($n < 20){
            return Terbilang($n - 10) . "Belas";
        }elseif($n < 100){
            return Terbilang($n / 10) . "Puluh" . Terbilang($n % 10);
        }elseif($n < 200){
            return " Seratus" . Terbilang($n - 100);        
        }elseif($n < 1000){
            return Terbilang($n / 100) . "Ratus" . Terbilang($n % 100);
        }elseif($n < 2000){
            return " Seribu" . Terbilang($n - 1000);        
        }elseif($n < 1000000){
            return Terbilang($n / 1000) . "Ribu" . Terbilang($n % 1000);
        }elseif($n < 1000000000){
            return Terbilang($n / 1000000) . "Juta" . Terbilang($n % 1000000);
        }
    }

