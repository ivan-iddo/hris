function tabKeluarga() {
    $("#page-keluarga").load("view/pegawai/form_keluarga.php");
    loadKeluarga();
}

function tabKeluargaView() {
    $("#page-keluarga").load("view/pegawai/form_keluarga_view.php");
    loadKeluarga();
}

function simpanKeluarga(action) {
  var id_keluarga = $('#id_keluarga').val();
    var form = $("#form-keluarga");
    var gotourl = 'pegawai/savekeluarga';
    if (action === 'edit') {
        gotourl = 'pegawai/editkeluarga/' + id_keluarga;
    }
    $.ajax({
        url: BASE_URL + gotourl,
        headers: {
            'Authorization': localStorage.getItem("Token"),
            'X_CSRF_TOKEN': 'donimaulana'
        },
        dataType: 'json',
        type: 'post',
        contentType: false,
        processData: false,
        data: new FormData(form[0]),
        success: function (data, textStatus, jQxhr) {
            hasil = data.hasil;
            message = data.message;
            if (hasil == "success") {
                $.niftyNoty({type: 'success', title: 'Success', message: message, container: 'floating', timer: 5000});
                $("#f_id_edit").val(data.id);
                loadKeluarga();/* $('.modal').modal('hide');*/
            } else {
                return false;
            }
        },
        error: function (jqXhr, textStatus, errorThrown) {
            $.niftyNoty({type: 'danger', title: 'Warning!', message: message, container: 'floating', timer: 5000});
        }
    });
}

function loadKeluarga() {
    var id_user = $('#id_user').val();
    $.ajax({
        url: BASE_URL + 'pegawai/listkeluarga/' + id_user,
        headers: {
            'Authorization': localStorage.getItem("Token"),
            'X_CSRF_TOKEN': 'donimaulana',
            'Content-Type': 'application/json'
        },
        dataType: 'json',
        type: 'get',
        contentType: 'application/json',
        processData: false,
        success: function (data, textStatus, jQxhr) {
            gridKeluargaOpt.api.setRowData(data);
        },
        error: function (jqXhr, textStatus, errorThrown) {
            alert('error');
        }
    });
}

function addKeluarga() {
    getOptions("txtKelamin", BASE_URL + "master/kelamin");
    getOptions("txtPendidikan", BASE_URL + "master/pendidikan");
    getOptions("txtPekerjaan", BASE_URL + "master/pekerjaan");
    getOptions("txtHubungan", BASE_URL + "master/hubkeluarga");
    bootbox.dialog({
        message: $('<div></div>').load('view/pegawai/input_keluarga.php'),
        animateIn: 'bounceIn',
        animateOut: 'bounceOut',
        backdrop: false,
        size: 'large',
        buttons: {
            success: {
                label: "Save", className: "btn-success", callback: function () {
                    simpanKeluarga('save');
                    return false;
                }
            }, main: {
                label: "Close", className: "btn-warning", callback: function () {
                    $.niftyNoty({type: 'dark', message: "Bye Bye", container: 'floating', timer: 5000});
                }
            }
        }
    });
}

function editKeluarga() {
    var selectedRows = gridKeluargaOpt.api.getSelectedRows();/* alert('>>'+selectedRows+'<<<');*/
    if (selectedRows == '') {
        onMessage('Silahkan Pilih Keluarga Terlebih dahulu!');
        return false;
    } else {
        var selectedRowsString = '';
        selectedRows.forEach(function (selectedRow, index) {
            if (index !== 0) {
                selectedRowsString += ', ';
            }
            selectedRowsString += selectedRow.id;
        });
        bootbox.dialog({
            message: $('<div></div>').load('view/pegawai/input_keluarga.php'),
            animateIn: 'bounceIn',
            animateOut: 'bounceOut',
            backdrop: false,
            size: 'large',
            buttons: {
                success: {
                    label: "Save", className: "btn-success", callback: function () {
                        simpanKeluarga('edit');
                        return false;
                    }
                }, main: {
                    label: "Close", className: "btn-warning", callback: function () {
                        $.niftyNoty({type: 'dark', message: "Bye Bye", container: 'floating', timer: 5000});
                    }
                }
            }
        });
        $.ajax({
            url: BASE_URL + 'pegawai/getkeluarga/' + selectedRowsString,
            headers: {
                'Authorization': localStorage.getItem("Token"),
                'X_CSRF_TOKEN': 'donimaulana',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            processData: false,
            success: function (data, textStatus, jQxhr) {
                $('#id_keluarga').val(data.id);
                $('#txtNama').val(data.nama);
                $('#txtTptLahir').val(data.tempat_lahir);
                $('#txtNik').val(data.NIK);
                $('#txtTglLahir').val(data.tgl_lahir);
                getOptionsEdit("txtKelamin", BASE_URL + "master/kelamin", data.kelamin);
                getOptionsEdit("txtPendidikan", BASE_URL + "master/pendidikan", data.id_pendidikan);
                getOptionsEdit("txtPekerjaan", BASE_URL + "master/pekerjaan", data.id_pekerjaan);
                getOptionsEdit("txtHubungan", BASE_URL + "master/hubkeluarga", data.id_hubkel);
            }
        });
    }
}

function deletKeluarga() {
    var selectedRows = gridKeluargaOpt.api.getSelectedRows();/* alert('>>'+selectedRows+'<<<');*/
    if (selectedRows == '') {
        onMessage('Silahkan Pilih Group Terlebih dahulu!');
        return false;
    } else {
        var selectedRowsString = '';
        selectedRows.forEach(function (selectedRow, index) {
            if (index !== 0) {
                selectedRowsString += ', ';
            }
            selectedRowsString += selectedRow.id;
        });
        submit_get(BASE_URL + 'pegawai/deletekeluarga/?id=' + selectedRowsString, loadKeluarga);
    }
}