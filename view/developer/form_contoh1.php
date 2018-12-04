<form id="form-contoh1"  method="post" role="form" class="form-horizontal pad-all">
<div class="row pad-all">
<div class="panel-body">
    <div class="form-group">
    <label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama</label>
    <div class="col-sm-5">
    <input placeholder="Nama" id="nama" name="nama" class="form-control" type="text">
    <input placeholder="ID Group" id="id_contoh1" name="id_contoh1"class="form-control" style="display:none"type="text">
    </div>
    </div>
    <div class="form-group">
    <label class="col-sm-3 control-label" for="demo-hor-inputemail">Deskripsi</label>
    <div class="col-sm-5">
    <input placeholder="Deskripsi" id="gaji_pokok"name="gaji_pokok"  class="form-control" type="text" > <span class="text-xs text-danger"></span>
    </div>
    </div>
    
     <div class="form-group">
      <label class="col-sm-3 control-label" for="demo-hor-inputemail">Gaji Pokok</label>
      <div class="col-sm-5">
      <input placeholder="0.00" id="gaji_pokok" class="form-control" type="text"> <span class="text-xs text-danger"></span>
      </div>
      </div>
      
      <div class="form-group">
      <label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Istri</label>
      <div class="col-sm-5">
      <input placeholder="0.00" id="t_istri" class="form-control" type="text"> <span class="text-xs text-danger"></span>
      </div>
      </div>
      
      <div class="form-group">
      <label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Anak</label>
      <div class="col-sm-5">
      <input placeholder="0.00" id="t_anak" class="form-control" type="text"> <span class="text-xs text-danger"></span>
      </div>
      </div>
      
      <div class="form-group">
      <label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Jabatan</label>
      <div class="col-sm-5">
      <input placeholder="0.00" id="t_jabatan" class="form-control" type="text"> <span class="text-xs text-danger"></span>
      </div>
      </div>
      
      <div class="form-group">
      <label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Fungsional</label>
      <div class="col-sm-5">
      <input placeholder="0.00" id="t_fungsional" class="form-control" type="text"> <span class="text-xs text-danger"></span>
      </div>
      </div>
      
      <div class="form-group">
      <label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Beras</label>
      <div class="col-sm-5">
      <input placeholder="0.00" id="t_beras" class="form-control" type="text"> <span class="text-xs text-danger"></span>
      </div>
      </div>
      
      <div class="form-group">
      <label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan PPH</label>
      <div class="col-sm-5">
      <input placeholder="0.00" id="t_pph" class="form-control" type="text"> <span class="text-xs text-danger"></span>
      </div>
      </div>
      
      
    </div>
</div>

</form>



<script>

 var idcell = getGridId(gridOptions_contoh1);
 $('#id_contoh1').val(idcell);
  

    window.setTimeout(function(){
        if(!empty($('#id_contoh1').val())){
    
        getJson(getdata_contoh1, url_api+'listdata?id='+idcell);
    }
    },500);
    


function getdata_contoh1(result){
    
    $('#nama').val(result.result[0].nama);
   // $('#id_edit_contoh1').val(result.result[0].id);
}


</script>