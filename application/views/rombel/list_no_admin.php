<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-table"></i> Rombongan Belajar
				<div class="panel-tools">
					<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
					<a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a>
				</div>
			</div>
			<div class="panel-body">

				<table id="Tabel" class="table table-striped table-bordered table-hover table-full-width dataTable"
					cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>NO.</th>
							<th>NAMA ROMBEL</th>
							<th>KELAS</th>
							<th>NAMA JURUSAN</th>
							
						</tr>
					</thead>
				</table>

			</div>
		</div>
	</div>
</div>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

<script>
	$(document).ready(function () {
		var t = $('#Tabel').DataTable({
			"ajax": "<?php echo site_url('rombel/data') ?>",
			"order": [
				[2, 'asc']
			],
			"columns": [{
					"data": null,
					"width": "24px",
					"sClass": "text-center",
					"orderable": false,
				},
				{
					"data": "nama_rombel",
					"sClass": "text-center",
					"width": "248px"
				},
				{
					"data": "kelas",
					"sClass": "text-center",
					"width": "48px"
				},
				{
                    "data": "nama_jurusan", 
                    "sClass": "text-center", 
                    "width":"248px" 
                },
				
			]
		});

		t.on('order.dt search.dt', function () {
			t.column(0, {
				search: 'applied',
				order: 'applied'
			}).nodes().each(function (cell, i) {
				cell.innerHTML = i + 1;
			});
		}).draw();
	});
</script>
