<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-table"></i> TABEL SISWA
                <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
                    <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a>
                </div>
            </div>
            <div class="panel-body">
            
            <table id="Tabel" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NIS</th>
                        <th>NAMA</th>
                        <th>GENDER</th>
                        <th>TANGGAL LAHIR</th>
                        <th>TEMPAT LAHIR</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no=1;
                foreach ($list->result() as $row){
                echo "<tr>
                        <td>$no</td>
                        <td>$row->nis</td>
                        <td>$row->nama</td>
                        <td>$row->gender</td>
                        <td>$row->tanggal_lahir</td>
                        <td>$row->tempat_lahir</td>
                    </tr>";
                    $no++;
                }
                ?>
                </tbody>
            </table>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

<script>
    /* $(document).ready(function() {
        var t = $('#Tabel').DataTable( {
			"ajax": "<?php echo site_url('siswa/data') ?>",
            "order": [[ 2, 'asc' ]],
            "columns": [
                {
                    "data": null,
                    "width": "50px",
                    "sClass": "text-center",
                    "orderable": false,
                },
                {
                    "data": "nis",
                    "width": "150px",
                    "sClass": "text-center"
                },
                { "data": "nama", "sClass": "text-center", "width":"600px" },
                { "data": "gender", "sClass": "text-center", "width":"150px"  },
                { "data": "tanggal_lahir", "sClass": "text-center" , "width":"250px"  },
                { "data": "tempat_lahir", "sClass": "text-center", "width":"250px" },
                { "data": "nama_rombel", "sClass": "text-center" },
            ]
        } );
               
        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    } ); */
</script>