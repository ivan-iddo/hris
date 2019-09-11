<style type="text/css">
    /*.daterangepicker{
        position: static !important;
        }*/
    </style>
    <form class="form-horizontal">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="demo-hor-inputemail">No. Disposisi</label>
                <div class="col-sm-5">
                    <input type="text" name="id" id="id" style="width: 220px;display:none"
                    class="form-control"/>
                    <input type="text" name="no_disposisi" id="no_disposisi" class="form-control"/>
                </div>
            </div>
            <div class="body-content-calendar">
                <div class="form-group body-remove-calendar">
                    <label class="col-sm-3 control-label" for="demo-hor-inputemail">Tgl Pelaksanaan</label>
                    <div class="col-sm-5">
                        <input type="text" name="tanggal[]" class="form-control tanggal daterangepicker" id="tanggal" 
                        />
                    </div>
                    <div class="col-xs-3 pull right">
                        <div class="btn btn-default btn-sm" id="add-data-calendar">Add</div>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Laporan</label>
                <div class="col-sm-5">
                    <input type="checkbox" name="laporan" id="laporan" value="1">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Monitor & Evaluasi</label>
                <div class="col-sm-5">
                    <input type="checkbox" name="monev" id="monev" value="1" checked="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Jenis Perjalanan</label>
                <div class="col-sm-5">
                    <select name="jenis_perjalanan" id="jenis_perjalanan" class="form-control select-chosen">
                        <option value="">Pilih</option>
                        <option>Dalam Negeri</option>
                        <option>Luar Negeri</option>
                    </select>
                </div>
            </div>

            <div class="form-group jenis_perjalanan_dalam_negeri hidden">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-5">
                    <select name="dalam_negeri" id="dalam_negeri" class="form-control select-chosen">
                        <option value="">Pilih</option>
                        <option>Dalam Kota</option>
                        <option>Luar Kota</option>
                    </select>
                </div>
            </div>

            <div class="form-group dalam_negeri hidden">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-5">
                    <select name="surat_tugas_dalam_negeri" id="surat_tugas_dalam_negeri"
                    class="form-control select-chosen">
                    <option value="">Pilih</option>
                    <option>Surat Tugas</option>
                    <option>Surat Izin</option>
                    <option>SPPD</option>
                </select>
            </div>
        </div>

        <div class="form-group jenis_perjalanan_luar_negeri hidden">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-5">
                <select name="surat_tugas_luar_negeri" id="surat_tugas_luar_negeri" class="form-control select-chosen">
                    <option value="">Pilih</option>
                    <option>Surat Tugas</option>
                    <option>Surat Izin</option>
                    <option>SPPD</option>
                    <option>Surat Rekomendasi</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Tipe</label>
            <div class="col-sm-5">
                <select name="jenis" id="jenis" class="form-control select-chosen">
                    <option value="">Pilih</option>
                    <option>Individu</option>
                    <option>Kelompok</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Nopeg</label>
            <div class="col-sm-5">
                <select name="nopeg" id="nopeg" class="select-chosen">
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Pegawai</label>
            <div class="col-sm-5">
                <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" readonly="true"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label" for="demo-hor-inputemail">Jabatan/Unit Kerja</label>
            <div class="col-sm-5">
                <input type="text" name="jabatan" id="jabatan" class="form-control" readonly="true"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Jenis Biaya</label>
            <div class="col-sm-5">
                <select name="jenis_biaya" id="jenis_biaya" class="select-chosen">
                    <option value="">Pilih</option>
                    <option>BLU</option>
                    <option>Sponsor</option>
                    <option>Sendiri</option>
                </select>
            </div>
        </div>
        <div class="body-content">
            <div class="form-group body-remove">
                <label class="col-sm-3 control-label">Uraian Biaya</label>
                <div class="body-detail">
                    <div class="col-sm-3">
                        <input type="text" name="biaya_uraian[]" class="form-control biaya_uraian" id="biaya_uraian" 
                        placeholder="Uraian"/>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="biaya_nominal[]" class="form-control biaya_nominal numeric-only" id="biaya_nominal" 
                        placeholder="Biaya"/>
                    </div>
                </div>
                <div class="col-xs-3 pull right">
                    <div class="btn btn-default btn-sm" id="add-data">Add</div>
                </div>
            </div>
        </div>

    </div>
</form>

<script type="text/javascript"> 
    $('.daterangepicker').daterangepicker({
     locale: {
       format: 'YYYY-MM-DD'
   }
});

    $('.select-chosen').chosen();
    $('.chosen-container').css({"width": "100%"});
    $(document).on('keydown',".numeric-only", function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
             (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
             (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
             return;
         }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $("#add-data").on("click", function () {

        var row = $(
            '<div class="form-group body-remove">' +
            '<label class="col-sm-3 control-label"></label>' +
            '<div class="body-detail">' +
            '<div class="col-sm-3">' +
            '<input type="text" name="biaya_uraian[]" class="form-control biaya_uraian" placeholder="Uraian" />' +
            '</div>' +
            '<div class="col-sm-3">' +
            '<input type="text" name="biaya_nominal[]" class="form-control biaya_nominal numeric-only" placeholder="Biaya" />' +
            '</div>' +
            '</div>' +
            '<div class="col-xs-3 pull right">' +
            '<div class="btn btn-default btn-sm btn-remove">' +
            '<i class="fa fa-trash-o"></i>' +
            '</div>' +
            '</div>' +
            '</div>');
        $(".body-content").append(row);
    });
    $(document).on('click', '.btn-remove', function (event) {
        console.log("remove" + $(this));
        $(this).parentsUntil(".body-remove").parent().remove();
    });


    $("#add-data-calendar").on("click", function () {
        var row = $(
            '<div class="form-group body-remove-calendar">' +
            '<label class="col-sm-3 control-label" for="demo-hor-inputemail"></label>' +
            '<div class="col-sm-5">' +
            '<input type="text" name="tanggal[]" class="form-control tanggal daterangepicker"  />' +
            '</div>' +
            '<div class="col-xs-3 pull right">' +
            '<div class="btn btn-default btn-sm btn-remove-calendar">' +
            '<i class="fa fa-trash-o"></i>' +
            '</div>' +
            '</div>' +
            '</div>');
        $(".body-content-calendar").append(row);
        $('.daterangepicker').daterangepicker({
         locale: {
           format: 'YYYY-MM-DD'
       }
   });
    });
    $(document).on('click', '.btn-remove-calendar', function (event) {
        console.log("remove" + $(this));
        $(this).parentsUntil(".body-remove-calendar").parent().remove();
    });

    function loadUser(id, url) {
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
              //  alert(JSON.stringify(e.result));
              for (var i = 0; i < e.result.length; i++) {
                $('#' + id).append('<option value="' + e.result[i].nip + '" data-nama="' + e.result[i].nama + '" data-nama-group="' + e.result[i].nama_group + '" >' + e.result[i].nip + ' - ' + e.result[i].nama + '</option>');
            }
            $('#' + id).trigger("chosen:updated");
        }
    });
    }

    $("#nopeg").on("change", function () {
        if ($(this).find(':selected').attr("data-nama") != undefined) {
            $("#nama_pegawai").val($(this).find(':selected').attr("data-nama"));
            $("#jabatan").val($(this).find(':selected').attr("data-nama-group"));
        }
        ;
    });

    loadUser("nopeg", BASE_URL + "users/list");

    var jenis_perjalanan, jenis_perjalanan_dalam_negeri, jenis_perjalanan_luar_negeri,
    surat_tugas_dalam_negeri, surat_tugas_luar_negeri, dalam_negeri;

    $("#jenis_perjalanan").on("change", function () {
        jenis_perjalanan = $(this).val();
        if (jenis_perjalanan == "Dalam Negeri") {
            $(".jenis_perjalanan_luar_negeri").addClass('hidden');
            $(".jenis_perjalanan_dalam_negeri").removeClass('hidden');
            $(".dalam_negeri").removeClass('hidden');
            // reset value
            $("#surat_tugas_luar_negeri").prop('selectedIndex', 0);
        }
        else {
            $(".jenis_perjalanan_dalam_negeri").addClass('hidden');
            $(".dalam_negeri").addClass('hidden');
            // show
            $(".jenis_perjalanan_luar_negeri").removeClass('hidden');
            // reset value
            $("#dalam_negeri").prop('selectedIndex', 0);
            $("#surat_tugas_dalam_negeri").prop('selectedIndex', 0);
        }
    });

    function simpan(action) {
        data = {};
        data.id = $("#id").val();
        data.no_disposisi = $("#no_disposisi").val();
        data.tanggal = $(".tanggal").serializeArray();
        data.laporan = 0;
        data.monev = 0;
        if ($('#laporan').is(":checked")){
            data.laporan = 1;
        };
        if ($('#monev').is(":checked")){
            data.monev = 1;
        };
        data.jenis = $("#jenis").val();
        data.jenis_biaya = $("#jenis_biaya").val();
        data.jenis_perjalanan = $("#jenis_perjalanan").val();
        data.dalam_negeri = $("#dalam_negeri").val();
        data.surat_tugas_dalam_negeri = $("#surat_tugas_dalam_negeri").val();
        data.surat_tugas_luar_negeri = $("#surat_tugas_luar_negeri").val();
        data.nopeg = $("#nopeg").val();
        data.nama_pegawai = $("#nama_pegawai").val();
        data.jabatan = $("#jabatan").val();
        data.biaya_uraian = $(".biaya_uraian").serializeArray();
        data.biaya_nominal = $(".biaya_nominal").serializeArray();

        console.log("actionSave");
        console.log(data);
        // return;

        if (action == 'add') {
            URL = BASE_URL + "pengembangan_pelatihan/save";
        } 
        else if (action == 'edit') {
            URL = BASE_URL + "pengembangan_pelatihan/edit";
        }
        save(URL, data, loaddata);
    }
</script>