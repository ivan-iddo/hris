<form id="form-m_index_jabatan_asn"  method="post" role="form" class="form-horizontal pad-all">
<div class="row pad-all">
<div class="panel-body">
    <input type="text" style="display:none" name="migrasi_index_jabatan_id" id="migrasi_index_jabatan_id" class="form-control"/><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Kode Pekerjaan</label>
							<div class="col-sm-7">
							<input type="text" name="kd_job_index" id="kd_job_index" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Pekerjaan</label>
							<div class="col-sm-7">
							<input type="text" name="ds_job_index" id="ds_job_index" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tipe ij</label>
							<div class="col-sm-7">
							<input type="text" name="tipe_ij" id="tipe_ij" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Nilai ij</label>
							<div class="col-sm-7">
							<input type="text" name="nilai_ij" id="nilai_ij" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Seq Pekerjaan</label>
							<div class="col-sm-7">
							<input type="text" name="seq_job_index" id="seq_job_index" class="form-control"/>
							</div>
							
					</div> 
					</div>
    </div>
</div>

</form>



<script>

 var idcell = getGridId(gridOptions_m_index_jabatan_asn,'migrasi_index_jabatan_id');
 $('#migrasi_index_jabatan_id').val(idcell);
  

    window.setTimeout(function(){
        if(!empty($('#migrasi_index_jabatan_id').val())){
    
        getJson(getdata_m_index_jabatan_asn, url_api+'listdata?id='+idcell);
    }
    },500);
    


function getdata_m_index_jabatan_asn(result){
    
    
   // $('#id_edit_m_index_jabatan_asn').val(result.result[0].id);
   $('#migrasi_index_jabatan_id').val(result.result[0].migrasi_index_jabatan_id);$('#kd_job_index').val(result.result[0].kd_job_index);$('#ds_job_index').val(result.result[0].ds_job_index);$('#tipe_ij').val(result.result[0].tipe_ij);$('#nilai_ij').val(result.result[0].nilai_ij);$('#seq_job_index').val(result.result[0].seq_job_index);$('#tgl_update').val(result.result[0].tgl_update);$('#no_peg_update').val(result.result[0].no_peg_update);
}


</script>