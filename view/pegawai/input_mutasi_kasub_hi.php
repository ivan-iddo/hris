<form id="form-mutasi"  method="post" role="form" class="form-horizontal pad-all">
	<div class="row pad-all">
		<div class="col-lg-5">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrt">Direktorat Tujuan</label>
				<div class="col-sm-8">
					<input id="txtIdUser" name="txtIdUser" style="display:none" type="text">
					<input id="status" name="status" style="display:none" type="text">
					<input name="iddok" id="iddok" style="display:none" type="text">
					
					<select aria-hidden="true" class="select-chosen" id="txtdirektorat" name="txtdirektorat" onchange="getToSub(this.value,'txtbagian','master/direktoratSub/')" style="width: 70%;" tabindex="-1">
						
					</select>
				</div>
			</div>
			<input type="text" name="kategori_chat" id="kategori_chat" style="display:none" value="1">
			<input type="text" name="statusproses" id="statusproses" style="display:none" value="90">
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
				<label class="col-sm-4 control-label" for="inputpropinsi">Jabatan</label>
				<div class="col-sm-8">
					<select aria-hidden="true" class="select-chosen" id="txtjabatan" name="txtjabatan" style="width: 100%;" tabindex="-1">
						
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrw">Tanggal Usulan Mutasi</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="tgl_mutasi" name="tgl_mutasi" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="demo-is-inputsmall">Keterangan</label>
				<div class="col-sm-8">
					<textarea placeholder="" class="form-control input-sm" id="keterangan" name="keterangan" type="text">
					</textarea>
				</div>
			</div>
										<!--<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">No.SK</label>
							<div class="col-sm-8">
							 <input class="form-control" type="text" id="no_sk" name="no_sk">
							</div>
						</div>
<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">Tgl.SK</label>
							<div class="col-sm-8">
							 <input class="form-control" type="text" id="tgl_sk" name="tgl_sk" placeholder="dd-mm-yyyy">
							</div>
						</div>-->
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">Kelas Jabatan</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="kelas_jabatan" name="kelas_jabatan" style="width: 100%;" tabindex="-1">
									
								</select>
							</div>
						</div><div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">Grade</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="grade" name="grade" style="width: 100%;" tabindex="-1">
									
								</select>
							</div>
						</div><div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">Tmt.Mutasi</label>
							<div class="col-sm-8">
								<input class="form-control" type="text" id="mutasi" name="mutasi">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">Satuan Kerja</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="satuan_kerja" name="satuan_kerja" style="width: 100%;" tabindex="-1">
									
								</select>
							</div>
							<a style="margin-left:3px" class="btn btn-success mar-all" onclick="prosesmutasi()"><i class="fa fa-file-excel-o"></i> Setujui</a>
						</div>  
						
					</div>
					<div class="col-lg-6">
						<!--Widget footer-->
						<div class="panel">
							<!--Heading-->
							<div class="panel-heading">
								<div class="panel-control">
									<div class="btn-group">
										<button type="button" class="btn btn-default" data-toggle="dropdown"><i class="demo-pli-gear icon-lg"></i></button>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="#">Available</a></li>
											<li><a href="#">Busy</a></li>
											<li><a href="#">Away</a></li>
											<li class="divider"></li>
											<li><a id="demo-connect-chat" href="#" class="disabled-link" data-target="#demo-chat-body">Connect</a></li>
											<li><a id="demo-disconnect-chat" href="#" data-target="#demo-chat-body">Disconect</a></li>
										</ul>
									</div>
								</div>
								<h3 class="panel-title">Chat</h3>
							</div>
							
							<!--Widget body-->
							<div>
								<div class="nano" style="height:300px">
									<div class="nano-content pad-all">
										<ul class="list-unstyled media-block">
											
											
										</ul>
									</div>
								</div>
								
								<!--Widget footer-->
								<div class="panel-footer">
									<div class="row">
										<div class="col-xs-9">
											<input type="text" id="idtk" name="idtk" style="display:none">
											<input placeholder="Enter your text" class="form-control chat-input" type="text" id="isi" name="isi">
										</div>
										<div class="col-xs-3">
											<a class="btn btn-primary btn-block"  onClick="chat();return false;">Send</a>
										</div>
									</div>
								</div>
								
							</div>
							
						</div>
						<a style="margin-left:3px" class="btn btn-danger" onclick="updatestatus('89')"><i class="fa fa-file-excel-o"></i> Tolak & Kembalikan Ke Pengaju</a>
						
					</div>
					
				</div>
			</div>
			
		</form>


		<script>
			$('.select-chosen').chosen();
			$('.chosen-container').css({"width": "100%"});
			$(document).ready(function () {
				$('#mutasi').datepicker({
					format: "dd-mm-yyyy",
				}).on('change', function(){
					$('.datepicker').hide();
				});
				$('#tgl_sk').datepicker({
					format: "dd-mm-yyyy",
				}).on('change', function(){
					$('.datepicker').hide();
				});
			});
		</script>