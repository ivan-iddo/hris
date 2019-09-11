function save(urlp, datas, loaddata) {
    var hasil;
    var message;
    $.ajax({
        url: urlp,
        headers: {
            'Authorization': localStorage.getItem("Token"),
            'X_CSRF_TOKEN': 'donimaulana',
            'Content-Type': 'application/json'
        },
        dataType: 'json',
        type: 'post',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify(datas),
        success: function (data, textStatus, jQxhr) {
            hasil = data.hasil;
            message = data.message;
            if (hasil == "success") {

                swal("Good job!", "Terimakasih!", "success");
                loaddata();
                $('.modal').modal('hide');
            } else {
                onMessage(message);
                return false;
            }


        },
        error: function (jqXhr, textStatus, errorThrown) {
            $.niftyNoty({
                type: 'danger',
                title: 'Warning!',
                message: message,
                container: 'floating',
                timer: 5000
            });
        }
    });


    //statusEnding();
}


function submit_get(urlp, loaddata) {
    var hasil;
    var message;
    swal({
        title: "Apakah Anda sudah Yakin?",
        text: "Data segera di proses!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Segera proses!",
        closeOnConfirm: false
    }, function () {
        $.ajax({
            url: urlp,
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

                hasil = data.hasil;
                message = data.message;
                if (hasil == "success") {


                    // return 'hore';
                    loaddata();
                } else {
                    $.niftyNoty({
                        type: 'danger',
                        title: 'Error',
                        message: message,
                        container: 'floating',
                        timer: 5000
                    });

                    // return 'gakhore';
                }


            },
            error: function (jqXhr, textStatus, errorThrown) {
                $.niftyNoty({
                    type: 'danger',
                    title: 'Warning!',
                    message: message,
                    container: 'floating',
                    timer: 5000
                });
                // return 'error';
            }
        });
        swal("Sukses!", "Data Diproses.", "success");
    });


    //statusEnding();
}

function submitmsg_get(urlp, pesan, loaddata) {
    var hasil;
    var message;
    swal({
        title: "Apakah Anda sudah Yakin?",
        text: pesan,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Sudah yakin!",
        closeOnConfirm: false
    }, function () {
        $.ajax({
            url: urlp,
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

                hasil = data.hasil;
                message = data.message;
                if (hasil == "success") {


                    // return 'hore';
                    loaddata();
                } else {


                    // return 'gakhore';
                }


            },
            error: function (jqXhr, textStatus, errorThrown) {

                // return 'error';
            }
        });
        swal("Sukses!", "Terimakasih.", "success");
    });


    //statusEnding();
}


function nomor(e, value) {
    //Check Charater
    var unicode = e.charCode ? e.charCode : e.keyCode;
    if (value.indexOf(".") != -1)
        if (unicode == 46) return false;
    if (unicode != 8)
        if ((unicode < 48 || unicode > 57) && unicode != 46) return false;
}

function onMessage(msg) {

    swal('PERHATIAN!', msg);

    //  swal(msg);
}

function getOptions(id, url) {

    $('#' + id).children().remove();
    $('#' + id).append('<option value="" selected="selected">Please select...</option>');


    $.ajax({
        type: "GET",
        url: url,
        headers: {
            'Authorization': localStorage.getItem("Token"),
            'X_CSRF_TOKEN': 'donimaulana',
            'Content-Type': 'application/json'
        },
        dataType: "json",
        success: function (e) {

            for (var i = 0; i < e.result.length; i++) {

                $('#' + id).append('<option value="' + e.result[i].value + '" >' + e.result[i].label + '</option>');
            }
            $('#' + id).trigger("chosen:updated");
        }
    });
}

function getOptionsEdit(id, url, value) {

    $('#' + id).children().remove();
    $('#' + id).append('<option value="" selected="selected">Please select...</option>');

    $.ajax({
        type: "GET",
        url: url,
        headers: {
            'Authorization': localStorage.getItem("Token"),
            'X_CSRF_TOKEN': 'donimaulana',
            'Content-Type': 'application/json'
        },
        dataType: "json",
        success: function (e) {

            for (var i = 0; i < e.result.length; i++) {

                $('#' + id).append('<option value="' + e.result[i].value + '" >' + e.result[i].label + '</option>');
            }

            $('#' + id).val(value);
            $('#' + id).trigger("chosen:updated");
        }
    });
}


function getInputTypeOptions(id, url) {


    $.ajax({
        type: "GET",
        url: url,
        headers: {
            'Authorization': localStorage.getItem("Token"),
            'X_CSRF_TOKEN': 'donimaulana',
            'Content-Type': 'application/json'
        },
        dataType: "json",
        success: function (e) {
            var htmlinput = '';
            for (var i = 0; i < e.result.length; i++) {
                htmlinput += '<input id="f_' + id + '" class="f_' + id + i + '" name="f_' + id + '" value="' + e.result[i].value + '" type="radio"> ' + e.result[i].label + '<br>';

            }
            $('#' + id).html(htmlinput);
        }
    });
}

function getInputTypeOptionsEdit(id, url, value) {

    //$('#'+id).children().remove();
    // $('#'+id).append('<option value="" selected="selected">Please select...</option>');

    $.ajax({
        type: "GET",
        url: url,
        headers: {
            'Authorization': localStorage.getItem("Token"),
            'X_CSRF_TOKEN': 'donimaulana',
            'Content-Type': 'application/json'
        },
        dataType: "json",
        success: function (e) {
            var htmlinput = '';
            for (var i = 0; i < e.result.length; i++) {

                if (value === e.result[i].value) {

                    htmlinput += '<input id="f_' + id + '" class="f_' + id + i + '" name="f_' + id + '" value="' + e.result[i].value + '" type="radio" checked> ' + e.result[i].label + ' <br>';
                } else {
                    htmlinput += '<input id="f_' + id + '" class="f_' + id + i + '" name="f_' + id + '" value="' + e.result[i].value + '" type="radio"> ' + e.result[i].label + '<br>';
                }

            }
            $('#' + id).html(htmlinput);
        }
    });
}

function paging(jumlah, namaf) {
    var pagination = '<div class="dataTables_info pull-left" id="demo-dt-delete_info" role="status" aria-live="polite" style="padding-right:20px">Showing of ' + jumlah + ' entries </div>';
    var num = 0;
    if (jumlah < 100) {
        pagination = '<ul class="pagination text-nowrap mar-no">';

        for (i = 1; i <= Math.ceil(jumlah / 20); i++) {
            pagination += '<li class="page-number">';
            pagination += '<a href="javascript:void(0)" onClick="' + namaf + '(' + num + ')">' + i + '</a>';
            pagination += '</li>';
            num = num + 20;

        }
        pagination += '</ul>';
    } else {
        pagination += '<select id="halaman" class="form-control pagination text-nowrap mar-no" style="width: 80px;" onChange="' + namaf + '(this.value);$(\'#hal\').val(this.value)">';
        for (i = 1; i <= Math.ceil(jumlah / 20); i++) {
            pagination += '<option value="' + num + '">';
            pagination += i;
            pagination += '</option>';
            // $('#halaman').append('<option value="'+num+'" >'+i+'</option>');
            num = num + 20;

        }
        // $('#halaman').trigger("chosen:updated");

        pagination += '</select>';
    }
    $('.paging').html(pagination);

}

function getKota(a, inputx) {
    getOptions(inputx, BASE_URL + "master/kota/" + a);
}

function getKecamatan(a, inputx) {
    getOptions(inputx, BASE_URL + "master/kecamatan/" + a);
}

function getKelurahan(a, inputx) {
    getOptions(inputx, BASE_URL + "master/kelurahan/" + a);
}

function getToSub(a, inputx, url) {
    getOptions(inputx, BASE_URL + url + a);
}

function getFormData(data) {
    var unindexed_array = data;
    var indexed_array = {};

    $.map(unindexed_array, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

function formJson(namaform) {
    var data = $("#" + namaform).serializeArray();
    return JSON.stringify(getFormData(data))
}

function validateUsername(fld) {
    var error = "";
    var illegalChars = /\W/; // allow letters, numbers, and underscores

    if (fld == "") {

        error = "You didn't enter a username.\n";
        onMessage(error);
        return false;

    } else if ((fld < 5) || (fld > 15)) {

        error = "The username is the wrong length.\n";
        onMessage(error);
        return false;

    } else if (illegalChars.test(fld)) {

        error = "The username contains illegal characters.\n";
        onMessage(error);
        return false;

    }
    return true;
}

function validatePassword(fld) {
    var error = "";
    var illegalChars = /[\W_]/; // allow only letters and numbers

    if (fld == "") {
        error = "Password tidak boleh kosong.\n";
        onMessage(error);
        return false;

    } else if ((fld.length < 6) || (fld.length > 15)) {
        error = "Panjang password minimum 7 karakter. \n";
        onMessage(error);
        return false;

    } else if (illegalChars.test(fld)) {
        error = "Password harus terdiri dari gabungan karakter dan numerik contoh: fulanbinfulan21 .\n";
        onMessage(error);
        return false;

    } else if ((fld.search(/[a-zA-Z]+/) == -1) || (fld.search(/[0-9]+/) == -1)) {
        error = "Password harus terdiri dari gabungan karakter dan numerik contoh: fulanbinfulan21 .\n";
        onMessage(error);
        return false;

    }
    return true;
}

function buildBook(urlpdf) {
    var isPDF = urlpdf.substr(-3);
    if (isPDF !== 'pdf') {
        window.open(urlpdf);
    } else {
        window.open(BASE_URL2 + "book.php?pdf=" + urlpdf, '_blank');
    }
}

function empty(str) {
    return !str || !/[^\s]+/.test(str);
}

function popPage(uri, action) {
    bootbox.dialog({
        message: $('<div></div>').load(uri),
        animateIn: 'bounceIn',
        animateOut: 'bounceOut',
        backdrop: false,
        size: 'large',
        buttons: {
            success: {
                label: "Save",
                className: "btn-primary",
                callback: function () {

                    if (simpan(action)) {
                        return true;
                    } else {
                        return false;
                    }

                }
            },

            main: {
                label: "Close",
                className: "btn-warning",
                callback: function () {

                }
            }
        }
    });
}

function popPagenew(uri, action) {
    bootbox.dialog({
        message: $('<div></div>').load(uri),
        backdrop: false,
        size: 'large',
        buttons: {
            success: {
                label: "Save",
                className: "btn-primary",
                callback: function () {

                    if (simpan(action)) {
                        return true;
                    } else {
                        return false;
                    }

                }
            },

            main: {
                label: "Close",
                className: "btn-warning",
                callback: function () {

                }
            }
        }
    });
}

function getJson(callback, url) {
    $.ajax({
        url: url,
        headers: {
            'Authorization': localStorage.getItem("Token"),
            'X_CSRF_TOKEN': 'donimaulana',
            'Content-Type': 'application/json'
        },
        dataType: 'json',
        type: 'get',
        contentType: 'application/json',
        processData: false,
        async: false,

        success: callback,
        error: function (jqXhr, textStatus, errorThrown) {
            alert('error');
        }
    });

}

function postForm(formName, url, loaddata) {
    var data = formJson(formName);//$("#form-upload").serializeArray();
    $.ajax({
        url: url,
        headers: {
            'Authorization': localStorage.getItem("Token"),
            'X_CSRF_TOKEN': 'donimaulana',
            'Content-Type': 'application/json'
        },
        dataType: 'json',
        type: 'post',
        contentType: 'application/json',
        processData: false,
        data: data,
        success: function (data, textStatus, jQxhr) {
            hasil = data.hasil;
            message = data.message;
            if (hasil == "success") {

                swal("Good job!", "Terimakasih!", "success");
                $("#f_id_edit").val(data.id);
                loaddata(0);
                $('.modal').modal('hide');
            } else {
                $.niftyNoty({
                    type: 'danger',
                    title: 'Warning!',
                    message: message,
                    container: 'floating',
                    timer: 5000
                });

                return false;
            }


        },
        error: function (jqXhr, textStatus, errorThrown) {
            $.niftyNoty({
                type: 'danger',
                title: 'Warning!',
                message: message,
                container: 'floating',
                timer: 5000
            });
        }
    });
}

function postFormMore(formName, url, loaddata) {
    var data = formJson(formName);//$("#form-upload").serializeArray();
    $.ajax({
        url: url,
        headers: {
            'Authorization': localStorage.getItem("Token"),
            'X_CSRF_TOKEN': 'donimaulana',
            'Content-Type': 'application/json'
        },
        dataType: 'json',
        type: 'post',
        contentType: 'application/json',
        processData: false,
        data: data,
        success: function (data, textStatus, jQxhr) {
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
                $("#f_id_edit").val(data.id);
                loaddata(0);
                //  $('.modal').modal('hide');
            } else {
                $.niftyNoty({
                    type: 'danger',
                    title: 'Warning!',
                    message: message,
                    container: 'floating',
                    timer: 5000
                });

                return false;
            }


        },
        error: function (jqXhr, textStatus, errorThrown) {
            $.niftyNoty({
                type: 'danger',
                title: 'Warning!',
                message: message,
                container: 'floating',
                timer: 5000
            });
        }
    });
}

function gopop(uri, callme, sizeme) {
    bootbox.dialog({
        message: $('<div></div>').load(uri),
        animateIn: 'bounceIn',
        animateOut: 'bounceOut',
        backdrop: false,
        size: sizeme,
        buttons: {
            success: {
                label: "Save",
                className: "btn-primary",
                callback: function () {

                    if (callme()) {
                        $('.modal').modal('hide');
                        return true;
                    } else {
                        return false;
                    }

                }
            },

            main: {
                label: "Close",
                className: "btn-warning",
                callback: function () {

                }
            }
        }
    });
}

function gopopOnly(uri, callme, sizeme) {
    bootbox.dialog({
        message: $('<div></div>').load(uri),
        animateIn: 'bounceIn',
        animateOut: 'bounceOut',
        backdrop: false,
        size: sizeme,
        buttons: {


            main: {
                label: "Close",
                className: "btn-warning",
                callback: function () {

                }
            }
        }
    });
}


function getGridId(gridOptions, id) {
    var selectedRows = gridOptions.api.getSelectedRows();
    // alert('>>'+selectedRows+'<<<');
    if (selectedRows == '') {
        // onMessage('Silahkan Pilih Group Terlebih dahulu!');
        return false;
    } else {
        var selectedRowsString = '';
        selectedRows.forEach(function (selectedRow, index) {

            if (index !== 0) {
                selectedRowsString += ', ';
            }
            selectedRowsString += selectedRow[id];
        });
        return selectedRowsString;


    }
}


function passpercentage(id, json, judul, samping, type) {


    var len = json.length
    i = 0;

    var options = {
        chart: {
            type: type

        },
        credits: {
            enabled: false
        },
        title: {
            text: judul
        },
        subtitle: {
            text: 'Source: HRD ',
            x: -20
        },
        yAxis: {
            min: 0,
            title: {
                text: samping
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        xAxis: {
            categories: []
        },
        series: []
    }

    for (i; i < len; i++) {
        if (i === 0) {
            var dat = json[i].category,
            lenJ = dat.length,
            j = 0,
            tmp;

            for (j; j < lenJ; j++) {
                options.xAxis.categories.push(dat[j]);
            }
        } else {
            options.series.push(json[i]);
        }
    }

    $('#' + id).highcharts(options);

    Pace.stop();

}

function generateChart(container, url, judul, samping, tipe) {
    Pace.start();
    $.ajax({
        url: BASE_URL + url,
        dataType: 'json',
        type: 'get',
        contentType: 'application/json',
        processData: false,
        success: function (data, textStatus, jQxhr) {
            $("#" + container).text("");

            passpercentage(container, data, judul, samping, tipe);


        },
        error: function (jqXhr, textStatus, errorThrown) {
            alert('error');
            Pace.stop();
        }
    });

}


function paging(jumlah, namaf) {
    console.log(jumlah);
    console.log(namaf);
    var pagination = '<div class="dataTables_info pull-left" id="demo-dt-delete_info" role="status" aria-live="polite" style="padding-right:20px">Showing of ' + jumlah + ' entries</div><ul class="pagination text-nowrap mar-no">';
    var num = 0;
    for (i = 1; i <= Math.ceil(jumlah / 20); i++) {
        pagination += '<li class="page-number">';
        pagination += '<a href="javascript:void(0)" onClick="' + namaf + '(' + num + ')">' + i + '</a>';
        pagination += '</li>';
        num = num + 20;

    }
    pagination += '</ul>';
    $('.paging').html(pagination);

}

function pagingDatatable(jumlah, limit, functionName) {
    var pagination = '<div class="dataTables_info pull-left" id="demo-dt-delete_info" role="status" aria-live="polite" style="padding-right:20px">Showing of ' + jumlah + ' entries</div><ul class="pagination text-nowrap mar-no">';
    var num = 0;
    for (i = 1; i <= Math.ceil(jumlah / limit); i++) {
        pagination += '<li class="page-number">';
        pagination += '<a href="javascript:void(0)" onClick="' + functionName + '(' + num + ')">' + i + '</a>';
        pagination += '</li>';
        num = num + limit;
    }
    pagination += '</ul>';
    $('.paging').html(pagination);

}