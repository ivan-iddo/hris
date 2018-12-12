<form id="form-jfung"  method="post" role="form" class="form-horizontal pad-all">
<div class="row">
<div class="col-lg-5">
<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrt">Jabatan</label>
							<div class="col-sm-8">
							  <input id="txtIdUser" name="txtIdUser" style="display:none" type="text">
								<select aria-hidden="true" class="select-chosen" id="txtjabatan" name="txtjabatan" onchange="getToSub(this.value,'txtbagian','master/direktoratSub/')" style="width: 70%;" tabindex="-1">
									 
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">TMT JabFung</label>
							<div class="col-sm-8">
								<input class="form-control" type="text" id="tmt_jabfung" name="tmt_jabfung">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">No SK JabFung</label>
							<div class="col-sm-8">
								<input class="form-control" type="text" id="no_skjfung" name="no_skjfung">
							</div>
            </div>
            <div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">Tgl SK JabFung</label>
							<div class="col-sm-8">
							 <input class="form-control" type="date" id="tgl_skjafung" name="tgl_skjafung">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">No.PAK</label>
							<div class="col-sm-8">
							 <input class="form-control" type="text" id="no_pak" name="no_pak">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">TMT PAK</label>
							<div class="col-sm-8">
							 <input class="form-control" type="text" id="tmt_pak" name="tmt_pak">
							</div>
						</div>
</div>
<div class="col-lg-6">
<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">Tgl PAK</label>
							<div class="col-sm-8">
							 <input class="form-control" type="date" id="tgl_pak" name="tgl_pak">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">Nilai PAK</label>
							<div class="col-sm-8">
								<input class="form-control" type="text" id="nilai_pak" name="nilai_pak">
						</div>
							</div>
							<div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">Satuan Kerja</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="satuan_kerja" name="satuan_kerja" style="width: 100%;" tabindex="-1">
									 
								</select>
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
</div>
               <div class="panel pad-all mar-all">
                  
                <div class="box-body">
                  
          <div class="btn-group mar-rgt">
          <input name="doc_file" id="doc_file" type="file" class="btn btn-success btn-sm fileinput-button dz-clickable">
                                                 
          </div>
          
             
             
                                    <div class="row text-xs text-danger">
                                        *Untuk upload ijazah silahkan simpan data terlebih dahulu
                                    </div>
                                     
            </div>
            <div class="panel-body">
            <div class="row pad-all">
          <div id="uploadbtn" class="btn btn-primary btn-sm pull-left upload-btn" onclick="upload_file()"><i class="fa fa-save"></i> Upload</div>
            </div>
          <div class="table-responsive">
					                    <table class="table table-striped">
					                        <thead>
					                            <tr>
					                                <th>No.</th>
					                                <th>Nama File</th>
					                                <th>Action</th>
					                            </tr>
					                        </thead>
					                        <tbody id="fileIjazah">
                                    
</tbody>
</table>
</div>
        </div>
</div>      
</form>


              <script>
 $('.select-chosen').chosen();
 $('.chosen-container').css({"width": "100%"});

      
     
</script>