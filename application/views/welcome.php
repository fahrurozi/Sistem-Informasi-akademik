<style>
	.example_d {
		color: white !important;
		background: #33A2FF;
        margin-top: 20px;
		padding: 4px 56px;
		border: 6px solid #2F95E9 !important;
		border-radius: 6px;
		display: inline-block;
		transition: all 0.1s;
        transition-timing-function: cubic-bezier(0.0, 0.0, 0.2, 1);
	}

	.example_d:hover {
		color: white !important;
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

    <div class="col-md-12">
		<div class="text-center">
			<div class="col-md-3">
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
			<div class="col-md-3">
				<a class="example_d" href="<?php echo site_url('jurusan'); ?>">
					<div class="col-md-12 btn" style="color: white">
						<p style="font-size: 20px">Jumlah Jurusan</p>
						<i class="fa fa-th fa-3x"></i>
						<div style="margin-top: -10px" class="values">
							<strong>
								<h1><?php echo $jurusan; ?></h1>
							</strong> Jurusan
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-3">
				<a class="example_d" href="<?php echo site_url('rombel'); ?>">
					<div class="col-md-12 btn" style="color: white">
						<p style="font-size: 20px">Jumlah Rombel</p>
						<i class="fa fa-book fa-3x"></i>
						<div style="margin-top: -10px" class="values">
							<strong>
								<h1><?php echo $rombel; ?></h1>
							</strong> Rombel
						</div>
					</div>
				</a>
			</div>
            <div class="col-md-3">
				<a class="example_d" href="<?php echo site_url('guru'); ?>">
					<div class="col-md-12 btn" style="color: white">
						<p style="font-size: 20px">Jumlah Guru</p>
						<i class="fa fa-id-card fa-3x"></i>
						<div style="margin-top: -10px" class="values">
							<strong>
								<h1><?php echo $guru; ?></h1>
							</strong> Guru
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>