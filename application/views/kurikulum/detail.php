<div class="row">
<div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-table"></i> Filter Data
                
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr><td>Jurusan</td><td><?php echo cmb_dinamis('jurusan', 'tb_jurusan', 'nama_jurusan', 'id_jurusan',null,"id='jurusan' onchange='loadData()'") ?></td></tr>
                    <tr><td>Kelas</td><td>
                    <select id="kelas" class="form-control" onchange="loadData()">
                    <option value="semua_kelas">Semua Kelas</option>
                            <?php
                                for($i=1 ; $i<=$info['jumlah_kelas'] ; $i++){
                                    echo "<option value='$i'>Kelas $i</option>";
                                }
                            ?>
                        </select>
                    </td></tr>
                    <tr>
                        <td colspan="2">
                            <?php echo anchor('kurikulum/adddetail/'.$this->uri->segment(3), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Tambah Data',"title='Tambah Data' class='btn btn-danger btn-sm'"); ?>
                            <?php echo anchor('kurikulum','kembali',"class='btn btn-success btn-sm'")?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-table"></i> Daftar Pelajaran
                <!-- 
                    <div class="panel-tools">
                        <a class="btn btn-xs btn-link" href="kurikulum/add"> <i class="fa fa-plus"></i> </a>
                        <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
                        <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> </a>
                        <a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
                        <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a>
                    </div> 
                -->
            </div>
            <div class="panel-body">
            
            <div id="tabel"></div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    loadData();
});
</script>

<script type="text/javascript">
    function loadData() {
        var kelas=$("#kelas").val();
        var jurusan=$("#jurusan").val();
        $.ajax({
            type:'GET',
            url : '<?php echo base_url('index.php/kurikulum/dataKurikulumDetail') ?>',
            data: 'jurusan='+jurusan+'&kelas='+kelas+'&id_kurikulum=<?php echo $this->uri->segment(3); ?>',
            success:function(html){
                $("#tabel").html(html)
            }
        })
    }

    function filterData() {
        loadData();
    }
</script>