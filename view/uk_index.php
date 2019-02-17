<?php $nama_modul='uk_index';?>
<div class="tab-base">
  <!--Nav Tabs-->
  <ul class="nav nav-tabs">
    <li>
      <a data-toggle="tab" href="#demo-lft-tab-1">
        <i class="demo-psi-home">
        </i> Home
      </a>
    </li>
    <li class="active">
      <a data-toggle="tab" href="#demo-lft-tab-2">
        <i class="demo-psi-pen-5">
        </i> Form Jabatan
      </a>
    </li>
    <li>
      <a data-toggle="tab" href="#demo-lft-tab-3"> 
        <i class="demo-psi-idea-2">
        </i> Help
      </a>
    </li>
  </ul>
  <!--Tabs Content-->
  <div class="tab-content">
    <div id="demo-lft-tab-1" class="tab-pane fade ">
    </div>
    <div id="demo-lft-tab-2" class="tab-pane fade active in">
      <div class="panel-body">
        <div class="bootstrap-table">
          <div class="fixed-table-container " style="padding-bottom: 0px;">
            <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="btn-group pad-btm pad-top ">
                <button id="demo-bootbox-bounce" class="btn btn-primary btn-labeled fa fa-plus-square btn-sm">Add
                </button>
                <button class="btn btn-warning btn-labeled fa fa-edit btn-sm" onClick="proses_edit();">Edit
                </button>
                <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="proses_delete();">Delete
                </button>
              </div>
              <div id="myGrid" style="height: 400px;width:100%" class="ag-theme-balham">
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
             
              
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="demo-lft-tab-3" class="tab-pane fade ">
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8">
$('.judul-menu').html('Master Jabatan');
  // specify the columns
  var columnDefs = [
      
    {
      headerName: "ID", field: "id", width: 80, filterParams:{
        newRowsAction: 'keep'}
    }
    ,
    {
      headerName: "Nama Jabatan", field: "nama", width: 150, filterParams:{
        newRowsAction: 'keep'}
    }
    ,
    {
      headerName: "Gaji Pokok", field: "gaji_pokok", width: 100, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "left"}
    },
    {
      headerName: "T.Istri", field: "tunjangan_istri", width: 100, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "left"}
    },
    {
      headerName: "T.Anak", field: "tunjangan_anak", width: 100, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "left"}
    },
    {
      headerName: "T.jabatan", field: "tunjangan_jabatan", width: 100, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "left"}
    },
    {
      headerName: "T.Fungsional", field: "tunjangan_fungsional", width: 100, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "left"}
    },
    {
      headerName: "T.Beras", field: "tunjangan_beras", width: 100, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "left"}
    },
    {
      headerName: "T.PPH", field: "tunjangan_pph", width: 100, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "left"}
    },
    {
      headerName: "TOTAL GAJI", field: "total", width: 100, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "left"}
    }
  ];
  var columnDefsDetail = [
    
     {
        headerName: 'Tipe Dokumen',
        field: 'nama_group',
        width: 380
    }, 
    {
      headerName: "ID", field: "id",hide: true, width: 80, filterParams:{
        newRowsAction: 'keep'}
    }
    
      
     
     
  ];
  
   

  var gridOptions = {
    enableSorting: true,
    enableFilter: true,
    suppressRowClickSelection: false, 
    groupSelectsChildren: true,
    debug: true,
    rowSelection: 'single',
    enableColResize: true,
    rowGroupPanelShow: 'always',
    pivotPanelShow: 'always',
    enableRangeSelection: true,
    columnDefs: columnDefs,
    pagination: false ,
    defaultColDef:{
      editable: false 
    }
  };
  
  var gridOptionsDetail = {
    columnDefs: columnDefsDetail,
    rowSelection: 'multiple',
    rowMultiSelectWithClick: true,
    getRowNodeId: function(data) {
      return data.id;
    }
    
  };
  
  
  
  
   
  function proses_delete(){
    var selectedRows = gridOptions.api.getSelectedRows();
    // alert('>>'+selectedRows+'<<<');
    if(selectedRows == ''){
      onMessage('Silahkan Pilih Data Terlebih dahulu!');
      return false;
    }
    else{
      var selectedRowsString = '';
      selectedRows.forEach( function(selectedRow, index) {
        if (index!==0) {
          selectedRowsString += ', ';
        }
        selectedRowsString += selectedRow.id;
      }
                          );
      submit_get(BASE_URL+'<?php echo $nama_modul?>/delete/?id_group='+selectedRowsString,loaddata);
      //loaddata();
    }
  }
  
  function proses_delete_item(){
    var selectedRows = gridOptionsDetail.api.getSelectedRows();
    // alert('>>'+selectedRows+'<<<');
    if(selectedRows == ''){
      onMessage('Silahkan Pilih Data Terlebih dahulu!');
      return false;
    }
    else{
      var selectedRowsString = '';
      selectedRows.forEach( function(selectedRow, index) {
        if (index!==0) {
          selectedRowsString += ', ';
        }
        selectedRowsString += selectedRow.id;
      }
                          );
      submit_get(BASE_URL+'<?php echo $nama_modul?>/delete/?id_group='+selectedRowsString,bukasetting);
      //loaddata();
    }
  }
  
  function proses_edit(){
    var selectedRows = gridOptions.api.getSelectedRows();
    // alert('>>'+selectedRows+'<<<');
    if(selectedRows == ''){
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
      return false;
    }
    else{
      var selectedRowsString = '';
      selectedRows.forEach( function(selectedRow, index) {
        if (index!==0) {
          selectedRowsString += ', ';
        }
        selectedRowsString += selectedRow.id;
      }
                          );
      $.ajax({
        url: BASE_URL+'<?php echo $nama_modul?>/getitem/?id='+selectedRowsString,
        headers: {
          'Authorization': localStorage.getItem("Token"),
          'X_CSRF_TOKEN':'donimaulana',
          'Content-Type':'application/json'
        }
        ,
        dataType: 'json',
        type: 'get',
        contentType: 'application/json', 
        processData: false,
        success: function( res, textStatus, jQxhr ){
          $('#f_group_group').val(res[0].nama);
          $('#gaji_pokok').val(res[0].deskripsi);
           $('#t_anak').val(res[0].tunjangan_anak);
           $('#t_istri').val(res[0].tunjangan_istri);
           $('#t_jabatan').val(res[0].tunjangan_jabatan);
           $('#t_fungsional').val(res[0].tunjangan_fungsional);
           $('#t_pph').val(res[0].tunjangan_pph);
           $('#t_beras').val(res[0].tunjangan_beras);
          $('#id_group').val(res[0].id);
          // gridOptions.api.setRowData(data);
        }
        ,
        error: function( jqXhr, textStatus, errorThrown ){
          alert('error');
        }
      }
            );
      var input='<form class="form-horizontal">';
      input += '<div class="panel-body">';
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Jabatan</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="Nama Group" id="f_group_group" class="form-control" type="text">';
      input +='<input placeholder="ID Group" id="id_group" style="display:none" class="form-control" type="text">';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Gaji Pokok</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="gaji_pokok" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Istri</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="t_istri" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Anak</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="t_anak" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Jabatan</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="t_jabatan" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Fungsional</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="t_fungsional" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Beras</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="t_beras" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan PPH</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="t_pph" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
       
      
      
      input += '</div>';
      input +='</form>';
      bootbox.dialog({
        title: "<i class=\"fa fa-users\"></i> Edit Jabatan",
        message:input, 
        animateIn: 'bounceIn',
        animateOut : 'bounceOut',
        buttons: {
          success: {
            label: "Save",
            className: "btn-primary",
            callback: function() {
              var name = $('#name').val();
              var answer = $("input[name='awesomeness']:checked").val();
              if(simpan('edit')){
                return true;
              }
              else{
                return false;
              }
            }
          }
          ,
          main: {
            label: "Cancel",
            className: "btn-warning",
            callback: function() {
              $.niftyNoty({
                type: 'dark',
                message : "Bye Bye",
                container : 'floating',
                timer : 5000
              }
                         );
            }
          }
        }
      }
                    );
    }
  }
  
  
   
  
  function agGroupCellRenderer(params){
    var input = document.createElement("input");
    input.type = "checkbox";
    var booleancheck = true;
    input.checked = booleancheck;
    return input;
  }
  // setup the grid after the page has finished loading 
  var gridDiv = document.querySelector('#myGrid');
  new agGrid.Grid(gridDiv, gridOptions);
  // do http request to get our sample data - not using any framework to keep the example self contained.
  // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
  function loaddata(){
    $.ajax({
      url: BASE_URL+'<?php echo $nama_modul?>/getitem',
      headers: {
      'Authorization': localStorage.getItem("Token"),
      'X_CSRF_TOKEN':'donimaulana',
      'Content-Type':'application/json'
    }
           ,
           dataType: 'json',
           type: 'get',
           contentType: 'application/json', 
           processData: false,
           success: function( data, textStatus, jQxhr ){
            if(data.result !== 'empty'){
                    gridOptions.api.setRowData(data);
            }else{
              gridOptions.api.setRowData([]);
            }
    }
    ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
  }
  );
  }
  loaddata();
  
  function bukasetting(){
    
    var selectedRows = gridOptions.api.getSelectedRows();
    var selectedRowsString = '';
    selectedRows.forEach( function(selectedRow, index) {
      if (index!==0) {
        selectedRowsString += ', ';
      }
      selectedRowsString += selectedRow.id;
    }
                        );
    //  alert(selectedRowsString);
    $.ajax({
      url: BASE_URL+'<?php echo $nama_modul?>/getgroup/?id='+selectedRowsString,
      headers: {
        'Authorization': localStorage.getItem("Token"),
        'X_CSRF_TOKEN':'donimaulana',
        'Content-Type':'application/json'
      }
      ,
      dataType: 'json',
      type: 'get',
      contentType: 'application/json', 
      processData: false,
      success: function( data, textStatus, jQxhr ){
        if(data.result !=='empty'){
        gridOptionsDetail.api.setRowData(data);
        gridOptionsDetail.api.forEachLeafNode(function(node,index) {
          //node.setExpanded(true); 
          if(node.data.ada==='1'){
            node.setSelected(true);
          }
        }
                                             );
        }else{
          gridOptionsDetail.api.setRowData([]);
        }
      }
      ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
    }
          );
  }
  var gridDivDetail = document.querySelector('#myGridDetail');
  new agGrid.Grid(gridDivDetail, gridOptionsDetail);
  
  function checkboxCellRenderer (params){
    var input = document.createElement("input");
    input.type = "checkbox";
    var booleancheck = false;
    if(params.value ==='1'){
      booleancheck = true;
    }
    input.checked = booleancheck;
    return input;
  }
  
   
  
  function getFileCellRenderer (params){
    var input = document.createElement("input");
    input.type = "checkbox";
    var booleancheck = true;
    input.checked = booleancheck;
    return input;
  }
  
  $('#demo-bootbox-bounce').on('click', function(){
    var input='<form class="form-horizontal">';
    input += '<div class="panel-body">';
    input +='<div class="form-group">';
    input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Jabatan</label>';
    input +='<div class="col-sm-5">';
    input +='<input placeholder="Nama Kategori" id="f_group_group" class="form-control" type="text">';
    input +='<input placeholder="ID Group" id="id_group" style="display:none" class="form-control" type="text">';
    input += '</div>';
    input += '</div>';
    input +='<div class="form-group">';
    input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Deskripsi</label>';
    input +='<div class="col-sm-5">';
    input +='<input placeholder="Deskripsi" id="gaji_pokok" class="form-control" type="text" > <span class="text-xs text-danger"></span>';
    input += '</div>';
    input += '</div>';
    
     input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Gaji Pokok</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="gaji_pokok" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Istri</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="t_istri" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Anak</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="t_anak" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Jabatan</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="t_jabatan" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Fungsional</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="t_fungsional" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan Beras</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="t_beras" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tunjangan PPH</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="0.00" id="t_pph" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      
      
    input += '</div>';
    input +='</form>';
    bootbox.dialog({
      title: "<i class=\"fa fa-users\"></i> Tambah Jabatan",
      message:input, 
      animateIn: 'bounceIn',
      animateOut : 'bounceOut',
      buttons: {
        success: {
          label: "Save",
          className: "btn-primary",
          callback: function() {
            if(simpan('add')){
              return true;
            }
            else{
              return false;
            }
          }
        }
        ,
        main: {
          label: "Cancel",
          className: "btn-warning",
          callback: function() {
            $.niftyNoty({
              type: 'dark',
              message : "Bye Bye",
              container : 'floating',
              timer : 5000
            }
                       );
          }
        }
      }
    }
                  );
  }
                              );
  
   
  function simpan(action){
    group_aplikasi	= '1';
    group_group     = $("#f_group_group").get(0).value;
    group_ket       = $("#gaji_pokok").get(0).value;
    id_group     = $("#id_group").get(0).value;
    t_anak = $("#t_anak").get(0).value;
    t_istri = $("#t_istri").get(0).value;
    t_jabatan = $("#t_jabatan").get(0).value;
    t_fungsional = $("#t_fungsional").get(0).value;
    t_pph = $("#t_pph").get(0).value;
    t_beras = $("#t_beras").get(0).value;
    
    id_parent = 0;
    if(!group_group){
      alert('Nama Kategori Tidak Boleh Kosong');
      return false;
    } 
    else{
      var data = {
        group_aplikasi:group_aplikasi,                                                        
        group_group:group_group,
        group_ket:group_ket,
        id_group:id_group,
        id_parent:id_parent,
        t_anak :t_anak,
        t_istri : t_istri,
        t_jabatan : t_jabatan,
        t_fungsional : t_fungsional ,
        t_pph :t_pph,
        t_beras : t_beras
      };
      var URL;
      if(action == 'add'){
        URL = BASE_URL+"<?php echo $nama_modul?>/save";
      }
      else if(action == 'edit'){
        URL = BASE_URL+"<?php echo $nama_modul?>/edit";
      }
      save(URL,data,loaddata);
      return true;
    }
  }
  
  
   function simpanDetail(){
    var selectedRows = gridOptionsDetail.api.getSelectedRows();
    var selectedRowsString = '';
    selectedRows.forEach( function(selectedRow, index) {
      if (index!==0) {
        selectedRowsString += ', ';
      }
      selectedRowsString += selectedRow.id;
    }
                        );
    
    var selectedRowsp = gridOptions.api.getSelectedRows();
    var selectedRowsStringp = '';
    selectedRowsp.forEach( function(selectedRowp, index) {
      if (index!==0) {
        selectedRowsStringp += ', ';
      }
      selectedRowsStringp += selectedRowp.id;
    }
                         );
    var id_group = selectedRowsStringp;
    var id_menu = selectedRowsString;
    if(id_group==''){
      $.niftyNoty({
        type: 'danger',
        title: 'Error',
        message: 'Pilih Group Terlebih dahulu',
        container: 'floating',
        timer: 5000
      }
                 );
      return false;
    }
    else if(id_menu==''){
      $.niftyNoty({
        type: 'danger',
        title: 'Error',
        message: 'Tidak ada menu untuk disimpan',
        container: 'floating',
        timer: 5000
      }
                 );
      return false;
    }
    else{
      var data = {
        id_group:id_group,                                                        
        id_menu:id_menu  
      };
      var hasil;
      var message;
      $.ajax({
        url: BASE_URL+'<?php echo $nama_modul?>/addmenu',
        headers: {
          'Authorization': localStorage.getItem("Token"),
          'X_CSRF_TOKEN':'donimaulana',
          'Content-Type':'application/json'
        }
        ,
        dataType: 'json',
        type: 'post',
        contentType: 'application/json', 
        processData: false,
        data:JSON.stringify(data),
        success: function( data, textStatus, jQxhr ){
          hasil=data.hasil;
          message=data.message;
          if(hasil=="success"){
            $.niftyNoty({
              type: 'success',
              title: 'Success',
              message: message,
              container: 'floating',
              timer: 5000
            }
                       );
            //loaddata();
          }
          else{
            $.niftyNoty({
              type: 'danger',
              title: 'Error',
              message: message,
              container: 'floating',
              timer: 5000
            }
                       );
          }
        }
        ,
        error: function( jqXhr, textStatus, errorThrown ){
          $.niftyNoty({
            type: 'danger',
            title: 'Warning!',
            message: message,
            container: 'floating',
            timer: 5000
          }
                     );
        }
      }
            );
    }
  }
</script>
<script src="js/login.js">
</script>
