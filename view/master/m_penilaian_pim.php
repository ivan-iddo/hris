<?php $nama_modul='kpi/mpenilaian';?>
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
        </i> Form Taksonomi
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
            <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="btn-group pad-btm pad-top ">
                <button id="demo-bootbox-bounce" class="btn btn-primary btn-labeled fa fa-plus-square btn-sm">Add
                </button>
                <button class="btn btn-warning btn-labeled fa fa-edit btn-sm" onClick="proses_edit();">Edit
                </button>
                <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="proses_delete();">Delete
                </button>
              </div>
              <h4>Indikator Kerja</h4>
              <div id="myGrid" style="height: 400px;width:100%" class="ag-theme-balham">
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="btn-group pad-btm pad-top">
               <button id="addDetail" class="btn btn-primary btn-labeled fa fa-plus-square btn-sm">Add
                </button>
                <button class="btn btn-warning btn-labeled fa fa-edit btn-sm" onClick="proses_edit_item();">Edit
                </button>
                <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="proses_delete_item();">Delete
                </button>
              </div>
              <h4>Sub Indikator Kerja</h4>
              <div id="myGridDetail" style="height: 400px;width:100%" class="ag-theme-balham">
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="btn-group pad-btm pad-top">
               <button id="addDetailSub" class="btn btn-primary btn-labeled fa fa-plus-square btn-sm">Add
                </button>
                <button class="btn btn-warning btn-labeled fa fa-edit btn-sm" onClick="proses_edit_sub();">Edit
                </button>
                <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="proses_delete_sub();">Delete
                </button>
              </div>
              <h4>Kegiatan</h4>
              <div id="myGridSubDetail" style="height: 400px;width:100%" class="ag-theme-balham">
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
      headerName: "Nama", field: "nama", width: 180, filterParams:{
        newRowsAction: 'keep'}
    } ,{
      headerName: "Profesi", field: "deskripsi", width: 80, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "left"}
    }
  ];
  
  
  var columnDefsDetail = [
    
   
    {
      headerName: "Nama", field: "nama", width: 180, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "left"}
    }, {
      headerName: "Bobot (%)", field: "deskripsi", width: 250, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "left"}
    }
      
     
     
  ];
  
  var SubBagiabCol = [
    
    
    {
      headerName: "Nama", field: "nama", width: 250, filterParams:{
        newRowsAction: 'keep'}
      ,cellStyle: {
        textAlign: "left"}
    } 
      
     
     
  ];
  
   

  var gridOptions = {
    enableSorting: true,
    enableFilter: true,
    suppressRowClickSelection: false,
    onRowClicked: bukasetting,
    onRowDoubleClicked:proses_edit,
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
      editable: false ,
      
      enableRowGroup:true,
               enablePivot:true,
               enableValue:true
    }
  };
  
  var gridOptionsDetail = {
    enableSorting: true,
    enableFilter: true,
    suppressRowClickSelection: false,
    columnDefs: columnDefsDetail,
    onRowDoubleClicked:proses_edit_item,
    onRowClicked: listSubBagian,
    groupSelectsChildren: true,
    debug: true,
    rowSelection: 'single',
    enableColResize: true,
    rowGroupPanelShow: 'always',
    pivotPanelShow: 'always',
    enableRangeSelection: true,
    columnDefs: columnDefsDetail,
    pagination: false ,
    defaultColDef:{
      editable: false 
    },
    getRowNodeId: function(data) {
      return data.id;
    }
  };
  
  var gridSubBagian = {
    enableSorting: true,
    enableFilter: true,
    suppressRowClickSelection: false,
    columnDefs: SubBagiabCol,
    onRowDoubleClicked:proses_edit_sub,
    groupSelectsChildren: true,
    debug: true,
    rowSelection: 'single',
    enableColResize: true,
    rowGroupPanelShow: 'always',
    pivotPanelShow: 'always',
    enableRangeSelection: true,
    columnDefs: SubBagiabCol,
    pagination: false ,
    defaultColDef:{
      editable: false 
    } 
  };
  
   var gridDivsub = document.querySelector('#myGridSubDetail');
  new agGrid.Grid(gridDivsub, gridSubBagian);
   
  
  
   
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
      submit_get(BASE_URL+'<?php echo $nama_modul?>/delete_detail/?id_group='+selectedRowsString,bukasetting);
      //loaddata();
    }
  }
  
  function proses_delete_sub(){
    var selectedRows = gridSubBagian.api.getSelectedRows();
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
      submit_get(BASE_URL+'<?php echo $nama_modul?>/delete_detail/?id_group='+selectedRowsString,listSubBagian);
      //loaddata();
    }
  }
  
  function proses_edit(){
    var selectedRows = gridOptions.api.getSelectedRows();
    // alert('>>'+selectedRows+'<<<');
    if(selectedRows == ''){
      onMessage('Silahkan Pilih Direktorat Terlebih dahulu!');
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
        url: BASE_URL+'<?php echo $nama_modul?>/getitemkpi/?id='+selectedRowsString,
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
         // $('#f_group_ket').val(res[0].deskripsi);
          $('#id_group').val(res[0].id);
          getOptionsEdit('f_group_ket',BASE_URL+'master/getmaster?id=42',res[0].profesi);
          // gridOptions.api.setRowData(data);
        }
        ,
        error: function( jqXhr, textStatus, errorThrown ){
          alert('error');
        }
      }
            );
      var input='<form class="form-horizontal">';
      input += '<div class="panel-body mar-all">';
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="" id="f_group_group" class="form-control" type="text">';
      input +='<input placeholder="ID Group" id="id_group" style="display:none" class="form-control" type="text">';
      input += '</div>';
      input += '</div>';
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail"> Profesi</label>';
      input +='<div class="col-sm-5">';
      input +='<select  id="f_group_ket" class="form-control" type="text"> </select>';
      input += '</div>';
      input += '</div>';
      input += '</div>';
      input +='</form>';
      bootbox.dialog({ 
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
  
  
  function proses_edit_item(){
    var selectedRows = gridOptionsDetail.api.getSelectedRows();
    // alert('>>'+selectedRows+'<<<');
    if(selectedRows == ''){
      onMessage('Silahkan Pilih Bagian Terlebih dahulu!');
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
        url: BASE_URL+'<?php echo $nama_modul?>/getitemdetail/?all=true&id='+selectedRowsString,
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
          $('#f_group_ket').val(res[0].deskripsi);
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
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="" id="f_group_group" class="form-control" type="text">';
      input +='<input placeholder="ID Group" id="id_group" style="display:none" class="form-control" type="text">';
      input += '</div>';
      input += '</div>';
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Bobot (%)</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="" id="f_group_ket" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      input += '</div>';
      input +='</form>';
      bootbox.dialog({ 
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
              if(simpanDetail('edit')){
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
  
  
  function proses_edit_sub(){
    var selectedRows = gridSubBagian.api.getSelectedRows();
    // alert('>>'+selectedRows+'<<<');
    if(selectedRows == ''){
      onMessage('Silahkan Pilih Sub Bagian Terlebih dahulu!');
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
        url: BASE_URL+'<?php echo $nama_modul?>/getitemdetail/?all=true&id='+selectedRowsString,
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
          $('#f_group_ket').val(res[0].deskripsi);
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
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="" id="f_group_group" class="form-control" type="text">';
      input +='<input placeholder="ID Group" id="id_group" style="display:none" class="form-control" type="text">';
      input += '</div>';
      input += '</div>';
      input +='<div class="form-group">';
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Bobot (%)</label>';
      input +='<div class="col-sm-5">';
      input +='<input placeholder="" id="f_group_ket" class="form-control" type="text"> <span class="text-xs text-danger"></span>';
      input += '</div>';
      input += '</div>';
      input += '</div>';
      input +='</form>';
      bootbox.dialog({ 
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
              if(simpanDetailSub('edit')){
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
  
  
  function getdata(result){
    gridOptions.api.setRowData(result); 
  }

  function loaddata(){
    getJson(getdata,BASE_URL+'<?php echo $nama_modul?>/getitemkpi?child=17');
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
          if(node.data.front==='1'){
            node.setSelected(true, false);
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
  
  function listSubBagian(){
    var selectedRows = gridOptionsDetail.api.getSelectedRows();
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
        gridSubBagian.api.setRowData(data);
        gridSubBagian.api.forEachLeafNode(function(node,index) {
          //node.setExpanded(true);
          if(node.data.front==='1'){
            node.setSelected(true, false);
          }
        }
                                             );
        }else{
          gridSubBagian.api.setRowData([]);
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
    getOptions("f_group_ket",BASE_URL+"master/getmaster?id=42");
    var input='<form class="form-horizontal">';
    input += '<div class="panel-body">';
    input +='<div class="form-group">';
    input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Kategori Dokumen</label>';
    input +='<div class="col-sm-5">';
    input +='<input placeholder="" id="f_group_group" class="form-control" type="text">';
    
    input +='<input placeholder="ID Group" id="id_parent" style="display:none" class="form-control" type="text" value="1">';
    
    input +='<input placeholder="ID Group" id="id_group" style="display:none" class="form-control" type="text">';
    input += '</div>';
    input += '</div>';
    input +='<div class="form-group">';
    input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Profesi</label>';
    input +='<div class="col-sm-5">';
    input +='<select  id="f_group_ket" name="f_group_ket" class="form-control" type="text" ></select>';
    input += '</div>';
    input += '</div>';
    input += '</div>';
    input +='</form>';
    bootbox.dialog({ 
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
  
  $('#addDetail').on('click', function(){
     var selectedRows = gridOptions.api.getSelectedRows();
    // alert('>>'+selectedRows+'<<<');
    if(selectedRows == ''){
      onMessage('Silahkan Pilih Direktorat Terlebih dahulu!');
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
    }
    var input='<form class="form-horizontal">';
    input += '<div class="panel-body mar-all pad-all">';
    input +='<div class="form-group">';
    input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama</label>';
    input +='<div class="col-sm-5">';
    input +='<input placeholder="" id="f_group_group" class="form-control" type="text">';
    input +='<input placeholder="ID Group" id="id_group" style="display:none" class="form-control" type="text">';
    input += '</div>';
    input += '</div>';
    input +='<div class="form-group">';
    input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Bobot (%)</label>';
    input +='<div class="col-sm-5">';
    input +='<input placeholder="" id="f_group_ket" class="form-control" type="text" > <span class="text-xs text-danger"></span>';
    input += '</div>';
    input += '</div>';
    input += '</div>';
    input +='</form>';
    bootbox.dialog({ 
      message:input, 
      animateIn: 'bounceIn',
      animateOut : 'bounceOut',
      buttons: {
        success: {
          label: "Save",
          className: "btn-primary",
          callback: function() {
            if(simpanDetail('add')){
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
  
  $('#addDetailSub').on('click', function(){
     var selectedRows = gridOptionsDetail.api.getSelectedRows();
    // alert('>>'+selectedRows+'<<<');
    if(selectedRows == ''){
      onMessage('Silahkan Pilih Bagian Terlebih dahulu!');
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
    }
    var input='<form class="form-horizontal">';
    input += '<div class="panel-body mar-all pad-all">';
    input +='<div class="form-group">';
    input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama</label>';
    input +='<div class="col-sm-5">';
    input +='<input placeholder="" id="f_group_group" class="form-control" type="text">';
    input +='<input placeholder="ID Group" id="id_group" style="display:none" class="form-control" type="text">';
    input += '</div>';
    input += '</div>';
    input +='<div class="form-group">';
    input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail"></label>';
    input +='<div class="col-sm-5">';
    input +='<input placeholder="" id="f_group_ket" class="form-control" type="text" style="display:none" > <span class="text-xs text-danger"></span>';
    input += '</div>';
    input += '</div>';
    input += '</div>';
    input +='</form>';
    bootbox.dialog({ 
      message:input, 
      animateIn: 'bounceIn',
      animateOut : 'bounceOut',
      buttons: {
        success: {
          label: "Save",
          className: "btn-primary",
          callback: function() {
            if(simpanDetailSub('add')){
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
    id_parent = 17; //rubah disini aja
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
        id_parent:id_parent
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
  
  
  function simpanDetail(action){
    var selectedRows = gridOptions.api.getSelectedRows();
    var selectedRowsString = '';
    selectedRows.forEach( function(selectedRow, index) {
      if (index!==0) {
        selectedRowsString += ', ';
      }
      selectedRowsString += selectedRow.id;
    }
                        );
    
     group_aplikasi	= '1';
    group_group     = $("#f_group_group").get(0).value;
    group_ket       = $("#f_group_ket").get(0).value;
    id_group     = $("#id_group").get(0).value;
    id_parent = selectedRowsString;
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
        id_parent:id_parent
      };
      var URL;
      if(action == 'add'){
        URL = BASE_URL+"<?php echo $nama_modul?>/save";
      }
      else if(action == 'edit'){
        URL = BASE_URL+"<?php echo $nama_modul?>/edit_detail";
      }
      save(URL,data,bukasetting);
      return true;
    }
  }
  
  function simpanDetailSub(action){
    var selectedRows = gridOptionsDetail.api.getSelectedRows();
    var selectedRowsString = '';
    selectedRows.forEach( function(selectedRow, index) {
      if (index!==0) {
        selectedRowsString += ', ';
      }
      selectedRowsString += selectedRow.id;
    }
                        );
    
     group_aplikasi	= '1';
    group_group     = $("#f_group_group").get(0).value;
    group_ket       = $("#f_group_ket").get(0).value;
    id_group     = $("#id_group").get(0).value;
    id_parent = selectedRowsString;
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
        id_parent:id_parent
      };
      var URL;
      if(action == 'add'){
        URL = BASE_URL+"<?php echo $nama_modul?>/save";
      }
      else if(action == 'edit'){
        URL = BASE_URL+"<?php echo $nama_modul?>/edit_detail";
      }
      save(URL,data,listSubBagian);
      return true;
    }
  }
</script>
<script src="js/login.js">
</script>
