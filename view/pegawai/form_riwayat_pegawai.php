<form class="form-horizontal" role="form" id="form-upload" name="form-upload" method="post"
      enctype="multipart/form-data">
	  
    <div class="panel panel-primary" style="border-bottom:none !important"><!--Panel heading-->
        <div class="panel-heading">
            <div class="panel-control">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#demo-tabs-box-1a" aria-expanded="true">Login Data</a>
                    </li>
                    <li class=""><a data-toggle="tab" href="#demo-tabs-box-1" aria-expanded="true">Master</a></li>
                    <li class=""><a data-toggle="tab" href="#demo-tabs-box-2" aria-expanded="false">Alamat</a></li>
                    <li class=""><a data-toggle="tab" href="#demo-tabs-box-3" aria-expanded="true">Kedinasan</a></li>
                    <li class=""><a data-toggle="tab" href="#demo-tabs-box-4" aria-expanded="false">Photo</a></li>
                    <li class="" onClick="$('#uploadfile').load('view/pegawai/form_file.php?id=1')">
                		<a data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">
            	    		Proses Rekrutmen
                		</a>
            		</li>
                    <li class="">
                        <div class="btn-group open">
                            <button class="dropdown-toggle btn" data-toggle="dropdown" aria-expanded="true"><i
                                        class="demo-pli-gear icon-lg"></i> Upload lainnya
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right bg-primary">
                                <li class="divider"></li>
                                <li onClick="$('#uploadfile').load('view/pegawai/form_kontrak.php')"><a
                                            data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">Kontrak</a>
                                </li>
                                <li onClick="$('#uploadfile').load('view/pegawai/form_file.php?id=3')"><a
                                            data-toggle="tab" href="#demo-tabs-box-5"
                                            aria-expanded="false">Penugasan</a></li>
                                <li onClick="$('#uploadfile').load('view/pegawai/form_file.php?id=4')"><a
                                            data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">SKP</a></li>
                                <li onClick="$('#uploadfile').load('view/pegawai/form_file.php?id=5')"><a
                                            data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">Data
                                        Medical</a></li>
                                <li onClick="$('#uploadfile').load('view/pegawai/form_file.php?id=6')"><a
                                            data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">SK</a></li>
                                <li onClick="$('#uploadfile').load('view/pegawai/form_penghargaan.php?id=7')"><a
                                            data-toggle="tab" href="#demo-tabs-box-5"
                                            aria-expanded="false">Penghargaan</a></li>
                                <li onClick="$('#uploadfile').load('view/pegawai/form_punishment.php?id=8')"><a
                                            data-toggle="tab" href="#demo-tabs-box-5"
                                            aria-expanded="false">Punishment</a></li>
                                <li onClick="$('#uploadfile').load('view/pegawai/form_str.php')"><a
                                            data-toggle="tab" href="#demo-tabs-box-5"
                                            aria-expanded="false">STR</a></li>
                                <li onClick="$('#uploadfile').load('view/pegawai/form_sip.php')"><a
                                            data-toggle="tab" href="#demo-tabs-box-5"
                                            aria-expanded="false">SIP</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!--Panel body-->
        <div class="panel-body"><!--Tabs content-->
            <div class="tab-content">
                <div id="demo-tabs-box-1a" class="tab-pane fade active in">
                    <div class="panel-body pad-all">
                        <div class="form-group"><label class="col-sm-3 control-label" for="demo-hor-inputemail">Username<span
                                        class="text-xs text-danger">*</span></label>
                            <div class="col-sm-5"><input type="text" name="f_id_edit" id="f_id_edit"
                                                         style="width: 220px;display:none" class="form-control"/><input
                                        type="text" name="f_id_user" id="f_id_user" style="width: 220px;display:none"
                                        class="form-control"/><input type="text" name="f_user_edit" id="f_user_edit"
                                                                     style="width: 220px;display:none"
                                                                     class="form-control"/><input type="text"
                                                                                                  name="f_user_username"
                                                                                                  id="f_user_username"
                                                                                                  style="width: 220px"
                                                                                                  class="form-control"/><span
                                        class="text-xs text-danger">*Tanpa spasi</span></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label"
                                                       for="demo-hor-inputemail">E-Mail<span
                                        class="text-xs text-danger">*</span></label>
                            <div class="col-sm-5"><input type="text" name="f_user_email" id="f_user_email"
                                                         style="width: 220px" class="form-control"/></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Password<span
                                        class="text-xs text-danger">*</span></label>
                            <div class="col-sm-5"><input type="password" name="f_user_password" id="f_user_password"
                                                         style="width: 220px" class="form-control"/><span
                                        class="text-xs text-danger">*Minimum 6 character</span></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label"
                                                       for="demo-hor-inputemail">Aktif</label>
                            <div class="col-sm-5"><select name="f_user_status_aktif" id="f_user_status_aktif"
                                                          style="width: 150px" class="form-control"/></div>
                        </div>
                    </div>
                </div>
                <div id="demo-tabs-box-1" class="tab-pane">
                    <div class="panel-body pad-all"><!-- START FORM 1 -->
                        <section class="content">
                            <div class="row"><!-- left column -->
                                <div class="col-md-6"><!-- general form elements -->
                                    <div class="box box-primary">
                                        <div class="box-header with-border"><h3 class="panel-title">Biodata</h3></div>
                                        <!-- /.box-header --><!-- form start -->
                                        <div class="box-body">
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="demo-hor-inputemail">Nama Lengkap</label>
                                                <div class="col-sm-8"><input type="text" name="f_user_name"
                                                                             id="f_user_name" style="width: 220px"
                                                                             class="form-control"/>
                                                                           <span
                                        class="text-xs text-danger">*Wajib diisi</span></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label" for="txtnip">NIP</label>
                                                <div class="col-sm-8"><input class="form-control" id="txtnip"
                                                                             name="txtnip" placeholder="" type="text"
                                                                             value="">
                                                                           <span
                                        class="text-xs text-danger">*Wajib diisi</span></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label" for="txtnik">NIK</label>
                                                <div class="col-sm-8"><input class="form-control" id="txtnik"
                                                                             name="txtnik" placeholder="" type="text"
                                                                             value="">
                                                                           <span
                                        class="text-xs text-danger">*Wajib diisi</span></div>
                                            </div>
											 <div class="form-group"><label class="col-sm-4 control-label" for="txtnopeg">No Pegawai</label>
                                                <div class="col-sm-8"><input class="form-control" id="txtnopeg"
                                                                             name="txtnopeg" placeholder="" type="text"
                                                                             value=""></div>
                                            </div>
											 <div class="form-group"><label class="col-sm-4 control-label" for="txtkarpeg">Kartu Pegawai</label>
                                                <div class="col-sm-8"><input class="form-control" id="txtkarpeg"
                                                                             name="txtkarpeg" placeholder="" type="text"
                                                                             value=""></div>
                                            </div>
											<div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="txtstp">Status Perkawinan</label>
                                                <div class="col-sm-8"><select aria-hidden="true"
                                                                              name="txtstp" id="txtstp"
                                                                              style="width: 100%;"
                                                                              tabindex="-1" class="form-control">
                                                                               <option value="">Please Select</option>
																			   <option value="belum menikah">Belum Menikah</option>
																			   <option value="menikah">Menikah</option>
																			   <option value="janda/duda">Janda/Duda</option>
																			   </select></div>
                                            </div>
											 <div class="form-group">
												<label class="col-sm-4 control-label" for="inputstatus">Tanggal Nikah</label>
												<div class="col-sm-8">
													<input type="date" class="form-control" id="txttglnikah" name="txttglnikah" placeholder="">
												</div>
											</div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="txtgelardepan">Gelar Depan</label>
                                                <div class="col-sm-8"><input class="form-control" id="txtgelardepan"
                                                                             name="txtgelardepan" placeholder=""
                                                                             type="text" value=""></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="txtgelarbelakang">Gelar Belakang</label>
                                                <div class="col-sm-8"><input class="form-control" id="txtgelarbelakang"
                                                                             name="txtgelarbelakang" placeholder=""
                                                                             type="text" value=""></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="txttlahir">Tempat Lahir</label>
                                                <div class="col-sm-8"><input class="form-control" id="txttlahir"
                                                                             name="txttlahir" placeholder="" type="text"
                                                                             value=""></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputkel">Tanggal Lahir</label>
                                                <div class="col-sm-8"><input class="form-control tgl" id="txttgllahir"
                                                                             name="txttgllahir"
                                                                             placeholder="Tanggal-Bulan-Tahun"
                                                                             type="date" value=""></div>
                                            </div>
                                        </div>
                                    </div><!-- /.box --><!-- Form Element sizes --><!-- /.box --><!-- Input addon -->
                                </div><!--/.col (left) --><!-- right column -->
                                <div class="col-md-6"><!-- Horizontal Form --><!-- general form elements disabled -->
                                    <div class="box box-warning"><h3 class="panel-title">&nbsp;</h3>
                                        <div class="box-body">
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputjnskela">Jenis Kelamin</label>
                                                <div class="col-sm-8"><select class="select-chosen" name="txtkelamin"
                                                                              id="txtkelamin" style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputjnskela">Agama</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              name="txtagama" id="txtagama"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="txtpendidikan">Pend.Terakhir</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              name="txtpendidikan" id="txtpendidikan"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div><!-- End Hori sontal -->
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputphone">Nama Bank</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              name="id_bank" id="id_bank"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputphone">No.Rekening</label>
                                                <div class="col-sm-8"><input class="form-control" id="no_rek"
                                                                             name="no_rek" placeholder="" type="text"
                                                                             value=""></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputphone">NPWP </label>
                                                <div class="col-sm-8"><input class="form-control" id="npwp" name="npwp"
                                                                             placeholder="" type="text" value=""></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputphone">BPJS Kesehatan</label>
                                                <div class="col-sm-8"><input class="form-control" id="bpjs_kes"
                                                                             name="bpjs_kes" placeholder="" type="text"
                                                                             value=""></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputphone">BPJS Ketenaga
                                                    Kerjaan</label>
                                                <div class="col-sm-8"><input class="form-control" id="bpjs_tk"
                                                                             name="bpjs_tk" placeholder="" type="text"
                                                                             value=""></div>
                                            </div>
                                            <h3 class="panel-title">Kontak</h3>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputphone">Phone</label>
                                                <div class="col-sm-8"><input class="form-control" id="txtphone"
                                                                             name="inputphone" placeholder=""
                                                                             type="text" value=""></div>
                                            </div>
                                        </div><!-- /.box-body --></div><!-- /.box --></div><!--/.col (right) --></div>
                            <!-- /.row --></section><!-- END FORM 1 --></div>
                </div>
                <div id="demo-tabs-box-2" class="tab-pane fade">
                    <div class="panel-body pad-all"><!-- START FORM 2 -->
                        <section class="content">
                            <div class="row"><!-- left column -->
                                <div class="col-md-6"><!-- general form elements -->
                                    <div class="box box-primary">
                                        <div class="box-header with-border"><h3 class="panel-title">Alamat Tinggal</h3>
                                        </div><!-- /.box-header --><!-- form start -->
                                        <div class="box-body">
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputalamat">Alamat</label>
                                                <div class="col-sm-8"><textarea class="form-control" id="txtAlamat"
                                                                                name="txtAlamat" placeholder="" rows="3"
                                                                                onkeyup="copyAlamat()"></textarea></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputalamat">&nbsp;</label>
                                                <div class="col-sm-3"><label class="col-sm-4 control-label"
                                                                             for="inputrt">RT</label><input
                                                            class="form-control" id="inputrt" name="inputrt"
                                                            placeholder="" type="text" value="" onkeyup="copyRT()">
                                                </div>
                                                <div class="col-sm-3"><label class="col-sm-4 control-label"
                                                                             for="inputrw">RW</label><input
                                                            class="form-control" id="inputrw" name="inputrw"
                                                            placeholder="" type="text" value="" onkeyup="copyRW()">
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputpropinsi">Propinsi</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtprov" name="txtprov"
                                                                              onchange="getKota(this.value,'txtkota')"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputkab">Kabupaten</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtkota" name="txtkota"
                                                                              onchange="getKecamatan(this.value,'txtkecamatan')"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label" for="kec">Kecamatan</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtkecamatan" name="txtkecamatan"
                                                                              onchange="getKelurahan(this.value,'txtkelurahan')"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputkel">Kelurahan</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtkelurahan" name="txtkelurahan"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
											<div class="form-group">
											<label class="col-sm-4 control-label" for="inputrt">Kode Pos</label> 
											<div class="col-sm-8">
												<input class="form-control" id="inputkpos" name="inputkpos" placeholder="" type="text" value="" onkeyup="copykpos()">
											</div>
											</div><!-- End Hori sontal --></div>
                                    </div><!-- /.box --><!-- Form Element sizes --><!-- /.box --><!-- Input addon -->
                                    <div class="box box-info"><!-- /.box-body --></div><!-- /.box --></div>
                                <!--/.col (left) --><!-- right column -->
                                <div class="col-md-6"><!-- Horizontal Form -->
                                    <div class="box box-info">
                                        <div class="box-header with-border"><h3 class="panel-title">Alamat Sesuai
                                                KTP</h3></div><!-- /.box-header --><!-- form start -->
                                        <div class="box-body">
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputalamat1">Alamat</label>
                                                <div class="col-sm-8"><textarea class="form-control" id="txtAlamatKtp"
                                                                                name="txtAlamatKtp" placeholder=""
                                                                                rows="3"></textarea></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputalamat">&nbsp;</label>
                                                <div class="col-sm-3"><label class="col-sm-4 control-label"
                                                                             for="inputrt">RT</label><input
                                                            class="form-control" id="inputrtktp" name="inputrtktp"
                                                            placeholder="" type="text" value=""></div>
                                                <div class="col-sm-3"><label class="col-sm-4 control-label"
                                                                             for="inputrw">RW</label><input
                                                            class="form-control" id="inputrwktp" name="inputrwktp"
                                                            placeholder="" type="text" value=""></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputpropinsi">Propinsi</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtprovktp" name="txtprovktp"
                                                                              onchange="getKota(this.value,'txtkotaktp')"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputkab">Kabupaten</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtkotaktp" name="txtkotaktp"
                                                                              onchange="getKecamatan(this.value,'txtkecamatanktp')"
                                                                              style="width: 100%;" tabindex="-1">
                                                        <option selected="selected"></option>
                                                    </select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label" for="kec">Kecamatan</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtkecamatanktp"
                                                                              name="txtkecamatanktp"
                                                                              onchange="getKelurahan(this.value,'txtkelurahanktp')"
                                                                              style="width: 100%;" tabindex="-1">
                                                        <option selected="selected"></option>
                                                    </select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputkel">Kelurahan</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtkelurahanktp"
                                                                              name="txtkelurahanktp"
                                                                              style="width: 100%;" tabindex="-1">
                                                        <option selected="selected"></option>
                                                    </select></div>
                                            </div><!-- End Hori sontal -->
											<div class="form-group">
											<label class="col-sm-4 control-label" for="inputrt">Kode Pos</label> 
											<div class="col-sm-8">
												<input class="form-control" id="inputkposktp" name="inputkposktp" placeholder="" type="text" value="">
											</div>
										</div></div><!-- /.box-header --><!-- /.box-body -->
                                    </div><!-- /.box --></div><!--/.col (right) --></div><!-- /.row --></section>
                        <!-- end FORM 2 --></div>
                </div>
                <div id="demo-tabs-box-3" class="tab-pane fade">
                    <div class="panel-body pad-all"><!-- START FORM 3 -->
                        <section class="content">
                            <div class="row"><!-- left column -->
                                <div class="col-md-6"><!-- general form elements -->
                                    <div class="box box-primary"><!-- /.box-header --><!-- form start -->
                                        <div class="box-body">
                                            <div class="form-group"><label class="col-sm-4 control-label">Jenis
                                                    Shift</label>
                                                <div class="col-sm-8"><select class="select-chosen" id="id_shift"
                                                                              name="id_shift"
                                                                              style="width: 100%;"></select></div>
                                            </div>
                                            <div class="form-group"><label
                                                        class="col-sm-4 control-label">Status Pegawai Tetap</label>
                                                <div class="col-sm-8"><select class="select-chosen" id="inputstatustetap"
                                                                              name="inputstatustetap" style="width: 100%;">
                                                                              </select>
                                                                              <span
                                        class="text-xs text-danger">*Wajib diisi</span>
                                                </div>
                                            </div>
                                            <div class="form-group"><label
                                                        class="col-sm-4 control-label">Status Pegawai PNS</label>
                                                <div class="col-sm-8"><select class="select-chosen" id="txtinputstatus"
                                                                              name="inputstatus" style="width: 100%;"
                                                                              onChange="getjabatanasn(this.value);">
                                                                              </select>
                                                                              <span
                                        class="text-xs text-danger">*Wajib diisi</span>
                                                </div>
                                            </div>
                                            <div class="datasn">
                                                <div class="form-group"><label class="col-sm-4 control-label"
                                                                               for="inputkab">Jabatan ASN</label>
                                                    <div class="col-sm-8"><select aria-hidden="true"
                                                                                  class="form-control select-chosen"
                                                                                  id="txtjabfung" name="txtjabfung"
                                                                                  style="width: 100%;"
                                                                                  tabindex="-1"></select></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label"
                                                                               for="inputkab">Keahlian ASN</label>
                                                    <div class="col-sm-8"><select aria-hidden="true"
                                                                                  class="form-control select-chosen"
                                                                                  id="subjabasn" name="subjabasn"
                                                                                  style="width: 100%;" tabindex="-1"
                                                                                  onchange="getToSub(this.value,'ketahli','m/keahlian_asn/getoption/')"></select>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="inputpns"><label
                                                            class="col-sm-4 control-label"
                                                            for="inputkab">Keterangan </label>
                                                    <div class="col-sm-8"><select aria-hidden="true"
                                                                                  class="form-control select-chosen"
                                                                                  id="ketahli" name="ketahli"
                                                                                  style="width: 100%;"
                                                                                  tabindex="-1"></select></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label"
                                                                               for="inputkel">TMT Jabatan ASN</label>
                                                    <div class="col-sm-8"><input class="form-control" id="txttmtjabfung"
                                                                                 name="txttmtjabfung"
                                                                                 placeholder="yyyy-mm-dd" type="date"
                                                                                 value=""></div>
                                                </div><!-- End Hori sontal -->
                                                <div class="form-group"><label class="col-sm-4 control-label"
                                                                               for="inputkel">TMT CPNS</label>
                                                    <div class="col-sm-8"><input class="form-control tgl"
                                                                                 id="txttmtcpns" name="txttmtcpns"
                                                                                 placeholder="yyyy-mm-dd" type="date"
                                                                                 value=""></div>
                                                </div>
                                                <div class="form-group"><label class="col-sm-4 control-label"
                                                                               for="inputkel">TMT PNS</label>
                                                    <div class="col-sm-8"><input class="form-control tgl" id="txttmtpns"
                                                                                 name="txttmtpns"
                                                                                 placeholder="yyyy-mm-dd" type="date"
                                                                                 value=""></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label" for="inputrt">Direktorat</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="form-control"
                                                                              id="txtdirektorat" name="txtdirektorat"
                                                                              onchange="getToSub(this.value,'txtbagian','master/direktoratSub/')"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label" for="inputrw">Bagian</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtbagian" name="txtbagian"
                                                                              onchange="getToSub(this.value,'unitkerja','master/direktoratSub/')"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputpropinsi">Sub Bagian</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="unitkerja" name="unitkerja"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                        </div>
                                    </div><!-- /.box --><!-- Form Element sizes --><!-- /.box --><!-- Input addon -->
                                    <div class="box box-info"><!-- /.box-body --></div><!-- /.box --></div>
                                <!--/.col (left) --><!-- right column -->
                                <div class="col-md-6"><!-- Horizontal Form -->
                                    <div class="box box-info">
                                        <div class="box-header with-border"><h3 class="panel-title"></h3></div>
                                        <!-- /.box-header --><!-- form start -->
                                        <div class="box-body">
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputkec">J.Internal</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtjabatan" name="txtjabatan"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select>
                                                                            <span
                                        class="text-xs text-danger">*Wajib diisi</span></div>
                                            </div>
											<div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputkec">J.Internal 1</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtjabatan1" name="txtjabatan1"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
											<div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputkec">J.Internal 2</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtjabatan2" name="txtjabatan2"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputkel">TMT Jabatan</label>
                                                <div class="col-sm-8"><input class="form-control" id="txttmtjabatan"
                                                                             name="txttmtjabatan"
                                                                             placeholder="yyyy-mm-dd" type="date"
                                                                             value=""></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputkel">Golongan</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtgolongan" name="txtgolongan"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputkel">TMT Golongan</label>
                                                <div class="col-sm-8"><input class="form-control" id="txttmtgolongan"
                                                                             name="txttmtgolongan"
                                                                             placeholder="yyyy-mm-dd" type="date"
                                                                             value=""></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="inputkel">Tgl Bergabung</label>
                                                <div class="col-sm-8"><input class="form-control" id="txttmtbergabung"
                                                                             name="txttmtbergabung"
                                                                             placeholder="yyyy-mm-dd" type="date"
                                                                             value=""></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label" for="inputrw">Kelompok
                                                    Profesi</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="kategori_profesi"
                                                                              name="kategori_profesi"
                                                                              style="width: 100%;" tabindex="-1"
                                                                              onchange="getToSub(this.value,'id_profesi','masterp/profesi/getoption/')">
                                                                                
                                                                              </select>
                                                                              <span
                                        class="text-xs text-danger">*Wajib diisi</span>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label" for="inputrw">Profesi</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="id_profesi" name="id_profesi"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="txtperingkat">Peringkat</label>
                                                <div class="col-sm-8"><select aria-hidden="true" class="select-chosen"
                                                                              id="txtperingkat" name="txtperingkat"
                                                                              style="width: 100%;"
                                                                              tabindex="-1"></select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-4 control-label"
                                                                           for="txtperingkat">No. Index Dokumen</label>
                                                <div class="col-sm-8"><input class="form-control" id="txtindex"
                                                                             name="txtindex" placeholder="" type="text"
                                                                             value=""></div>
                                            </div><!-- End Hori sontal --></div>
                                    </div><!-- /.box --><!-- general form elements disabled --><!-- /.box --></div>
                                <!--/.col (right) --></div><!-- /.row --></section><!-- end FORM 3 --></div>
                </div>
                <div id="demo-tabs-box-4" class="tab-pane fade">
                    <div class="panel-body pad-all"><!-- START FORM 4 -->
                        <div class="col-md-4"><img src="" id="img-cover" class="img-responsive pad"
                                                   style="border:1px solid #999; width:180px; height:200px;"><label>Upload
                                Cover</label><input name="cover_file" id="cover-fl" type="file">
                            <p class="help-block">jpg, jpeg, png</p><a href="javascript:void(0);"
                                                                       class="btn btn-primary pull-left upload-btn"
                                                                       onclick="upload_file()"><i
                                        class="fa fa-save"></i> Upload</a></div><!-- end FORM 4 --></div>
                </div>
                <div id="demo-tabs-box-5" class="tab-pane fade">
                    <div class="panel-body pad-all" id="uploadfile"></div>
                </div>
            </div>
        </div>
    </div>
</form>
<script> $('.select-chosen').chosen();
    $('.chosen-container').css({"width": "100%"});
    window.setTimeout(function () {
        var element = document.getElementById('f_id_edit');
        if (element) {
            var f_id_edit = $("#f_id_edit").val();
            $('#f_user_password').val('');
            if (empty(f_id_edit)) {/*getOptions("f_user_status_aktif",BASE_URL+"Appdata/getstatus");*/
                getOptions("kategori_profesi", BASE_URL + 'masterp/group_profesi/getoption');
                getOptions("txtperingkat", BASE_URL + "master/peringkat_jabatan");
                getOptions("id_bank", BASE_URL + "master/getmaster?id=26");
                getOptions("id_shift", BASE_URL + "master/getmaster?id=27");
                getOptions("txtprovktp", BASE_URL + "master/provinsi");
                getOptions("txtinputstatus", BASE_URL + "master/status_pegawai_pns");
                getOptions("inputstatustetap", BASE_URL + "master/status_pegawai_tetap");
                getOptions("txtdirektorat", BASE_URL + "master/direktorat");
                getOptions("txtjabfung", BASE_URL + "m/group_jabatan_asn/getoption");
                getOptions("txtjabatan", BASE_URL + "master/jabatan_struktural_fix");
                getOptions("txtjabatan1", BASE_URL + "master/jabatan_struktural_fix");
                getOptions("txtjabatan2", BASE_URL + "master/jabatan_struktural_fix");
                getOptions("txtgolongan", BASE_URL + "master/golongan_pegawai");
                getOptions("txtkelamin", BASE_URL + "master/kelamin");
                getOptions("f_user_status_aktif", BASE_URL + "Appdata/getstatus");
                getOptions("txtagama", BASE_URL + "master/agama");
                getOptions("txtpendidikan", BASE_URL + "master/getmaster?id=29");
                getOptions("subjabasn", BASE_URL + "master/getmaster?id=40");
                getOptions("txtprov", BASE_URL + "master/provinsi");
            }
        }
    }, 2000);
    $("#cover-fl").change(function () {
        preview_cover(this);
    });

    function preview_cover(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-cover').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function upload_file() {
        var form = $("#form-upload");
        if ($('#f_id_edit').val() !== '') {
            $.ajax({
                url: BASE_URL + "supplier/uploadcover_data", /* Url to which the request is send */
                type: "POST",
                data: new FormData(form[0]), /* Data sent to server, a set of key/value pairs (i.e. form fields and values)*/
                contentType: false,       /* The content type used when sending data to the server.*/
                cache: false,             /* To unable request pages to be cached*/
                processData: false,        /* To send DOMDocument or non processed data file it is set to false*/
                success: function (data)   /* A function to be called if request succeeds*/ {
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
                    } else {
                        alert(message);
                        return false;
                    }
                }
            });
        } else {
            alert('Data pegawai harus disimpan terlebih dahulu!');
            return false;
        }
    }

	function copykpos(){
	 
		$("#inputkposktp").val($("#inputkpos").val());
	}
	
    function copyAlamat() {
        $("#txtAlamatKtp").val($("#txtAlamat").val());
    }

    function copyRT() {
        $("#inputrtktp").val($("#inputrt").val());
    }

    function copyRW() {
        $("#inputrwktp").val($("#inputrw").val());
    }</script>