<form id="form-pengajuan"  method="post" role="form" class="form-horizontal pad-all">
<div class="row pad-all">
<div class="panel-body">
    <input type="text" style="display:none" name="kd_pengajuan" id="kd_pengajuan" class="form-control"/><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">pengajuan</label>
							<div class="col-sm-7">
							<input type="text" name="pengajuan" id="pengajuan" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">pengajuan id</label>
							<div class="col-sm-7">
							<input type="text" name="pengajuan_id" id="pengajuan_id" class="form-control"/>
							</div>
							
					</div> 
					</div>
      
      
    </div>
</div>

</form>



<script>

 var idcell = getGridId(gridOptions_pengajuan,'kd_pengajuan');
 $('#kd_pengajuan').val(idcell);
  

    window.setTimeout(function(){
        if(!empty($('#kd_pengajuan').val())){
    
        getJson(getdata_pengajuan, url_api+'listdata?id='+idcell);
    }
    },500);
    


function getdata_pengajuan(result){
    
    
   // $('#id_edit_pengajuan').val(result.result[0].id);
   $('#kd_pengajuan').val(result.result[0].kd_pengajuan);$('#pengajuan').val(result.result[0].pengajuan);$('#pengajuan_id').val(result.result[0].pengajuan_id);
}


</script>