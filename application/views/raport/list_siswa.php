<div class="col-md-12">
    <table class="table table-bordered">
        <tr><td width="200">TAHUN AKADEMIK</td><td><?php echo get_tahun_ajaran_aktif('tahun_ajaran') ?></td></tr>
        <tr><td >SEMESTER</td><td><?php echo get_tahun_ajaran_aktif('semester_aktif') ?></td></tr>
        <tr><td>JURUSAN</td><td><?php echo $rombel['kelas'].' '.$rombel['nama_jurusan']?> (<?php echo $rombel['nama_rombel']?>)</td></tr>
    </table>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
        <i class="fa fa-external-link-square"></i>DAFTAR KELAS
        <div class="panel-tools">
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
        <tr><th>NIS</th><th>NAMA</th><th>LIHAT NILAI</th></tr>
        <?php
        foreach($siswa->result() as $row){
            echo 
            "<tr>
                <td width='100'>$row->nis</td>
                <td>$row->nama</td>
                <td width='100'>".anchor('raport/nilai_semester/'.$row->nis,'Lihat Raport', 'class="btn btn-success btn-sm"')."</td>
            </tr>";
        }
        ?>
        </table>
    </div>
    </div>
</div>
