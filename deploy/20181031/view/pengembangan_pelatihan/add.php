<form class="form-horizontal">
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-3 control-label" for="demo-hor-inputemail">No. Disposisi</label>
            <div class="col-sm-5">
                <input type="text" name="f_id_edit" id="f_id_edit" style="width: 220px;display:none"
                       class="form-control"/>
                <input type="text" name="f_user_edit" id="f_user_edit" style="width: 220px;display:none"
                       class="form-control"/>
                <input type="text" name="no_disposisi" id="no_disposisi" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="demo-hor-inputemail">Tgl Pelaksanaan</label>
            <div class="col-sm-5">
                <input type="text" name="tanggal" id="tanggal" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Jenis Perjalanan</label>
            <div class="col-sm-5">
                <select name="jenis_perjalanan" id="jenis_perjalanan" class="form-control select-chosen">
                    <option value="0">Pilih</option>
                    <option value="1">Dalam Negeri</option>
                    <option value="2">Luar Negeri</option>
                </select>
            </div>
        </div>

        <div class="form-group jenis_perjalanan_dalam_negeri hidden">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-5">
                <select name="dalam_negeri" id="dalam_negeri" class="form-control select-chosen">
                    <option value="0">Pilih</option>
                    <option value="1">Dalam Kota</option>
                    <option value="2">Luar Kota</option>
                </select>
            </div>
        </div>

        <div class="form-group dalam_negeri hidden">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-5">
                <select name="surat_tugas_dalam_negeri" id="surat_tugas_dalam_negeri" class="form-control select-chosen">
                    <option value="0">Pilih</option>
                    <option value="1">Surat Tugas</option>
                    <option value="2">Surat Izin</option>
                    <option value="3">SPPD</option>
                </select>
            </div>
        </div>

        <div class="form-group jenis_perjalanan_luar_negeri hidden">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-5">
                <select name="surat_tugas_luar_negeri" id="surat_tugas_luar_negeri" class="form-control select-chosen">
                    <option value="0">Pilih</option>
                    <option value="1">Surat Tugas</option>
                    <option value="2">Surat Izin</option>
                    <option value="3">SPPD</option>
                    <option value="4">Surat Rekomendasi</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Tipe</label>
            <div class="col-sm-5">
                <select name="jenis" id="jenis" class="form-control select-chosen">
                    <option value="0">Pilih</option>
                    <option value="1">Individu</option>
                    <option value="2">Kelompok</option>
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
                <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" readonly="true" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label" for="demo-hor-inputemail">Jabatan/Unit Kerja</label>
            <div class="col-sm-5">
                <input type="text" name="jabatan" id="jabatan" class="form-control" readonly="true" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Jenis Biaya</label>
            <div class="col-sm-5">
                <select name="jenis" id="jenis" class="select-chosen">
                    <option value="0">Pilih</option>
                    <option value="1">BLU</option>
                    <option value="2">Sponsor</option>
                    <option value="3">Sendiri</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Uraian Biaya</label>
               <div class="col-sm-3">
                   <input type="text" name="biaya_uraian[]" class="form-control biaya_uraian" placeholder="Uraian" />
               </div>
               <div class="col-sm-3">
                   <input type="text" name="biaya_nominal[]" class="form-control biaya_nominal" placeholder="Biaya" />
               </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"></label>
               <div class="col-sm-3">
                   <input type="text" name="biaya_uraian[]" class="form-control biaya_uraian" placeholder="Uraian" />
               </div>
               <div class="col-sm-3">
                   <input type="text" name="biaya_nominal[]" class="form-control biaya_nominal" placeholder="Biaya" />
               </div>
        </div>

    </div>
</form>

<script type="text/javascript">
    $('.select-chosen').chosen();
    $('.chosen-container').css({"width": "100%"});

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
                for (var i = 0; i < e.result.length; i++) {
                    $('#' + id).append('<option value="' + e.result[i].nip + '" data-nama="' +e.result[i].nama+ '" data-nama-group="' +e.result[i].nama_group+ '" >' + e.result[i].nip + ' - ' + e.result[i].nama + '</option>');
                }
                $('#' + id).trigger("chosen:updated");
            }
        });
    }

    $("#nopeg").on("change", function(){
      if ($(this).find(':selected').attr("data-nama") != undefined){      
        $("#nama_pegawai").val($(this).find(':selected').attr("data-nama"));
        $("#jabatan").val($(this).find(':selected').attr("data-nama-group"));
      };
    });

    loadUser("nopeg", BASE_URL + "users/list");

    var jenis_perjalanan, jenis_perjalanan_dalam_negeri, jenis_perjalanan_luar_negeri,
        surat_tugas_dalam_negeri, surat_tugas_luar_negeri, dalam_negeri;

    $("#jenis_perjalanan").on("change", function () {
        jenis_perjalanan = $(this).val();
        if (jenis_perjalanan == 1) {
            $(".jenis_perjalanan_luar_negeri").addClass('hidden');
            $(".jenis_perjalanan_dalam_negeri").removeClass('hidden');
            $(".dalam_negeri").removeClass('hidden');
            // reset value
            $("#surat_tugas_luar_negeri").prop('selectedIndex', 0)
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
        data.f_id_edit = $("#f_id_edit").val();
        data.f_user_edit = $("#f_user_edit").val();
        data.no_disposisi = $("#no_disposisi").val();
        data.tanggal = $("#tanggal").val();
        data.jenis_perjalanan = $("#jenis_perjalanan").val();
        data.dalam_negeri = $("#dalam_negeri").val();
        data.surat_tugas_dalam_negeri = $("#surat_tugas_dalam_negeri").val();
        data.surat_tugas_luar_negeri = $("#surat_tugas_luar_negeri").val();
        data.jenis = $("#jenis").val();
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
            } else if (action == 'edit') {
                URL = BASE_URL + "pengembangan_pelatihan/edit";
            }
            save(URL, data, loaddata);
    }
</script>