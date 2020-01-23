<form name="form-file-upload-sk" id="form-file-upload-sk" class="form-horizontal">
    <div class="panel-body pad-all">
        <div class="row">
            <input type="text" style="display:none" name="kategorifile" id="kategorifile" value="<?php echo $_GET['id'] ?>">
            <input type="text" style="display:none" name="id_userfile" id="id_userfile">
            <div class="form-group">
                <div class="col-sm-4">
                    <input name="inputfileupload" id="inputfileupload" type="file" class="btn btn-success btn-sm fileinput-button dz-clickable">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <input type="text" placeholder="nama file" class="form-control" id="namafile" name="namafile">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <span id="uploadbtn" style="width:80px" class="form-control btn btn-primary btn-md  upload-btn" onclick="upload_file2()">
                        <i class="fa fa-save padd-left"></i> 
                        Upload
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row"></div>
<div class="row pad-all">
    <div class="table-responsive">
        <table class="table table-striped table-hover table-vcenter">
            <thead>
                <tr>
                    <th class="min-width" style="width:20px">No.</th>
                    <th>Nama File</th>
                    <th class="min-width" style="width:20px">View</th>
                    <th class="min-width" style="width:20px">Delete</th>
                </tr>
            </thead>
            <tbody id="filesk"></tbody>
        </table>
    </div>
</div>
</form>
<script> function upload_file2() {
    var id_pelatihan = $('#f_id_edit').val();
    $('#id_userfile').val(id_pelatihan);
	var data = formJson('form-file-upload-sk');
    if (empty($('#inputfileupload').val())) {
        swal('PERHATIAN!', 'Anda belum memilih file untuk di upload');
        return false;
    } else if (empty($('#namafile').val())) {
        swal('PERHATIAN!', 'Anda memasukkan nama file');
        return false;
    }
    if (id_pelatihan !== '') {
        $.ajax({
            url: BASE_URL + "pegawais/upload/upload_file", /* Url to which the request is send*/
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

function getfileupload(result) {
    $('#filesk').html(result.isi);
}

function loadfileupload() {
    getJson(getfileupload, BASE_URL + 'pegawai/listfile/?id=' + $('#f_id_edit').val() + '&kategori=' + $('#kategorifile').val());
}

loadfileupload();

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
        getJson(filedelete, BASE_URL + 'pegawai/deletelistfile/?id=' + a);
    });
}</script>