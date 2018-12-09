<form name="form-file" id="form-file">
    <div class="panel-body pad-all">
        <div class="row"><input type="text" style="display:none" name="kategorifile" id="kategorifile"
                                value="<?php echo $_GET['id'] ?>"><input type="text" style="display:none"
                                                                         name="id_userfile" id="id_userfile">
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6"><input required name="inputfileupload" id="inputfileupload" type="file"
                                             class="btn btn-success btn-sm fileinput-button dz-clickable"></div>
                <div class="col-sm-3"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6"><input type="text" placeholder="Keterangan" class="form-control" id="keterangan"
                                            required name="keterangan"></div>
                <div class="col-sm-3"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6"><input type="text" placeholder="Kasus" class="form-control" id="kasus"
                                            required name="kasus"></div>
                <div class="col-sm-3"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6"><input type="text" placeholder="tindakan" class="form-control" id="tindakan"
                                            required name="tindakan"></div>
                <div class="col-sm-3"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6"><input type="date" placeholder="Tmt Awal" class="form-control" id="Tmt Awal"
                                            required name="date_start"></div>
                <div class="col-sm-3"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6"><input type="date" placeholder="Tmt Akhir" class="form-control" id="Tmt Akhir"
                                            required name="date_end"></div>
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
</form>
<script> 
$("form").on("submit", function(e){
        e.preventDefault();
        var id_pelatihan = $('#f_id_edit').val();
        $('#id_userfile').val(id_pelatihan);
        var form = $("#form-file");
        // if (empty($('#inputfileupload').val())) {
        //     swal('PERHATIAN!', 'Anda belum memilih file untuk di upload');
        //     return false;
        // }
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
    });

    function getfileupload(result) {
        $('#fileIjazah').html(result.isi);
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