<form id="form-pendidikan" class="pad-all" method="post" name="form-pendidikan" role="form">

    <!-- left column -->
	<input type="text" style="display:none" name="kategorifile" id="kategorifile" value="13">
	  <input type="text" style="display:none" name="id_userfile" id="id_userfile">
      <div class="panel-body">
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
     </div><!-- /.box -->
     <!-- general form elements disabled -->
     <!-- /.box -->
   </div><!--/.col (right) -->
 </div><!-- /.row -->
 <div> 
 </div>
</form>
<script>
 
 function getfileijazah(result) {
        $('#fileijazah').html(result.isi);
    }

    function loadfileijazah() {
	var id_user = $('#id_user').val();
      var selectedRows = gridPendidikanOpt.api.getSelectedRows();
      var selectedRowsString = '';
      selectedRows.forEach( function(selectedRow, index) {
       
        if (index!==0) {
            selectedRowsString += ', ';
        }
        selectedRowsString += selectedRow.id;
    });
      getJson(getfileijazah, BASE_URL + 'pegawai/file_pendi/?id=' + id_user + '&id_pen=' + selectedRowsString +'&kategori=' + $('#kategorifile').val());
  }

  loadfileijazah();
</script>