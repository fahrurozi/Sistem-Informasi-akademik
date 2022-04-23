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
		<tr>
			<td>ROMBEL</td>
			<td><?php echo $this->session->userdata('nama_lengkap') ?></td>
		</tr>
	</table>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-external-link-square"></i>Jadwal Pelajaran
			<div class="panel-tools">
			</div>
		</div>
		<div class="panel-body">
			<table class="table table-bordered">
				<tr>
					<th>NO</th>
					<th>HARI</th>
					<th>JAM</th>
					<th>MATA PELAJARAN</th>
					<th>RUANG</th>
				</tr>

				<?php
        $no=1;
        foreach ($jadwal->result() as $row) {
            echo 
                "<tr>
                    <td>".$no++."</td>
                    <td>$row->hari</td>
                    <td>$row->jam</td>
                    <td>$row->nama_mapel</td>
                    <td>$row->nama_ruangan</td>
                </tr>";
            }
        ?>

				<tr>
					<th>NO</th>
					<th>HARI</th>
					<th>JAM</th>
					<th>MATA PELAJARAN</th>
					<th>RUANG</th>
				</tr>
			</table>
		</div>
	</div>
</div>
