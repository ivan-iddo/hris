<form id="form-keluarga" method="post" name="form-keluarga" enctype="multipart/form-data">
 <input id="id_keluarga" name="id_keluarga" style="" type="hidden">
  <input class="form-control" id="id_user_baru" name="id_user_baru" placeholder="" type="hidden">
  <input type="text" style="display:none" name="kategorifile" id="kategorifile" value="11">
</div>
<div class="panel pad-all mar-all">
     
<div class="table-responsive">
<table class="table table-striped">
   <thead>
	  <tr>
		  <th>No.</th>
		  <th>Nama File</th>
		  <th>Action</th>
	  </tr>
  </thead>
  <tbody id="filekeluarga">
	
  </tbody>
</table>
</div>
</div>      

</form>
<script type="text/javascript">

    var id_user = $('#id_user').val();
    $('.select2').chosen();
    $('.select-chosen').chosen();
    
    function getfileupload(result) {
        $('#filekeluarga').html(result.isi);
    }

    function loadfileupload() {
      var selectedRows = gridKeluargaOpt.api.getSelectedRows();
      var selectedRowsString = '';
      selectedRows.forEach( function(selectedRow, index) {
       
        if (index!==0) {
            selectedRowsString += ', ';
        }
        selectedRowsString += selectedRow.id;
    });
      getJson(getfileupload, BASE_URL + 'pegawai/file_klg/?id=' + id_user + '&id_kel=' + selectedRowsString +'&kategori=' + $('#kategorifile').val());
  }

  loadfileupload();
</script>