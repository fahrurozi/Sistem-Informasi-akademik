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
                                    echo form_open('guru/edit', 'role="form" class="form-horizontal"');
                                    echo form_hidden('id_guru',$guru['id_guru']);
                                ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            NIP
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?php echo $guru['nip']; ?>" name="nip" placeholder="NIP" id="form-field-1" class="form-control" title="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            NAMA GURU
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?php echo $guru['nama_guru']; ?>" name="nama_guru" placeholder="NAMA GURU" id="form-field-1" class="form-control" title="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="form-field-1" class="col-sm-2 control-label">
                                            GENDER
                                        </label>
                                        <div class="col-sm-9">
                                            <?php echo 
                                            form_dropdown('gender',array('L'=>'Laki-laki','P'=>'Perempuan'), $guru['gender'],"class='form-control'");
                                              ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1"></label>
                                        <div class="col-sm-1">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <div class="col-sm-1">
                                            <?php echo anchor('guru','Kembali', array("class" => "btn btn-default")); ?>
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