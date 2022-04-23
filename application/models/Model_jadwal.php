<?php

class Model_jadwal extends CI_Model {

    function jamPelajaran() {
        $jam_mapel = array(
            '07.00 - 07.45' => '07.00 - 07.45',
            '07.45 - 08.30' => '07.45 - 08.30',
            '08.30 - 09.15' => '08.30 - 09.15',
            '09.15 - 10.00' => '09.15 - 10.00',
            '10.00 - 10.15' => '10.00 - 10.15',
            '10.15 - 11.00' => '10.15 - 11.00',
            '11.00 - 11.45' => '11.00 - 11.45',
            '11.45 - 12.15' => '11.45 - 12.15',
            '12.15 - 12.55' => '12.15 - 12.55',
            '12.55 - 13.35' => '12.55 - 13.35',
            '13.35 - 14.15' => '13.35 - 14.15',
            '14.15 - 14.55' => '14.15 - 14.55',
            '14.55 - 15.10' => '14.55 - 15.10',
            '15.10 - 15.50' => '15.10 - 15.50',
            '15.50 - 16.30' => '15.50 - 16.30',
            '16.30 - 17.10' => '16.30 - 17.10',
            '17.10 - 17.50' => '17.10 - 17.50',
        );
        return $jam_mapel;
    }

    function hari() {
        $nama_hari = array(
            'Senin'     => 'Senin',
            'Selasa'    => 'Selasa',
            'Rabu'      => 'Rabu',
            'Kamis'     => 'Kamis',
            'Jumat'     => 'Jumat',
        );
        return $nama_hari;
    }


    function generateJadwal() {
        $id_kurikulum   = $this->input->post('kurikulum');
        $semester       = $this->input->post('semester');

        //ambil data berdasarkan kurikulum yang dipilih
        $kurikulum_detail   = $this->db->get_where('tb_kurikulum_detail', array('id_kurikulum'=>$id_kurikulum));

        //mengambil tahun ajaran yang aktif
        $tahun_aktif        = $this->db->get_where('tb_tahun_ajaran', array('is_aktif'=>'y'))->row_array();
        
        foreach($kurikulum_detail->result() as $row) {
            //mendapatkan rombel sesuai dengan jurusan dan kelas
            $rombel = $this->db->get_where('tb_rombel', array('id_jurusan'=>$row->id_jurusan, 'kelas'=>$row->kelas));
            foreach($rombel->result() as $row_rombel) {
                $data = array(
                    'id_tahun_ajaran' => $tahun_aktif['id_tahun_ajaran'], 
                    'semester'        => $semester, 
                    'hari'            => 'Senin', 
                    'id_jurusan'      => $row_rombel->id_jurusan, 
                    'kelas'           => $row_rombel->kelas, 
                    'id_mapel'        => $row->id_mapel, 
                    'id_guru'         => '1',
                    'id_rombel'       => $row_rombel->id_rombel, 
                    'jam'             => '07.00 - 07.45', 
                    'id_ruangan'      => 'RTKJ1'
                );

                $this->db->insert('tb_jadwal', $data);
            }
        }
    }

    function addJadwal(){
        $tahun_aktif        = $this->db->get_where('tb_tahun_ajaran', array('is_aktif'=>'y'))->row_array();
        $semester           = $this->input->post('semester');
        
        $data = array(
            'id_tahun_ajaran'   => $tahun_aktif['id_tahun_ajaran'],
            'semester'          => $semester,
            'id_mapel'          => 'SENIN',
            'kelas'             => $this->input->post('kelas',TRUE),
            'id_jurusan'        => $this->input->post('jurusan',TRUE),
            'id_rombel'         => $this->input->post('rombel',TRUE),
            'hari'              => 'Senin',
            'jam'               => '07.00 - 07.45',
            'id_ruangan'        => 'RTKJ1'
        );
        $this->db->insert('tb_jadwal',$data);
        
    }

}