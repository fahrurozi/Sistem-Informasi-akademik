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
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
        <tr>
            <th>NO</th>
            <th>JURUSAN</th>
            <th>KELAS</th>
            <th>ROMBEL</th>

            <th></th>
        </tr>
        <?php
        $no=1;
        foreach ($jurusan->result() as $row){
            echo "<tr>
                <td>$no</td>
                <td>$row->nama_jurusan</td>
                <td>$row->kelas</td>
                <td>$row->nama_rombel</td>
                <td>".anchor('raport/rombel/'.$row->id_rombel,'<i class ="fa fa-eye" aria-hidden="true"></i>',"title='Lihat Kelas'")."</td>
                </tr>";
            $no++;
        }
        ?>
        </table>
    </div>
    </div>
</div>
