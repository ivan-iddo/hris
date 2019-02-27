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
        </i> Form User Group
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
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="btn-group pad-btm pad-top ">
                <button id="demo-bootbox-bounce" class="btn btn-primary btn-labeled fa fa-plus-square btn-sm">Add
                </button>
                <button class="btn btn-warning btn-labeled fa fa-edit btn-sm" onClick="proses_edit();">Edit
                </button>
                <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="proses_delete();">Delete
                </button>
                <div class="pull-right" style="margin-left: 90px">
                <input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="Search..." style="width: 200px;" type="search" id="search" onkeydown="if(event.keyCode=='13'){loaddata(0);}" ></label>
                </div>
              </div>

              <div id="myGrid" style="height: 400px;width:100%" class="ag-theme-balham">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="btn-group pad-btm pad-top">
                <button class="btn btn-success btn-labeled fa fa-check btn-sm" onClick="simpanDetail()">Save
                </button> 
              </div>
              <div id="myGridDetail" style="height: 400px;width:100%" class="ag-theme-balham">
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
  // specify the columns
  var columnDefs = [
    {
      headerName: "ID", field: "id", width: 150, filterParams:{
        newRowsAction: 'keep'}
    }
    ,
    {
      headerName: "Group", field: "nama", width: 150, filterParams:{
        newRowsAction: 'keep'}
    }
    ,
    {
      headerName: "Limit Jumlah Akun", field: "jumlah", width: 150, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "center"}
    }
  ];
  var columnDefsDetail = [
    {
      headerName: "Group", field: "nama_group",hide: true, width: 200, rowGroupIndex: 0}
    , 
    {
      headerName: "Front", field: "front", hide: true, width: 120,cellRenderer:checkboxCellRenderer}
    ,
    {
      headerName: "value", field: "front", hide: true, width: 120}
    ,
    {
      headerName: "id modul", field: "id_modul", hide: true,  width: 120},
       {
      headerName: "Save", field: "save", cellStyle: {textAlign: "center"},  width: 120, cellRenderer: checkboxCellRenderer
      },
      {
      headerName: "Edit", field: "edit", cellStyle: {textAlign: "center"},  width: 120, cellRenderer: checkboxCellRenderer
      },
      {
      headerName: "Delete", field: "delete", cellStyle: {textAlign: "center"},  width: 120, cellRenderer: checkboxCellRenderer},
       {
      headerName: "Approved", field: "approved", cellStyle: {textAlign: "center"},  width: 120, cellRenderer: checkboxCellRenderer
      },
       {
      headerName: "Unapproved", field: "unapproved", cellStyle: {textAlign: "center"},  width: 120, cellRenderer: checkboxCellRenderer
      }
      
      
     
     
  ];
  
   

  var gridOptions = {
    enableSorting: true,
    enableFilter: true,
    suppressRowClickSelection: false,
    onRowClicked: bukasetting,
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
  var gridOptionsDetail ={
    components: {
      fileCellRenderer: getFileCellRenderer()
    }
    ,
    columnDefs: columnDefsDetail,
    rowData: null, 
    rowSelection: 'multiple',
    groupSelectsChildren: true,
    groupSelectsFiltered: true,
    suppressAggFuncInHeader: true,
    enableFilter:true,
    groupDefaultExpanded: -1,
    getRowNodeId: function(data) {
      return data.id;
    }
    ,
    suppressRowClickSelection: true,
    autoGroupColumnDef: {
      headerName: "Menu", field: "nama", width: 400,
      cellRenderer:'agGroupCellRenderer',
      cellRendererParams: {
        checkbox: true,
        suppressCount: true 
      }
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
      submit_get(BASE_URL+'Appdata/deleteGroup/?id_group='+selectedRowsString,loaddata);
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
        url: BASE_URL+'Appdata/getgroup/?id='+selectedRowsString,
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
          $('#f_group_ket').val(res[0].ket);
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
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Group</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="Nama Group" id="f_group_group" class="form-control" type="text">';
      input +='<input placeholder="ID Group" id="id_group" style="display:none" class="form-control" type="text">';
      input += '</div>';
      input += '</div>';
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Jumlah Akun</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="Jumlah Akun" id="f_group_ket" class="form-control" type="text" onkeypress="return nomor(event,value)" > <span class="text-xs text-danger">*Numeric Only</span>';
      input += '</div>';
      input += '</div>';
      input += '</div>';
      input +='</form>';
      bootbox.dialog({
        title: "<i class=\"fa fa-users\"></i> Edit Group",
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
    var search = 0;
            if($('#search').val() !==''){
              search = $('#search').val();
            }
    $.ajax({
      url: BASE_URL+'Appdata/loaddataGroup/'+search+'/?id_modul=<?php
      echo $_GET['id_modul'];
      ?>',
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
          gridOptions.api.setRowData(data.result);
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
      url: BASE_URL+'Appdata/loaddataMenu/?id_group='+selectedRowsString,
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
        gridOptionsDetail.api.setRowData(data);
        gridOptionsDetail.api.forEachLeafNode(function(node,index) {
          //node.setExpanded(true);
          if(node.data.front==='1'){
            node.setSelected(true, false);
          }
        }
                                             );
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
    input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Group</label>';
    input +='<div class="col-sm-5">';
    input +='<input placeholder="Nama Group" id="f_group_group" class="form-control" type="text">';
    input +='<input placeholder="ID Group" id="id_group" style="display:none" class="form-control" type="text">';
    input += '</div>';
    input += '</div>';
    input +='<div class="form-group">';
    input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Jumlah Akun</label>';
    input +='<div class="col-sm-5">';
    input +='<input placeholder="Jumlah Akun" id="f_group_ket" class="form-control" type="text" onkeypress="return nomor(event,value)" > <span class="text-xs text-danger">*Numeric Only</span>';
    input += '</div>';
    input += '</div>';
    input += '</div>';
    input +='</form>';
    bootbox.dialog({
      title: "<i class=\"fa fa-users\"></i> Add New Group",
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
    group_ket       = $("#f_group_ket").get(0).value;
    id_group     = $("#id_group").get(0).value;
    if(!group_group){
      alert('Nama Group Tidak Boleh Kosong');
      return false;
    }
    else if((group_ket) ===''){
      alert('Jumlah Akun harus Berupa Numerik');
      return false;
    }
    else{
      var data = {
        group_aplikasi:group_aplikasi,                                                        
        group_group:group_group,
        group_ket:group_ket,
        id_group:id_group
      };
      var URL;
      if(action == 'add'){
        URL = BASE_URL+"Appdata/saveGroup";
      }
      else if(action == 'edit'){
        URL = BASE_URL+"Appdata/editGroup";
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
      selectedRowsString += selectedRow.id_modul+'|'+selectedRow.id;
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
        url: BASE_URL+'Appdata/addmenu',
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
