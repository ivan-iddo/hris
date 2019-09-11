<form id="form-kpi"  method="post" role="form" class="form-horizontal pad-all">
	<div class="row pad-all">
		<div class="panel-body">
			<input type="text" style="display:none" name="kd_kpi" id="kd_kpi" class="form-control"/><div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">kpi</label>
					<div class="col-sm-7">
						<input type="text" name="kpi" id="kpi" class="form-control"/>
					</div>

				</div> 
			</div><div class="row mar-all"> 
				<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">kpi id</label>
					<div class="col-sm-7">
						<input type="text" name="kpi_id" id="kpi_id" class="form-control"/>
					</div>

				</div> 
			</div>


		</div>
	</div>

</form>



<script>
var idcell = getGridId(gridOptions_kpi,'kd_kpi');
$('#kd_kpi').val(idcell);
window.setTimeout(function(){
if(!empty($('#kd_kpi').val())){
	getJson(getdata_kpi, url_api+'listdata?id='+idcell);
}
},500);
function getdata_kpi(result){
// $('#id_edit_kpi').val(result.result[0].id);
$('#kd_kpi').val(result.result[0].kd_kpi);$('#kpi').val(result.result[0].kpi);$('#kpi_id').val(result.result[0].kpi_id);
}
</script>