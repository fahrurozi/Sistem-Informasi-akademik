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
                                
                                <?php echo form_open_multipart('users/add', 'role="form" class="form-horizontal"');?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            NAMA LENGKAP
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="nama_lengkap" placeholder="MASUKAN NAMA LENGKAP" id="form-field-1" class="form-control" title="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            USERNAME
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="username" placeholder="MASUKAN USERNAME" id="form-field-1" class="form-control" title="">
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            PASSWORD
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="password" name="password" placeholder="MASUKAN PASSWORD" id="form-field-1" class="form-control" title="">
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1">
                                            LEVEL USER
                                        </label>
                                        <div class="col-sm-8">
                                            <?php 
                                            echo cmb_dinamis('1', 'tb_level_user', 'nama_level', 'id_level_user', '1', 'disabled');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            FOTO
                                        </label>
                                        <div class="col-sm-2">
                                            <input type="file" name="userfile"> 
                                            <!-- <input type="file" name="userfile" >                                            -->                                    
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1"></label>
                                        <div class="col-sm-1">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <div class="col-sm-1">
                                            <?php echo anchor('users','Kembali', array("class" => "btn btn-default")); ?>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                <!--</form> -->
                            </div>
                            <!-- FORM -->

                        </div>
                        <!-- end: TEXT FIELDS PANEL -->
                    </div>
</div>
</body>
