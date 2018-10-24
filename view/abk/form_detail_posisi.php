<style>
.input-group-addon{
	border:none !important; 
}
 
</style>
<form id="form-detail-posisi" method="post"> 
<div class="box-body pad-all">
												
												
												<div class="col-md-12 col-xs-12">
													<div class="form-group pad-bottom">
														<label class="control-label col-md-4 col-sm-4 col-xs-12" for="BDHOBI">Gambaran posisi dalam struktur</label>
														<div class="col-md-6 col-sm-8 col-xs-12">
														<input style="display:none" type="text" name="id_pengajuan_posisi" id="id_pengajuan_posisi">
																  <input style="display:none" type="text" name="id_posisi" id="id_posisi">
																
															<textarea id="dlm_struktur" name="dlm_struktur" class="form-control col-md-12 col-xs-12" rows="2"></textarea>
														</div>
													</div>
													<div class="form-group pad-top">
													<label class="control-label col-md-4 col-sm-4 col-xs-12" for="BDHOBI">Uraian Jabatan</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
														<textarea id="urian" name="urian" class="form-control col-md-12 col-xs-12" rows="2"></textarea>
													</div>
												</div>
												</div>
			  
                                                
	  
												
												
												
												
												
												
												<!-- End Hori sontal -->
												
											  </div>
</form>
           <script>
           
 $('.select-chosen').chosen();
 $('.chosen-container').css({"width": "100%"});
 
           var selectedRows = gridTK.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               
            }else{
                var selectedRowsString = '';
				var id_ukres = '';
				var tahunres = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
			   id_ukres += selectedRow.id_unit;
			   tahunres += selectedRow.tahun;
           });  
           $('#idtk').val(selectedRowsString);
		   	getJson(setPengajuan,BASE_URL+'abk/abk/getposisi?id='+selectedRowsString);

            }
           

			function setPengajuan(result){
				if(result.hasil ==='success'){
					//getOptionsEdit("id_sumber",BASE_URL+"master/direktoratSub",result.data.id_uk_det);
					 
				    $('#id_posisi').val(result.data.id_posisi); 
					$('#dlm_struktur').val(result.data.dlm_struktur);
					$('#urian').val(result.data.urian); 

	 
				}else{ 
					$('#id_pengajuan_posisi').val(selectedRowsString); 
				}
			}

			 
           </script>