<form id="form-keluarga" method="post" name="form-keluarga" enctype="multipart/form-data">
  <input id="id_keluarga" name="id_keluarga" style="" type="hidden">
  <div class="panel-body pad-all">
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                  
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class="control-label" for="inputstatus">N.I.K</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" id="txtNik" name="txtNik" placeholder="" type="text">
                            <input class="form-control" id="id_user_baru" name="id_user_baru" placeholder="" type="hidden">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputstatus">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtNama" name="txtNama" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputrt">Tmp.Lahir</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="txtTptLahir" name="txtTptLahir" placeholder=""
                            type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputtgllahirkel">Tanggal Lahir</label>
                        <div class="col-sm-8">
                            <input class="form-control tgl" id="txtTglLahir" name="txtTglLahir" placeholder="dd-mm-yyyy"
                            type="text">
                        </div>
                    </div><!-- End Hori sontal -->
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
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputpropinsi">Jenis Kelamin</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="txtKelamin" name="txtKelamin"
                            style="width: 100%;">
                            <option value="1">Laki - Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="inputpropinsi">Pendidikan</label>
                    <div class="col-sm-8">
                        <select class="form-control select2" id="txtPendidikan" name="txtPendidikan"
                        style="width: 100%;">
						<option value="">Please select..</option>				
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
                <label class="col-sm-4 control-label" for="inputpropinsi">Pekerjaan</label>
                <div class="col-sm-8">
                    <select class="form-control select2" id="txtPekerjaan" name="txtPekerjaan"
                    style="width: 100%;">
					<option value="">Please select..</option>				
					<option value="1">Pelajar</option>
					<option value="2">PNS</option>
					<option value="3">Karyawan Swasta</option>
					<option value="4">TNI</option>     
					<option value="5">Polri</option>  
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="inputpropinsi">Hubungan</label>
            <div class="col-sm-8">
                <select class="form-control select2" id="txtHubungan" name="txtHubungan"
                style="width: 100%;">
				<option value="">Please select..</option>
				<option value="1">Pasangan</option>
                <option value="2">Anak</option>
                <option value="3">Orang Tua</option>
                <option value="4">Kakak</option>     
                <option value="5">Adik</option>  
                <option value="6">Mertua</option>  
                <option value="7">Kakak Ipar</option>  
                <option value="8">Adik Ipar</option>  
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label" for="inputstatus">Karis/Karsu</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="txtkarn" name="txtkarn" placeholder="">
        </div>
    </div><!-- End Hori sontal -->
</div>
</div>
</div><!--/.col (right) -->
</div><!-- /.row -->
</div>
<div class="panel-body pad-all">
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                  <input type="text" style="display:none" name="kategorifile" id="kategorifile" value="11">
                  <input type="text" style="display:none" name="id_userfile" id="id_userfile">
                  
                  <div class="form-group">
                    <div class="col-sm-8">
                        <input name="inputfileupload" id="inputfileupload" type="file" class="btn btn-success btn-sm fileinput-button dz-clickable">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8">
                     <input type="text" placeholder="nama file" class="form-control" id="namafile" name="namafile">
                 </div>
             </div>
             <div class="form-group">
                <div class="col-sm-8">
                    <span id="uploadbtn" style="width:80px" class="form-control btn btn-primary btn-md  upload-btn" onclick="upload_file_klg()">
                        <i class="fa fa-save padd-left"></i> 
                        Upload
                    </span>
                </div>
            </div><!-- End Hori sontal -->
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
</div><!-- /.row -->
</div>
<div class="panel pad-all mar-all">
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
          <tbody id="filekeluarga">
            
          </tbody>
      </table>
  </div>
</div>
</div>      

</form>
<script type="text/javascript">

    var id_user = $('#id_user').val();
    $('#id_user_baru').val(id_user);
    $('.select2').chosen();
    $('.select-chosen').chosen();

    
    $('#form-keluarga').submit(function(e){
      e.preventDefault();
      /*
      * tambah fungsi untuk pengujian edit atau add
      */
      $.ajax({
        url: BASE_URL + 'pegawais/keluarga/savekeluarga',
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data, textStatus, jQxhr) {
         /*
         * tambah fungsi untuk niftyNoty
         */
         hasil = data.hasil;
         message = data.message;
         if (hasil == "success") {
            $.niftyNoty({
                type: 'success',
                title: 'Success',
                message: message,
                container: 'floating',
                timer: 5000
            });
            $("#form-keluarga").val(data.id);
            loadKeluarga();
                // $('.modal').modal('hide');
            } else {
                return false;
            }
        },
        error: function(jqXhr, textStatus, errorThrown) {
          /*
         * tambah fungsi untuk niftyNoty
         */
         hasil = jqXhr.hasil;
         message = jqXhr.message;
         $.niftyNoty({
            type: 'danger',
            title: 'Warning!',
            message: message,
            container: 'floating',
            timer: 5000
        });
     }
 }); 
  });
    $(document).ready(function () {
     $('.tgl').datepicker({
      format: "dd-mm-yyyy",
  }).on('change', function(){
      $('.datepicker').hide();
  });
});
    
    
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

  function upload_file_klg() {
    $('#id_userfile').val(id_user);
    var form = $("#form-keluarga");
    if (empty($('#inputfileupload').val())) {
        swal('PERHATIAN!', 'Anda belum memilih file untuk di upload');
        return false;
    } else if (empty($('#namafile').val())) {
        swal('PERHATIAN!', 'Anda memasukkan nama file');
        return false;
    }
    if (id_user !== '') {
        $.ajax({
            url: BASE_URL + "pegawais/keluarga/upload_file_klg", /* Url to which the request is send*/
            type: "POST",
            data: new FormData(form[0]), /* Data sent to server, a set of key/value pairs (i.e. form fields and values)*/
            contentType: false,       /* The content type used when sending data to the server.*/
            cache: false,             /* To unable request pages to be cached*/
            processData: false,        /* To send DOMDocument or non processed data file it is set to false*/
            success: function (data)   /* A function to be called if request succeeds*/ {
                hasil = data.hasil;
                message = data.message;
                if (hasil == "success") {
                    swal("Good job!", message, "success");
                    loadfileupload();
                } else {
                    alert(message);
                    return false;
                }
            }
        });
    } else {
        swal('PERHATIAN!', 'Anda harus menyimpan data Pegawai Terlebih dahulu sebelum melakukan upload file!');
    }
}
function filedelete(result) {
    if (result.hasil === 'success') {
        swal("Deleted!", "Data berhail dihapus.", "success");
    } else {
        swal("GAGAL!", "Data gagal dihapus.");
    }
    loadfileupload();
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
        getJson(filedelete, BASE_URL + 'pegawai/deletelist_klg/?id=' + a);
    });
}
</script>