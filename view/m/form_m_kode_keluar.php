<form id="form-m_kode_keluar"  method="post" role="form" class="form-horizontal pad-all">
<div class="row pad-all">
<div class="panel-body">
    <input type="text" style="display:none" name="kd_keluar" id="kd_keluar" class="form-control"/><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">ds keluar</label>
							<div class="col-sm-7">
							<input type="text" name="ds_keluar" id="ds_keluar" class="form-control"/>
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
					</div>
      
      
    </div>
</div>

</form>



<script>

 var idcell = getGridId(gridOptions_m_kode_keluar,'kd_keluar');
 $('#kd_keluar').val(idcell);
  

    window.setTimeout(function(){
        if(!empty($('#kd_keluar').val())){
    
        getJson(getdata_m_kode_keluar, url_api+'listdata?id='+idcell);
    }
    },500);
    


function getdata_m_kode_keluar(result){
    
    
   // $('#id_edit_m_kode_keluar').val(result.result[0].id);
   $('#kd_keluar').val(result.result[0].kd_keluar);$('#ds_keluar').val(result.result[0].ds_keluar);$('#tgl_update').val(result.result[0].tgl_update);$('#no_peg_update').val(result.result[0].no_peg_update);
}


</script>