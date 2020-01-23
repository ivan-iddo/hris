<form name="form-file-identitas" id="form-file-identitas" class="form-horizontal">
    <div class="panel-body pad-all">
        <div class="row">
         <div class="col-md-4">
             <img src="" id="img-cover" class="img-responsive pad"
             style="border:1px solid #999; width:180px; height:200px;"><label>Upload
             Cover</label><input name="cover_file" id="cover-fl" type="file">
             <p class="help-block">jpg, jpeg, png</p><a href="javascript:void(0);"
             class="btn btn-primary pull-left upload-btn"
             onclick="upload_file()"><i
             class="fa fa-save"></i> Upload</a>
         </div>
         <div class="col-md-6">
            <input type="text" style="display:none" name="kategorifile" id="kategorifile" value="<?php echo $_GET['id'] ?>">
            <input type="text" style="display:none" name="id_userfile" id="id_userfile">
            <div class="form-group">
                <div class="col-sm-4">
                    <input name="inputfileupload" id="inputfileupload" type="file" class="btn btn-success btn-sm fileinput-button dz-clickable">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
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
            <tbody id="fileidentitass"></tbody>
        </table>
    </div>
</div>
</form>
<script> function upload_file2() {
    var id_pelatihan = $('#f_id_edit').val();
    $('#id_userfile').val(id_pelatihan);
    var data = formJson('form-file-identitas');
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

function upload_file() {
    var form = $("#form-file-identitas");
    var id_pelatihan = $('#f_id_edit').val();
    $('#id_userfile').val(id_pelatihan);
    if ($('#id_userfile').val() !== '') {
        $.ajax({
            url: BASE_URL + "supplier/uploadcover_data", /* Url to which the request is send */
            type: "POST",
            data: new FormData(form[0]), /* Data sent to server, a set of key/value pairs (i.e. form fields and values)*/
            contentType: false,       /* The content type used when sending data to the server.*/
            cache: false,             /* To unable request pages to be cached*/
            processData: false,        /* To send DOMDocument or non processed data file it is set to false*/
            success: function (data)   /* A function to be called if request succeeds*/ {
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
                } else {
                    alert(message);
                    return false;
                }
            }
        });
    } else {
        alert('Data pegawai harus disimpan terlebih dahulu!');
        return false;
    }
}

$("#cover-fl").change(function () {
    preview_cover(this);
});

$('#img-cover').attr('src', '');
var id = $('#id_userfile').val();
var id_pelatihan = $('#f_id_edit').val();

function tampil(){
    $.ajax({
        url   : BASE_URL+'pegawai/getuser/?id='+id_pelatihan,
        headers: {
         'Authorization': localStorage.getItem("Token"),
         'X_CSRF_TOKEN':'donimaulana',
         'Content-Type':'application/json'
     },
     dataType: 'json',
     type: 'get',
     contentType: 'application/json', 
     processData: false,
     success: function( res, textStatus, jQxhr ){
         $('#img-cover').attr('src', res[0].foto);
     }
     
 });
}
tampil();   //pemanggilan fungsi tampil barang.         


function preview_cover(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-cover').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }

}

function getfileupload(result) {
    $('#fileidentitass').html(result.isi);
}

function loadfileupload() {
    getJson(getfileupload, BASE_URL + 'pegawai/listfile/?id=' + $('#f_id_edit').val()+'&kategori=10');
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