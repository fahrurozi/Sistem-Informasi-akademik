<body>
	<div class="row">
		<div class="col-sm-12">
			<!-- start: TEXT FIELDS PANEL -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-external-link-square"></i> Edit Data
					<div class="panel-tools">
						<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
						</a>
						<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
							<i class="fa fa-wrench"></i>
						</a>
						<a class="btn btn-xs btn-link panel-refresh" href="#">
							<i class="fa fa-refresh"></i>
						</a>
						<a class="btn btn-xs btn-link panel-expand" href="#">
							<i class="fa fa-resize-full"></i>
						</a>
						<a class="btn btn-xs btn-link panel-close" href="#">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>

				<!-- FORM -->
				<div class="panel-body">
					<?php
                                    echo form_open('rombel/edit', 'role="form" class="form-horizontal"');
                                    echo form_hidden('id_rombel',$rombel['id_rombel']);
                                ?>
                    
                    <div class="form-group">
						<label class="col-sm-2 control-label" for="form-field-1">
							Rombongan Belajar
						</label>
						<div class="col-sm-8">
							<input type="text" value="<?php echo $rombel['nama_rombel'] ?>" name="nama_rombel" placeholder="Text Field" id="form-field-1"
								class="form-control" title="">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="form-field-select-1">
							Kelas
						</label>
						<div class="col-sm-8">
							<?php 
                            echo form_dropdown('kelas', array('1'=>'KELAS I', '2'=>'KELAS II', '3'=>'KELAS III', '4'=>'KELAS IV'), $rombel['kelas'], "class='form-control'");
                            ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="form-field-select-1">
							Jurusan
						</label>
						<div class="col-sm-8">
							<?php 
                                echo cmb_dinamis('id_jurusan', 'tb_jurusan', 'nama_jurusan', 'id_jurusan', $rombel['id_jurusan']);
                            ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="form-field-select-1"></label>
						<div class="col-sm-1">
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</div>
						<div class="col-sm-1">
							<?php echo anchor('rombel','Kembali', array("class" => "btn btn-default")); ?>
						</div>
					</div>

					</form>
				</div>
				<!-- FORM -->

			</div>
			<!-- end: TEXT FIELDS PANEL -->
		</div>
	</div>
</body>
