<form id="form-his_ijin"  method="post" role="form" class="form-horizontal pad-all">
<div class="row pad-all">
<div class="panel-body">
    <input type="text" style="display:none" name="id" id="id" class="form-control"/><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">id user</label>
							<div class="col-sm-7">
							<input type="text" name="id_user" id="id_user" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">total</label>
							<div class="col-sm-7">
							<input type="text" name="total" id="total" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">tgl cuti</label>
							<div class="col-sm-7">
							<input type="text" name="tgl_cuti" id="tgl_cuti" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">tgl akhir cuti</label>
							<div class="col-sm-7">
							<input type="text" name="tgl_akhir_cuti" id="tgl_akhir_cuti" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">jenis cuti</label>
							<div class="col-sm-7">
							<input type="text" name="jenis_cuti" id="jenis_cuti" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">status</label>
							<div class="col-sm-7">
							<input type="text" name="status" id="status" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">tampilkan</label>
							<div class="col-sm-7">
							<input type="text" name="tampilkan" id="tampilkan" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">keterangan</label>
							<div class="col-sm-7">
							<input type="text" name="keterangan" id="keterangan" class="form-control"/>
							</div>
							
					</div> 
					</div>
      
      
    </div>
</div>

</form>



<script>

 var idcell = getGridId(gridOptions_his_ijin,'id');
 $('#id').val(idcell);
  

    window.setTimeout(function(){
        if(!empty($('#id').val())){
    
        getJson(getdata_his_ijin, url_api+'listdata?id='+idcell);
    }
    },500);
    


function getdata_his_ijin(result){
    
    
   // $('#id_edit_his_ijin').val(result.result[0].id);
   $('#id').val(result.result[0].id);$('#id_user').val(result.result[0].id_user);$('#total').val(result.result[0].total);$('#tgl_cuti').val(result.result[0].tgl_cuti);$('#tgl_akhir_cuti').val(result.result[0].tgl_akhir_cuti);$('#jenis_cuti').val(result.result[0].jenis_cuti);$('#status').val(result.result[0].status);$('#tampilkan').val(result.result[0].tampilkan);$('#keterangan').val(result.result[0].keterangan);
}


</script>