<form id="form-sys_user"  method="post" role="form" class="form-horizontal pad-all">
<div class="row pad-all">
<div class="panel-body">
    <input type="text" style="display:none" name="id_user" id="id_user" class="form-control"/><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">username</label>
							<div class="col-sm-7">
							<input type="text" name="username" id="username" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">password</label>
							<div class="col-sm-7">
							<input type="text" name="password" id="password" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">salt</label>
							<div class="col-sm-7">
							<input type="text" name="salt" id="salt" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">name</label>
							<div class="col-sm-7">
							<input type="text" name="name" id="name" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">email</label>
							<div class="col-sm-7">
							<input type="text" name="email" id="email" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">id aplikasi</label>
							<div class="col-sm-7">
							<input type="text" name="id_aplikasi" id="id_aplikasi" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">kode klinik</label>
							<div class="col-sm-7">
							<input type="text" name="kode_klinik" id="kode_klinik" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">id grup</label>
							<div class="col-sm-7">
							<input type="text" name="id_grup" id="id_grup" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">last login</label>
							<div class="col-sm-7">
							<input type="text" name="last_login" id="last_login" class="form-control"/>
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
					<label class="col-sm-2 control-label" for="inputstatus">created</label>
							<div class="col-sm-7">
							<input type="text" name="created" id="created" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">modified</label>
							<div class="col-sm-7">
							<input type="text" name="modified" id="modified" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">author</label>
							<div class="col-sm-7">
							<input type="text" name="author" id="author" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">id uk</label>
							<div class="col-sm-7">
							<input type="text" name="id_uk" id="id_uk" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">foto</label>
							<div class="col-sm-7">
							<input type="text" name="foto" id="foto" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">id uk group</label>
							<div class="col-sm-7">
							<input type="text" name="id_uk_group" id="id_uk_group" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">kd keluar</label>
							<div class="col-sm-7">
							<input type="text" name="kd_keluar" id="kd_keluar" class="form-control"/>
							</div>
							
					</div> 
					</div><div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">id shift</label>
							<div class="col-sm-7">
							<input type="text" name="id_shift" id="id_shift" class="form-control"/>
							</div>
							
					</div> 
					</div>
      
      
    </div>
</div>

</form>



<script>

 var idcell = getGridId(gridOptions_sys_user,'id_user');
 $('#id_user').val(idcell);
  

    window.setTimeout(function(){
        if(!empty($('#id_user').val())){
    
        getJson(getdata_sys_user, url_api+'listdata?id='+idcell);
    }
    },500);
    


function getdata_sys_user(result){
    
    
   // $('#id_edit_sys_user').val(result.result[0].id);
   $('#id_user').val(result.result[0].id_user);$('#username').val(result.result[0].username);$('#password').val(result.result[0].password);$('#salt').val(result.result[0].salt);$('#name').val(result.result[0].name);$('#email').val(result.result[0].email);$('#id_aplikasi').val(result.result[0].id_aplikasi);$('#kode_klinik').val(result.result[0].kode_klinik);$('#id_grup').val(result.result[0].id_grup);$('#last_login').val(result.result[0].last_login);$('#status').val(result.result[0].status);$('#created').val(result.result[0].created);$('#modified').val(result.result[0].modified);$('#author').val(result.result[0].author);$('#id_uk').val(result.result[0].id_uk);$('#foto').val(result.result[0].foto);$('#id_uk_group').val(result.result[0].id_uk_group);$('#kd_keluar').val(result.result[0].kd_keluar);$('#id_shift').val(result.result[0].id_shift);
}


</script>