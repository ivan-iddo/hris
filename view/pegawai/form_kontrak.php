<?php session_start();?>
<style type="text/css">
   input[type="date"]:before {
    content: attr(placeholder) !important;
    color: #aaa;
    margin-right: 0.5em;
}
input[type="date"]:focus:before,
input[type="date"]:valid:before {
    content: "";
}
</style>
<?php //if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
    <form name="form-file-kontrak" id="form-file-kontrak" class="form-horizontal">
        <div class="panel-body pad-all">
            <div class="row">
                <input type="text" name="id_userfile" id="id_userfile" style="display:none">
                <div class="form-group">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6"><input required name="inputfileupload" id="inputfileupload" type="file"
                       class="btn btn-success btn-sm fileinput-button dz-clickable"></div>
                       <div class="col-sm-3"></div>
                   </div>
                   <div class="form-group">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6"><input type="text" placeholder="No Kontrak" class="form-control" id="noktr"
                        required name="noktr"></div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6"><input type="text" placeholder="TMT Awal Kotrak" class="form-control tgl" id="tmtawal"
                            required name="tmtawal"></div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="form-group">
                         <div class="col-sm-3"></div>
                         <div class="col-sm-6"><input type="text" placeholder="Tanggal Kontrak" class="form-control tgl" id="tglktr"
                             required name="tglktr"></div>
                             <div class="col-sm-3"></div>
                         </div>
                         <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6"><input type="text" placeholder="Jenis Kontrak" class="form-control" id="jnsktr"
                                required name="jnsktr"></div>
                                <div class="col-sm-3"></div>
                            </div>
							 <div class="form-group"><label
								class="col-sm-3 control-label"></label>
								<div class="col-sm-6"><select class="select-chosen" id="statustetap"
								  name="statustetap" style="width: 100%;">
								</select>
								<span
								class="text-xs text-danger">*Wajib diisi Status Tetap</span>
							  </div>
							</div>
							<div class="form-group"><label
							  class="col-sm-3 control-label"></label>
							  <div class="col-sm-6"><select class="select-chosen" id="status"
								name="status" style="width: 100%;"
								onChange="getjabatanasn(this.value);">
							  </select>
							  <span
							  class="text-xs text-danger">*Wajib diisi Status PNS</span>
							</div>
						  </div>
                            <div class="form-group">
                             <div class="col-sm-3"></div>
                             <div class="col-sm-6"><input type="text" placeholder="Tanggal Akhir Kontrak" class="form-control tgl" id="tglakhir"
                                 name="tglakhir"></div>
                                 <div class="col-sm-3"></div>
                             </div>
                             <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                  <button type="submit" class="btn btn-default">Simpan</button>
                              </div>
                              <div class="col-sm-3"></div>
                          </div>
                      </div>
                  </div>
              </div>
          <?php //}?>
          <div class="row"></div>
          <div class="row pad-all">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th style="width:20px">No.</th>
                            <th>No Kontrak</th>
                            <th>TMT awal Kotrak</th>
                            <th>Tanggal Kontrak</th>
                            <th>Jenis Kontrak</th>
							<th>Status</th>
                            <th>PNS</th>
                            <th>TMT Akhir Kontrak</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="filekontrak"></tbody>
                </table>
            </div>
        </div>
    </form>
    <script> 
// set ID user
var id = $('#f_id_edit').val();
console.log(id);
$('#id_userfile').val(id);
$("form").on("submit", function(e){
    e.preventDefault();
    var id_pelatihan = $('#f_id_edit').val();
    $('#id_userfile').val(id_pelatihan);
    var form = $("#form-file-kontrak");
	if(empty($('#statustetap').val())){
         onMessage("Data 'Status Tetap' is required"); 
         return false;
    }else if(empty($('#status').val())){
         onMessage("Data 'Status PNS' is required"); 
         return false;
    }
    if (id_pelatihan !== '') {
        $.ajax({
            url: BASE_URL + "pegawais/kontrak/add", /* Url to which the request is send*/
            type: "POST",
            headers: {
                'Authorization': localStorage.getItem("Token"),
                'X_CSRF_TOKEN': 'donimaulana'
            },
            data: new FormData(form[0]), /* Data sent to server, a set of key/value pairs (i.e. form fields and values)*/
            contentType: false,       /* The content type used when sending data to the server.*/
            cache: false,             /* To unable request pages to be cached*/
            processData: false,        /* To send DOMDocument or non processed data file it is set to false*/
            success: function (data)   /* A function to be called if request succeeds*/ {
                if (data.success) {
                    getfileupload(data);
                    swal("Good job!", data.message, "success");
                } else {
                    alert(data.message);
                    return false;
                }
            }
        });
	
    } 
    else {
        swal('PERHATIAN!', 'Anda harus menyimpan data Pegawai Terlebih dahulu sebelum melakukan upload file!');
    }
});

function getfileupload(result) {
    $('#filekontrak').html(result.data);
}

function loadData() {
    getJson(getfileupload, BASE_URL + 'pegawais/kontrak/' + id);
}

loadData();

function filedelete(result) {
    if (result.success) {
        swal("Deleted!", "Data berhail dihapus.", "success");
    } else {
        swal("GAGAL!", "Data gagal dihapus.");
    }
    getfileupload(result);
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
        getJson(filedelete, BASE_URL + 'pegawais/kontrak/delete/' + a + "?id_userfile=" + id);
    });
}
$(document).ready(function () {
 $('.tgl').datepicker({
  format: "dd-mm-yyyy",
}).on('change', function(){
  $('.datepicker').hide();
});
});
$('.select-chosen').chosen();
$('.chosen-container').css({"width": "100%"});
getOptions("status", BASE_URL + "master/status_pegawai_pns");
getOptions("statustetap", BASE_URL + "master/status_pegawai_tetap");
 
     
</script>