<form id="form-pelatihan"  method="post" role="form" class="pad-all">
<input type="text" style="display:none" name="kategorifile" id="kategorifile" value="13">
<input type="text" style="display:none" name="id_userfile" id="id_userfile">
<input type="text" id="id_pelatihan" name="id_pelatihan" style="display:none">
  <div class="table-responsive">
   <table class="table table-striped">
	 <thead>
	   <tr>
		 <th>No.</th>
		 <th>Nama File</th>
		 <th>Action</th>
	   </tr>
	 </thead>
	 <tbody id="file">
	  
	 </tbody>
   </table>
 </div>
</form>


<script>

function getfilepel(result) {
	$('#file').html(result.isi);
}

function loadfilepel() {
var id_user = $('#id_user').val();
$('#id_userfile').val(id_user);
var selectedRows = gridPelatihanOpt.api.getSelectedRows();
var selectedRowsString = '';
selectedRows.forEach( function(selectedRow, index) {

if (index!==0) {
	selectedRowsString += ', ';
}
selectedRowsString += selectedRow.id;
});
getJson(getfilepel, BASE_URL + 'pegawais/pelatihan/file_pel/?id=' + id_user + '&id_pel=' + selectedRowsString +'&kategori=' + $('#kategorifile').val());
}

loadfilepel();

</script>