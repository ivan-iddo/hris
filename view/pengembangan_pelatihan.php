<!--Nav Tabs-->
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
    <button class=
        "btn btn-warning btn-labeled fa fa-edit btn-sm" onclick=
        "proses_edit();">Edit
    </button>
    <button class=
        "btn btn-danger btn-labeled fa fa-close btn-sm" onclick=
        "proses_delete();">Delete per latihan
    </button>
	<button class=
        "btn btn-danger btn-labeled fa fa-close btn-sm" onclick=
        "del();">Delete per orang
    </button>
    <button class=
        "btn btn-success btn-labeled fa fa-check btn-sm" id="id_upload" value="" onclick=
        "uploadFile();">Upload File
    </button>
	<button class=
        "btn btn-success btn-labeled fa fa-check btn-sm" value="" onclick=
        "laporan_selesai();">Laporan Selesai
    </button>	
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
                                    "btn btn-info btn-labeled fa fa-check btn-sm" onclick=
                                    "cetak();">Tugas / Izin
                            </button>
							<button class=
                                    "btn btn-info btn-labeled fa fa-check btn-sm" onclick=
                                    "cetak_rak();">Surat RAK
                            </button>
							<button class=
                                    "btn btn-info btn-labeled fa fa-check btn-sm" onclick=
                                    "cetak_dft_rak();">Peserta RAK
                            </button>
							<button class=
                                    "btn btn-info btn-labeled fa fa-check btn-sm" onclick=
                                    "cetak_spd();">Surat SPD
                            </button>
							<button class=
                                    "btn btn-info btn-labeled fa fa-check btn-sm" onclick=
                                    "cetak_rekomendasi();">Rekomendasi
                            </button>
							<button class=
                                    "btn btn-info btn-labeled fa fa-check btn-sm" onclick=
                                    "cetak_pengantar();">Pengantar
                            </button>
							<button class=
                                    "btn btn-info btn-labeled fa fa-check btn-sm" onclick=
                                "nota();">Nota Dinas
                            </button>
							<button class=
                                    "btn btn-info btn-labeled fa fa-check btn-sm" onclick=
                                "ikatan();">Ikatan Dinas
                            </button>
							<button class=
                                    "btn btn-info btn-labeled fa fa-check btn-sm" onclick=
                                "verbal();">Verbal
                            </button>
                        </div>
                    </div>
                </div>
				
                <div class="dataTables_filter" id="demo-dt-addrow_filter">
                    <button class=
                    "btn btn-success btn-labeled fa fa-check btn-sm" onclick="download();">Download
					</button>
					<input aria-controls="demo-dt-addrow" class="form-control input-sm tanggal_cek" placeholder="Tanggal Awal"
                                         type="text" name="tanggal_awal" id="tanggal_awal">
					<input aria-controls="demo-dt-addrow" class="form-control input-sm tanggal_cek" placeholder="Tanggal Akhir"
                                        type="text" name="tanggal_akhir" id="tanggal_akhir">
					<button class="btn btn-success btn-labeled fa fa-check btn-sm " onclick= "loaddata(0);">Proses Filter
					</button>
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
                <div class="col-sm-7 eq-box-sm ">
                    <!--Basic Panel-->
                    <!--===================================================-->
                    <div class="panel pad-all">
                        <div class="panel-body">
                            <form class="form-horizontal" id="form-add">
                                <div class="panel-body">
                                    <div class="form-group hidden">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">No. Indeks</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="id" id="id" style="width: 220px;display:none"
                                                   class="form-control"/>
                                            <input type="text" name="no_disposisi" id="no_disposisi" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Jenis Biaya</label>
                                        <div class="col-sm-5">
                                            <select name="jenis_biaya" id="jenis_biaya" class="select-chosen">
                                                <option value="">Pilih</option>
                                                <option value="BLU">BLU</option>
                                                <option value="Sponsor">Sponsor</option>
                                                <option value="Sendiri">Sendiri</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Jenis Surat</label>
                                        <div class="col-sm-5">
                                            <select name="jenis_surat" id="jenis_surat"
                                                    class="form-control select-chosen">
                                                <option value="">Pilih</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Membaca (untuk Verbal Surat)</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="membaca" id="membaca" class="form-control" title="Untuk Verbal Surat"/>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Yth (untuk Verbal Surat)</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="yth" id="yth" class="form-control" title="Untuk Verbal Surat"/>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Plh</label>
                                        <div class="col-sm-5">
                                         <select name="phl" id="phl"
                                                    class="form-control select-chosen">
                                         </select>
										</div>
                                    </div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Jenis Plh</label>
                                        <div class="col-sm-5">
                                            <select name="jenis_plh" id="jenis_plh" class="form-control select-chosen">
                                                <option value="">Pilih</option>
                                                <option value="Plh">Plh</option>
                                                <option value="an">an</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Nama Pelatihan</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nama_pelatihan" id="nama_pelatihan" class="form-control" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Tempat</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="tujuan" id="tujuan" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Institusi Latbang</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="institusi" id="institusi" class="form-control"/>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Alamat</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="alamat" id="alamat" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="body-content-calendar">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="demo-hor-inputemail">Tgl
                                                Pelaksanaan</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="tanggal[]" class="form-control tanggal daterangepicker"
                                                       id="tanggal"
                                                />
                                            </div>
                                            <!-- <div class="col-xs-3 pull right">
                                                <div class="btn btn-default btn-sm" id="add-data-calendar">Add</div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Acara di Mulai</label>
                                        <div class="body-detail">
                                            <div class="col-xs-4">
                                                <input type="time" name="jam_mulai" class="form-control jam_mulai" id="jam_mulai" placeholder="Jam Mulai" required/>
                                            </div>
                                            <div class="col-xs-1">
                                                s/d
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="time" name="jam_sampai" class="form-control jam_sampai" id="jam_sampai" placeholder="Jam Selesai" required/>
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
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Total Hari Kerja</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="id" id="id" style="width: 220px;display:none"
                                                   class="form-control"/>
                                            <input type="text" name="total_hari_kerja" id="total_hari_kerja" class="form-control numeric-only"/>
										</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Jenis Kegiatan</label>
                                        <div class="col-sm-5">
                                            <select name="pengembangan_pelatihan_kegiatan" id="pengembangan_pelatihan_kegiatan"
                                                    class="form-control select-chosen">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-5">
                                            <select name="pengembangan_pelatihan_kegiatan_status" id="pengembangan_pelatihan_kegiatan_status"
                                                    class="form-control select-chosen">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Jenis Perjalanan</label>
                                        <div class="col-sm-5">
                                            <select name="jenis_perjalanan" id="jenis_perjalanan"
                                                    class="form-control select-chosen"
													onChange="getperjalanan(this.value);">
                                                <option value="">Pilih</option>
                                                <option>Dalam Negeri</option>
                                                <option>Luar Negeri</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group jenis_perjalanan_dalam_negeri hidden">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-5">
                                            <select name="dalam_negeri" id="dalam_negeri" class="form-control select-chosen">
                                                <option value="">Pilih</option>
                                                <option>Dalam Kota</option>
                                                <option>Luar Kota</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="form-group dalam_negeri-luarkota hidden">
                                        <label class="col-sm-2 control-label">Alat Angkut</label>
                                        <div class="col-sm-5">
                                            <select name="surat_tugas_dalam_negeri_luarkota" id="surat_tugas_dalam_negeri_luarkota"
                                                    class="form-control select-chosen">
                                                <option value="">Pilih</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="luar">
									<div class="form-group target_kinerja">
                                        <label class="col-sm-2 control-label">Target Kinerja </label>
                                        <div class="col-sm-10">
                                            <input type="text area" name="target_kinerja" id="target_kinerja" class="form-control"/>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Tanggal Pergi</label>
                                        <div class="body-detail">
                                            <div class="col-sm-4">
                                                <input type="text" name="tanggal_go[]" class="form-control tanggal_go daterangepicker"
                                                       id="tanggal_go"
                                                />
                                            </div>
											<label class="col-sm-2 control-label">Hari Pergi</label>
											<div class="col-xs-4">
                                                <input type="text" name="hari_go" id="hari_go" class="form-control numeric-only"/>
											</div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Tanggal Pulang</label>
                                        <div class="body-detail">
                                            <div class="col-sm-4">
                                                <input type="text" name="tanggal_back[]" class="form-control tanggal_back daterangepicker"
                                                       id="tanggal_back"
                                                />
                                            </div>
											<label class="col-sm-2 control-label">Hari Pulang</label>
											<div class="col-xs-4">
                                                <input type="text" name="hari_back" id="hari_back" class="form-control numeric-only"/>
                                            </div>
                                        </div>
                                    </div>
									</div>
                                    <!--<div class="form-group dalam_negeri-dalamkota hidden">
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
                                                <option>SPD</option>
                                                <option>Surat Rekomendasi</option>
                                            </select>
                                        </div>
                                    </div>-->
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tipe</label>
                                        <div class="col-sm-5">
                                            <select name="jenis" id="jenis" class="form-control select-chosen">
                                                <option value="">Pilih</option>
                                                <option>Individu</option>
                                                <option>Kelompok</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nopeg</label>
                                        <div class="col-sm-5">
                                            <select name="nopeg" id="nopeg" class="select-chosen">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">NIP</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nip" id="nip" class="form-control"
                                                   readonly="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">NIK</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nik" id="nik" class="form-control"
                                                   readonly="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Nama Pegawai</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control"
                                                   readonly="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Jabatan</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="jabatan" id="jabatan" class="form-control"
                                                   readonly="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Pangkat</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="pangkat" id="pangkat" class="form-control"
                                                   readonly="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Golongan</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="golongan" id="golongan" class="form-control"
                                                   readonly="true"/>
                                        </div>
                                    </div> 
									<div class="form-group" hidden>
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">berkas</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="berkas" id="berkas" class="form-control"
                                                   />
                                        </div>
                                    </div>
									<!--<div class="form-group">
                                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Akomodasi</label>
										<div class="col-sm-5">
                                            <input type="number" name="akomodasi" id="akomodasi" class="form-control"/>
                                        </div>
                                    </div>-->
									<div class="form-group">
									<label class="col-sm-2 control-label" for="demo-hor-inputemail"></label>
                                        <div class="col-sm-5">
                                            <input type="checkbox" name="laporan_kegiatan" id="laporan_kegiatan">Laporan Kegiatan
                                        </div>
                                    </div>
                                    <!-- <div class="body-content"> -->
                                        <!-- <div class="form-group" id="row_1">
                                            <label class="col-sm-3 control-label">Uraian Biaya</label>
                                            <div class="body-detail">
                                                <div class="col-xs-2">
                                                    <input type="text" name="biaya_uraian[]" class="form-control biaya_uraian" id="biaya_uraian" placeholder="Uraian"/>
                                                </div>
                                                <div class="col-xs-2">
                                                    <input type="text" name="qty_nominal[]" class="form-control qty_nominal numeric-only" id="qty_nominal_1" min="1" value="1" required onkeyup="getTotal(1)"/>
                                                </div>
                                                <div class="col-xs-2">
                                                    <input type="text" name="biaya_nominal[]" class="form-control biaya_nominal numeric-only" required onkeyup="getTotal(1)"/>
                                                </div>
                                                <div class="col-xs-2">
                                                    <input type="text" name="total_nominal[]" class="form-control total_nominal numeric-only" id="total_nominal_1" min="0" value="0"
                                                           readonly/>
                                                </div>
                                            </div>
                                            <div class="col-xs-1 pull right">
                                                <div class="btn btn-default btn-sm" id="add-data">Add</div>
                                            </div>
                                        </div> -->
                                    <!-- </div> -->
                                    <table class="body-content">
                                        <tbody>
                                        <tr id="row_1">
                                        <td>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Uraian Biaya</label>
                                            <div class="body-detail">
                                                <div class="col-xs-2">
                                                    <input type="text" name="biaya_uraian[]" class="form-control biaya_uraian" id="biaya_uraian_1" placeholder="Uraian"/>
                                                </div>
                                                <div class="col-xs-2">
                                                    <input type="number" name="qty_nominal[]" class="form-control qty_nominal" id="qty_nominal_1" title="Jumlah Keterangan" min="1" value="1" required onkeyup="getTotal(1)"/>
                                                </div>
												<div class="col-xs-2">
                                                    <input type="text" name="uraian_nominal[]" class="form-control uraian_nominal" id="uraian_nominal_1" placeholder="Ket nominal"/>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" name="biaya_nominal[]" class="form-control biaya_nominal" id="biaya_nominal_1" min="0" placeholder="0" required onkeyup="getTotal(1)"/>
                                                </div>
                                            </div>
                                            <div class="col-xs-1 pull right">
                                                <div class="btn btn-default btn-sm" id="add-data">Add</div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"></label>
                                            <div class="body-detail">
                                                <div class="col-xs-3">
                                                    <input type="text" name="total_nominal[]" class="form-control total_nominal" id="total_nominal_1" min="0" value="0"
                                                           readonly/>
                                                </div>
												<div class="col-xs-2">
                                                    <input type="number" name="orang[]" class="form-control orang" title="Jumlah Orang" id="orang_1" min="0" placeholder="0" required onkeyup="getTotal(1)"/>
                                                </div>
												<div class="col-xs-4">
                                                    <input type="text" name="total[]" class="form-control total" id="total_1" min="0" value="0"
                                                           readonly/>
                                                </div>
												<div class="col-xs-1">
                                                    <input type="text" name="muncul[]" class="muncul" id="muncul_1" title="Rincian biaya yg Diterima" placeholder="Rincian biaya yg Diterima">
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        </tr>
                                        </tbody>
                                    </table>
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
    function download(){
    var datalist = { 
        fileName: 'Latbang',
        sheetName: 'Latbang'
    };
		gridOptionsList.api.exportDataAsExcel(datalist);
	}
	var listPI = [
        {headerName: "NOPEG", field: "nopeg", width: 190, filterParams: {newRowsAction: 'keep'}},
        {headerName: "NAMA", field: "nama_pegawai", width: 190, filterParams: {newRowsAction: 'keep'}},
        {headerName: "JABATAN", field: "jabatan", width: 190, filterParams: {newRowsAction: 'keep'}},
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
            {headerName: "Nomer Berkas", field: "pengembangan_pelatihan_detail.berkas", width:90, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Nopeg", field: "pengembangan_pelatihan_detail.nopeg", width: 90, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Nama pegawai", field: "pengembangan_pelatihan_detail.nama_pegawai", width: 190, filterParams: {newRowsAction: 'keep'}},
            
			{headerName: "Tanggal dan Jam Pelatihan", field: "tanggal_from", width: 190, filterParams: {newRowsAction: 'keep'}},
			{headerName: "Nama Kegiatan", field: "nama_pelatihan", width: 190, filterParams: {newRowsAction: 'keep'}},
            // , rowGroup:true
            {headerName: "Status", field: "pengembangan_pelatihan_kegiatan_status.nama", width: 190, filterParams: {newRowsAction: 'keep'}},
			{headerName: "Jenis Kegiatan", field: "pengembangan_pelatihan_kegiatan.nama", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Tempat Kegiatan", field: "tujuan", width: 190, filterParams: {newRowsAction: 'keep'}},
			{headerName: "Lembaga", field: "institusi", width: 190, filterParams: {newRowsAction: 'keep'}},
			{headerName: "Per orang", field: "pernominal", width: 190, filterParams: {newRowsAction: 'keep'}},
			{headerName: "Created By", field: "createdby", width: 190, filterParams: {newRowsAction: 'keep'}},
			{headerName: "Date By", field: "created", width: 190, filterParams: {newRowsAction: 'keep'}},
            	{headerName: "Laporan Kegiatan",field: "laporan", 
				  cellRenderer: checkboxCellRenderer
				},
			{headerName: "Created By Laporan", field: "pengembangan_pelatihan_detail.laporan_by", width: 190, filterParams: {newRowsAction: 'keep'}},
			{headerName: "Date By Laporan", field: "pengembangan_pelatihan_detail.laporan_date", width: 190, filterParams: {newRowsAction: 'keep'}},
            
				{headerName: "Dokumen",field: "pengembangan_pelatihan_detail.file", 
				  cellRenderer: function(params) {
					  return '<a href="api/upload/data/latbang/'+params.value+'" target="_blank"><i class="fa fa-eye"></i> Usulan</a>'
				  }
				},
				{headerName: "Dokumen",field: "pengembangan_pelatihan_detail.file_izn", 
				  cellRenderer: function(params) {
					  return '<a href="api/upload/data/latbang/'+params.value+'" target="_blank"><i class="fa fa-eye"></i> Tugas/Izin</a>'
				  }
				},
				{headerName: "Dokumen",field: "pengembangan_pelatihan_detail.file_rak", 
				  cellRenderer: function(params) {
					  return '<a href="api/upload/data/latbang/'+params.value+'" target="_blank"><i class="fa fa-eye"></i> RAK</a>'
				  }
				},
				{headerName: "Dokumen",field: "pengembangan_pelatihan_detail.file_spd", 
				  cellRenderer: function(params) {
					  return '<a href="api/upload/data/latbang/'+params.value+'" target="_blank"><i class="fa fa-eye"></i> SPD</a>'
				  }
				},
				{headerName: "Dokumen",field: "pengembangan_pelatihan_detail.file_rkm", 
				  cellRenderer: function(params) {
					  return '<a href="api/upload/data/latbang/'+params.value+'" target="_blank"><i class="fa fa-eye"></i> Rekomendasi</a>'
				  }
				},
				{headerName: "Dokumen",field: "pengembangan_pelatihan_detail.file_lap", 
				  cellRenderer: function(params) {
					  return '<a href="api/upload/data/latbang/'+params.value+'" target="_blank"><i class="fa fa-eye"></i> Laporan Kegiatan</a>'
				  }
				},
    ];

    var gridOptionsList = {
        enableSorting: true,
        enableFilter: true,
        suppressRowClickSelection: false,
        // groupDefaultExpanded: 2,
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
            editable: false,
            enableRowGroup: true,
            enablePivot: true,
            enableValue: true
        },
        // onGridReady: function (params) {
        //     params.api.sizeColumnsToFit();
        // },
        onCellEditingStarted: function (event) {
            console.log('cellEditingStarted');
        },
        onCellEditingStopped: function (event) {
            console.log('cellEditingStopped');
        }
    };

    var myGrid = document.querySelector('#myGrid');
    new agGrid.Grid(myGrid, gridOptionsList);

    var dataTable = [];
    var isClickRowTable = true;
    $('.daterangepicker').daterangepicker({
           locale: {
             format: 'DD-MM-YYYY'
           }
    });
	
	$('.select-chosen').chosen();
    $('.chosen-container').css({"width": "100%"});
    $('.judul-menu').html('Pengajuan Pelatihan & Pengembangan');
    $('.buttoenedit').hide();

	function checkboxCellRenderer (params){
    var input = document.createElement("input");
	if(params.value ==='Melakukan Kegiatan'){
    input.type = "submit";
    input.value = "Melakukan Kegiatan";
    input.className = "btn-success btn-labeled";
    }else if(params.value ==='Menunggu Laporkan'){
    input.type = "submit";
    input.value = "Menunggu Laporkan";
    input.className = "btn-warning btn-labeled";
    }else if(params.value ==='Belum Melaporkan'){
    input.type = "submit";
    input.value = "Belum Melaporkan";
    input.className = "btn-danger btn-labeled";
    }else if(params.value ==='Pengajuang Baru'){
    input.type = "submit";
    input.value = "Pengajuang Baru";
    input.className = "btn-default btn-labeled";
    }else if(params.value ==='Sudah Melaporkan'){
    input.type = "submit";
    input.value = "Sudah Melaporkan";
    input.className = "btn-primary btn-labeled";
	}
	return input;
	}
	
    $("#jenis_biaya").on("change", function () {
        jenis_biaya = $(this).val();
        if (jenis_biaya == "BLU") {
            console.log(jenis_biaya);
            $("#jenis_surat").children().remove();
            $("#jenis_surat").append('<option value="Surat Tugas">Surat Tugas</option>');
            // reset value
            // $("#jenis_surat").prop('selectedIndex', 0);
            $("#jenis_surat").trigger("chosen:updated");
        }
        else if(jenis_biaya == "Sponsor"){
            $("#jenis_surat").children().remove();
            $("#jenis_surat").append('<option value="Surat Izin">Surat Izin</option>');
            // reset value
            $("#jenis_surat").prop('selectedIndex', 0);
            $("#jenis_surat").trigger("chosen:updated");
        }
        else if(jenis_biaya == "Sendiri"){
            $("#jenis_surat").children().remove();
            $("#jenis_surat").append('<option value="Surat Izin">Surat Izin</option>');
            // reset value
            $("#jenis_surat").prop('selectedIndex', 0);
            $("#jenis_surat").trigger("chosen:updated");
        } else if(jenis_biaya == ""){
            console.log(jenis_biaya);
            $("#jenis_surat").children().remove();
            $("#jenis_surat").append('<option value="">Pilih</option>');
            $("#jenis_surat").prop('selectedIndex', 0);
            $("#jenis_surat").trigger("chosen:updated");
        }
    });

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
			$('#surat_tugas_dalam_negeri_luarkota').prop('selectedIndex', 0);
            $("#surat_tugas_dalam_negeri_luarkota").trigger("chosen:updated");
			$(".dalam_negeri-luarkota").removeClass('hidden');
						
        }
        else{
            $(".jenis_perjalanan_dalam_negeri").addClass('hidden');
            $(".dalam_negeri").addClass('hidden');

            $(".jenis_perjalanan_luar_negeri").addClass('hidden');

            $("#dalam_negeri").prop('selectedIndex', 0);
            $("#dalam_negeri").trigger("chosen:updated");
        }
        // changeDalamNegeri();
    });

    $("#jenis").on("change", function () {
        jenis = $(this).val();
        if (jenis =='Kelompok') {
            $(".btn-pegawai-add").removeClass('hidden');
        } 
        // else if (jenis =='Individu'){
        //     $(".btn-pegawai-add").addClass('hidden');
        // } else {
        //     $(".btn-pegawai-add").removeClass('hidden');
        // }
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
                    $('#' + id).append('<option ' + (e.result[i].id == valueEdit ? 'selected' : '') + ' value="' + e.result[i].id + '" data-nik="' + e.result[i].nik + '" data-laporan="' + e.result[i].laporan_kegiatan + '" data-nip="' + e.result[i].nip + '" data-golongan="' + e.result[i].golongan + '"data-akomodasi="' + e.result[i].akomodasi +'"data-berkas="' + e.result[i].berkas + '" data-pangkat="' + e.result[i].pangkat +'" data-nama="' + e.result[i].nama + '" data-nama-group="' + e.result[i].nama_uk + '" >' + e.result[i].id + ' - ' + e.result[i].nama + '</option>');
                }
                $('#' + id).trigger("chosen:updated");
            }
        });
    }

    loadUser("nopeg", BASE_URL + "users/list_usernew");

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
        var count_body = $(".body-content tr").length;
        var row_id = count_body + 1;
        var row = 
                '<tr id="row_'+row_id+'">'+
                '<td>'+
                '<div class="form-group body-remove">' +
                   ' <label class="col-sm-2 control-label"></label>' +
                   '<div class="body-detail">' +
                        '<div class="col-xs-2">' +
                            '<input type="text" name="biaya_uraian[]" class="form-control biaya_uraian" id="biaya_uraian_'+row_id+'" placeholder="Uraian"/>' +
                        '</div>' +
                        '<div class="col-xs-2">' +
                            '<input type="number" name="qty_nominal[]" class="form-control qty_nominal" id="qty_nominal_'+row_id+'" title="Jumlah Keterangan" min="1" value="1" required onkeyup="getTotal('+row_id+')"/>' +
                        '</div>' +
						'<div class="col-xs-2">' +
                            '<input type="text" name="uraian_nominal[]" class="form-control uraian_nominal" id="uraian_nominal'+row_id+'" placeholder="Ket uraian"/>' +
                        '</div>' +
                        '<div class="col-xs-3">' +
                            '<input type="text" name="biaya_nominal[]" class="form-control biaya_nominal" id="biaya_nominal_'+row_id+'" min="0" placeholder="0" required onkeyup="getTotal('+row_id+')"/>' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-xs-1 pull right">' +
                        '<div class="btn btn-default btn-sm btn-remove" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-trash-o"></i></div>' +
                    '</div>' +
                '</div>' +
                '<div class="form-group body-remove">' +
                   ' <label class="col-sm-2 control-label"></label>' +
                   '<div class="body-detail">' +
                        '<div class="col-xs-3">' +
                            '<input type="text" name="total_nominal[]" class="form-control total_nominal" id="total_nominal_'+row_id+'" min="0" placeholder="0" readonly/>' +
                        '</div> '+  
						'<div class="col-xs-2">' +
                            '<input type="number" name="orang[]" class="form-control orang" title="Jumlah Orang" id="orang_'+row_id+'" min="0" placeholder="0" required onkeyup="getTotal(\''+row_id+'\')"/>' +
                        '</div> '+
						'<div class="col-xs-4">' +
                            '<input type="text" name="total[]" class="form-control total" id="total_'+row_id+'" min="0" value="0" readonly/>' +
                        '</div> '+
						'<div class="col-xs-1">' +
                            '<input type="text" name="muncul[]" class="muncul" title="Rincian biaya yg Diterima" placeholder="Rincian biaya yg Diterima" id="muncul_'+row_id+'">' +
                        '</div> '+
                    '</div>' +
                '</div>'
                + '</td>'
                + '</tr>'
                ;
        $(".body-content tbody").append(row);
    });

    // $(document).on('click', '.btn-remove', function (event) {
    //     // console.log("remove" + $(this));
    //     $(this).parentsUntil(".body-remove").parent().remove();
    // });

    function removeRow(tr_id)
      {
        $(".body-content tbody tr#row_"+tr_id).remove();
      }
	
	function formatAngka(angka) {
	 if (typeof(angka) != 'string') angka = angka.toString();
	 var reg = new RegExp('([0-9]+)([0-9]{3})');
	 while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
	 return angka;
	}
	
    function getTotal(row = null) {
        if(row) {
		  $("#biaya_nominal_"+row).on('keypress', function(e) {
			 var c = e.keyCode || e.charCode;
			 switch (c) {
			  case 8: case 9: case 27: case 13: return;
			  case 65:
			   if (e.ctrlKey === true) return;
			 }
			 if (c < 48 || c > 57) e.preventDefault();
			})
			 var inp = $("#biaya_nominal_"+row).val().replace(/\./g, '');
			 // set nilai ke variabel bayar
			 bayar = new Number(inp);
			 $("#biaya_nominal_"+row).val(formatAngka(inp));
			 
			 var total = Number($("#qty_nominal_"+row).val()) * bayar;
			  // total = total.toFixed(2);
			 $("#total_nominal_"+row).val(formatAngka(total));
			 
			 var total_biaya = total * Number($("#orang_"+row).val());
			  // total = total.toFixed(2);
			 $("#total_"+row).val(formatAngka(total_biaya));
			
        } else {
          alert('no row !! please refresh the page');
        }
    }

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
            $("#nip").val($(this).find(':selected').attr("data-nip"));
            $("#laporan_kegiatan").val($(this).find(':selected').attr("data-laporan"));
            // $("#nip").val($(this).find(':selected').val());
            $("#pangkat").val($(this).find(':selected').attr("data-pangkat"));
            $("#golongan").val($(this).find(':selected').attr("data-golongan"));
            $("#akomodasi").val($(this).find(':selected').attr("data-akomodasi"));
            $("#berkas").val($(this).find(':selected').attr("data-bekas"));
        }
    });



    function addRowTable(idRow = "") {
        if ($("#nopeg").val().length == "") {
            onMessage("Silahkan pilih pegawai .");
            return;
        }
		var hasil;
		var message;
		var datas = {};
		datas.tanggal = $(".tanggal").serializeArray();
		datas.nopeg = $("#nopeg").val();
		console.log(datas);
		var URL = BASE_URL + "pengembangan_pelatihan/cek";;
		$.ajax({
			url: URL,
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

					var dataRow = {};
					//var itemUraian = {};
					//var biaya_uraian = $(".biaya_uraian").serializeArray();
					//var uraian_nominal = $(".uraian_nominal").serializeArray();
					// var biaya_nominal = $(".biaya_nominal").serializeArray();
					//var biaya_nominal = $(".total_nominal").serializeArray();
					//var biaya_pernominal = $(".biaya_nominal").serializeArray();
					//var qty_nominal = $(".qty_nominal").serializeArray();
					//var uraian_total = 0;
					//for (var i = 0; i < biaya_uraian.length; i++) {
					//    if (biaya_uraian[i].value.length > 0) {
					//        itemUraian = {};
					//        itemUraian.uraian = biaya_uraian[i].value;
					//        itemUraian.uraian_nominal = uraian_nominal[i].value;
					//        itemUraian.nominal = parseFloat(biaya_nominal[i].value);
					//        itemUraian.pernominal = parseFloat(biaya_pernominal[i].value);
					//        itemUraian.qty = parseFloat(qty_nominal[i].value);
					//        uraian_total += itemUraian.nominal;
					//        detail_uraian.push(itemUraian);
					//    }
					//    else{
					//        onMessage("Lengkapi detail uraian biaya .");
					//        return;
					 //   }
					//}

				   // dataRow.uraian_total = uraian_total;
					dataRow.nopeg = $("#nopeg").val();
					dataRow.nip = $("#nip").val();
					dataRow.nik = $("#nik").val();
					dataRow.laporan_kegiatan = 0;
					if ($('#laporan_kegiatan').is(":checked")){
						dataRow.laporan_kegiatan = 1;
					};
					dataRow.pangkat = $("#pangkat").val();
					dataRow.golongan = $("#golongan").val();
					dataRow.akomodasi = $("#akomodasi").val();
					dataRow.nama_pegawai = $("#nama_pegawai").val();
					dataRow.jabatan = $("#jabatan").val();
					//dataRow.detail_uraian = detail_uraian;
					if (idRow == ""){
						dataTable.push(dataRow);//disini masih ngak ada masalah, karena actionnya push, entah berapapun indexnya data di masukan di atas index terakhir
					}
					else{
						dataTable[idRow]/*seharusnya id row ini adalah index [x] nya kan?*/ = dataRow;//tapi di sini, ngak bisa main push kan, karena kita mau timpa data dengan index [x]
					}

					console.log("dataRow",dataRow);
					console.log("dataTable",dataTable);
					// return;

					gridPI.api.setRowData(dataTable);
					isClickRowTable = true;
					clearAddPegawai();
				} else {
					bootbox.dialog({
					message: message,
					animateIn: 'bounceIn',
					animateOut: 'bounceOut',
					backdrop: false,
					buttons: {
						success: {
							label: "Save",
							className: "btn-primary",
							callback: function () {
							
							var dataRow = {};
							//var itemUraian = {};
							//var biaya_uraian = $(".biaya_uraian").serializeArray();
							//var uraian_nominal = $(".uraian_nominal").serializeArray();
							// var biaya_nominal = $(".biaya_nominal").serializeArray();
							//var biaya_nominal = $(".total_nominal").serializeArray();
							//var biaya_pernominal = $(".biaya_nominal").serializeArray();
							//var qty_nominal = $(".qty_nominal").serializeArray();
							//var uraian_total = 0;
							//for (var i = 0; i < biaya_uraian.length; i++) {
							//    if (biaya_uraian[i].value.length > 0) {
							//        itemUraian = {};
							//        itemUraian.uraian = biaya_uraian[i].value;
							//        itemUraian.uraian_nominal = uraian_nominal[i].value;
							//        itemUraian.nominal = parseFloat(biaya_nominal[i].value);
							//        itemUraian.pernominal = parseFloat(biaya_pernominal[i].value);
							//        itemUraian.qty = parseFloat(qty_nominal[i].value);
							//        uraian_total += itemUraian.nominal;
							//        detail_uraian.push(itemUraian);
							//    }
							//    else{
							//        onMessage("Lengkapi detail uraian biaya .");
							//        return;
							 //   }
							//}

						   // dataRow.uraian_total = uraian_total;
							dataRow.nopeg = $("#nopeg").val();
							dataRow.nip = $("#nip").val();
							dataRow.nik = $("#nik").val();
							dataRow.laporan_kegiatan = 0;
							if ($('#laporan_kegiatan').is(":checked")){
								dataRow.laporan_kegiatan = 1;
							};
							dataRow.pangkat = $("#pangkat").val();
							dataRow.golongan = $("#golongan").val();
							dataRow.akomodasi = $("#akomodasi").val();
							dataRow.nama_pegawai = $("#nama_pegawai").val();
							dataRow.jabatan = $("#jabatan").val();
							//dataRow.detail_uraian = detail_uraian;
							if (idRow == ""){
								dataTable.push(dataRow);//disini masih ngak ada masalah, karena actionnya push, entah berapapun indexnya data di masukan di atas index terakhir
							}
							else{
								dataTable[idRow]/*seharusnya id row ini adalah index [x] nya kan?*/ = dataRow;//tapi di sini, ngak bisa main push kan, karena kita mau timpa data dengan index [x]
							}

							console.log("dataRow",dataRow);
							console.log("dataTable",dataTable);
							// return;

							gridPI.api.setRowData(dataTable);
							isClickRowTable = true;
							clearAddPegawai();
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
        //var detail_uraian = [];
        
    }

    function editRowTable() {
        var selectedRows = gridPI.api.getSelectedRows();//disini adalah mengambil data di row yg di select
        var selectedRow = selectedRows[0];
        var indexId = 0;
        selectedRows.forEach( function(selectedRow, index) {
            // if (index!==0) {
            //     selectedRowsString += ', ';
            // }
            // selectedRowsString += selectedRow.athlete;
            indexId = index;
        });
        console.log("Row Selected",selectedRow);
        // console.log("Row Selected",selectedRow);//sampai sini data ngak ada index nya
        if (isClickRowTable) {
            if (selectedRows == '') {
                onMessage('Silahkan Pilih Pegawai Terlebih dahulu!');
                return false;
            }
            else {
                var selectedRows = gridPI.api.getSelectedRows();
                var selectedRow = selectedRows[0];
                loadUser("nopeg", BASE_URL + "users/list_usernew", selectedRow.nopeg);

                $('#nama_pegawai').val(selectedRow.nama_pegawai);
                $('#jabatan').val(selectedRow.jabatan);
                $('#nip').val(selectedRow.nip);
                $('#nik').val(selectedRow.nik);
                $('#pangkat').val(selectedRow.pangkat);
                $('#golongan').val(selectedRow.golongan);
                $('#akomodasi').val(selectedRow.akomodasi);
                $('#berkas').val(selectedRow.berkas);
				
				if (selectedRow.laporan_kegiatan == "1"){
                   $('#laporan_kegiatan').prop("checked", true);
                }
                else{
                    $('#laporan_kegiatan').prop("checked", false);
                }
                
                isClickRowTable = false;
                btnActionEdit(indexId);
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
        if ($('#jenis').val()=='Kelompok') {
            $(".btn-pegawai-add").removeClass('hidden');
        } else if ($('#jenis').val()=='Individu'){
            $(".btn-pegawai-add").addClass('hidden');
        } else {
            $(".btn-pegawai-add").removeClass('hidden');
        }
        $(".btn-pegawai-remove").addClass('hidden');
        $(".btn-pegawai-edit").addClass('hidden');
        $(".btn-pegawai-cancel").addClass('hidden');
    }

    function updateRowTable() {
        var idRowDataTable = $(".btn-pegawai-edit").val();
        // dataTable = $.grep(dataTable, function(e){ 
        //      return e.nopeg != idRowDataTable; 
        // });
        // console.log('update dataTable', dataTable);
        btnActionAdd();
        addRowTable(idRowDataTable);
    }

    function removeRowTable(){
        var idRowDataTable = $(".btn-pegawai-remove").val();
        dataTable = $.grep(dataTable, function(e, i){ 
             return i != idRowDataTable; 
        });
        console.log('delete dataTable', dataTable);
        btnActionAdd();
        clearAddPegawai();
        gridPI.api.setRowData(dataTable);
    }

    function clearAddPegawai() {
        // $(".body-remove-calendar").remove();
        $("#nopeg").prop('selectedIndex', 0);
        $("#nopeg").trigger("chosen:updated");
        $("#nama_pegawai").val("");
        $("#jabatan").val("");
        $("#nip").val("");
        $("#nik").val("");
        $('#laporan_kegiatan').prop("checked", false);
        $("#pangkat").val("");
        $("#golongan").val("");
        $("#akomodasi").val("");
        $(".btn-pegawai-remove").val("");
        $(".btn-pegawai-edit").val("");
        isClickRowTable = true;
        btnActionAdd();
    }

    function form_reset() {
		$(".body-remove").remove();
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
		getOptions("phl", BASE_URL + "master/plh");
		$("#jenis_plh").prop('selectedIndex', 0);
        $("#jenis_plh").trigger("chosen:updated");
		$("#plh").prop('selectedIndex', 0);
        $("#plh").trigger("chosen:updated");
		$("#dalam_negeri").prop('selectedIndex', 0);
        $("#dalam_negeri").trigger("chosen:updated");
		$("#biaya_uraian_1").val("");
		$("#uraian_nominal_1").val("");
        $("#orang_1").val("");
        $("#total_1").val("");
        $("#muncul_1").val("");
        $("#biaya_nominal_1").val("");
        $("#total_nominal_1").val(0);
        $("#qty_nominal_1").val(1);
		$("#jenis_biaya").prop('selectedIndex', 0);
        $("#jenis_biaya").trigger('chosen:updated');
        $("#jenis_biaya").trigger('change');
        $("#jenis").prop('selectedIndex', 0);
        $("#jenis").trigger("chosen:updated");
		$("#surat_tugas_dalam_negeri_luarkota").prop('selectedIndex', 0);
        $("#surat_tugas_dalam_negeri_luarkota").trigger("chosen:updated");
		getOptions("surat_tugas_dalam_negeri_luarkota", BASE_URL + "master/alat_angkut");
		
	}

    // CRUD
    function simpan() {
        obj = {};
        obj.id = $("#id").val();
        obj.no_disposisi = $("#no_disposisi").val();
        obj.nama_pelatihan = $("#nama_pelatihan").val();
        obj.tujuan = $("#tujuan").val();
        obj.membaca = $("#membaca").val();
        obj.yth = $("#yth").val();
        obj.institusi = $("#institusi").val();
        obj.alamat = $("#alamat").val();
        obj.tanggal = $(".tanggal").serializeArray();
        obj.biaya_uraian = $(".biaya_uraian").serializeArray();
        obj.uraian_nominal = $(".uraian_nominal").serializeArray();
        obj.biaya_nominal = $(".biaya_nominal").serializeArray();
        obj.total_nominal = $(".total_nominal").serializeArray();
        obj.biaya_pernominal = $(".biaya_nominal").serializeArray();
        obj.orang = $(".orang").serializeArray();
        obj.total = $(".total").serializeArray();
        obj.muncul = $(".muncul").serializeArray();
        obj.qty_nominal = $(".qty_nominal").serializeArray();
		obj.tanggal_go = $(".tanggal_go").serializeArray();
        obj.tanggal_back = $(".tanggal_back").serializeArray();
        obj.jam_mulai = $("#jam_mulai").val();
        obj.jam_sampai = $("#jam_sampai").val();
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
        obj.jenis_surat = $("#jenis_surat").val();
        // obj.surat_tugas_dalam_negeri = $("#surat_tugas_dalam_negeri").val();
        // obj.surat_tugas_dalam_negeri_dalamkota = $("#surat_tugas_dalam_negeri_dalamkota").val();
        // obj.surat_tugas_dalam_negeri_luarkota = $("#surat_tugas_dalam_negeri_luarkota").val();
        // obj.surat_tugas_luar_negeri = $("#surat_tugas_luar_negeri").val();
        obj.phl = $("#phl").val();
        obj.jenis_plh = $("#jenis_plh").val();
		obj.hari_go = $("#hari_go").val();
        obj.hari_back = $("#hari_back").val();
        obj.target_kinerja = $("#target_kinerja").val();
        obj.surat_tugas_dalam_negeri_luarkota = $("#surat_tugas_dalam_negeri_luarkota").val();
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
        $('.nav-tabs a[href="#demo-lft-tab-1"]').tab('show');
    }
    // setup the grid after the page has finished loading
    

    function loaddata(jml = 0) {
        var search = 0;
        if ($('#search').val() !== '') {
            search = $('#search').val();
        }
		var dari = $('#tanggal_awal').val();
        var sampai = $('#tanggal_akhir').val();
		
		$.ajax({
            url: BASE_URL + 'pengembangan_pelatihan/list/' + jml + '/' +search + '/' + dari + '/' +sampai,
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
             pagingDatatable(data.total,data.limit,'loaddata');
                     
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
		form_reset();
		var selectedRows = gridOptionsList.api.getSelectedRows();
		if (selectedRows.length != 1) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
            var selectedRow = selectedRows[0];
            console.log(selectedRow);
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

                    $("#nama_pelatihan").val(res.data.nama_pelatihan);
                    $("#tujuan").val(res.data.tujuan);
                    $("#membaca").val(res.data.membaca);
                    $("#yth").val(res.data.yth);
                    $("#target_kinerja").val(res.data.target_kinerja);
                    $("#institusi").val(res.data.institusi);
                    $("#alamat").val(res.data.alamat);
                    $("#jam_mulai").val(res.data.jam_mulai);
                    $("#jam_sampai").val(res.data.jam_sampai);
					getOptionsEdit("phl", BASE_URL + "master/plh",res.data.phl);
					getOptionsEdit("surat_tugas_dalam_negeri_luarkota", BASE_URL + "master/alat_angkut",res.data.alat_angkut);
					getperjalanan(res.data.jenis_perjalanan);
                    $('#jenis').val(res.data.jenis);
					$("#jenis").trigger("chosen:updated");
                    $('#jenis_plh').val(res.data.jenis_plh);
                    $("#jenis_plh").trigger("chosen:updated");

					for (var id = 0; id < res.data.detail_uraian.length; id++) {
						if (id == 0) {
							$("#biaya_uraian_1").val(res.data.detail_uraian[id].uraian);
							$("#total_nominal_1").val(formatAngka(res.data.detail_uraian[id].nominal));
							$("#uraian_nominal_1").val(res.data.detail_uraian[id].uraian_nominal);
							$("#biaya_nominal_1").val(formatAngka(res.data.detail_uraian[id].pernominal));
							$("#qty_nominal_1").val(res.data.detail_uraian[id].qty);
							$("#orang_1").val(res.data.detail_uraian[id].orang);
							$("#total_1").val(formatAngka(res.data.detail_uraian[id].total));
							$("#muncul_1").val(res.data.detail_uraian[id].muncul);
							
						}
						else {
							var row_id = id + 1
							var row = 
									'<tr id="row_'+row_id+'">'+
									'<td>'+
									'<div class="form-group body-remove">' +
									   ' <label class="col-sm-2 control-label"></label>' +
									   '<div class="body-detail">' +
											'<div class="col-xs-2">' +
												'<input type="text" name="biaya_uraian[]" class="form-control biaya_uraian" id="biaya_uraian_'+row_id+'" placeholder="Uraian" value="' + res.data.detail_uraian[id].uraian + '" />' +
											'</div>' +
											'<div class="col-xs-2">' +
												'<input type="number" name="qty_nominal[]" class="form-control qty_nominal" id="qty_nominal_'+row_id+'" title="Jumlah Keterangan" min="1" value=' + res.data.detail_uraian[id].qty + ' required onkeyup="getTotal('+row_id+')"/>' +
											'</div>' +
											'<div class="col-xs-2">' +
												'<input type="text" name="uraian_nominal[]" class="form-control uraian_nominal" id="uraian_nominal_'+row_id+'" placeholder="Ket uraian" value="' + res.data.detail_uraian[id].uraian_nominal + '" />' +
											'</div>' +
											'<div class="col-xs-3">' +
												'<input type="number" name="biaya_nominal[]" class="form-control biaya_nominal" id="biaya_nominal_'+row_id+'" min="0" value=' + formatAngka(res.data.detail_uraian[id].pernominal) + ' required onkeyup="getTotal('+row_id+')"/>' +
											'</div>' +
										'</div>' +
										'<div class="col-xs-1 pull right">' +
											'<div class="btn btn-default btn-sm btn-remove" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-trash-o"></i></div>' +
										'</div>' +
									'</div>' +
									'<div class="form-group body-remove">' +
									   ' <label class="col-sm-2 control-label"></label>' +
									   '<div class="body-detail">' +
											'<div class="col-xs-3">' +
												'<input type="number" name="total_nominal[]" class="form-control total_nominal" id="total_nominal_'+row_id+'" min="0" value=' + formatAngka(res.data.detail_uraian[id].nominal) + ' readonly/>' +
											'</div> '+ 
											'<div class="col-xs-2">' +
												'<input type="number" name="orang[]" class="form-control orang" title="Jumlah Orang" id="orang_'+row_id+'" min="0" placeholder="0" value=' + res.data.detail_uraian[id].orang + ' required onkeyup="getTotal(\''+row_id+'\')"/>' +
											'</div> '+
											'<div class="col-xs-4">' +
												'<input type="number" name="total[]" class="form-control total" id="total_'+row_id+'" min="0" value=' + formatAngka(res.data.detail_uraian[id].total) + ' readonly/>' +
											'</div> '+
											'<div class="col-xs-1">' +
												'<input type="text" name="muncul[]" class="muncul[]" title="Rincian biaya yg Diterima" placeholder="Rincian biaya yg Diterima" id="muncul_'+row_id+'" value=' + res.data.detail_uraian[id].muncul + '>' +
											'</div> '+
										'</div>' +
									'</div>'
									+ '</td>'
									+ '</tr>'
									;
							$(".body-content tbody").append(row);
						}
					};
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
						$('#hari_go').val(res.data.tanggal[i].hari_go);
						$('#hari_back').val(res.data.tanggal[i].hari_back);
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
                        }if (i == 0){
                            $("#tanggal_go").val(res.data.tanggal[i].tanggal_go +" - "+ res.data.tanggal[i].tanggal_go1);
                        }
                        else{
                            var row = $(
                                '<div class="form-group body-remove-calendar">' +
                                '<label class="col-sm-3 control-label" for="demo-hor-inputemail"></label>' +
                                '<div class="col-sm-5">' +
                                '<input type="text" name="tanggal_go[]" class="form-control tanggal_go daterangepicker" value="'+ res.data.tanggal[i].tanggal_go +" - "+ res.data.tanggal[i].tanggal_go1 +'" />' +
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
                        }if (i == 0){
                            $("#tanggal_back").val(res.data.tanggal[i].tanggal_back +" - "+ res.data.tanggal[i].tanggal_back);
                        }
                        else{
                            var row = $(
                                '<div class="form-group body-remove-calendar">' +
                                '<label class="col-sm-3 control-label" for="demo-hor-inputemail"></label>' +
                                '<div class="col-sm-5">' +
                                '<input type="text" name="tanggal_back[]" class="form-control tanggal_back daterangepicker" value="'+ res.data.tanggal[i].tanggal_back +" - "+ res.data.tanggal[i].tanggal_back1 +'" />' +
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
						if (res.data.dalam_negeri == "Luar Kota") {
						$(".dalam_negeri").removeClass('hidden');
						$('#surat_tugas_dalam_negeri_luarkota').val(res.data.alat_angkut);
                        $("#surat_tugas_dalam_negeri_luarkota").trigger("chosen:updated");
						$(".dalam_negeri-luarkota").removeClass('hidden');
						$(".jenis_perjalanan_dalam_negeri").removeClass('hidden');
						}else if (res.data.dalam_negeri == "Dalam Kota") {
						$(".jenis_perjalanan_dalam_negeri").removeClass('hidden');
						}
                        } 
                    else {
                        $(".jenis_perjalanan_dalam_negeri").addClass('hidden');
                        $(".dalam_negeri").addClass('hidden');
                        // show
                        $(".jenis_perjalanan_luar_negeri").removeClass('hidden');
                        // reset value
						$('#surat_tugas_dalam_negeri_luarkota').val(res.data.alat_angkut);
                        $("#surat_tugas_dalam_negeri_luarkota").trigger("chosen:updated");
						$(".dalam_negeri-luarkota").removeClass('hidden');
						
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

                    if (res.data.jenis_biaya == "BLU") {
                        $("#jenis_surat").children().remove();
                        $("#jenis_surat").append('<option value="Surat Tugas">Surat Tugas</option>');
						// reset value
                        // $("#jenis_surat").prop('selectedIndex', 0);
                        $('#jenis_surat').val(res.data.jenis_surat);
                        $("#jenis_surat").trigger("chosen:updated");
                    }
                    else if(res.data.jenis_biaya == "Sponsor"){
                        $("#jenis_surat").children().remove();
                        $("#jenis_surat").append('<option value="Surat Izin">Surat Izin</option>');
                        // reset value
                        $('#jenis_surat').val(res.data.jenis_surat);
                        $("#jenis_surat").trigger("chosen:updated");
                    }
                    else if(res.data.jenis_biaya == "Sendiri"){
                        $("#jenis_surat").children().remove();
                        $("#jenis_surat").append('<option value="Surat Izin">Surat Izin</option>');
                        // reset value
                        $('#jenis_surat').val(res.data.jenis_surat);
                        $("#jenis_surat").trigger("chosen:updated");
                    } else if(res.data.jenis_biaya == ""){
                        $("#jenis_surat").children().remove();
                        $("#jenis_surat").append('<option value="">Pilih</option>');
                        $('#jenis_surat').val(res.data.jenis_surat);
                        $("#jenis_surat").trigger("chosen:updated");
                    }

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
        btnActionAdd();
    }

	function getperjalanan(a){
		if((a==='Luar Negeri')){
			$('.luar').show('slow');
		}else{
			$('.luar').hide('slow');
		}
	}
	
    function del() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
            submit_get(BASE_URL + 'pengembangan_pelatihan/del/?id=' + selectedRowsSelesai[0].kode, loaddata);
        }
    }
	function laporan_selesai() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
            submit_get(BASE_URL + 'pengembangan_pelatihan/laporan_selesai/?id=' + selectedRowsSelesai[0].kode+'&laporan=' + selectedRowsSelesai[0].laporan_kegiatan, loaddata);
        }
    }
    function cetak() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
			if (selectedRowsSelesai[0].jenis_perjalanan!='Dalam Negeri') {
			gopop(BASE_URL + 'pengembangan_pelatihan/preview/?id=' + selectedRowsSelesai[0].id + '&kode=' + selectedRowsSelesai[0].kode,pdf,'large');
			}else{
			gopop(BASE_URL + 'pengembangan_pelatihan/preview/?id=' + selectedRowsSelesai[0].id,pdf,'large');
			}
		}
    }

    function pdf() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
	   if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } else {
			if (selectedRowsSelesai[0].jenis_perjalanan!='Dalam Negeri') {
            window.open(BASE_URL + 'pengembangan_pelatihan/cetak/?id=' + selectedRowsSelesai[0].id+ '&surat='+ selectedRowsSelesai[0].jenis_surat+ '&kode=' + selectedRowsSelesai[0].kode);
            }else{
			window.open(BASE_URL + 'pengembangan_pelatihan/cetak/?id=' + selectedRowsSelesai[0].id+ '&surat='+ selectedRowsSelesai[0].jenis_surat);
			}
		}
	}

    function verbal(){
     var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        }else{ 
		gopop(BASE_URL + 'pengembangan_pelatihan/preview/?id=' + selectedRowsSelesai[0].id + '&surat=Surat_verbal&kode=' + selectedRowsSelesai[0].kode,pdf_verbal,'large');
		}
    } 
	function pdf_verbal(){
     var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
            window.open(BASE_URL + 'pengembangan_pelatihan/cetak/?id=' + selectedRowsSelesai[0].id + '&surat=Surat_verbal&kode=' + selectedRowsSelesai[0].kode);
        }
    }
	function cetak_rekomendasi(){
     var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
			if (selectedRowsSelesai[0].jenis_perjalanan!='Luar Negeri') {
			if (selectedRowsSelesai[0].jenis_biaya!='Sponsor') {
            onMessage('Tidak mencetak Rekomendasi, hanya untuk pegawai yang dibiayai Sponsor');
            return false;
			}else{
            gopop(BASE_URL + 'pengembangan_pelatihan/preview_rekomendasi/?id=' + selectedRowsSelesai[0].id + '&kode=' + selectedRowsSelesai[0].kode,pdf_rekomendasi,'large');
			}
			}else{
			gopop(BASE_URL + 'pengembangan_pelatihan/preview_rekomendasi/?id=' + selectedRowsSelesai[0].id + '&kode=' + selectedRowsSelesai[0].kode,pdf_rekomendasi,'large');
			}
        }
    } 
	
	function pdf_rekomendasi(){
     var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
            window.open(BASE_URL + 'pengembangan_pelatihan/cetak_rekomendasi/?id=' + selectedRowsSelesai[0].id + '&kode=' + selectedRowsSelesai[0].kode);
        }
    }
	
	function cetak_spd(){
     var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
			if (selectedRowsSelesai[0].jenis_perjalanan!='Luar Negeri') {
			if (selectedRowsSelesai[0].jenis_biaya!='BLU') {
            onMessage('Tidak mencetak SPD, hanya untuk pegawai yang dibiayai BLU');
            return false;
			}else {
				if (selectedRowsSelesai[0].dalam_negeri!='Luar Kota') {
				onMessage('Tidak mencetak SPD, hanya untuk pegawai yang dibiayai BLU dan Luar Kota');
				return false;
				}else{
				 gopop(BASE_URL + 'pengembangan_pelatihan/preview_spd/?id=' + selectedRowsSelesai[0].id + '&kode=' + selectedRowsSelesai[0].kode,pdf_spd,'large');
				}
			}
			}else{
				gopop(BASE_URL + 'pengembangan_pelatihan/preview_spd/?id=' + selectedRowsSelesai[0].id + '&kode=' + selectedRowsSelesai[0].kode,pdf_spd,'large');
			}
			}
        }
	
	function pdf_spd() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
	   if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } else {
         window.open(BASE_URL + 'pengembangan_pelatihan/cetak_spd/?id=' + selectedRowsSelesai[0].id + '&kode=' + selectedRowsSelesai[0].kode);
		}
	}
	
	function cetak_pengantar(){
     var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
			if (selectedRowsSelesai[0].jenis_perjalanan!='Luar Negeri') {
            onMessage('Tidak mencetak pengantar, hanya untuk pegawai yang perjalanan luar negeri');
            return false;
			}else{
			gopop(BASE_URL + 'pengembangan_pelatihan/preview/?id=' + selectedRowsSelesai[0].id + '&surat=Surat_pengantar&kode=' + selectedRowsSelesai[0].kode,pdf_cetak_pengantar,'large');
        }
		}
    }
	
	function pdf_cetak_pengantar() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
	   if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } else {
         window.open(BASE_URL + 'pengembangan_pelatihan/cetak/?id=' + selectedRowsSelesai[0].id + '&surat=Surat_pengantar&kode=' + selectedRowsSelesai[0].kode);
		}
	}
	
	function nota(){
     var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
			if (selectedRowsSelesai[0].jenis_perjalanan!='Luar Negeri') {
            onMessage('Tidak mencetak nota, hanya untuk pegawai yang perjalanan luar negeri');
            return false;
			}else{
			gopop(BASE_URL + 'pengembangan_pelatihan/preview/?id=' + selectedRowsSelesai[0].id + '&surat=nota&kode=' + selectedRowsSelesai[0].kode,pdf_cetak_nota,'large');
        }
		}
    }
	
	function pdf_cetak_nota() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
	   if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } else {
         window.open(BASE_URL + 'pengembangan_pelatihan/cetak/?id=' + selectedRowsSelesai[0].id + '&surat=nota&kode=' + selectedRowsSelesai[0].kode);
		}
	}
	
	function ikatan(){
     var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
			if (selectedRowsSelesai[0].jenis_perjalanan!='Luar Negeri') {
            onMessage('Tidak mencetak ikatan, hanya untuk pegawai yang perjalanan luar negeri');
            return false;
			}else{
			gopop(BASE_URL + 'pengembangan_pelatihan/preview/?id=' + selectedRowsSelesai[0].id + '&surat=ikatan&kode=' + selectedRowsSelesai[0].kode,pdf_cetak_ikatan,'large');
        }
		}
    }
	
	function pdf_cetak_ikatan() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
	   if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } else {
         window.open(BASE_URL + 'pengembangan_pelatihan/cetak/?id=' + selectedRowsSelesai[0].id + '&surat=ikatan&kode=' + selectedRowsSelesai[0].kode);
		}
	}
	
	function cetak_rak(){
     var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
			if (selectedRowsSelesai[0].jenis_biaya!='BLU') {
            onMessage('Tidak mencetak RAK, hanya untuk pegawai yang dibiayai BLU');
            return false;
			}else{
             gopop(BASE_URL + 'pengembangan_pelatihan/preview/?id=' + selectedRowsSelesai[0].id + '&surat=RAK',pdf_rak,'large');
			}
        }
    }
	
	function pdf_rak() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
	   if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } else {
            window.open(BASE_URL + 'pengembangan_pelatihan/cetak/?id=' + selectedRowsSelesai[0].id + '&surat=RAK');
        }
	}
	
	function cetak_dft_rak(){
     var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
			if (selectedRowsSelesai[0].jenis_biaya!='BLU') {
            onMessage('Tidak mencetak Daftar RAK, hanya untuk pegawai yang dibiayai BLU');
            return false;
			}else{
				if (selectedRowsSelesai[0].jenis=='Individu') {
				onMessage('Tidak mencetak Daftar RAK, hanya untuk kelompok');
				return false;
				}else{
				gopop(BASE_URL + 'pengembangan_pelatihan/preview/?id=' + selectedRowsSelesai[0].id + '&surat=dft',pdf_dft,'large');
				}
			}
        }
    }
	
	function pdf_dft() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
	   if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } else {
         window.open(BASE_URL + 'pengembangan_pelatihan/cetak/?id=' + selectedRowsSelesai[0].id + '&surat=dft');
		}
	}

    function uploadFile() {
        var selectedRowsSelesai = gridOptionsList.api.getSelectedRows();
        $('#id_upload').val(selectedRowsSelesai[0].kode);
        if (selectedRowsSelesai.length <= 0) {
            onMessage('Silahkan Pilih Data Terlebih dahulu!');
            return false;
        } 
        else {
            bootbox.dialog({
            message: $('<div></div>').load('view/pengembangan_pelatihan_upload.php'),
            animateIn: 'bounceIn',
            animateOut: 'bounceOut',
            backdrop: false,
            size: 'medium',
            buttons: {
                success: {
                    label: "Save", className: "btn-success", callback: function () {
                        // simpanKeluarga('save'); ini bisa di hapus
                        $('#form-latbang-upload').submit(); //ini untuk submit form-keluarga
                        return false;
                    }
                }, main: {
                    label: "Close", className: "btn-warning", callback: function () {
                        $.niftyNoty({type: 'dark', message: "Bye Bye", container: 'floating', timer: 5000});
                    }
                }
            }
        });
            
            // submit_get(BASE_URL + 'pengembangan_pelatihan/laporan_selesai/?id=' + selectedRowsSelesai[0].id, loaddata);
        }
    
}
		$(document).ready(function () {
		$('.tanggal').datepicker({
            format: "dd-mm-yyyy",
        }).on('change', function(){
			$('.datepicker').hide();
		  });
		});
		$(document).ready(function () {
		$('.tanggal_cek').datepicker({
            format: "dd-mm-yyyy",
        }).on('change', function(){
			$('.datepicker').hide();
		  });
		});
</script>