<div class="col-md-12">
	<table class="table table-bordered">
		<tr>
			<td width="200">TAHUN AKADEMIK</td>
			<td><?php echo get_tahun_ajaran_aktif('tahun_ajaran') ?></td>
		</tr>
		<tr>
			<td>SEMESTER</td>
			<td><?php echo get_tahun_ajaran_aktif('semester_aktif') ?></td>
		</tr>
	</table>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-calendar"></i>Jadwal Murid yang Diampu
			<div class="panel-tools">
			</div>
		</div>
		<div class="panel-body">
			<table class="table table-bordered">
				<tr>
					<th>NO</th>
					<th>JURUSAN</th>
					<th>MATA PELAJARAN</th>
					<th>HARI</th>
					<th>JAM</th>
					<th>RUANG</th>
				</tr>

		<?php
        $no=1;
        foreach ($wk->result() as $row){
            echo "<tr>
                    <td>$no</td>
                    <td>$row->nama_jurusan</td>
                    <td>$row->nama_mapel</td>
                    <td>$row->hari</td>
                    <td>$row->jam</td>
                    <td>$row->nama_ruangan</td>
                </tr>";
                $no++;
        }
		?>
				<tr>
					<th>NO</th>
					<th>JURUSAN</th>
					<th>MATA PELAJARAN</th>
					<th>HARI</th>
					<th>JAM</th>
					<th>RUANG</th>
				</tr>
			</table>
		</div>
    </div>
<!---------------------------------------------------------------------------------------------------------->
    <div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-table"></i>Jadwal Mengajar
			<div class="panel-tools">
			</div>
		</div>
		<div class="panel-body">
			<table class="table table-bordered">
				<tr>
					<th>NO</th>
					<th>ROMBEL</th>
					<th>HARI</th>
					<th>JAM</th>
					<th>MATA PELAJARAN</th>
					<th>RUANGAN</th>
				</tr>

		<?php
        $no=1;
        foreach ($mengajar->result() as $row_mengajar){
            echo "<tr>
                    <td>$no</td>
					<td>$row_mengajar->nama_rombel</td>
					<td>$row_mengajar->hari</td>
                    <td>$row_mengajar->jam</td>
                    <td>$row_mengajar->nama_mapel</td>
                    <td>$row_mengajar->nama_ruangan</td>
                </tr>";
                $no++;
        }
		?>
				<tr>
					<th>NO</th>
					<th>ROMBEL</th>
					<th>HARI</th>
					<th>JAM</th>
					<th>MATA PELAJARAN</th>
					<th>RUANGAN</th>
				</tr>
			</table>
		</div>
	</div>
</div>
