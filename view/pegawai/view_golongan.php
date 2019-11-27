<form id="form-golongan"  method="post" role="form" class="pad-all">
 <input class="form-control" id="id_golongan" name="id_golongan" placeholder="" type="text" style="display:none">
  <input type="text" style="display:none" name="kategorifile" id="kategorifile" value="12">
  <input type="text" style="display:none" name="id_userfile" id="id_userfile">           
<div class="table-responsive">
  <table class="table table-striped">
	<thead>
	  <tr>
		<th>No.</th>
		<th>Nama File</th>
		<th>Action</th>
	  </tr>
	</thead>
	<tbody id="fileijazah">
	  
	</tbody>
  </table>
</div>

</form>


	  <script>
	  
	  function getfileuploa(result) {
		$('#fileijazah').html(result.isi);
	}

function loadfileuploa() {
var id_user = $('#id_user').val();
$('#id_userfile').val(id_user);
var selectedRows = gridGolonganOpt.api.getSelectedRows();
var selectedRowsString = '';
selectedRows.forEach( function(selectedRow, index) {

if (index!==0) {
	selectedRowsString += ', ';
}
selectedRowsString += selectedRow.id;
});
getJson(getfileuploa, BASE_URL + 'pegawais/golongan/file_gol/?id=' + id_user + '&id_gol=' + selectedRowsString +'&kategori=' + $('#kategorifile').val());
}

loadfileuploa();
</script>