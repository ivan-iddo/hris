<form name="form-file-penghargaan" id="form-file-penghargaan" class="form-horizontal">
    <div class="panel-body pad-all">
        <div class="row">
            <input type="hidden" name="id_userfile" id="id_userfile">
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6"><input required name="inputfileupload" id="inputfileupload" type="file"
                                             class="btn btn-success btn-sm fileinput-button dz-clickable"></div>
                <div class="col-sm-3"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6"><input type="text" placeholder="Nama Penghargaan" class="form-control" id="penghargaan"
                                            required name="penghargaan"></div>
                <div class="col-sm-3"></div>
            </div>
            <div class="form-group">
               <div class="col-sm-3"></div>
               <div class="col-sm-6"><input type="text" placeholder="Instansi Pemberi" class="form-control" id="instansi"
                                           required name="instansi"></div>
               <div class="col-sm-3"></div>
            </div>
            <div class="form-group">
               <div class="col-sm-3"></div>
               <div class="col-sm-6"><input type="date" placeholder="Tanggal" class="form-control" id="tanggal"
                                           required name="tanggal"></div>
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
    <div class="row"></div>
    <div class="row pad-all">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-vcenter">
                <thead>
                <tr>
                    <th style="width:20px">No.</th>
                    <th>Nama Penghargaan</th>
                    <th>Instansi Pemberi</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="fileIjazah"></tbody>
            </table>
        </div>
    </div>
</form>
<script> 
// set ID user
var id = $('#f_id_edit').val();
$('#id_userfile').val(id);
$("form").on("submit", function(e){
    e.preventDefault();
    var form = $("#form-file-penghargaan");

    if (id !== '') {
        $.ajax({
            url: BASE_URL + "pegawais/penghargaan/add", /* Url to which the request is send*/
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
    $('#fileIjazah').html(result.data);
}

function loadData() {
    getJson(getfileupload, BASE_URL + 'pegawais/penghargaan/' + id);
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
        getJson(filedelete, BASE_URL + 'pegawais/penghargaan/delete/' + a + "?id_userfile=" + id);
    });
}
</script>