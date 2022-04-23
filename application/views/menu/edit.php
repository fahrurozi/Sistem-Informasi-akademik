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
                                    echo form_open('menu/edit', 'role="form" class="form-horizontal"');
                                    echo form_hidden('id_menu',$menu['id_menu']);
                                ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            NAMA MENU
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?php echo $menu['nama_menu']?>" name="nama_menu" placeholder="MASUKAN NAMA MENU" id="form-field-1" class="form-control" title="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            URL
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?php echo $menu['url']?>" name="url" placeholder="MASUKAN URL" id="form-field-1" class="form-control" title="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            ICON
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?php echo $menu['icon']?>" name="icon" placeholder="MASUKAN KODE IKON" id="form-field-1" class="form-control" title="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            IS MAIN MENU
                                        </label>
                                        <div class="col-sm-8">
                                        <select name="is_main_menu" class="form-control">
                                                <option value="0">MAIN MENU</option>
                                                <?php
                                                $tb_menu = $this->db->get('tb_menu');
                                                foreach ($tb_menu->result() as $row){
                                                    echo "<option value='$row->id_menu'";
                                                    echo $row->id_menu==$menu['is_main_menu']?'selected':'';
                                                    echo ">$row->nama_menu</option>";
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
                                            <?php echo anchor('menu','Kembali', array("class" => "btn btn-default")); ?>
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
