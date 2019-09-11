<form id="form-pelatihan"  method="post" role="form" class="pad-all">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
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
                      
                    </div>
                  </div><!-- /.box -->
                  
                  <!-- general form elements disabled -->
                  <!-- /.box -->
                </div><!--/.col (right) -->
              </div><!-- /.row -->
              <div class="panel pad-all mar-all">
                
                <div class="box-body">
                  
                  <div class="btn-group mar-rgt">
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
                     <tbody id="fileIjazah">
                      
                     </tbody>
                   </table>
                 </div>
               </div>
             </div>
           </form>


           <script>
            function upload_file(){
              var form = $("#form-pelatihan");
              var id_pelatihan = $('#id_pelatihan').val();
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
                              var datafile='';
                              datafile+='<tr>';
                              datafile+='<td>1.';
                              datafile+='</td>';
                              datafile+='<td>';
                              datafile +=data.file.substring(0, 30)+'...';
                              datafile+='</td>';
                              datafile+='<td>';
                              
                              datafile +='<a title="Lihat File" id="book1-trigger" class="btn btn-default" href="javascript:void(0)" onclick="buildBook(\'api/upload/data/'+data.file+'\')"><i class="fa fa-eye"></i></a>';
                              datafile+='</td>';
                              datafile+='</tr>';
                              $('#fileIjazah').html(datafile);
                              
                              message=data.message; 
                              if(hasil=="success"){ 
                                
                               $.niftyNoty({
                                 type: 'success',
                                 title: 'Success',
                                 message: message,
                                 container: 'floating',
                                 timer: 5000
                               });  
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
            
          </script>