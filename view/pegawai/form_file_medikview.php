
<div class="row"><input type="text" style="display:none" name="kategorifile" id="kategorifile" value="<?php echo $_GET['id'] ?>"></div>
<div class="row pad-all">
    <div class="table-responsive">
        <table class="table table-striped table-hover table-vcenter">
            <thead>
                <tr>
                    <th class="min-width" style="width:20px">No.</th>
                    <th>Nama File</th>
                    <th class="min-width" style="width:20px">View</th>
                </tr>
            </thead>
            <tbody id="filemedik"></tbody>
        </table>
    </div>
</div>

<script> function upload_file2() {
    var id_pelatihan = $('#f_id_edit').val();
    $('#id_userfile').val(id_pelatihan);
    var form = $("#form-file-upload-medik");
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
            type: "POST",
            data: new FormData(form[0]), /* Data sent to server, a set of key/value pairs (i.e. form fields and values)*/
            contentType: false,       /* The content type used when sending data to the server.*/
            cache: false,             /* To unable request pages to be cached*/
            processData: false,        /* To send DOMDocument or non processed data file it is set to false*/
            success: function (data)   /* A function to be called if request succeeds*/ {
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
    $('#filemedik').html(result.isi);
}

function loadfileupload() {
    getJson(getfileupload, BASE_URL + 'pegawai/listfiletg/?id=' + $('#f_id_edit').val() + '&kategori=5');
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