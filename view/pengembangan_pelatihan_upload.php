<form id="form-latbang-upload" method="post" name="form-latbang-upload" enctype="multipart/form-data">
  <input id="id_latbang" name="id_latbang" style="" type="hidden">
    <div class="panel-body pad-all">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
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
                    </div>
                </div><!-- /.box -->
                <!-- Form Element sizes -->
                <!-- /.box -->
                <!-- Input addon -->
                <div class="box box-info">
                    <!-- /.box-body -->
                </div><!-- /.box -->
            </div><!--/.col (left) -->
        </div><!-- /.row -->
    </div>
</form>
<script type="text/javascript">

    var id_upload = $('#id_upload').val();
    var id_latbang = $('#id_latbang').val(id_upload);

    $('#form-latbang-upload').submit(function(e){
      e.preventDefault();
      /*
      * tambah fungsi untuk pengujian edit atau add
      */
      var form = $("#form-latbang-upload");
      var data = new FormData(form[0]);
      for (var value of data.values()) {
       console.log(value); 
      } 

      $.ajax({
        url: BASE_URL + 'pegawais/keluarga/upload_file',
        // url: BASE_URL + 'pengembangan_pelatihan/upload_file/?id='+id_upload,
        // headers: {
        //         'Authorization': localStorage.getItem("Token"),
        //         'X_CSRF_TOKEN': 'reshaelfianur',
        //         'Content-Type': 'application/json'
        //     },
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
                 loaddata(0);
                 return false;
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
</script>