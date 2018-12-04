<form id="form-mutasi"  method="post" role="form" class="form-horizontal pad-all">
<div class="row pad-all">
<div class="col-lg-5">
<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">Jenis Mutasi</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="jenis_mutasi" name="jenis_mutasi" style="width: 100%;" tabindex="-1">
								</select>
							</div>
						</div>
<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrt">Direktorat Tujuan</label>
							<div class="col-sm-8">
              <input id="txtIdUser" name="txtIdUser" style="display:none" type="text">
								<select aria-hidden="true" class="select-chosen" id="txtdirektorat" name="txtdirektorat" onchange="getToSub(this.value,'txtbagian','master/direktoratSub/')" style="width: 70%;" tabindex="-1">
									 
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">Bagian Tujuan</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="txtbagian" name="txtbagian" onchange="getToSub(this.value,'unitkerja','master/direktoratSub/')" style="width: 100%;" tabindex="-1">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">Sub Bagian Tujuan</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="unitkerja" name="unitkerja" style="width: 100%;" tabindex="-1">
									 
								</select>
							</div>
            </div>
			<div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">J.Struktural</label>
							<div class="col-sm-8">
							<select aria-hidden="true" class="select-chosen" id="txtjabatan" name="txtjabatan" style="width: 100%;" tabindex="-1">
									 
									 </select>
							</div>
           				 </div>
            <div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">Tgl.Mutasi</label>
							<div class="col-sm-8">
							 <input class="form-control" type="date" id="tgl_mutasi" name="tgl_mutasi">
							</div>
						</div>
                              <div class="form-group">
					                        <label class="col-sm-4 control-label" for="demo-is-inputsmall">Keterangan</label>
					                        <div class="col-sm-8">
					                            <textarea placeholder="" class="form-control input-sm" id="keterangan" name="keterangan" type="text">
</textarea>
					                        </div>
					                    </div>   
</div>
<div class="col-lg-6">
<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">No.SK</label>
							<div class="col-sm-8">
							 <input class="form-control" type="text" id="no_sk" name="no_sk">
							</div>
						</div>
<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">Tgl.SK</label>
							<div class="col-sm-8">
							 <input class="form-control" type="date" id="tgl_sk" name="tgl_sk">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">Kelas Jabatan</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="kelas_jabatan" name="kelas_jabatan" style="width: 100%;" tabindex="-1">
									 
								</select>
						</div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">Satuan Kerja</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="satuan_kerja" name="satuan_kerja" style="width: 100%;" tabindex="-1">
									 
								</select>
						</div>
           				 </div>
</div>
</div>
           
</form>


              <script>
 $('.select-chosen').chosen();
 $('.chosen-container').css({"width": "100%"});

      
     
</script>