<form id="form-m_keahlian_asn_detail"  method="post" role="form" class="form-horizontal pad-all">
<div class="row pad-all">
<div class="panel-body">
    <input type="text" style="display:none" name="id" id="id" class="form-control"/>
					<div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Jenis Keahlian</label>
							<div class="col-sm-7">
							<select aria-hidden="true" class="form-control select-chosen" id="kode_ahli" name="kode_ahli" style="width: 100%;" tabindex="-1">
									 
								</select>
							 </div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Detail Keahlian ASN</label>
							<div class="col-sm-7">
							<input type="text" name="nama" id="nama" class="form-control"/>
							</div>
							
					</div> 
					</div>
      
      
    </div>
</div>

</form>



<script>

 var idcell = getGridId(gridOptions_m_keahlian_asn_detail,'id');
 $('#id').val(idcell);
  

    window.setTimeout(function(){
        if(!empty($('#id').val())){
    
        getJson(getdata_m_keahlian_asn_detail, url_api+'listdata?id='+idcell);
    }else{
		getOptions("kode_ahli",BASE_URL+"master/getmaster?id=40");
	}
    },500);
    


function getdata_m_keahlian_asn_detail(result){
    
    
   // $('#id_edit_m_keahlian_asn_detail').val(result.result[0].id);
   $('#id').val(result.result[0].id);$('#nama').val(result.result[0].nama); 
   $('#tampilkan').val(result.result[0].tampilkan);
   getOptionsEdit("kode_ahli",BASE_URL+"master/getmaster?id=40",result.result[0].kode_ahli);
}


</script>