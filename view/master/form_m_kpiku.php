<form id="form-m_status_pegawai"  method="post" role="form" class="form-horizontal pad-all">
	<div class="row pad-all">
		<div class="panel-body">
			<input type="text" style="display:none" name="id_grup" id="id_grup" class="form-control"/><div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">Parameter</label>
					<div class="col-sm-7">
						<input type="text" name="grup" id="grup" class="form-control"/>
					</div>
					
				</div> 
				<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">Bobot</label>
					<div class="col-sm-7">
						<input type="text" name="grup" id="grup" class="form-control"/>
					</div>
					
				</div> 
			</div>
			
			
		</div>
	</div>

</form>



<script>

	var idcell = getGridId(gridOptions_m_status_pegawai,'id_grup');
	$('#id_grup').val(idcell);
	

	window.setTimeout(function(){
		if(!empty($('#id_grup').val())){
			
			getJson(getdata_m_status_pegawai, url_api+'listkpi?id=5&id_grup='+idcell);
		}
	},500);
	


	function getdata_m_status_pegawai(result){
		
		
		$('#id_grup').val(result.result[0].id_grup);$('#grup').val(result.result[0].grup);
	}


</script>