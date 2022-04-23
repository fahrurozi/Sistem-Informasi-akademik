<div class="col-md-12">
    <table class="table table-bordered">
        <tr><td width="200">TAHUN AKADEMIK</td><td><?php echo get_tahun_ajaran_aktif('tahun_ajaran') ?></td></tr>
        <tr><td >SEMESTER</td><td><?php echo get_tahun_ajaran_aktif('semester_aktif') ?></td></tr>
        <tr><td>JURUSAN</td><td><?php echo $rombel['kelas'].' '.$rombel['nama_jurusan']?></td></tr>
        <tr><td>MATA PELAJARAN</td><td><?php echo $rombel['nama_mapel']?></td></tr>
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
        <tr><th >NIS</th><th>NAMA</th><th width="150">NILAI</th></tr>
        <?php 
        foreach ($siswa as $row){
           
            echo "<tr>
                <td width='80'>$row->nis</td>
                <td>". strtoupper($row->nama)."</td>
                <td><input width='100' type='int' onKeyup='updateNilai(\"$row->nis\")' id='nilai".$row->nis."' value='". chek_nilai($row->nis, $this->uri->segment(3))."' class='form-control' ></td>
            </tr>";
            
        }
        ?>
        </table>
    </div>
    </div>
</div>
<script type="text/javascript">
function updateNilai(nis){
    var nilai = $("#nilai"+nis).val();
    $.ajax({
        type:'GET',
        url : '<?php echo site_url() ?>/nilai/update_nilai',
        data : 'nis='+nis+'&id_jadwal='+<?php echo $this->uri->segment(3)?>+'&nilai='+nilai,
        success:function(html){
           // $("#dataSiswa").html(html);
        }
    })
}
</script>
