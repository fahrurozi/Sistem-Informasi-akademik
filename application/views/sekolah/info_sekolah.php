<body>

<div class="row">
                    <div class="col-sm-12">
                        <!-- start: TEXT FIELDS PANEL -->
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i> PROFIL SEKOLAH
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
                                    echo form_open('sekolah/index', 'role="form" class="form-horizontal"');
                                    echo form_hidden('id_sekolah',$info['id_sekolah']);
                                ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            NAMA SEKOLAH
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?php echo $info['nama_sekolah']; ?>" name="nama_sekolah" placeholder="NAMA SEKOLAH" id="form-field-1" class="form-control" title="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            ALAMAT SEKOLAH
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?php echo $info['alamat']; ?>" name="alamat" placeholder="ALAMAT SEKOLAH" id="form-field-1" class="form-control" title="">
                                        </div>
                                    </div>

                                    
                                    
                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1">
                                            JENJANG SEKOLAH
                                        </label>
                                        <div class="col-sm-8">
                                            <?php 
                                            echo cmb_dinamis('jenjang', 'tb_jenjang_sekolah', 'nama_jenjang', 'id_jenjang',$info['id_jenjang']);
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1">
                                            EMAIL, TELPON
                                        </label>
                                        <div class="col-sm-6">
                                            <input type="text" value="<?php echo $info['email']; ?>" name="email" placeholder="EMAIL" id="form-field-1" class="form-control" title="">
                                        </div>

                                        <div class="col-sm-2">
                                            <input type="text" value="<?php echo $info['telpon']; ?>" name="telpon" placeholder="TELPON" id="form-field-1" class="form-control" title="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1"></label>
                                        <div class="col-sm-1">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <div class="col-sm-1">
                                            <?php echo anchor('Siswa/','Kembali', array("class" => "btn btn-default")); ?>
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