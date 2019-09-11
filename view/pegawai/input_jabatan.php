<form id="form-jabatan"  method="post" role="form" class="form-horizontal pad-all">
	<div class="row pad-all">
		<div class="col-lg-5">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrt">Direktorat</label>
				<div class="col-sm-8">
					<input id="txtIdUser" name="txtIdUser" style="display:none" type="text">
					<input id="idjabatan" name="idjabatan" style="display:none" type="text">
					<select aria-hidden="true" class="select-chosen" id="txtdirektorat" name="txtdirektorat" onchange="getToSub(this.value,'txtbagian','master/direktoratSub/')" style="width: 70%;" tabindex="-1">
						<option value="" >Please select...</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrw">Bagian</label>
				<div class="col-sm-8">
					<select aria-hidden="true" class="select-chosen" id="txtbagian" name="txtbagian" onchange="getToSub(this.value,'unitkerja','master/direktoratSub/')" style="width: 100%;" tabindex="-1">
						
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputpropinsi">Sub Bagian</label>
							<!--<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="unitkerja" name="unitkerja" style="width: 100%;" tabindex="-1">
									 
								</select>
							</div>-->
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="unitkerja" name="unitkerja" onchange="getToSub(this.value,'kaunit','master/direktoratSub/')" style="width: 100%;" tabindex="-1">
									
								</select>
							</div>
						</div>
						<!--Tambah hirarki-->
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">Ka Unit</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="kaunit" name="kaunit" onchange="getToSub(this.value,'staff','master/direktoratSub/')" style="width: 100%;" tabindex="-1">
									
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">Staff</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="staff" name="staff" style="width: 100%;" tabindex="-1">
									
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">Tgl.Mutasi</label>
							<div class="col-sm-8">
								<input class="form-control tgl" type="text" id="tgl_mutasi" name="tgl_mutasi" placeholder="dd-mm-yyyy">
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
								<input class="form-control tgl" type="text" id="tgl_sk" name="tgl_sk" placeholder="dd-mm-yyyy">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="jabatan">Jabatan 1</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="jabatan" name="jabatan" style="width: 100%;" tabindex="-1">
									<option value="" >Please select...</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="jabatan">Jabatan 2</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="jabatan2" name="jabatan2" style="width: 100%;" tabindex="-1">
									<option value="" >Please select...</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="jabatan">Jabatan 3</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="jabatan3" name="jabatan3" style="width: 100%;" tabindex="-1">
									<option value="" >Please select...</option>
								</select>
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
				$(document).ready(function () {
					$('.tgl').datepicker({
						format: "dd-mm-yyyy",
					}).on('change', function(){
						$('.datepicker').hide();
					});
				});    
			</script>