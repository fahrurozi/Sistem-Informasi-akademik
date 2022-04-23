<body>

<div class="row">
                    <div class="col-sm-12">
                        <!-- start: TEXT FIELDS PANEL -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i> Text Fields
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
                                    echo form_open('siswa/add', 'role="form" class="form-horizontal"');
                                ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            NIS
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="nis" placeholder="Text Field" id="form-field-1" class="form-control" title="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            Nama
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="nama" placeholder="Text Field" id="form-field-1" class="form-control" title="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1">
                                            Jenis Kelamin
                                        </label>
                                        <div class="col-sm-8">
                                            <?php 
                                            echo form_dropdown('gender', array('L'=>'Laki-laki', 'P'=>'Perempuan'), null, "class='form-control'");
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1">
                                            Agama
                                        </label>
                                        <div class="col-sm-8">
                                            <?php 
                                            echo cmb_dinamis('agama', 'tb_agama', 'nama_agama', 'id_agama');
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1">
                                            TTL
                                        </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="tempat_lahir" placeholder="Text Field" id="form-field-1" class="form-control" title="">
                                        </div>

                                        <div class="col-sm-2">
                                            <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" id="form-field-1" class="form-control" title="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1">
                                            Rombel
                                        </label>
                                        <div class="col-sm-8">
                                            <?php 
                                            echo cmb_dinamis('rombel', 'tb_rombel', 'nama_rombel', 'id_rombel');
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1"></label>
                                        <div class="col-sm-1">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <div class="col-sm-1">
                                            <?php echo anchor('siswa/','Kembali', array("class" => "btn btn-default")); ?>
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