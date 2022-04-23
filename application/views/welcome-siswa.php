<style>
	.example_d {
		color: black !important;
		text-transform: uppercase;
		background: #33A2FF;
		margin-top: 20px;
		padding: 4px 96px;
		border: 6px solid #2F95E9 !important;
		border-radius: 6px;
		display: inline-block;
		transition: all 0.1s;
        transition-timing-function: cubic-bezier(0.0, 0.0, 0.2, 1);
	}

	.example_d:hover {
		color: black !important;
		margin-top: 12px;
		text-decoration: none;
		border-color: #2F95E9 !important;
		transition: all 0.1s;
        transition-timing-function: cubic-bezier(0.4, 0.0, 1, 1);
	}

</style>

<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-full-width">
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
	<div class="col-md-12" style="padding-bottom: 6px">
		<h3><i class="fa fa-graduation-cap"></i>&nbsp; Informasi Kelas
			<strong><?php echo $this->session->userdata('nama_lengkap') ?></strong></h3>
	</div>

	<div class="col-md-12">
		<div class="text-center">
			<div class="col-md-4">
				<a class="example_d" href="<?php echo site_url('siswa'); ?>">
					<div class="col-md-12 btn" style="color: white">
						<p style="font-size: 20px">Jumlah Siswa</p>
						<i class="fa fa-users fa-3x"></i>
						<div style="margin-top: -10px" class="values">
							<strong>
								<h1><?php echo $siswa; ?></h1>
							</strong> Siswa
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-4">
				<a class="example_d" href="<?php echo site_url('siswa'); ?>">
					<div class="col-md-12 btn" style="color: white">
						<p style="font-size: 20px">Siswa Perempuan</p>
						<i class="fa fa-users fa-3x"></i>
						<div style="margin-top: -10px" class="values">
							<strong>
								<h1><?php echo $p; ?></h1>
							</strong> Siswi
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-4">
				<a class="example_d" href="<?php echo site_url('siswa'); ?>">
					<div class="col-md-12 btn" style="color: white">
						<p style="font-size: 20px">Siswa Laki-laki</p>
						<i class="fa fa-users fa-3x"></i>
						<div style="margin-top: -10px" class="values">
							<strong>
								<h1><?php echo $l; ?></h1>
							</strong> Siswa
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
