<form id="form-contoh1"  method="post" role="form" class="form-horizontal pad-all">
<div class="row pad-all">
<div class="panel-body">
    GANTI_FORM
      
      
    </div>
</div>

</form>



<script>

 var idcell = getGridId(gridOptions_contoh1,'GANTI_ID');
 $('#GANTI_ID').val(idcell);
  

    window.setTimeout(function(){
        if(!empty($('#GANTI_ID').val())){
    
        getJson(getdata_contoh1, url_api+'listdata?id='+idcell);
    }
    },500);
    


function getdata_contoh1(result){
    
    
   // $('#id_edit_contoh1').val(result.result[0].id);
   ISI_DATA
}


</script>