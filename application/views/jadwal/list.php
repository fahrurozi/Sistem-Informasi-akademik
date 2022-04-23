<div class="row">
	<div class="col-md-12">
				<?php echo form_open('jadwal/cetakJadwal'); ?>
				<table class="table table-borderless table-full-width">
					<tr>
						<td><i class="fa fa-filter" aria-hidden="true"></i></td>
						<td>Jurusan</td>
						<td>
							<?php echo cmb_dinamis(
								'jurusan', 
								'tb_jurusan', 
								'nama_jurusan', 
								'id_jurusan',
								null,
								"class='form-control' id='jurusan' onchange='loadRombel()'"
								) 
							?>
						</td>
						<td>Kelas</td>
						<td>
							<select id="kelas" name="kelas" class="form-control" onchange="loadRombel()">	
								<?php
                                    for($i=1 ; $i<=$info['jumlah_kelas'] ; $i++){
                                        echo "<option value='$i'>Kelas $i</option>";
                                    }
                                ?>
							</select>
						</td>
						<td>Rombel</td>
						<td width="20%"> <div id="showRombel"></div> </td>
						<td>
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary" data-toggle="modal"
								data-target="#exampleModal">
                                Generate Jadwal
							</button>
							&nbsp;
							<button type="submit" class="btn btn-danger" name="exportJadwal">
								<i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;&nbsp; Cetak Jadwal
							</button>
						</td>
					</tr>
				</table>
				</form>


	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-table"></i> Daftar Pelajaran
				<div class="panel-tools">
					<a class="btn btn-xs btn-link" data-toggle="modal" data-target="#addModal"> <i class="fa fa-plus"></i> </a>
					<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
					<!-- <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"> <i
							class="fa fa-wrench"></i> </a> -->
					<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
					<a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a>
				</div>
			</div>
			<div class="panel-body">
				<div id="tabel"></div>
			</div>
		</div>
	</div>

</div>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		loadRombel();
	});
</script>

<script type="text/javascript">
	function loadRombel() {
		var kelas = $("#kelas").val();
		var jurusan = $("#jurusan").val();

		$.ajax({
			type: 'GET',
			url: '<?php echo base_url('index.php/jadwal/tampilkanRombel') ?>',
			data: 'jurusan=' + jurusan + '&kelas=' + kelas,
			success: function (html) {
				$("#showRombel").html(html)
				loadData();
			}
		})
	}

	function loadData() {
		var kelas	= $("#kelas").val();
		var jurusan	= $("#jurusan").val();
		var rombel	= $("#rombel").val();

		$.ajax({
			type: 'GET',
			url: '<?php echo base_url('index.php/jadwal/dataJadwal') ?>',
			data: 'jurusan=' + jurusan + '&kelas=' + kelas + '&rombel=' + rombel,
			success: function (html) {
				$("#tabel").html(html)
			}
		})
	}


	function updateGuru(id) {
		var guru = $("#guru"+id).val();

		$.ajax({
			type: 'GET',
			url: '<?php echo base_url('index.php/jadwal/guruUpdate') ?>',
			data: 'id_guru=' + guru + '&id_jadwal=' + id,
			success: function (html) {
				loadData();
			}
		})
	}

	function updateRuangan(id) {
		var ruangan = $("#ruangan"+id).val();

		$.ajax({
			type: 'GET',
			url: '<?php echo base_url('index.php/jadwal/ruanganUpdate') ?>',
			data: 'id_ruangan=' + ruangan + '&id_jadwal=' + id,
			success: function (html) {
				loadData();
			}
		})
	}

	function updateMapel(id) {
		var mapel = $("#mapel"+id).val();

		$.ajax({
			type: 'GET',
			url: '<?php echo base_url('index.php/jadwal/mapelUpdate') ?>',
			data: 'id_mapel=' + mapel + '&id_jadwal=' + id,
			success: function (html) {
				loadData();
			}
		})
	}

	function updateHari(id) {
		var hari = $("#hari"+id).val();

		$.ajax({
			type: 'GET',
			url: '<?php echo base_url('index.php/jadwal/hariUpdate') ?>',
			data: 'hari=' + hari + '&id_jadwal=' + id,
			success: function (html) {
				loadData();
			}
		})
	}

	function updateJam(id) {
		var jam = $("#jam"+id).val();

		$.ajax({
			type: 'GET',
			url: '<?php echo base_url('index.php/jadwal/jamUpdate') ?>',
			data: 'jam=' + jam + '&id_jadwal=' + id,
			success: function (html) {
				loadData();
			}
		})
	}

	function filterData() {
		loadData();
	}
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php 
                echo form_open('jadwal/generate_jadwal');
            ?>
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
                    <tr>
                        <td>Kurikulum</td>
                        <td><?php echo cmb_dinamis('kurikulum', 'tb_kurikulum', 'nama_kurikulum', 'id_kurikulum'); ?></td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td><?php echo form_dropdown('semester', array(1=>'Ganjil', 2=>'Genap'), null, "class='form-control'"); ?></td>
                    </tr>
                </table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="submit" name="submit" class="btn btn-primary">Generate Data</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="Label"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="Label">Modal title
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h4>
			</div>
			<div class="row">
   				<div class="col-sm-12 col-sm-offset-1">
			<div class="modal-body">
				<?php
                    echo form_open('jadwal/add', 'role="form" class="form-horizontal"');
                ?>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="form-field-1">
						SEMESTER
					</label>
					<div class="col-sm-8">
						<?php echo form_dropdown('semester', array(1=>'Ganjil', 2=>'Genap'), null, "class='form-control'"); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="form-field-select-1">
						JURUSAN
					</label>
					<div class="col-sm-8">
						<?php echo cmb_dinamis('jurusan', 'tb_jurusan', 'nama_jurusan', 'id_jurusan') ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="form-field-select-1">
						KELAS
					</label>
					<div class="col-sm-8">
						<select name="kelas" class="form-control">
							<?php
                                for ($i=1;$i<=$info['jumlah_kelas'];$i++){
                                    echo "<option value='$i'>Kelas $i</option>";
                                }
                            ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="form-field-select-1">
						ROMBEL
					</label>
					<div class="col-sm-8">
						<?php echo cmb_dinamis('rombel', 'tb_rombel', 'nama_rombel', 'id_rombel') ?>
					</div>
				</div>
			</div>
   			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="submit" name="submit" class="btn btn-primary">Sumbit</button>
            </div>
            </form>
		</div>
	</div>
</div>