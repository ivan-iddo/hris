<form id="form-m_group_jabatan_asn"  method="post" role="form" class="form-horizontal pad-all">
<div class="row pad-all">
<div class="panel-body">
    <input type="text" style="display:none" name="id" id="id" class="form-control"/><div class="row mar-all"> 				
					<div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Kode Grup</label>
							<div class="col-sm-7">
							<input type="text" name="kd_grp_job_profesi" id="kd_grp_job_profesi" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Grup Jabatan</label>
							<div class="col-sm-7">
							<input type="text" name="ds_group_jabatan" id="ds_group_jabatan" class="form-control"/>
							</div>
							
					</div> 
					</div>
      
      
    </div>
</div>

</form>



<script>

 var idcell = getGridId(gridOptions_m_group_jabatan_asn,'migrasi_group_jabatan_ASN_id');
 $('#id').val(idcell);
  

    window.setTimeout(function(){
        if(!empty($('#id').val())){
    
        getJson(getdata_m_group_jabatan_asn, url_api+'listdata?id='+idcell);
    }
    },500);
    


function getdata_m_group_jabatan_asn(result){
    
    
   // $('#id_edit_m_group_jabatan_asn').val(result.result[0].id);
   $('#id').val(result.result[0].migrasi_group_jabatan_ASN_id);$('#kd_grp_job_profesi').val(result.result[0].kd_grp_job_profesi);$('#ds_group_jabatan').val(result.result[0].ds_group_jabatan);
}


</script>