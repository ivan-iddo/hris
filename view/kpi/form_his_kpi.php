<form id="form-his_kpi"  method="post" role="form" class="form-horizontal pad-all">
<div class="row pad-all">
<div class="panel-body">
    <input type="text" style="display:none" name="id" id="id" class="form-control"/><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">id jenis</label>
							<div class="col-sm-7">
							<input type="text" name="id_jenis" id="id_jenis" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">no pegawai</label>
							<div class="col-sm-7">
							<input type="text" name="no_pegawai" id="no_pegawai" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">awal</label>
							<div class="col-sm-7">
							<input type="text" name="awal" id="awal" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">akhir</label>
							<div class="col-sm-7">
							<input type="text" name="akhir" id="akhir" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">id unitkerja</label>
							<div class="col-sm-7">
							<input type="text" name="id_unitkerja" id="id_unitkerja" class="form-control"/>
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

 var idcell = getGridId(gridOptions_his_kpi,'id');
 $('#id').val(idcell);
  

    window.setTimeout(function(){
        if(!empty($('#id').val())){
    
        getJson(getdata_his_kpi, url_api+'listdata?id='+idcell);
    }
    },500);
    


function getdata_his_kpi(result){
    
    
   // $('#id_edit_his_kpi').val(result.result[0].id);
   $('#id').val(result.result[0].id);$('#id_jenis').val(result.result[0].id_jenis);$('#no_pegawai').val(result.result[0].no_pegawai);$('#awal').val(result.result[0].awal);$('#akhir').val(result.result[0].akhir);$('#id_unitkerja').val(result.result[0].id_unitkerja);$('#tampilkan').val(result.result[0].tampilkan);
}


</script>