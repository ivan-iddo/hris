<form id="form-jfung"  method="post" role="form" class="form-horizontal pad-all">
	<div class="row">
	<input type="text" style="display:none" name="kategorifile" id="kategorifile" value="13">
		  <input type="text" style="display:none" name="id_userfile" id="id_userfile">
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