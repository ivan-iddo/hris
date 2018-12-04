<style>
.input-group-addon{
	border:none !important; 
}
 
</style>
<form id="form-detail-alasan" method="post">
<div class="box-body pad-all">
												
												<div class="row">
												<div class="form-group row pad-top">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX">Alasan permintaan</label>
															<div class="col-md-8 col-sm-4 col-xs-12">
																<div class="input-group">
																  <span class="input-group-addon">
																	<input aria-label="..." type="checkbox">
																  </span>
																  <span class="input-group-addon">Menggantikan Karyawan :</span>
																  <span class="input-group-addon">&nbsp;</span>
																  &nbsp;
																  <input style="display:none" type="text" name="id_pengajuandetail" id="id_pengajuandetail">
																  <input style="display:none" type="text" name="id_alasan" id="id_alasan">
																</div><!-- /input-group -->
															</div>
															
														</div>
													</div>
													<div class="row">
												<div class="form-group row pad-top">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX">&nbsp;</label>
															<div class="col-md-6 col-sm-4 col-xs-12">
																<div class="input-group">
																  <span class="input-group-addon"> 
																  </span>
																  
																  <span class="input-group-addon">Nama Karyawan yang digantikan :</span>
																  <input class="form-control" id="nama_karyawan" name="nama_karyawan" type="text">
																</div><!-- /input-group -->
															</div>
															
														</div>
													</div>
													<div class="form-group row pad-top">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX">&nbsp;</label>
															<div class="col-md-6 col-sm-4 col-xs-12">
																<div class="input-group">
																  <span class="input-group-addon"> 
																  </span>
																  
																  <span class="input-group-addon">Keluar/Pensiun per :</span>
																  <input class="form-control" id="tgl_keluar" name="tgl_keluar" type="date">
																</div><!-- /input-group -->
															</div>
															
														</div>
													 
													 
													<div class="row">
														<div class="form-group row pad-top">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX"></label>
															<div class="col-md-8 col-sm-4 col-xs-12">
																<div class="input-group">
																  <span class="input-group-addon">
																	<input aria-label="..." type="checkbox">
																  </span>
																  <span class="input-group-addon">Penambahan / Rekrutmen baru, alasan :</span>
																  <input class="form-control" id="alasan_rekrut" name="alasan_rekrut" type="text">
																</div><!-- /input-group -->
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group row pad-top">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX"></label>
															<div class="col-md-8 col-sm-4 col-xs-12">
																<div class="input-group">
																  <span class="input-group-addon">
																  </span>
																  <span class="input-group-addon">Dampak yang diharapkan :</span>
																  <input class="form-control" id="dampak_diharapkan" name="dampak_diharapkan" type="text">
																</div><!-- /input-group -->
															</div>
														</div>
													</div>			
													<div class="row">
														<div class="form-group row pad-top">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX"></label>
															<div class="col-md-8 col-sm-4 col-xs-12">
																<div class="input-group">
																  <span class="input-group-addon">
																 </span>
																  <span class="input-group-addon">Indikator :</span>
																  <input class="form-control" id="indikator" name="indikator" type="text">
																</div><!-- /input-group -->
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group row pad-top">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX"></label>
															<div class="col-md-6 col-sm-5 col-xs-12">
																<div class="input-group">
																  <span class="input-group-addon">
																	<input aria-label="..." type="checkbox">
																  </span>
																  <span class="input-group-addon">Sementara, untuk jangka waktu :</span>
																  <input class="form-control" id="jangka_waktu_bln" name="jangka_waktu_bln" type="text">
																  <span class="input-group-addon">Bulan</span>
																</div><!-- /input-group -->
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group row pad-top">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX"></label>
															<div class="col-md-8 col-sm-8 col-xs-12">
																<div class="input-group">
																  <span class="input-group-addon">
																	<input aria-label="..." type="checkbox">
																  </span>
																  <span class="input-group-addon">Lain-lain :</span>
																  <input class="form-control" id="lain_lain" name="lain_lain" type="text">
																</div><!-- /input-group -->
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group row pad-top">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX">Sumber</label>
															<div class="col-md-4 col-sm-4 col-xs-12">
															 
																<select aria-hidden="true" class="form-control select-chosen" id="id_sumber" name="id_sumber" style="width: 100%;" tabindex="-1">
									 
									 </select> 
																 
															</div>
															
														</div>
													</div>
													<div class="row">
														<div class="form-group row pad-top">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX">Status Pegawai-PNS </label>
															<div class="col-md-3 col-sm-3 col-xs-12">
															<select aria-hidden="true" class="form-control select-chosen" id="status_pegawai_pns" name="status_pegawai_pns" style="width: 100%;" tabindex="-1">
									 
									 </select> 
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group row pad-top">
															<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX">Status Pegawai-Tetap / non-PNS </label>
															<div class="col-md-4 col-sm-4 col-xs-12">
															<select aria-hidden="true" class="form-control select-chosen" id="status_pegawai_tetap" name="status_pegawai_tetap" style="width: 100%;" tabindex="-1">
									 
									 </select> 
															
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
		   	getJson(setPengajuan,BASE_URL+'abk/abk/getrowpengajuandetail?id='+selectedRowsString);

            }
           

			function setPengajuan(result){
				if(result.hasil ==='success'){
					//getOptionsEdit("id_sumber",BASE_URL+"master/direktoratSub",result.data.id_uk_det);
					getOptionsEdit("id_kp",BASE_URL+'dokumen/gettaksonomi?id=35',result.data.id_kp);

				$('#id_alasan').val(result.data.id);
				$('#id_pengajuandetail').val(result.data.id_pengajuan);
				$('#id_gantikaryawan').val(result.data.id_gantikaryawan);
				$('#nama_karyawan').val(result.data.nama_karyawan);
				$('#tgl_keluar').val(result.data.tgl_keluar);
				$('#alasan_rekrut').val(result.data.alasan_rekrut);
				$('#dampak_diharapkan').val(result.data.dampak_diharapkan);
				$('#indikator').val(result.data.indikator);
				$('#jangka_waktu_bln').val(result.data.jangka_waktu_bln);
				$('#lain_lain').val(result.data.lain_lain);   
				$('#flag').val(result.data.flag); 

				getOptionsEdit("id_sumber",BASE_URL+'dokumen/gettaksonomi?id=36',result.data.id_sumber);
				getOptionsEdit("status_pegawai_pns",BASE_URL+"master/status_pegawai?type=pns",result.data.status_pegawai_pns);
					getOptionsEdit("status_pegawai_tetap",BASE_URL+"master/status_pegawai?type=nonpns",result.data.status_pegawai_tetap);


				}else{ 
					$('#id_pengajuandetail').val(selectedRowsString);
					getOptions("id_sumber",BASE_URL+'dokumen/gettaksonomi?id=36');
					getOptions("status_pegawai_pns",BASE_URL+"master/status_pegawai?type=pns");
					getOptions("status_pegawai_tetap",BASE_URL+"master/status_pegawai?type=nonpns");
				}
			}

			 
           </script>