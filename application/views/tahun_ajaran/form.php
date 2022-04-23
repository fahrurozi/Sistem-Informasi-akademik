<html>
<head>
	<title>Form Import</title>

	<!-- Load File jquery.min.js yang ada difolder js -->
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	
	<style type="text/css">
		.margin-button-submit {
			margin-right : 0.5%;
		}
	</style>
	

	<script>
	$(document).ready(function(){
		// Sembunyikan alert validasi kosong
		$("#kosong").hide();
	});
	</script>
</head>
<body>
	<h3>Form Import</h3>
	<hr>

	<!-- 	<a href="<?php echo base_url("excel/format.xlsx"); ?>">Download Format</a> -->
	<a class="btn btn-xs btn-success" href="<?php echo base_url('assets\format_excel\tahun_ajaran\format_tahun_ajaran.xlsx')?>"> <i class="fa fa-download"> DOWNLOAD FORMAT</i> </a>
	<br>
	<br>

	<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
	<form method="post" class="md-form" action="<?php echo base_url("index.php/tahun_ajaran/form"); ?>" enctype="multipart/form-data">
		<!--
		-- Buat sebuah input type file
		-- class pull-left berfungsi agar file input berada di sebelah kiri
		-->


		<input  type="file" name="file">

		<!--
		-- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
		-->
		<br>
		<a href="<?php echo base_url('index.php/tahun_ajaran') ?>" class='btn btn-s btn-danger'>Cancel</a>
		<input type="submit" class="btn btn-s btn-primary" name="preview" value="Preview">
	</form>

	<?php
	if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
		if(isset($upload_error)){ // Jika proses upload gagal
			echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
			die; // stop skrip
		}

		// Buat sebuah tag form untuk proses import data ke database
		echo "<form method='post' action='".base_url("index.php/tahun_ajaran/import")."'>";

		// Buat sebuah div untuk alert validasi kosong
		echo "<div style='color: red;' id='kosong'>
		Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
		</div>";

		echo "<div class='panel panel-default'>";



		echo "<div class='panel-heading'>
		<i class='fa fa-table'></i> TABEL PREVIEW
		<div class='panel-tools'>";
			echo "<a class='btn btn-xs btn-link' href='http://localhost/project-akademi-sekolah/index.php/tahun_ajaran/add'> <i class='fa fa-plus'></i> </a>
			<a class='btn btn-xs btn-link panel-collapse collapses' href='#'> </a>
			<a class='btn btn-xs btn-link panel-config' href='#panel-config' data-toggle='modal'> <i class='fa fa-wrench'></i> </a>
			<a class='acceleratorbtn btn-xs btn-link panel-refresh' href='#'> <i class='fa fa-refresh'></i> </a>
			<a class='btn btn-xs btn-link panel-expand' href='#'> <i class='fa fa-resize-full'></i> </a>
		</div>
	</div>";

		echo "<div class='panel-body'>";

		echo "<table class='table table-striped table-bordered table-hover table-full-width dataTable' border='1' cellpadding='8'>
		
		<tr>
			<th>TAHUN AJARAN</th>
			<th>STATUS</th>
			<th>SEMESTER</th>
		</tr>";

		echo "</div>";
		echo "</div>";
		
		

		$numrow = 1;
		$kosong = 0;

		// Lakukan perulangan dari data yang ada di excel
		// $sheet adalah variabel yang dikirim dari controller
		foreach($sheet as $row){
			// Ambil data pada excel sesuai Kolom
			$tahun_ajaran = $row['A']; // Ambil data NIS
			$is_aktif = $row['B']; // Ambil data nama
			$semester_aktif = $row['C']; // Ambil data nama

			// Cek jika semua data tidak diisi
			if($tahun_ajaran == "" && $is_aktif == "" && $semester_aktif == "")
				continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Validasi apakah semua data telah diisi
				$tahun_td = ( ! empty($tahun_ajaran))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
				$is_aktif_td = ( ! empty($is_aktif))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
				$semester_td = ( ! empty($semester_aktif))? "" : " style='background: #E07171;'";

				// Jika salah satu data ada yang kosong
				if($tahun_ajaran == "" or $is_aktif == "" or $semester_aktif == ""){
					$kosong++; // Tambah 1 variabel $kosong
				}

				echo "<tr>";
				echo "<td".$tahun_td.">".$tahun_ajaran."</td>";
				echo "<td".$is_aktif_td.">".$is_aktif."</td>";
				echo "<td".$semester_td.">".$semester_aktif."</td>";
				echo "</tr>";
			}

			$numrow++; // Tambah 1 setiap kali looping
		}

		echo "</table>";

		// Cek apakah variabel kosong lebih dari 0
		// Jika lebih dari 0, berarti ada data yang masih kosong
		if($kosong > 0){
		?>
			<script>
			$(document).ready(function(){
				// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
				$("#jumlah_kosong").html('<?php echo $kosong; ?>');

				$("#kosong").show(); // Munculkan alert validasi kosong
			});
			</script>
		<?php
			echo "<a href='".base_url("index.php/tahun_ajaran/form")."' class='btn btn-s btn-danger'>Cancel</a>";
		}else{ // Jika semua data sudah diisi
			echo "<hr>";

			// Buat sebuah tombol untuk mengimport data ke database
			echo "<button type='submit' class='btn btn-primary margin-button-submit' name='import'>Import</button>";
			echo "<a href='".base_url("index.php/tahun_ajaran/form")."' class='btn btn-s btn-danger'>Cancel</a>";
		}

		echo "</form>";
	}
	?>
</body>
</html>
