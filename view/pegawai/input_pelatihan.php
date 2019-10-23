<form id="form-pelatihan"  method="post" role="form" class="pad-all">
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
            <label class="col-sm-4 control-label" for="inputstatus">Pelatihan</label>
            <div class="col-sm-8">
              <input class="form-control" id="nama" name="nama" placeholder="" type="text">
              <input type="text" id="id_pelatihan" name="id_pelatihan" style="display:none">
            </div>
          </div>
                        <!--<div class="form-group">
                          <label class="col-sm-4 control-label" for="inputstatus">Lokasi</label>
                          <div class="col-sm-8">
                            <input class="form-control" id="tempat" name="tempat" placeholder="" type="text">
                          </div>
                        </div>
                      -->
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputrt">Lokasi</label>
                        <div class="col-sm-8">
                          <select class="form-control select2" id="tempat" name="tempat" style="width: 100%;">
                           
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputstatus">Penyelenggara</label>
                        <div class="col-sm-8">
                          <input class="form-control" id="penyelenggara" name="penyelenggara" placeholder="" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputrt">Penanggung Biaya</label>
                        <div class="col-sm-8">
                          <select class="form-control select2" id="penanggung" name="penanggung" style="width: 100%;">
                           <option value="1">Sendiri</option>
						   <option value="2">Kantor</option>     
						   <option value="3">Sponsor</option>     
              
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputtgllahirkel">Lama</label>
                        <div class="col-sm-8">
                          <input class="form-control" id="durasi" name="durasi" placeholder="" type="text">
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
                        <label class="col-sm-4 control-label" for="inputpropinsi">Mulai</label>
                        <div class="col-sm-8">
                          <input class="form-control tgl" id="mulai" name="mulai" placeholder="dd-mm-yyyy" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputpropinsi">Sampai</label>
                        <div class="col-sm-8">
                          <input class="form-control tgl" id="sampai" name="sampai" placeholder="dd-mm-yyyy" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputpropinsi">Bersetifikat</label>
                        <div class="col-sm-8">
                          <input class="form-control" id="jenis_sertifikat" name="jenis_sertifikat" placeholder="" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputpropinsi">No. Sertifikat</label>
                        <div class="col-sm-8">
                          <input class="form-control" id="no_sertifikat" name="no_sertifikat" placeholder="" type="text">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputrt">Kategori</label>
                        <div class="col-sm-8">
                          <select class="form-control select2" id="kategori" name="kategori" style="width: 100%;">
                           <option value="119">Kopetensi</option>
						   <option value="120">Profesi</option>     
		                  </select>
                        </div>
                      </div>
                      
                    </div>
                  </div><!-- /.box -->
                  
                  <!-- general form elements disabled -->
                  <!-- /.box -->
                </div><!--/.col (right) -->
              </div><!-- /.row -->
              <div class="panel pad-all mar-all">
                
                <div class="box-body">
                  
                  <div class="btn-group mar-rgt">
					 <input type="text" placeholder="nama file" class="form-control" id="namafile" name="namafile">
                    <input name="doc_file" id="doc_file" type="file" class="btn btn-success btn-sm fileinput-button dz-clickable">
                    
                  </div>
                  
                  
                  
                  <div class="row text-xs text-danger">
                    *Untuk upload ijazah silahkan simpan data terlebih dahulu
                  </div>
                  
                </div>
                <div class="panel-body">
                  <div class="row pad-all">
                    <div id="uploadbtn" class="btn btn-primary btn-sm pull-left upload-btn" onclick="upload_file()"><i class="fa fa-save"></i> Upload</div>
                  </div>
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
               </div>
             </div>
           </form>


           <script>
		   
		   function getfilepel(result) {
				$('#file').html(result.isi);
			}

    function loadfilepel() {
	var id_user = $('#id_user').val();
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
  
            function upload_file(){
			  var id_user = $('#id_user').val();
			  $('#id_userfile').val(id_user);
              var form = $("#form-pelatihan");
              var id_pelatihan = $('#id_pelatihan').val();
			  if (empty($('#doc_file').val())) {
					swal('PERHATIAN!', 'Anda belum memilih file untuk di upload');
					return false;
				} else if (empty($('#namafile').val())) {
					swal('PERHATIAN!', 'Anda memasukkan nama file');
					return false;
				}
              if(id_pelatihan!==''){
                $.ajax({
                            url: BASE_URL+"pegawais/upload/upload_pelatihan", // Url to which the request is send 
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
								loadfilepel();
							}else{
                              alert(message);
                              return false;	
                            }
                          }
                        });
              }else{
                alert('Anda harus menyimpan data pelatihan terlebih dahulu sebelum melakukan upload ijazah!');
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
    loadfilepel();
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
        getJson(filedelete, BASE_URL + 'pegawais/pelatihan/deletelist/?id=' + a);
    });
}

          </script>