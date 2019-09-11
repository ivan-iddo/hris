<form id="form-m_status_pegawai"  method="post" role="form" class="form-horizontal pad-all">
  <div class="row pad-all">
    <div class="panel-body">
      <input type="text" style="display:none" name="id" id="id" class="form-control"/><div class="row mar-all"> 
       <div class="form-group">
         <label class="col-sm-2 control-label" for="inputstatus">nama</label>
         <div class="col-sm-7">
           <input type="text" name="nama" id="nama" class="form-control"/>
         </div>
         
       </div> 
     </div>
     
     
   </div>
 </div>

</form>



<script>

 var idcell = getGridId(gridOptions_m_status_pegawai,'id');
 $('#id').val(idcell);
 

 window.setTimeout(function(){
  if(!empty($('#id').val())){
    
    getJson(getdata_m_status_pegawai, url_api+'listdata?id='+idcell);
  }
},500);
 


 function getdata_m_status_pegawai(result){
  
  
   // $('#id_edit_m_status_pegawai').val(result.result[0].id);
   $('#id').val(result.result[0].id);$('#nama').val(result.result[0].nama);
 }


</script>