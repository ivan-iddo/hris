<!--Nav Tabs-->
<?php require_once("../../constants.php"); ?>
<ul class="nav nav-tabs">
    <div class="alert alert-danger hidden" id="users-blocked" role="alert">
        Akun anda tidak dapat mengajukan pelatihan! Silahkan selesaikan laporan pada pelatihan sebelumnya.
    </div>
    <div class="alert alert-warning hidden" id="users-monev" role="alert">
        Anda memiliki pelatihan & pengembangan saat ini (Monitoring & Evaluasi).
    </div>
  <li class="active">
    <a data-toggle="tab" href="#demo-lft-tab-1">
      <i class="demo-psi-home">
      </i> List
    </a>
  </li>
  <li>
    <a data-toggle="tab" href="#demo-lft-tab-2" onclick="proses_add()">
      <i class="demo-psi-pen-5">
      </i> Add
    </a>
  </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active in" id="demo-lft-tab-1">
        <div class="fixed-table-toolbar">
        </div>
        <div class="panel-body">
            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="demo-dt-addrow_wrapper">
                <div class="newtoolbar">
                    <div class="table-toolbar-left" id="demo-custom-toolbar2">
                        <div class="btn-group">
                            <!-- <button class="btn btn-primary btn-labeled fa fa-plus-square btn-sm" id=
                            "demo-bootbox-bounce">Add
                            </button> -->
                            <button class=
                                    "btn btn-success btn-labeled fa fa-check btn-sm" onclick=
                                    "proses_update(<?php echo STATUS_LATBANG_KABAG ?>);">Persetujuan Kabag
                            </button>
                        </div>
                    </div>
                </div>
                <div class="dataTables_filter" id="demo-dt-addrow_filter">
                    <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder=""
                                         type="search" id="search"
                                         onkeydown="if(event.keyCode=='13'){loaddata(0, this);}"></label>
                </div>
            </div>
            <div class="bootstrap-table">
                <div class="fixed-table-container" style="padding-bottom: 0px;">
                    <div class="ag-theme-balham" id="myGrid" style="height: 400px;width:100%;">
                    </div>

                    <div class="paging pull-right mar-all">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- form add -->
    <div class="tab-pane fade" id="demo-lft-tab-2">
        <div class="row">
            <div class="eq-height">
                <div class="col-sm-3 eq-box-sm ">
                    <!--Basic Panel-->
                    <!--===================================================-->
                    <div class="panel pad-all">
                        <div class="panel-body">
                            <form class="form-horizontal" id="form-add">
                                <div class="panel-body">
                                    <div class="form-group hidden">
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">No. Indeks</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="id" id="id" style="width: 220px;display:none"
                                                   class="form-control"/>
                                            <input type="text" name="no_disposisi" id="no_disposisi" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Pelatihan</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nama_pelatihan" id="nama_pelatihan" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">Tujuan</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="tujuan" id="tujuan" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">Institusi Latbang</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="institusi" id="institusi" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="body-content-calendar">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="demo-hor-inputemail">Tgl
                                                Pelaksanaan</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="tanggal[]" class="form-control tanggal daterangepicker"
                                                       id="tanggal"
                                                />
                                            </div>
                                            <div class="col-xs-3 pull right">
                                                <div class="btn btn-default btn-sm" id="add-data-calendar">Add</div>
                                            </div>
                                        </div>
                                    </div>
<!--                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Laporan</label>
                                        <div class="col-sm-5">
                                            <input type="checkbox" name="laporan" id="laporan" value="1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Monitor & Evaluasi</label>
                                        <div class="col-sm-5">
                                            <input type="checkbox" name="monev" id="monev" value="1">
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">Total Hari Kerja</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="id" id="id" style="width: 220px;display:none"
                                                   class="form-control"/>
                                            <input type="text" name="total_hari_kerja" id="total_hari_kerja" class="form-control numeric-only"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jenis Kegiatan</label>
                                        <div class="col-sm-5">
                                            <select name="pengembangan_pelatihan_kegiatan" id="pengembangan_pelatihan_kegiatan"
                                                    class="form-control select-chosen">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-5">
                                            <select name="pengembangan_pelatihan_kegiatan_status" id="pengembangan_pelatihan_kegiatan_status"
                                                    class="form-control select-chosen">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jenis Perjalanan</label>
                                        <div class="col-sm-5">
                                            <select name="jenis_perjalanan" id="jenis_perjalanan"
                                                    class="form-control select-chosen">
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
                                    <div class="form-group dalam_negeri-luarkota hidden">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-5">
                                            <select name="surat_tugas_dalam_negeri_luarkota" id="surat_tugas_dalam_negeri_luarkota"
                                                    class="form-control select-chosen">
                                                <option value="">Pilih</option>
                                                <option>Surat Tugas</option>
                                                <option>SPPD</option>
                                                <option>RAK</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group dalam_negeri-dalamkota hidden">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-5">
                                            <select name="surat_tugas_dalam_negeri_dalamkota" id="surat_tugas_dalam_negeri_dalamkota"
                                                    class="form-control select-chosen">
                                                <option value="">Pilih</option>
                                                <option>Surat Izin</option>
                                                <option>RAK</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group jenis_perjalanan_luar_negeri hidden">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-5">
                                            <select name="surat_tugas_luar_negeri" id="surat_tugas_luar_negeri"
                                                    class="form-control select-chosen">
                                                <option value="">Pilih</option>
                                                <option>Surat Tugas</option>
                                                <option>Surat Izin</option>
                                                <option>SPPD</option>
                                                <option>Surat Rekomendasi</option>
                                            </select>
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
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">NIP</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nip" id="nip" class="form-control"
                                                   readonly="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">NIK</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nik" id="nik" class="form-control"
                                                   readonly="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Pegawai</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control"
                                                   readonly="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">Jabatan/Unit
                                            Kerja</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="jabatan" id="jabatan" class="form-control"
                                                   readonly="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">Pangkat</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="pangkat" id="pangkat" class="form-control"
                                                   readonly="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">Golongan</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="golongan" id="golongan" class="form-control"
                                                   readonly="true"/>
                                        </div>
                                    </div>
                                    <div class="body-content">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Uraian Biaya</label>
                                            <div class="body-detail">
                                                <div class="col-sm-3">
                                                    <input type="text" name="biaya_uraian[]" class="form-control biaya_uraian"
                                                           id="biaya_uraian"
                                                           placeholder="Uraian"/>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" name="biaya_nominal[]"
                                                           class="form-control biaya_nominal numeric-only" id="biaya_nominal" min="0" value="0"
                                                           placeholder="Biaya"/>
                                                </div>
                                            </div>
                                            <div class="col-xs-3 pull right">
                                                <div class="btn btn-default btn-sm" id="add-data">Add</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer" style="border:none;background-color : #e9e9e9">
                                        <button type="button" class="btn btn-primary btn-pegawai-add" onclick="addRowTable()">
                                            <span class="fa fa-edit"></span>Tambah Pegawai
                                        </button>
                                        <button type="button" class="btn btn-primary hidden btn-pegawai-edit" value="" onclick="updateRowTable()">
                                            <span class="fa fa-edit"></span>Edit
                                        </button>
                                        <button type="button" class="btn btn-primary hidden btn-pegawai-remove" value="" onclick="removeRowTable()">
                                            <span class="fa fa-remove"></span>Hapus
                                        </button>
                                        <button type="button" class="btn btn-primary hidden btn-pegawai-remove"
                                                onclick="clearAddPegawai()">
                                            <span class="fa fa-remove"></span>Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--===================================================-->
                <!--End Basic Panel-->
                <div class="col-sm-4 eq-box-sm">
                    <!--Panel with Header-->
                    <!--===================================================-->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Peserta</h3>
                        </div>
                        <div class="panel-body">
                            <div id="gridPI" style="width:100%;height: 500px;" class="ag-theme-balham"></div>
                            <div class="paging pull-right mar-all">
                            </div>
                        </div>
                    </div>
                    <!--===================================================-->
                    <!--End Panel with Header-->
                </div>
            </div>
        </div>
        <button class="btn btn-primary" onclick="simpan()">
            Simpan
        </button>
    </div>
</div>

<script>
    $('.judul-menu').html('Pengembangan Pelatihan');
    var listPI = [
        {headerName: "NOPEG", field: "nopeg", width: 190, filterParams: {newRowsAction: 'keep'}},
        {headerName: "NAMA", field: "nama_pegawai", width: 190, filterParams: {newRowsAction: 'keep'}},
        {headerName: "JABATAN", field: "jabatan", width: 190, filterParams: {newRowsAction: 'keep'}},
        {headerName: "TOTAL BIAYA", field: "uraian_total", width: 190, filterParams: {newRowsAction: 'keep'}},
    ];
    var gridPI = {
        enableSorting: true,
        enableFilter: true,
        suppressRowClickSelection: false,
        onRowClicked: editRowTable,
        groupSelectsChildren: true,
        debug: true,
        rowSelection: 'single',
        enableColResize: true,
        rowGroupPanelShow: 'always',
        pivotPanelShow: 'always',
        enableRangeSelection: true,
        columnDefs: listPI,
        pagination: false,
        paginationPageSize: 50,
        defaultColDef: {
            editable: false,
            enableRowGroup: true,
            enablePivot: true,
            enableValue: true
        }
    };
    // setup the grid after the page has finished loading
    var gridDiv = document.querySelector('#gridPI');
    new agGrid.Grid(gridDiv, gridPI);

    var columnListData = [
            {headerName: "Nama Pelatihan", field: "nama_pelatihan", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Tujuan", field: "tujuan", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Institusi", field: "institusi", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Kegiatan", field: "pengembangan_pelatihan_kegiatan.nama", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Pengembangan Pelatihan Status", field: "pengembangan_pelatihan_kegiatan_status.nama", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Tipe", field: "jenis", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Jenis Perjalanan", field: "jenis_perjalanan", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Jenis Biaya", field: "jenis_biaya", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Created Date", field: "created", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Created By", field: "createdby", width: 190, filterParams: {newRowsAction: 'keep'}}
    ];

    var gridOptionsList = {
        enableSorting: true,
        enableFilter: true,
        suppressRowClickSelection: false,
        groupDefaultExpanded: 2,
        groupSelectsChildren: true,
        debug: true,
        rowSelection: 'single',
        enableColResize: true,
        rowGroupPanelShow: 'always',
        pivotPanelShow: 'always',
        enableRangeSelection: true,
        columnDefs: columnListData,
        pagination: false,
        autoGroupColumnDef: {
            headerName: 'Group',
            field: 'athlete'
        },
        defaultColDef: {
            editable: true
        },
        onGridReady: function (params) {
            params.api.sizeColumnsToFit();
        },
        onCellEditingStarted: function (event) {
            console.log('cellEditingStarted');
        },
        onCellEditingStopped: function (event) {
            console.log('cellEditingStopped');
        }
    };

    var dataTable = [];
    var isClickRowTable = true;
    $('.daterangepicker').daterangepicker({
           locale: {
             format: 'DD-MM-YYYY'
           }
    });
    $('.select-chosen').chosen();
    $('.chosen-container').css({"width": "100%"});
    $('.judul-menu').html('Penilaian Kerja Individu');
    $('.buttoenedit').hide();

    $("#jenis_perjalanan").on("change", function () {
        jenis_perjalanan = $(this).val();
        if (jenis_perjalanan == "Dalam Negeri") {
            $(".jenis_perjalanan_luar_negeri").addClass('hidden');
            $(".jenis_perjalanan_dalam_negeri").removeClass('hidden');
            $(".dalam_negeri").removeClass('hidden');
            // reset value
            $("#surat_tugas_luar_negeri").prop('selectedIndex', 0);
            $("#surat_tugas_luar_negeri").trigger("chosen:updated");
        }
        else if(jenis_perjalanan == "Luar Negeri"){
            $(".jenis_perjalanan_dalam_negeri").addClass('hidden');
            $(".dalam_negeri").addClass('hidden');
            // show
            $(".jenis_perjalanan_luar_negeri").removeClass('hidden');
            // reset value
            $("#dalam_negeri").prop('selectedIndex', 0);
            $("#dalam_negeri").trigger("chosen:updated");
        }
        else{
            $(".jenis_perjalanan_dalam_negeri").addClass('hidden');
            $(".dalam_negeri").addClass('hidden');

            $(".jenis_perjalanan_luar_negeri").addClass('hidden');

            $("#dalam_negeri").prop('selectedIndex', 0);
            $("#dalam_negeri").trigger("chosen:updated");
            $("#surat_tugas_luar_negeri").prop('selectedIndex', 0);
            $("#surat_tugas_luar_negeri").trigger("chosen:updated");
        }
        changeDalamNegeri();
    });

    function changeDalamNegeri(argument = null) {
        console.log("changeDalamNegeri" + argument);
        if (argument == "Dalam Kota"){
            $("#surat_tugas_dalam_negeri_luarkota").prop('selectedIndex', 0);
            $("#surat_tugas_dalam_negeri_luarkota").trigger('chosen:updated');
            $(".dalam_negeri-dalamkota").removeClass('hidden');
            $(".dalam_negeri-luarkota").addClass('hidden');
        }
        else if (argument == "Luar Kota"){
            $("#surat_tugas_dalam_negeri_dalamkota").prop('selectedIndex', 0);
            $("#surat_tugas_dalam_negeri_dalamkota").trigger('chosen:updated');
            $(".dalam_negeri-dalamkota").addClass('hidden');
            $(".dalam_negeri-luarkota").removeClass('hidden');
        }
        else{        
            $("#surat_tugas_dalam_negeri_luarkota").prop('selectedIndex', 0);
            $("#surat_tugas_dalam_negeri_dalamkota").prop('selectedIndex', 0);
            $("#surat_tugas_dalam_negeri_luarkota").trigger("chosen:updated");
            $("#surat_tugas_dalam_negeri_dalamkota").trigger("chosen:updated");
        }
    }

    $("#dalam_negeri").on("change", function(){
        changeDalamNegeri($(this).val());
    });

      function loadUser(id, url, valueEdit = null) {
        $('#' + id).children().remove();
        $('#' + id).append('<option value="" selected="selected">Pilih</option>');

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
                    $('#' + id).append('<option ' + (e.result[i].nip == valueEdit ? 'selected' : '') + ' value="' + e.result[i].nip + '" data-nik="' + e.result[i].nik + '" data-golongan="' + e.result[i].golongan + '" data-pangkat="' + e.result[i].pangkat +'" data-nama="' + e.result[i].nama + '" data-nama-group="' + e.result[i].nama_uk + '" >' + e.result[i].id + ' - ' + e.result[i].nama + '</option>');
                }
                $('#' + id).trigger("chosen:updated");
            }
        });
    }

    loadUser("nopeg", BASE_URL + "users/list_userlat");

    function loadPengembanganPelatihanKegiatan(id, url, valueEdit = null) {
        $('#' + id).children().remove();
        $('#' + id).append('<option value="" selected="selected">Pilih</option>');

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
                    $('#' + id).append('<option value='+e.result[i].id+' '+(e.result[i].id == valueEdit ? 'selected' : '') + '" >' + e.result[i].nama + '</option>');
                }
                $('#' + id).trigger("chosen:updated");
            }
        });
    }

    loadPengembanganPelatihanKegiatan("pengembangan_pelatihan_kegiatan", BASE_URL + "pengembangan_pelatihan_kegiatan/list");

    function loadPengembanganPelatihanKegiatanStatus(id, url, valueEdit = null) {
        $('#' + id).children().remove();
        $('#' + id).append('<option value="" selected="selected">Pilih</option>');

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
                    $('#' + id).append('<option value='+e.result[i].id+'  '+(e.result[i].id == valueEdit ? 'selected' : '') + '" >' + e.result[i].nama + '</option>');
                }
                $('#' + id).trigger("chosen:updated");
            }
        });
    }

    loadPengembanganPelatihanKegiatanStatus("pengembangan_pelatihan_kegiatan_status", BASE_URL + "pengembangan_pelatihan_kegiatan_status/list");

    $(document).on('keydown', ".numeric-only", function (e) {
        $('.numeric-only').jStepper({minValue:0, minLength:1});
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
            '<input type="text" name="biaya_nominal[]" class="form-control biaya_nominal numeric-only" min="0" value="0" placeholder="Biaya" />' +
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
                format: 'DD-MM-YYYY'
            }
        });
    });
    $(document).on('click', '.btn-remove-calendar', function (event) {
        $(this).parentsUntil(".body-remove-calendar").parent().remove();
    });

    $("#nopeg").on("change", function () {
        if ($(this).find(':selected').attr("data-nama") != undefined) {
            $("#nama_pegawai").val($(this).find(':selected').attr("data-nama"));
            $("#jabatan").val($(this).find(':selected').attr("data-nama-group"));
            $("#nik").val($(this).find(':selected').attr("data-nik"));
            $("#nip").val($(this).find(':selected').val());
            $("#pangkat").val($(this).find(':selected').attr("data-pangkat"));
            $("#golongan").val($(this).find(':selected').attr("data-golongan"));
        }
    });



    function addRowTable(idRow = "") {
        if ($("#nopeg").val().length == "") {
            onMessage("Silahkan pilih pegawai .");
            return;
        }
        var detail_uraian = [];
        var dataRow = {};
        var itemUraian = {};
        var biaya_uraian = $(".biaya_uraian").serializeArray();
        var biaya_nominal = $(".biaya_nominal").serializeArray();
        var uraian_total = 0;
        for (var i = 0; i < biaya_uraian.length; i++) {
            if (biaya_uraian[i].value.length > 0) {
                itemUraian = {};
                itemUraian.uraian = biaya_uraian[i].value;
                itemUraian.nominal = parseFloat(biaya_nominal[i].value);
                uraian_total += itemUraian.nominal;
                detail_uraian.push(itemUraian);
            }
            else{
                onMessage("Lengkapi detail uraian biaya .");
                return;
            }
        }

        dataRow.uraian_total = uraian_total;
        dataRow.nopeg = $("#nopeg").val();
        dataRow.nip = $("#nik").val();
        dataRow.pangkat = $("#pangkat").val();
        dataRow.golongan = $("#golongan").val();
        dataRow.nama_pegawai = $("#nama_pegawai").val();
        dataRow.jabatan = $("#jabatan").val();
        dataRow.detail_uraian = detail_uraian;
        if (idRow == ""){
            dataTable.push(dataRow);
        }
        else{
            dataTable[idRow] = dataRow;
        }

        console.log(dataRow);
        // return;

        gridPI.api.setRowData(dataTable);
        isClickRowTable = true;
        clearAddPegawai();
    }

    function editRowTable() {
        var selectedRows = gridPI.api.getSelectedRows();
        var selectedRow = selectedRows[0];
        console.log(selectedRow);
        if (isClickRowTable) {
            if (selectedRows == '') {
                onMessage('Silahkan Pilih Pegawai Terlebih dahulu!');
                return false;
            }
            else {
                var selectedRows = gridPI.api.getSelectedRows();
                var selectedRow = selectedRows[0];
                loadUser("nopeg", BASE_URL + "users/list_userlat", selectedRow.nopeg);

                $('#nama_pegawai').val(selectedRow.nama_pegawai);
                $('#jabatan').val(selectedRow.jabatan);
                $('#nip').val(selectedRow.nopeg);
                $('#nik').val(selectedRow.nip);
                $('#pangkat').val(selectedRow.pangkat);
                $('#golongan').val(selectedRow.golongan);
                selectedRow.detail_uraian.forEach(function (item, index) {
                    if (index == 0) {
                        $("#biaya_uraian").val(selectedRow.detail_uraian[index].uraian);
                        $("#biaya_nominal").val(selectedRow.detail_uraian[index].nominal);
                    }
                    else {
                        var row = $(
                            '<div class="form-group body-remove">' +
                            '<label class="col-sm-3 control-label"></label>' +
                            '<div class="body-detail">' +
                            '<div class="col-sm-3">' +
                            '<input type="text" name="biaya_uraian[]" class="form-control biaya_uraian" placeholder="Uraian" value=' + selectedRow.detail_uraian[index].uraian + ' />' +
                            '</div>' +
                            '<div class="col-sm-3">' +
                            '<input type="text" name="biaya_nominal[]" class="form-control biaya_nominal" placeholder="Biaya" value=' + selectedRow.detail_uraian[index].nominal + ' />' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-xs-3 pull right">' +
                            '<div class="btn btn-default btn-sm btn-remove">' +
                            '<i class="fa fa-trash-o"></i>' +
                            '</div>' +
                            '</div>' +
                            '</div>');
                        $(".body-content").append(row);
                    }
                });
                isClickRowTable = false;
                btnActionEdit(selectedRow.nopeg);
            }
        }
    }
    function btnActionEdit(nopeg) {
        $(".btn-pegawai-add").addClass('hidden');
        $(".btn-pegawai-remove").attr('value', nopeg);
        $(".btn-pegawai-remove").removeClass('hidden');
        $(".btn-pegawai-edit").attr('value', nopeg);
        $(".btn-pegawai-edit").removeClass('hidden');
        $(".btn-pegawai-cancel").removeClass('hidden');
    }

    function btnActionAdd() {
        $(".btn-pegawai-add").removeClass('hidden');
        $(".btn-pegawai-remove").addClass('hidden');
        $(".btn-pegawai-edit").addClass('hidden');
        $(".btn-pegawai-cancel").addClass('hidden');
    }

    function updateRowTable() {
        var idRowDataTable = $(".btn-pegawai-edit").val();
        dataTable = $.grep(dataTable, function(e){ 
             return e.nopeg != idRowDataTable; 
        });
        btnActionAdd();
        addRowTable(idRowDataTable);
    }

    function removeRowTable(){
        var idRowDataTable = $(".btn-pegawai-remove").val();
        dataTable = $.grep(dataTable, function(e){ 
             return e.nopeg != idRowDataTable; 
        });
        btnActionAdd();
        clearAddPegawai();
        gridPI.api.setRowData(dataTable);
    }

     function clearAddPegawai() {
        $(".body-remove").remove();
        $(".body-remove-calendar").remove();
        $("#nopeg").prop('selectedIndex', 0);
        $("#nopeg").trigger("chosen:updated");
        $("#nama_pegawai").val("");
        $("#jabatan").val("");
        $("#nip").val("");
        $("#nik").val("");
        $("#pangkat").val("");
        $("#golongan").val("");
        $("#biaya_uraian").val("");
        $("#biaya_nominal").val(0);
        $(".btn-pegawai-remove").val("");
        $(".btn-pegawai-edit").val("");
        isClickRowTable = true;
        btnActionAdd();
    }


    function form_reset() {
        clearAddPegawai();
        dataTable = [];
        gridPI.api.setRowData(dataTable);
        console.log(dataTable);
        isClickRowTable = true;
        $("#form-add").trigger('reset');
        
        $("#pengembangan_pelatihan_kegiatan").prop('selectedIndex', 0);
        $("#pengembangan_pelatihan_kegiatan").trigger("chosen:updated");
        $("#pengembangan_pelatihan_kegiatan_status").prop('selectedIndex', 0);
        $("#pengembangan_pelatihan_kegiatan_status").trigger("chosen:updated");
        $("#jenis_perjalanan").prop('selectedIndex', 0);
        $("#jenis_perjalanan").trigger("chosen:updated");
        $("#jenis_perjalanan").trigger('change');
        $("#jenis_biaya").prop('selectedIndex', 0);
        $("#jenis_biaya").trigger('chosen:updated');
        $("#jenis").prop('selectedIndex', 0);
        $("#jenis").trigger("chosen:updated");
        $("#jenis").prop('selectedIndex', 0);
        $("#jenis").trigger("chosen:updated");
    }

    // CRUD
    function simpan() {
        obj = {};
        obj.id = $("#id").val();
        obj.no_disposisi = $("#no_disposisi").val();
        obj.nama_pelatihan = $("#nama_pelatihan").val();
        obj.tujuan = $("#tujuan").val();
        obj.institusi = $("#institusi").val();
        obj.tanggal = $(".tanggal").serializeArray();
        obj.laporan = 0;
        obj.monev = 0;
        if ($('#laporan').is(":checked")){
            obj.laporan = 1;
        };
        if ($('#monev').is(":checked")){
            obj.monev = 1;
        };
        obj.jenis = $("#jenis").val();
        obj.jenis_biaya = $("#jenis_biaya").val();
        obj.jenis_perjalanan = $("#jenis_perjalanan").val();
        obj.pengembangan_pelatihan_kegiatan = $("#pengembangan_pelatihan_kegiatan").val();
        obj.pengembangan_pelatihan_kegiatan_status = $("#pengembangan_pelatihan_kegiatan_status").val();
        obj.dalam_negeri = $("#dalam_negeri").val();
        obj.surat_tugas_dalam_negeri = $("#surat_tugas_dalam_negeri").val();
        obj.surat_tugas_dalam_negeri_dalamkota = $("#surat_tugas_dalam_negeri_dalamkota").val();
        obj.surat_tugas_dalam_negeri_luarkota = $("#surat_tugas_dalam_negeri_luarkota").val();
        obj.surat_tugas_luar_negeri = $("#surat_tugas_luar_negeri").val();
        obj.total_hari_kerja = $("#total_hari_kerja").val();
        obj.detail = dataTable;
        console.log(obj);
        // return;

        if ($('#id').val().length == "") {
            URL = BASE_URL + "pengembangan_pelatihan/save";
        } 
        if ($('#id').val().length != "") {
            URL = BASE_URL + "pengembangan_pelatihan/edit";
        }
        save(URL, obj, loaddata);
    }

    function proses_update(status) {
        obj = {};
        var selectedRows = gridOptionsList.api.getSelectedRows();

        if (selectedRows.length != 1) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
            var selectedRow = selectedRows[0];
            obj.id = selectedRow.id;
        }
        obj.status = status;
        console.log(obj);

        URL = BASE_URL + "pengembangan_pelatihan/update";
        save(URL, obj, loaddata);
    }
    // setup the grid after the page has finished loading
    var myGrid = document.querySelector('#myGrid');
    new agGrid.Grid(myGrid, gridOptionsList);

    function loaddata(jml = 0) {
        var search = 0;
        if ($('#search').val() !== '') {
            search = $('#search').val();
        }
        $.ajax({
            url: BASE_URL + 'pengembangan_pelatihan/list/' + jml + '/' +search,
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
                if (data.is_blocked == true){
                    $("#users-blocked").removeClass('hidden');
                }
                else{
                    $("#users-blocked").addClass('hidden');
                }
                if (data.is_monev == true){
                    $("#users-monev").removeClass('hidden')
                }
                else{
                    $("#users-monev").addClass('hidden');
                }
                gridOptionsList.api.setRowData(data.result);
                pagingDatatable(data.total, data.limit, 'loaddata');
            },
            error: function (jqXhr, textStatus, errorThrown) {
                alert('error');
            }
        });
    }
    
    function proses_delete() {
        var selectedRows = gridOptionsList.api.getSelectedRows();
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
            submit_get(BASE_URL + 'pengembangan_pelatihan/delete/?id=' + selectedRowsString, loaddata);
        }
    }

    loaddata(0);

    function proses_edit(){
        var selectedRows = gridOptionsList.api.getSelectedRows();

        if (selectedRows.length != 1) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
            var selectedRow = selectedRows[0];
            var selectedRowsString = selectedRow.id;
            $.ajax({
                url: BASE_URL + 'pengembangan_pelatihan/get/?id=' + selectedRowsString,
                headers: {
                    'Authorization': localStorage.getItem("Token"),
                    'X_CSRF_TOKEN': 'donimaulana',
                    'Content-Type': 'application/json'
                },
                dataType: 'json',
                type: 'get',
                contentType: 'application/json',
                processData: false,
                success: function (res, textStatus, jQxhr) {
                    $('#id').val(res.data.id);
                    $('#no_disposisi').val(res.data.no_disposisi);
                    $('#total_hari_kerja').val(res.data.total_hari_kerja);

                    if (res.data.pengembangan_pelatihan_kegiatan != null){                    
                        $('#pengembangan_pelatihan_kegiatan').val(res.data.pengembangan_pelatihan_kegiatan.id);
                        $("#pengembangan_pelatihan_kegiatan").trigger("chosen:updated");
                    };
                    if (res.data.pengembangan_pelatihan_kegiatan_status != null){                    
                        $('#pengembangan_pelatihan_kegiatan_status').val(res.data.pengembangan_pelatihan_kegiatan_status.id);
                        $("#pengembangan_pelatihan_kegiatan_status").trigger("chosen:updated");
                    };


                    $('#jenis').val(res.data.jenis);
                    $("#jenis").trigger("chosen:updated");

                    if (res.data.monev == "1"){
                        $('#monev').prop("checked", true);
                    }
                    else{
                        $('#monev').prop("checked", false);
                    }
                    if (res.data.laporan == "1"){
                        $('#laporan').prop("checked", true);
                    }
                    else{
                        $('#laporan').prop("checked", false);
                    }
                    $('#jenis_perjalanan').val(res.data.jenis_perjalanan);
                    $("#jenis_perjalanan").trigger("chosen:updated");

                    for (var i = 0; i < res.data.tanggal.length; i++) {
                        if (i == 0){
                            $("#tanggal").val(res.data.tanggal[i].tanggal_from +" - "+ res.data.tanggal[i].tanggal_to);
                        }
                        else{
                            var row = $(
                                '<div class="form-group body-remove-calendar">' +
                                '<label class="col-sm-3 control-label" for="demo-hor-inputemail"></label>' +
                                '<div class="col-sm-5">' +
                                '<input type="text" name="tanggal[]" class="form-control tanggal daterangepicker" value="'+ res.data.tanggal[i].tanggal_from +" - "+ res.data.tanggal[i].tanggal_to +'" />' +
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
                                     format: 'DD-MM-YYYY'
                                   }
                            });
                        }
                    };

                    if (res.data.jenis_perjalanan == "Dalam Negeri") {
                        $("#dalam_negeri").val(res.data.dalam_negeri);
                        $("#dalam_negeri").trigger("chosen:updated");

                        $("#surat_tugas_dalam_negeri").val(res.data.surat_tugas_dalam_negeri);
                        $("#dalam_negeri").trigger("chosen:updated");
                        $("#surat_tugas_dalam_negeri").trigger('chosen:updated');

                        $(".dalam_negeri").removeClass('hidden');
                        $(".jenis_perjalanan_dalam_negeri").removeClass('hidden');
                        // hide
                        $(".jenis_perjalanan_luar_negeri").addClass('hidden');
                    }
                    else {
                        $(".jenis_perjalanan_dalam_negeri").addClass('hidden');
                        $(".dalam_negeri").addClass('hidden');
                        // show
                        $(".jenis_perjalanan_luar_negeri").removeClass('hidden');
                        // reset value
                        $("#dalam_negeri").prop('selectedIndex', 0);
                        $("#surat_tugas_luar_negeri").val(res.data.surat_tugas_luar_negeri);
                        $("#surat_tugas_luar_negeri").trigger('chosen:updated');
                    }
                    $('#jenis').val(res.data.jenis);
                    $("#jenis").trigger("chosen:updated");
                    $('#jenis_biaya').val(res.data.jenis_biaya);
                    $("#jenis_biaya").trigger("chosen:updated");
                    $('#nama_pegawai').val(res.data.nama_pegawai);
                    $('#jabatan').val(res.data.jabatan);
                    dataTable = res.data.detail;

                    gridPI.api.setRowData(dataTable);
                    $('.nav-tabs a[href="#demo-lft-tab-2"]').tab('show');

                },
                error: function (jqXhr, textStatus, errorThrown) {
                    alert('error');
                }
            });
        }
    }

    function proses_add() {
        form_reset();
    }

    function laporan_selesai() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
            submit_get(BASE_URL + 'pengembangan_pelatihan/laporan_selesai/?id=' + selectedRowsSelesai[0].id, loaddata);
        }
    }
    function cetak() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
            window.open(BASE_URL + 'pengembangan_pelatihan/cetak/?id=' + selectedRowsSelesai[0].id);
        }
    }
</script>