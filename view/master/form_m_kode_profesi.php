<form id="form-m_kode_profesi"  method="post" role="form" class="form-horizontal pad-all">
	<div class="row pad-all">
		<div class="panel-body">
			<input type="text" style="display:none" name="id" id="id" class="form-control"/>
			<div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Grup Profesi</label>
					<div class="col-sm-7">
						<select aria-hidden="true" class="form-control select-chosen" name="kd_grp_job_profesi" id="kd_grp_job_profesi" style="width: 100%;" tabindex="-1">
							
						</select>
					</div>
					
				</div> 
			</div>
			<div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Kode Profesi</label>
					<div class="col-sm-7">
						<input type="text" name="kd_profesi" id="kd_profesi" class="form-control"/>
					</div>
					
				</div> 
			</div><div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Profesi</label>
					<div class="col-sm-7">
						<input type="text" name="ds_profesi" id="ds_profesi" class="form-control"/>
					</div>
					
				</div> 
			</div>
		</div>
	</div>

</form>



<script>
	getOptionsEdit("kd_grp_job_profesi",BASE_URL+'masterp/group_profesi/getoption');
	var idcell = getGridId(gridOptions_m_kode_profesi,'id');
	$('#id').val(idcell);
	

	window.setTimeout(function(){
		if(!empty($('#id').val())){
			
			getJson(getdata_m_kode_profesi, url_api+'listdata?id='+idcell);
		}
	},500);
	


	function getdata_m_kode_profesi(result){
		
		
   // $('#id_edit_m_kode_profesi').val(result.result[0].id);
   $('#id').val(result.result[0].id);$('#kd_profesi').val(result.result[0].kd_profesi);$('#ds_profesi').val(result.result[0].ds_profesi);
   getOptionsEdit("kd_grp_job_profesi",BASE_URL+'masterp/group_profesi/getoption',result.result[0].kd_grp_job_profesi);
}


</script>