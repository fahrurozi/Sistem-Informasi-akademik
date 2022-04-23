<div class="col-md-12">
    <table class="table table-bordered">
        <tr><td width="200">TAHUN AKADEMIK</td><td><?php echo get_tahun_ajaran_aktif('tahun_ajaran') ?></td></tr>
        <tr><td >SEMESTER</td><td><?php echo get_tahun_ajaran_aktif('semester_aktif') ?></td></tr>
    </table>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
        <i class="fa fa-external-link-square"></i>DAFTAR KELAS
        <div class="panel-tools">
            
                    <a class='btn btn-xs btn-link' href='<?php echo base_url("index.php/nilai/add/").$rombel["id_rombel"] ?>'> <i class='fa fa-plus'></i> </a>
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
                    <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> </a>
                    <a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
                    <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
        <tr>
            <th>NO</th>
            <th>JURUSAN</th>
            <th>ROMBEL</th>
            <th>MATA PELAJARAN</th>
            <th>HARI</th>
            <th>JAM</th>
            <th>RUANG</th>
            <th></th>
        </tr>
        <?php
        $no=1;
        foreach ($jadwal->result() as $row){
            echo "<tr>
                <td>$no</td>
                <td>$row->nama_jurusan</td>
                <td>$row->nama_rombel</td>
                <td>$row->nama_mapel</td>
                <td>$row->hari</td>
                <td>$row->jam</td>
                <td>$row->nama_ruangan</td>
                <td>".anchor('nilai/rombel/'.$row->id_jadwal,'<i class ="fa fa-eye" aria-hidden="true"></i>',"title='Lihat Kelas'")."</td>
                </tr>";
            $no++;
        }
        ?>
        </table>
    </div>
    </div>
</div>
