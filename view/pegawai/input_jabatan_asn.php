<form id="form-jfung"  method="post" role="form" class="form-horizontal pad-all">
<div class="row">
<div class="col-lg-5">
<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrt">Direktorat</label>
							<div class="col-sm-8">
              <input id="txtIdUser" name="txtIdUser" style="display:none" type="text">
              <input id="idasn" name="idasn" style="display:none" type="text">
								<select aria-hidden="true" class="select-chosen" id="txtjabatan" name="txtjabatan" onchange="getToSub(this.value,'txtbagian','master/direktoratSub/')" style="width: 70%;" tabindex="-1">
									 
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
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="unitkerja" name="unitkerja" style="width: 100%;" tabindex="-1">
									 
								</select>
							</div>
            </div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">TMT JabFung</label>
							<div class="col-sm-8">
								<input class="form-control" type="date" id="tmt_jabfung" name="tmt_jabfung">
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
							 <input class="form-control" type="date" id="tmt_pak" name="tmt_pak">
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
                    *Untuk upload file simpan data terlebih dahulu
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
     function upload_file(){
	    var form = $("#form-jfung");
	    var idasn = $('#idasn').val();
	    
	        if(!empty(idasn)){
	                $.ajax({
	                url: BASE_URL+"pegawais/upload/upload_jabasn", // Url to which the request is send 
	                type: "POST", 
	                data: new FormData(form[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
	                contentType: false,       // The content type used when sending data to the server.
	                cache: false,             // To unable request pages to be cached
	                processData:false,        // To send DOMDocument or non processed data file it is set to false
	                success: function(data)   // A function to be called if request succeeds
	                {
	                    hasil=data.hasil;
	                    var datafile='';
	                    datafile+='<tr>';
	                    datafile+='<td>1.';
	                    datafile+='</td>';
	                    datafile+='<td>';
	                    datafile +=data.file.substring(0, 30)+'...';
	                    datafile+='</td>';
	                    datafile+='<td>';
	                    
	                    datafile +='<a title="Lihat File" id="book1-trigger" class="btn btn-default" href="javascript:void(0)" onclick="buildBook(\'api/upload/data/'+data.file+'\')"><i class="fa fa-eye"></i></a>';
	                    datafile+='</td>';
	                    datafile+='</tr>';
	                   $('#fileIjazah').html(datafile);
	                    
	                    message=data.message; 
	                       if(hasil=="success"){ 
	                                
	                                   $.niftyNoty({
	                                                   type: 'success',
	                                                   title: 'Success',
	                                                   message: message,
	                                                   container: 'floating',
	                                                   timer: 5000
	                                               });  
	                             }else{
	                                    alert(message);
	                                  return false;	
	                             }
	                }
	                });
	    }else{
	        alert('Anda harus menyimpan data jabatan Asn terlebih dahulu sebelum melakukan upload!');
	    }
    }
      $('.select-chosen').chosen();
 $('.chosen-container').css({"width": "100%"});

</script>