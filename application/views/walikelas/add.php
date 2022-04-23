<body>

<div class="row">
                    <div class="col-sm-12">
                        <!-- start: TEXT FIELDS PANEL -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i> Tambah Data
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
                                    echo form_open('walikelas/add', 'role="form" class="form-horizontal"');
                                ?>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            GURU
                                        </label>
                                        <div class="col-sm-8">
                                            <?php echo cmb_dinamis('id_guru', 'tb_guru', 'nama_guru', 'id_guru') ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            TAHUN AJARAN
                                        </label>
                                        <div class="col-sm-5">
                                            <!-- <?php echo cmb_dinamis('id_tahun_ajaran', 'tb_tahun_ajaran', 'tahun_ajaran', 'id_tahun_ajaran') ?> -->
                                            <?php echo cmb_dinamis('id_tahun_ajaran', 'tb_tahun_ajaran', 'tahun_ajaran', 'id_tahun_ajaran',null,"id='id_tahun_ajaran' onchange='loadTahun()'") ?>
                                        </div>
                                        <label class="col-sm-1 control-label" for="form-field-1">
                                            SEMESTER
                                        </label>
                                        <div class="col-sm-2">
                                            <!-- <?php echo cmb_dinamis('semester_aktif', 'tb_tahun_ajaran', 'semester_aktif', 'id_tahun_ajaran', "id='semester_aktif") ?> -->
                                            <div id="semester_aktif"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1">
                                            ROMBONGAN BELAJAR
                                        </label>
                                        <div class="col-sm-8">
                                            <?php echo cmb_dinamis('id_rombel', 'tb_rombel', 'nama_rombel', 'id_rombel') ?>    
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1"></label>
                                        <div class="col-sm-1">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <div class="col-sm-1">
                                        <?php echo anchor('walikelas/','Kembali', array("class" => "btn btn-default")); ?>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                            <!-- FORM -->

                        </div>
                        <!-- end: TEXT FIELDS PANEL -->
                    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadTahun();
    });
</script>

<script type="text/javascript">
    function loadTahun(){
        var tahun_ajaran=$('#id_tahun_ajaran').val();
        $.ajax({
            type:'GET',
            url:"<?php echo base_url('index.php/walikelas/show_combobox_semester_by_tahun_ajaran') ?>",
            data:'id_tahun_ajaran='+tahun_ajaran,
            success:function(html){
                $("#semester_aktif").html(html);
            }
        })
    }

</script>
</body>