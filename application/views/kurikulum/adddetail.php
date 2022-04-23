<body>

<div class="row">
                    <div class="col-sm-12">
                        <!-- start: TEXT FIELDS PANEL -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i> Tambah
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
                                    echo form_open('kurikulum/adddetail', 'role="form" class="form-horizontal"');
                                ?>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            KURIKULUM
                                        </label>
                                        <div class="col-sm-8">
                                            <?php echo cmb_dinamis('id_kurikulum', 'tb_kurikulum', 'nama_kurikulum', 'id_kurikulum', $this->uri->segment(3)) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            MATA PELAJARAN
                                        </label>
                                        <div class="col-sm-8">
                                            <?php echo cmb_dinamis('id_mapel', 'tb_mapel', 'nama_mapel', 'id_mapel') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1">
                                            JURUSAN
                                        </label>
                                        <div class="col-sm-8">
                                            <?php echo cmb_dinamis('jurusan', 'tb_jurusan', 'nama_jurusan', 'id_jurusan') ?>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1">
                                            KELAS
                                        </label>
                                        <div class="col-sm-8">
                                            <select name ="kelas" class="form-control">
                                                <?php
                                                    for ($i=1;$i<=$info['jumlah_kelas'];$i++){
                                                        echo "<option value='$i'>Kelas $i</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1"></label>
                                        <div class="col-sm-1">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <div class="col-sm-1">
                                            <?php echo anchor('kurikulum/detail/'.$this->uri->segment(3),'Kembali', array("class" => "btn btn-default")); ?>
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