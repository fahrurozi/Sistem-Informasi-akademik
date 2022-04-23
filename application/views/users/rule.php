<div class="row">
    <div class="col-md-4">
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-table"></i> LEVEL USER
            </div>
            <div class="panel-body">
            
            <table id="Tabel" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <tr><td>Pilih Level</td><td><?php echo cmb_dinamis('level_user', 'tb_level_user', 'nama_level', 'id_level_user',null,"id='level_user' onChange='loadData()'")?></td></tr>
            </table>

            </div>
        </div>
    </div>
    <div class="col-md-8">
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-table"></i> HAK AKSES MODUL
            </div>
            <div class="panel-body">
            <div id="tabel"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        loadData();
    });
</script>

<script type="text/javascript">
	function loadData() {
		//var kelas = $("#kelas").val();
		//var jurusan = $("#jurusan").val();
        var level_user = $("#level_user").val();
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url('index.php/users/modul') ?>',
			data: 'level_user=' + level_user,
			success: function (html) {
				$("#tabel").html(html)
			}
		})
	}

    function addRule(id_modul){
        var level_user = $("#level_user").val();
        $.ajax({
			type: 'GET',
			url: '<?php echo base_url('index.php/users/addrule') ?>',
			data: 'level_user=' + level_user + '&id_menu=' + id_modul,
			success: function (html) {
				//$("#tabel").html(html)
                //loadData();
                alert("sukses");
			}
		})
    }
</script>
