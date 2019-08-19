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
                                <label>Upload</label>
                            </div>
                            <div class="col-sm-8">
                                <input required="" name="inputfileupload" id="inputfileupload" type="file"
                                       class="btn btn-success btn-sm fileinput-button dz-clickable">
                            </div>
                        </div>
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
									<option value="71">Laki - Laki</option>
                                    <option value="72">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="inputpropinsi">Pendidikan</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="txtPendidikan" name="txtPendidikan"
                                        style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="inputpropinsi">Pekerjaan</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="txtPekerjaan" name="txtPekerjaan"
                                        style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="inputpropinsi">Hubungan</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="txtHubungan" name="txtHubungan"
                                        style="width: 100%;">
                                </select>
                            </div>
                        </div>
						 <div class="form-group">
                            <label class="col-sm-4 control-label" for="inputstatus">Karis/Karsu</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="txtkarn" name="txtkarn" placeholder="">
                            </div>
                        </div><!-- End Hori sontal -->
                    </div>
                </div>
            </div><!--/.col (right) -->
        </div><!-- /.row -->
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
</script>