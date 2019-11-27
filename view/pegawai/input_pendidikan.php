<form id="form-pendidikan" class="pad-all" method="post" name="form-pendidikan" role="form">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
		<input type="text" style="display:none" name="kategorifile" id="kategorifile" value="13">
		  <input type="text" style="display:none" name="id_userfile" id="id_userfile">
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputpropinsi">Jenjang Pendidikan</label>
            <div class="col-sm-8">
              <select class="form-control select2" id="txtJPend" name="txtJPend" style="width: 100%;" onChange="getpendidikan(this.value);">
				<option value="54">SD</option>
                <option value="55">SLTP</option>
                <option value="56">SLTA</option>
                <option value="57">DIII</option>     
                <option value="94">DIV</option>  
                <option value="100">S1</option>  
                <option value="101">S2</option>  
                <option value="105">S3</option>  
                <option value="122">Spesialis</option>  
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputpropinsi">Jurusan</label>
            <div class="col-sm-8">
              <input class="form-control" id="txtJjurusan" name="txtJjurusan"  placeholder="" type="text">
            </div>
          </div>
          <div class="form-group" id="Spesialis">
            <label class="col-sm-4 control-label" for="inputpropinsi">Spesialis</label>
            <div class="col-sm-8">
              <input class="form-control" id="txtJspesialis" name="txtJspesialis"  placeholder="" type="text" >
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-4 control-label" for="inputpropinsi">Akreditasi</label>
            <div class="col-sm-8">
              <select class="form-control select2" id="txtJakreditasi" name="txtJakreditasi" style="width: 100%;">
                <option value="1">Akreditasi A</option>
                <option value="2">Akreditasi B</option>
                <option value="3">Akreditasi C</option>
                <option value="4">Akreditasi Ban PT</option>     
                <option value="5"> - </option>     
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputstatus">Nama Sekolah</label>
            <div class="col-sm-8">
              <input class="form-control" id="txtNamaSekolah" name="txtNamaSekolah"  placeholder="" type="text">
              <input class="form-control" id="id_pendidikan" name="id_pendidikan"  style="display:none" placeholder="" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputstatus">Tahun Lulus</label>
            <div class="col-sm-8">
              <input class="form-control" id="txtTahunLulus" name="txtTahunLulus" placeholder="" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputrt">No. Ijazah</label>
            <div class="col-sm-8">
              <input class="form-control" id="txtNoIjazah" name="txtNoIjazah" placeholder="" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputtgllahirkel">Tanggal Ijazah</label>
            <div class="col-sm-8">
              <input class="form-control tgl" id="txtTglIjazah" name="txtTglIjazah" placeholder="dd-mm-yyyy" type="text">
            </div>
          </div><!-- End Hori sontal -->
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputpropinsi">Status</label>
            <div class="col-sm-8">
              <select class="form-control select2" id="txtStatusLulus" name="txtStatusLulus" style="width: 100%;">
                <option value="1">Lulus</option>
                <option value="2">Tidak Lulus</option>     
              
              </select>
            </div>
          </div>
        </div>
      </div><!-- /.box -->
      <!-- Form Element sizes -->
      <!-- /.box -->
      <!-- Input addon -->
      <div class="box box-info">
        <!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
          <div class="btn-group mar-rgt">
			<input type="text" placeholder="nama file" class="form-control" id="namafile" name="namafile">
            <input name="doc_file" id="doc_file" type="file" class="btn btn-success btn-sm fileinput-button dz-clickable">
            <div id="uploadbtn" class="btn btn-primary btn-sm pull-left upload-btn" onclick="upload_file()"><i class="fa fa-save"></i> Upload</div>
            
          </div>
          
          
          <div class="row text-xs text-danger">
            *Untuk upload ijazah silahkan simpan data terlebih dahulu
          </div>
          
        </div><!-- End Hori sontal -->
      </div>
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
	function getpendidikan(a){

		if((a==='101') || (a==='105')){
     $('#Spesialis').show('slow');
   }else{
     $('#Spesialis').hide('slow');
   }
 }
 
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
  
 function upload_file(){
  var id_user = $('#id_user').val();
  $('#id_userfile').val(id_user);             
  var form = $("#form-pendidikan");
  var id_pendidikan = $('#id_pendidikan').val();
  if (empty($('#doc_file').val())) {
		swal('PERHATIAN!', 'Anda belum memilih file untuk di upload');
		return false;
	} else if (empty($('#namafile').val())) {
		swal('PERHATIAN!', 'Anda memasukkan nama file');
		return false;
	}
  if(id_pendidikan!==''){
    $.ajax({
                            url: BASE_URL+"pegawais/upload/upload_pendidikan", // Url to which the request is send 
                            type: "POST", 
                            data: new FormData(form[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                            contentType: false,       // The content type used when sending data to the server.
                            cache: false,             // To unable request pages to be cached
                            processData:false,        // To send DOMDocument or non processed data file it is set to false
                            success: function(data)   // A function to be called if request succeeds
                            {
                              hasil=data.hasil;
                               message = data.message;
							if (hasil == "success") {
								swal("Good job!", message, "success");
								loadfileijazah();
							}else{
                              alert(message);
                              return false;	
                            }
                          }
                        });
  }else{
    alert('Anda harus menyimpan data pendidikan terlebih dahulu sebelum melakukan upload ijazah!');
  }
}
$(document).ready(function () {
 $('.tgl').datepicker({
  format: "dd-mm-yyyy",
}).on('change', function(){
  $('.datepicker').hide();
});
});
$('.select2').chosen();
$('.chosen-container').css({"width": "100%"});
function filedelete(result) {
    if (result.hasil === 'success') {
        swal("Deleted!", "Data berhail dihapus.", "success");
    } else {
        swal("GAGAL!", "Data gagal dihapus.");
    }
    loadfileijazah();
}

function hapusfile(a) {
    swal({
        title: "Apakah Anda sudah Yakin?",
        text: "Data yang sudah dihapus tidak bisa di hidupkan kembali!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus saja!",
        closeOnConfirm: false
    }, function () {
        getJson(filedelete, BASE_URL + 'pegawai/deletelist_pen/?id=' + a);
    });
}
</script>