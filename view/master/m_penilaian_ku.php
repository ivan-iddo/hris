<?php $nama_modul='kpi/mpenilaian';?>
<?php
require_once('../../connectdb.php');
?>
<?php 
   $query= mysqli_query($con,'SELECT count(m_penilaian_kpi.id_grup) as jml, sum(his_kpi_detail.bobot) as bobot_kpi FROM m_penilaian_kpi LEFT JOIN his_kpi_detail ON m_penilaian_kpi.id_grup=his_kpi_detail.id_kegiatan where m_penilaian_kpi.kode=96 and m_penilaian_kpi.child=5 and m_penilaian_kpi.tampilkan="1"');
	$rowcount=mysqli_num_rows($query);
   if(!empty($rowcount)){
   while($row = mysqli_fetch_array($query)){
        $total = $row['jml'];
        $bob = $row['bobot_kpi'];
    }
    }
?>
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
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="btn-group pad-btm pad-top">
                <button id="demo-bootbox-bounce" class="btn btn-primary btn-labeled fa fa-plus-square btn-sm" onClick="demo-bootbox-bounce">Add
                </button>
                <button class="btn btn-warning btn-labeled fa fa-edit btn-sm" onClick="proses_edit();">Edit
                </button>
                <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="proses_delete();">Delete
                </button>
              </div>
              <h4>Indikator Kerja</h4>
              <input placeholder="" id="nilai" class="form-control" value="<?php echo $total?>" type="text" style="display:none">
			  <input placeholder="" id="bobot_kpi" class="form-control" value="<?php echo $bob?>" type="text" style="display:none"> 
			  <div id="myGrid" style="height: 400px;width:100%" class="ag-theme-balham">
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
  var columnDefs = [
      
    
    {
      headerName: "Id", field: "id", width: 190, filterParams:{
        newRowsAction: 'keep'}
    },
	 {
      headerName: "Nama", field: "nama", width: 400, filterParams:{
        newRowsAction: 'keep'}
    },{
      headerName: "Bobot", field: "no", width: 210, filterParams:{
        newRowsAction: 'keep'}
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
    rowGroupPanelShow: 'no',
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
 
   var gridDivsub = document.querySelector('#myGrid');
  new agGrid.Grid(gridDivsub, gridOptions);
   
  
  
   
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
		  getOptionsEdit('f_group_bot',BASE_URL+'master/getbobot',res[0].no);
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
      input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Bobot</label>';
      input +='<div class="col-sm-5">';
      input +='<select  id="f_group_bot" name="f_group_bot" class="form-control" type="text" ></select>';
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
 
  function agGroupCellRenderer(params){
    var input = document.createElement("input");
    input.type = "checkbox";
    var booleancheck = true;
    input.checked = booleancheck;
    return input;
  }
  
  function getdata(result){
    gridOptions.api.setRowData(result); 
  }

  function loaddata(){
    getJson(getdata,BASE_URL+'<?php echo $nama_modul?>/getitemkpi?child=5');
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
	getOptions("f_group_bot",BASE_URL+"master/getbobot");
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
    input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Bobot</label>';
    input +='<div class="col-sm-5">';
    input +='<select  id="f_group_bot" name="f_group_bot" class="form-control" type="text" ></select>';
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

  function simpan(action){
    group_aplikasi	= '1';
    group_group     = $("#f_group_group").get(0).value;
    id_group     = $("#id_group").get(0).value;
    id_parent = 5; //rubah disini aja
	pilih=($("#f_group_bot").get(0).value);
	nilai=$("#nilai").get(0).value;
	ambil=$("#bobot_kpi").get(0).value;
	if(nilai>=20){
	   onMessage('Parameter Mencapai Max!');
      return false;
    }else{
	if(pilih+ambil>=100){
	   onMessage('Total Max bobot 100 %!');
      return false;
    }else{
	if(!group_group){
      alert('Nama Kategori Tidak Boleh Kosong');
      return false;
    }
    else{
      var data = {
        group_aplikasi:group_aplikasi,                                                        
        group_group:group_group,
        id_group:id_group,
        bobot_ambil:bobot_ambil,
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

  }}}
 
</script>
<script src="js/login.js">
</script>
