<?php
require_once('../../connectdb.php');

?>
<form id="form-jfung"  method="post" role="form" class="form-horizontal pad-all">
	<div class="row">
	<input type="text" style="display:none" name="kategorifile" id="kategorifile" value="13">
		  <input type="text" style="display:none" name="id_userfile" id="id_userfile">
		<div class="col-lg-5">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrt">Direktorat</label>
				<div class="col-sm-8">
				<input type="hidden" value="<?php echo $_SESSION['userdata']['_pnc_username'] ; ?>" name="created" id="created">
					<input id="txtIdUser" name="txtIdUser" style="display:none" type="text">
					<input id="idasn" name="idasn" style="display:none" type="text">
					<select aria-hidden="true" class="select-chosen" id="txtjabatan" name="txtjabatan" onchange="getToSub(this.value,'txtbagian','master/direktoratSub/')" style="width: 70%;" tabindex="-1">
						
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrw">Bagian</label>
				<div class="col-sm-8">
					<select aria-hidden="true" class="select-chosen" id="txtbagian" name="txtbagian" onchange="getToSub(this.value,'unitkerja','master/direktoratSub/')" style="width: 100%;" tabindex="-1">
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputpropinsi">Sub Bagian</label>
				<div class="col-sm-8">
					<select aria-hidden="true" class="select-chosen" id="unitkerja" name="unitkerja" style="width: 100%;" tabindex="-1">
						
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrw">TMT JabFung</label>
				<div class="col-sm-8">
					<input class="form-control tgl" type="text" id="tmt_jabfung" name="tmt_jabfung" placeholder="dd-mm-yyyy">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputpropinsi">No SK JabFung</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="no_skjfung" name="no_skjfung">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrw">Tgl SK JabFung</label>
				<div class="col-sm-8">
					<input class="form-control tgl" type="text" id="tgl_skjafung" name="tgl_skjafung" placeholder="dd-mm-yyyy">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrw">No.PAK</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="no_pak" name="no_pak">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrw">TMT PAK</label>
				<div class="col-sm-8">
					<input class="form-control tgl" type="text" id="tmt_pak" name="tmt_pak" placeholder="dd-mm-yyyy">
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrw">Tgl PAK</label>
				<div class="col-sm-8">
					<input class="form-control tgl" type="text" id="tgl_pak" name="tgl_pak" placeholder="dd-mm-yyyy">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputpropinsi">Nilai PAK</label>
				<div class="col-sm-8">
					<input class="form-control" type="number" id="nilai_pak" name="nilai_pak">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputpropinsi">Satuan Kerja</label>
				<div class="col-sm-8">
					<select aria-hidden="true" class="select-chosen" id="satuan_kerja" name="satuan_kerja" style="width: 100%;" tabindex="-1">
						
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="demo-is-inputsmall">Keterangan</label>
				<div class="col-sm-8">
					<textarea placeholder="" class="form-control input-sm" id="keterangan" name="keterangan" type="text">
					</textarea>
				</div>
			</div> 
			<div class="form-group"><label class="col-sm-4 control-label"
				for="inputkab">Jabatan ASN</label>
				<div class="col-sm-8"><select aria-hidden="true"
					class="form-control select-chosen"
					id="jabfungasn" name="jabfungasn"
					style="width: 100%;"
					tabindex="-1"><option value=0>Please Select</option></select></div>
				</div>
				<div class="form-group"><label class="col-sm-4 control-label"
					for="inputkab">Jenis Jabatan</label>
					<div class="col-sm-8"><select aria-hidden="true"
						class="form-control select-chosen"
						id="ahlifungasn" name="ahlifungasn"
						style="width: 100%;" tabindex="-1"
						onchange="getToSub(this.value,'ketahlijabfungasn','m/keahlian_asn/getoption/')"><option value=0>Please Select</option></select>
					</div>         
				</div>
				
				<div class="form-group" id="inputpns"><label
					class="col-sm-4 control-label"
					for="inputkab">Ket Jabatan</label>
					<div class="col-sm-8"><select aria-hidden="true"
						class="form-control select-chosen"
						id="ketahlijabfungasn" name="ketahlijabfungasn"
						style="width: 100%;"
						tabindex="-1"></select></div>
					</div>
				</div>

			</div>
		</div>
		<div class="panel pad-all mar-all">
			
			<div class="box-body">
				
				<div class="btn-group mar-rgt">
					<input type="text" placeholder="nama file" class="form-control" id="namafile" name="namafile">
					<input name="doc_file" id="doc_file" type="file" class="btn btn-success btn-sm fileinput-button dz-clickable">
					
				</div>
				
				
				
				<div class="row text-xs text-danger">
					*Untuk upload file simpan data terlebih dahulu
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
						<tbody id="fileasn">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>      
	</form>


	<script>
	 function getfileasn(result) {
				$('#fileasn').html(result.isi);
			}

    function loadfileasn() {
	var id_user = $('#id_user').val();
      var selectedRows = gridJOpt.api.getSelectedRows();
      var selectedRowsString = '';
      selectedRows.forEach( function(selectedRow, index) {
       
        if (index!==0) {
            selectedRowsString += ', ';
        }
        selectedRowsString += selectedRow.id;
    });
      getJson(getfileasn, BASE_URL + 'pegawais/jabatan_asn/file_asn/?id=' + id_user + '&id_asn=' + selectedRowsString +'&kategori=' + $('#kategorifile').val());
  }

  loadfileasn();
  
		function upload_file(){
			var id_user = $('#id_user').val();
			$('#id_userfile').val(id_user);
			var form = $("#form-jfung");
			var idasn = $('#idasn').val();
			if (empty($('#doc_file').val())) {
				swal('PERHATIAN!', 'Anda belum memilih file untuk di upload');
				return false;
			} else if (empty($('#namafile').val())) {
				swal('PERHATIAN!', 'Anda memasukkan nama file');
				return false;
			}
			if(!empty(idasn)){
				$.ajax({
	                url: BASE_URL+"pegawais/upload/upload_jabasn", // Url to which the request is send 
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
								loadfileasn();
							}else{
                              alert(message);
                              return false;	
                            }
	                }
	            });
			}else{
				alert('Anda harus menyimpan data jabatan Asn terlebih dahulu sebelum melakukan upload!');
			}
		}
		$('.select-chosen').chosen();
		$('.chosen-container').css({"width": "100%"});
		
		$(document).ready(function () {
			$('.tgl').datepicker({
				format: "dd-mm-yyyy",
			}).on('change', function(){
				$('.datepicker').hide();
			});
		});
		
		function filedelete(result) {
    if (result.hasil === 'success') {
        swal("Deleted!", "Data berhail dihapus.", "success");
    } else {
        swal("GAGAL!", "Data gagal dihapus.");
    }
    loadfileasn();
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
        getJson(filedelete, BASE_URL + 'pegawais/jabatan_asn/deletelist/?id=' + a);
    });
}
	</script>