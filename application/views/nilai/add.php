<body>

<div class="row">
                    <div class="col-sm-12">
                        <!-- start: TEXT FIELDS PANEL -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-external-link-square"></i> Tambah History Kelas
                            </div>

                            <!-- FORM -->
                            <div class="panel-body">
                                <?php
                                    echo form_open('nilai/add', 'role="form" class="form-horizontal"');
                                ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            NIS
                                        </label>
                                        <div class="col-sm-8">
                                            <?php 
                                            echo cmb_dinamis('nis', 'tb_siswa', 'nama', 'nis');
                                            ?>
                                            <?php echo $this->session->flashdata('message');?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-1">
                                            ROMBEL
                                        </label>
                                        <div class="col-sm-8">
                                            <?php
                                            echo cmb_dinamis('id_rombel', 'tb_rombel', 'nama_rombel', 'id_rombel',$this->uri->segment(3), 'selected');
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1">
                                            ID TAHUN AJARAN
                                        </label>
                                        <div class="col-sm-5">
                                            <?php echo cmb_dinamis('id_tahun_ajaran', 'tb_tahun_ajaran', 'tahun_ajaran', 'id_tahun_ajaran',null,"id='id_tahun_ajaran' onchange='loadTahun()'") ?>
                                        </div>
                                        <label class="col-sm-1 control-label" for="form-field-1">
                                            SEMESTER
                                        </label>
                                        <div class="col-sm-2">
                                            <div id="semester_aktif">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class ="col-sm-2 control-label" for="form-field-select-1"></label>
                                        <div class="col-sm-1">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <div class="col-sm-1">
                                            <?php echo anchor('nilai/','Kembali', array("class" => "btn btn-default")); ?>
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
