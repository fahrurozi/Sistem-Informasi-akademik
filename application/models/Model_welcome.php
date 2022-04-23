<?php

class Model_welcome extends CI_Model {

    function jml_siswa() {
        return $this->db->count_all_results('tb_siswa');
    }
    function jml_siswa_rombel() {
        $this->db->select('nis');
        $this->db->from('tb_siswa');
        $this->db->where('id_rombel', $this->session->userdata('id_rombel'));
        return $this->db->count_all_results();
    }
    function jml_siswa_rombel_p() {
        $this->db->select('nis');
        $this->db->from('tb_siswa');
        $this->db->where('id_rombel', $this->session->userdata('id_rombel'));
        $this->db->where('gender', 'P');
        return $this->db->count_all_results();
    }
    function jml_siswa_rombel_l() {
        $this->db->select('nis');
        $this->db->from('tb_siswa');
        $this->db->where('id_rombel', $this->session->userdata('id_rombel'));
        $this->db->where('gender', 'L');
        return $this->db->count_all_results();
    }
    function jml_guru() {
        return $this->db->count_all_results('tb_guru');
    }
    function jml_ruang() {
        return $this->db->count_all_results('tb_ruangan');
    }
    function jml_jurusan() {
        return $this->db->count_all_results('tb_rombel');
    }
    function jml_rombel() {
        return $this->db->count_all_results('tb_jurusan');
    }

}