<form id="form-golongan"  method="post" role="form" class="pad-all">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
		 <input type="text" style="display:none" name="kategorifile" id="kategorifile" value="12">
		  <input type="text" style="display:none" name="id_userfile" id="id_userfile">
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputstatus">Pangkat</label>
            <div class="col-sm-8">
              <select class="form-control select2" id="pangkat_id" name="pangkat_id" style="width: 100%; ">
                <option value="21">I / Non PNS GOL 1</option>
                <option value="20">I/A / JURU MUDA</option>
                <option value="19">I/B / JURU MUDA TK.1</option>
                <option value="18">I/C / JURU</option>     
                <option value="17">I/D / JURU TK.1</option>  
                <option value="16">II / Non PNS GOL 2</option>  
                <option value="15">II/A / PENGATUR MUDA</option>  
                <option value="14">II/B / PENGATUR MUDA TK.1</option>  
                <option value="13">II/C / PENGATUR</option> 
				<option value="12">II/D / PENGATUR TK.1</option>
                <option value="11">III / Non PNS GOL 3</option>
                <option value="10">III/A / PENATA MUDA</option>
                <option value="9">III/B / PENATA MUDA TK.1</option>     
                <option value="8">III/C / PENATA</option>  
                <option value="7">III/D / PENATA TK.1</option>  
                <option value="6">IV / Non PNS GOL 4</option>  
                <option value="4">IV/A / PEMBINA</option>  
                <option value="3">IV/B / PEMBINA TK.1</option> 
				<option value="2">IV/C / PEMBINA UTAMA MUDA</option>  
                <option value="1">IV/D / PEMBINA UTAMA MADYA</option>  
                <option value="5">IV/E / PEMBINA UTAMA</option> 
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
              <input class="form-control" id="tmt_golongan_akhir" name="tmt_golongan_akhir" placeholder="dd-mm-yyyy" type="text" readonly>
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
                                <option value="110">Fungsional</option>
                                <option value="111">Reguler</option>
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
				   <div class="row pad-all mar-all">
                   
					<div class="form-group">
                    <div class="col-sm-8">
                     <input type="text" placeholder="nama file" class="form-control" id="namafile" name="namafile">
                 </div>
				  <div class="form-group">
					<div class="col-sm-8">
                      <input name="doc_file" id="doc_file" type="file" class="btn btn-success btn-sm fileinput-button dz-clickable">
                      
                    </div>
                    </div>
             </div>
                    
                    
                     <div class="form-group">
					<div class="col-sm-8">
                    <div class="row text-xs text-danger">
                      *Untuk upload ijazah silahkan simpan data terlebih dahulu
                    </div>
                    </div>
                    </div>
                    
                   <div class="col-sm-8">
                  <div class="row pad-all">
                    <div id="uploadbtn" class="btn btn-primary btn-sm pull-left upload-btn" onclick="upload_file()"><i class="fa fa-save"></i> Upload</div>
                  </div>
                  </div> 
                  </div>
				   
                </div>

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
                            <tbody id="fileijazah">
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                 
              </form>


              <script>
			  
			  function getfileuploa(result) {
				$('#fileijazah').html(result.isi);
			}

    function loadfileuploa() {
	var id_user = $('#id_user').val();
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

                function upload_file(){
				  var id_user = $('#id_user').val();
				  $('#id_userfile').val(id_user);
				  var data = formJson('form-golongan');
                  var id_golongan = $('#id_golongan').val();
                   if (empty($('#doc_file').val())) {
					swal('PERHATIAN!', 'Anda belum memilih file untuk di upload');
					return false;
				} else if (empty($('#namafile').val())) {
					swal('PERHATIAN!', 'Anda memasukkan nama file');
					return false;
				}
                  if(!empty(id_golongan)){
                    $.ajax({
                            url: BASE_URL+"pegawais/upload/upload_golongan", // Url to which the request is send 
                             headers: {
				'Authorization': localStorage.getItem("Token"),
				'X_CSRF_TOKEN':'donimaulana',
				'Content-Type':'application/json'
			  },
			  dataType: 'json',
			  type: 'post',
			  contentType: 'application/json', 
			  processData: false,
              data:data,
              success: function( data, textStatus, jQxhr ){
                            hasil=data.hasil;
                            message = data.message;
							if (hasil == "success") {
								swal("Good job!", message, "success");
								loadfileuploa();
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
                      var test = date.addDays(2)
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
      $('.select2').chosen();
      $('.chosen-container').css({"width": "100%"});
    	function filedelete(result) {
    if (result.hasil === 'success') {
        swal("Deleted!", "Data berhail dihapus.", "success");
    } else {
        swal("GAGAL!", "Data gagal dihapus.");
    }
    loadfileuploa();
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
        getJson(filedelete, BASE_URL + 'pegawais/golongan/deletelist/?id=' + a);
    });
}  
    </script>