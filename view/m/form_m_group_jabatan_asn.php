<form id="form-m_group_jabatan_asn"  method="post" role="form" class="form-horizontal pad-all">
<div class="row pad-all">
<div class="panel-body">
    <input type="text" style="display:none" name="migrasi_group_jabatan_ASN_id" id="migrasi_group_jabatan_ASN_id" class="form-control"/><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">kd grp job profesi</label>
							<div class="col-sm-7">
							<input type="text" name="kd_grp_job_profesi" id="kd_grp_job_profesi" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">ds group jabatan</label>
							<div class="col-sm-7">
							<input type="text" name="ds_group_jabatan" id="ds_group_jabatan" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">tgl update</label>
							<div class="col-sm-7">
							<input type="text" name="tgl_update" id="tgl_update" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">no peg update</label>
							<div class="col-sm-7">
							<input type="text" name="no_peg_update" id="no_peg_update" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">tampilkan</label>
							<div class="col-sm-7">
							<input type="text" name="tampilkan" id="tampilkan" class="form-control"/>
							</div>
							
					</div> 
					</div>
      
      
    </div>
</div>

</form>



<script>

 var idcell = getGridId(gridOptions_m_group_jabatan_asn,'migrasi_group_jabatan_ASN_id');
 $('#migrasi_group_jabatan_ASN_id').val(idcell);
  

    window.setTimeout(function(){
        if(!empty($('#migrasi_group_jabatan_ASN_id').val())){
    
        getJson(getdata_m_group_jabatan_asn, url_api+'listdata?id='+idcell);
    }
    },500);
    


function getdata_m_group_jabatan_asn(result){
    
    
   // $('#id_edit_m_group_jabatan_asn').val(result.result[0].id);
   $('#migrasi_group_jabatan_ASN_id').val(result.result[0].migrasi_group_jabatan_ASN_id);$('#kd_grp_job_profesi').val(result.result[0].kd_grp_job_profesi);$('#ds_group_jabatan').val(result.result[0].ds_group_jabatan);$('#tgl_update').val(result.result[0].tgl_update);$('#no_peg_update').val(result.result[0].no_peg_update);$('#tampilkan').val(result.result[0].tampilkan);
}


</script>