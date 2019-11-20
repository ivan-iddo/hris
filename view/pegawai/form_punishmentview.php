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

    <div class="row"><input type="text" style="display:none" name="kategorifile" id="kategorifile" value="<?php echo $_GET['id'] ?>"></div>
    <div class="row pad-all">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-vcenter">
                <thead>
                    <tr>
                        <th style="width:20px">No.</th>
                        <th>Keterangan</th>
                        <th>Kasus</th>
                        <th>Tidakan</th>
                        <th>Tmt Awal</th>
                        <th>Tmt Akhir</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="fileIjazah"></tbody>
            </table>
        </div>
    </div>
<script> 
var id = $('#f_id_edit').val();
$('#id_userfile').val(id);
$("form").on("submit", function(e){
    e.preventDefault();
    var form = $("#form-file-punishment");

    if (id !== '') {
        $.ajax({
            url: BASE_URL + "pegawais/punishment/add", /* Url to which the request is send*/
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
    getJson(getfileupload, BASE_URL + 'pegawais/punishment/' + id);
}

loadData();

function filedelete(result) {
    console.log(result);
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
        getJson(filedelete, BASE_URL + 'pegawais/punishment/delete/' + a + '?id_userfile=' + id);
    });
}
$(document).ready(function () {
    $('.tgl').datepicker({
        format: "dd-mm-yyyy",
    }).on('change', function(){
        $('.datepicker').hide();
    });
});
</script>