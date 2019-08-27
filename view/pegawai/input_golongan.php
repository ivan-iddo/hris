<form id="form-golongan"  method="post" role="form" class="pad-all">
                <div class="row">
                  <!-- left column -->
                  <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                      <!-- /.box-header -->
                      <!-- form start -->
                      <div class="box-body">
					     <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputstatus">Pangkat</label>
                          <div class="col-sm-8">
                          <select class="form-control select2" id="pangkat_id" name="pangkat_id" style="width: 100%; ">
                               
                               </select>
						<input class="form-control" id="id_golongan" name="id_golongan" placeholder="" type="text" style="display:none">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="tmt_golongan">TMT Golongan</label>
                          <div class="col-sm-8">
                            <input class="form-control tgl" id="tmt_golongan" name="tmt_golongan" placeholder="dd-mm-yyyy" type="text">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="tmt_golongan_akhir">TMT Akhir</label>
                          <div class="col-sm-8">
                            <input class="form-control tgl" id="tmt_golongan_akhir" name="tmt_golongan_akhir" placeholder="dd-mm-yyyy" type="text" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputstatus">No.SK</label>
                          <div class="col-sm-8">
                          <input class="form-control" id="no_sk" name="no_sk" placeholder="" type="text">
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
                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputpropinsi">Tgl. SK</label>
                          <div class="col-sm-8">
                            <input class="form-control tgl" id="tgl_sk" name="tgl_sk" placeholder="dd-mm-yyyy" type="text">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputpropinsi">Penandatangan SK</label>
                          <div class="col-sm-8">
                            <input class="form-control" id="penanda_tanganan" name="penanda_tanganan" placeholder="" type="text">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputpropinsi">Status</label>
                          <div class="col-sm-8">
                            <select class="form-control" id="status" name="status" type="text" onChange="getTmtakhir(this.value);">
                              <option value="">--Silahkan Pilih--</option>
                              <!-- <option value="fungsional">Fungsional</option>
                              <option value="reguler">Reguler</option> -->
                            </select>
                          </div>
                        </div>
						<div class="form-group">
                          <label class="col-sm-4 control-label" for="inputpropinsi">Keterangan</label>
                          <div class="col-sm-8">
                            <input class="form-control" id="ket" name="ket" placeholder="Keterangan" type="text">
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
                                                      <tbody id="fileIjazah">
                                                        
                                                        </tbody>
                                                      </table>
                            </div>
                      </div>
        
                </div>
</div>
<div class="row pad-all mar-all">
<div class="btn-group mar-rgt">
          <input name="doc_file" id="doc_file" type="file" class="btn btn-success btn-sm fileinput-button dz-clickable">
                                                 
          </div>
          
             
             
                                    <div class="row text-xs text-danger">
                                        *Untuk upload ijazah silahkan simpan data terlebih dahulu
                                    </div>
                                     
            </div>
            <div class="row pad-all">
                  <div id="uploadbtn" class="btn btn-primary btn-sm pull-left upload-btn" onclick="upload_file()"><i class="fa fa-save"></i> Upload</div>
              </div>
</div>

              </form>


              <script>
    function upload_file(){
                var form = $("#form-golongan");
                var id_golongan = $('#id_golongan').val();
                
                    if(!empty(id_golongan)){
                            $.ajax({
                            url: BASE_URL+"pegawais/upload/upload_golongan", // Url to which the request is send 
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
                    alert('Anda harus menyimpan data golongan terlebih dahulu sebelum melakukan upload ijazah!');
                }
    }
   

    Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setFullYear(date.getFullYear() + days);
    return date;
    }

    function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [month, day, year].join('-');
    }

     function getTmtakhir(a){

      if ($('#tmt_golongan').val() == "") {
        alert('Anda harus mengisi TMT Golongan terlebih dahulu!');
        $('#status').val("")
      } else {
        if(a==='110'){
          var date = new Date($('#tmt_golongan').val());
          var test = date.addDays(3)
          var tust = formatDate(test)
          document.getElementById("tmt_golongan").readOnly = true;
           $('#tmt_golongan_akhir').val(tust);
         }else if(a==='111'){
          var date = new Date($('#tmt_golongan').val());
          var test = date.addDays(4)
          var tust = formatDate(test)
          document.getElementById("tmt_golongan").readOnly = true;
          $('#tmt_golongan_akhir').val(tust);
         }else{
          document.getElementById("tmt_golongan").readOnly = false;
        }
      }

        // var date = new Date();

        // alert(date.addDays(5));

     }
	 $(document).ready(function () {
	  $('.tgl').datepicker({
		format: "dd-mm-yyyy",
	  }).on('change', function(){
		$('.datepicker').hide();
	  });
	 });
</script>