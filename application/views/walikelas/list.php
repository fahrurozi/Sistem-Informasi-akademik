<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <tr><td width='300'>TAHUN AJARAN</td><td><?php echo get_tahun_ajaran_aktif('tahun_ajaran') ?></td></tr>
            <tr><td>SEMESTER</td><td><?php echo get_tahun_ajaran_aktif('semester_aktif') ?></td></tr>
        </table>
        
    </div>


    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-table"></i> Editable Table
                <div class="panel-tools">
                    <a class="btn btn-xs btn-link" href="<?php echo base_url('index.php/walikelas/add') ?>"> <i class="fa fa-plus"></i> </a>
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
                    <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> </a>
                    <a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
                    <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a>
                </div>
            </div>
            <div class="panel-body">
            
            <table id="Tabel" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>ROMBEL</th>
                        <th>NAMA JURUSAN</th>
                        <th>KELAS</th>
                        <th>NAMA WALIKELAS</th>
                    </tr>
                </thead>
            </table>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    function updateDataWalikelas(id_walikelas) {
        //var id_walikelas = $("#kelas").val();
        var id_guru = $("#guru"+id_walikelas).val();
        $.ajax({
            type    :'GET',
            url     : "<?php echo base_url('index.php/walikelas/updateWalikelas') ?>",
            data    : 'id_walikelas='+id_walikelas+'&id_guru='+id_guru,
            success:function(html){
                //$("$showRombel").html(html);
                //loadPelajaran();
            }
        })
    }

</script>


<script>
    $(document).ready(function() {
        var t = $('#Tabel').DataTable( {
			"ajax": "<?php echo site_url('walikelas/data') ?>",
            "order": [[ 2, 'asc' ]],
            "columns": [
                {
                    "data": null,
                    "width": "24px",
                    "sClass": "text-center",
                    "orderable": false,
                },
                
                { "data": "nama_rombel", "sClass": "text-center", "width":"170px" },
                { "data": "nama_jurusan", "sClass": "text-center", "width":"350px" },
                { "data": "kelas", "sClass": "text-center", "width":"100px" },
                { "data": "nama_guru", "sClass": "text-center", "width":"248px" },
            ]
        } );
               
        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    } );
</script>