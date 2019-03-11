<?php session_start();?>

<div class="tab-base">
  <!--Nav Tabs-->
  <ul class="nav nav-tabs">
      <li>
				<a href="#demo-lft-tab-1" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-laptop fa-2x text-danger"></i> 
						</span>
						View Data Warning Kontrak
					</a>
			</li>

      <li class="active">
				<a href="#demo-lft-tab-2" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-laptop fa-2x text-danger"></i> 
						</span>
						View Data Warning STR
					</a> 
			</li>

      <li> 
			   <a href="#demo-lft-tab-3" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-laptop fa-2x text-danger"></i> 
						</span>
						View Data Warning SIP
					</a> 
			</li>
    </ul>
  <!--Tabs Content-->
  <div class="tab-content">
    <div id="demo-lft-tab-1" class="tab-pane fade ">
      <div class="panel-body">
        <div class="bootstrap-table">
          <div class="fixed-table-container " style="padding-bottom: 0px;">
            <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12">
                
                <div class="row">  
                  <div class="col-md-6">              
                    <div class="box box-primary"> 
                      <div class="box-body">
                        <div class="row pad-top"> 

                          <div class="form-group">
                              <label class="col-sm-2 control-label" for="txtdarikontrak">Dari</label>
                              <div class="col-sm-3">
                                 <input class="form-control datepickerbootstrap" type="text" id="txtdarikontrak" name="txtdarikontrak">
                              </div>
                          </div>
                        </div>  
                        <div class="row pad-top"> 

                          <div class="form-group">
                              <label class="col-sm-2 control-label" for="txtsampaikontrak">Sampai</label>
                              <div class="col-sm-3">
                                 <input class="form-control datepickerbootstrap" type="text" id="txtsampaikontrak" name="txtsampaikontrak">
                              </div>
                          </div>
                        </div> 
                        <?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
                        <div class="admininput">
                          <div class="row pad-top"> 
                            <div class="form-group">
                            <label class="col-sm-2 control-label" for="txtdirektoratkontrak">Unit Kerja</label>
                              <div class="col-sm-7">
                                <select class="form-control select-chosen" id="txtdirektoratkontrak" name="txtdirektoratkontrak" style="width: 100%;">
                                </select> 
                              </div>
                            </div>
                          </div>  
                        </div>
                        <?php }?> 
  
                        <div class="row "> 
                          <div class="form-group">
                              <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                              <div class="row  text-left"> 
                                <button class="btn btn-primary mar-all" onClick="loaddata_warning_kontrak();">Search</button> 
                              </div>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div> 
                  </div>

                </div>
                <div style="border-top:1px solid #dedede;padding:10px"></div>
                <div class="row">
                  <div class="col-sm-6 table-toolbar-left">
                  </div>
                  <div class="col-sm-6 table-toolbar-right">
                      <div class="btn-group">
                        <button class="btn btn-default"  onCLick="downloadformkontrak();return false;"><i class="fa fa-file-excel-o"></i> Download Excel</button>
                    </div>
                  </div>
                </div>
                <div id="myGrid_warning" style="height: 300px;width:100%" class="ag-theme-balham">
                  </div>
                  <div class="paging pull-right mar-all"> 
                </div>

              </div>

            </div>

          </div>
        </div>

      </div>

    </div>
    <div id="demo-lft-tab-2" class="tab-pane fade active in">
   
      <div class="panel-body">
        <div class="bootstrap-table">
          <div class="fixed-table-container " style="padding-bottom: 0px;">
            <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">  
                  <div class="col-md-6">              
                    <div class="box box-primary"> 
                      <div class="box-body">
                        <div class="row pad-top"> 

                          <div class="form-group">
                              <label class="col-sm-2 control-label" for="txtdaristr">Dari</label>
                              <div class="col-sm-3">
                                 <input class="form-control datepickerbootstrap" type="text" id="txtdaristr" name="txtdaristr">
                              </div>
                          </div>
                        </div>  
                        <div class="row pad-top"> 

                          <div class="form-group">
                              <label class="col-sm-2 control-label" for="txtsampaistr">Sampai</label>
                              <div class="col-sm-3">
                                 <input class="form-control datepickerbootstrap" type="text" id="txtsampaistr" name="txtsampaistr">
                              </div>
                          </div>
                        </div> 
                        <?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
                        <div class="admininput">
                          <div class="row pad-top"> 
                            <div class="form-group">
                            <label class="col-sm-2 control-label" for="txtdirektoratstr">Unit Kerja</label>
                              <div class="col-sm-7">
                                <select class="form-control select-chosen" id="txtdirektoratstr" name="txtdirektoratstr" style="width: 100%;">
                                </select> 
                              </div>
                            </div>
                          </div>  
                        </div>
                        <?php }?> 
  
                        <div class="row "> 
                          <div class="form-group">
                              <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                              <div class="row  text-left"> 
                                <button class="btn btn-primary mar-all" onClick="loaddata_warning_str();">Search</button> 
                              </div>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div> 
                  </div>
                
                </div>
                <div style="border-top:1px solid #dedede;padding:10px"></div>
                <div class="row">
                  <div class="col-sm-6 table-toolbar-left">
                  </div>
                  <div class="col-sm-6 table-toolbar-right">
                      <div class="btn-group">
                        <button class="btn btn-default"  onCLick="downloadformstr();return false;"><i class="fa fa-file-excel-o"></i> Download Excel</button>
                    </div>
                  </div>
                </div>
                <div id="myGrid_warning_str" style="height: 300px;width:100%" class="ag-theme-balham">
                </div>
                <div class="paging pull-right mar-all"> 
                </div>
                
              </div>

            </div>

          </div>
        </div>

      </div>
    </div>

    <div class="tab-pane fade" id="demo-lft-tab-3">
      <div class="panel-body">
        <div class="bootstrap-table">
          <div class="fixed-table-container " style="padding-bottom: 0px;">
            <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12">
                
                <div class="row">  
                  <div class="col-md-6">              
                    <div class="box box-primary"> 
                      <div class="box-body">
                        <div class="row pad-top"> 

                          <div class="form-group">
                              <label class="col-sm-2 control-label" for="txtdarisip">Dari</label>
                              <div class="col-sm-3">
                                 <input class="form-control datepickerbootstrap" type="text" id="txtdarisip" name="txtdarisip">
                              </div>
                          </div>
                        </div>  
                        <div class="row pad-top"> 

                          <div class="form-group">
                              <label class="col-sm-2 control-label" for="txtsampaisip">Sampai</label>
                              <div class="col-sm-3">
                                 <input class="form-control datepickerbootstrap" type="text" id="txtsampaisip" name="txtsampaisip">
                              </div>
                          </div>
                        </div> 
                        <?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
                        <div class="admininput">
                          <div class="row pad-top"> 
                            <div class="form-group">
                            <label class="col-sm-2 control-label" for="txtdirektoratsip">Unit Kerja</label>
                              <div class="col-sm-7">
                                <select class="form-control select-chosen" id="txtdirektoratsip" name="txtdirektoratsip" style="width: 100%;">
                                </select> 
                              </div>
                            </div>
                          </div>  
                        </div>
                        <?php }?> 
  
                        <div class="row "> 
                          <div class="form-group">
                              <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                              <div class="row  text-left"> 
                                <button class="btn btn-primary mar-all" onClick="loaddata_warning_sip();">Search</button> 
                              </div>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div> 
                  </div>

                </div>
                <div style="border-top:1px solid #dedede;padding:10px"></div>
                <div class="row">
                  <div class="col-sm-6 table-toolbar-left">
                  </div>
                  <div class="col-sm-6 table-toolbar-right">
                      <div class="btn-group">
                        <button class="btn btn-default"  onCLick="downloadformsip();return false;"><i class="fa fa-file-excel-o"></i> Download Excel</button>
                    </div>
                  </div>
                </div>
                <div id="myGrid_warning_sip" style="height: 300px;width:100%" class="ag-theme-balham">
                  </div>
                  <div class="paging pull-right mar-all"> 
                </div>
                
              </div>

            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
 <script>
    $('.select-chosen').chosen();
     $('.chosen-container').css({"width": "100%"});
    getOptions("txtdirektoratstr",BASE_URL+"master/direktoratSub");
    getOptions("txtdirektoratkontrak",BASE_URL+"master/direktoratSub");
    getOptions("txtdirektoratsip",BASE_URL+"master/direktoratSub");
 </script>
 <?php } ?> 
<script type="text/javascript" charset="utf-8">
   $(document).ready(function(){
    $('.datepickerbootstrap').datepicker({
      format: 'dd/mm/yyyy',
      autoclose: true
    });     
  })

  // specify the columns
  var url_view= BASE_URL2+'view/warning_pegawai/'; 
  var url_api=BASE_URL+'warning_pegawai/warning/';


  var columnDefs_warning = [
           {headerName: "ID", field: "id", width: 70, filterParams:{newRowsAction: 'keep'}},
           {headerName: "NIP", field: "nip", width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Divisi", field: "nama_group", width: 250, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Status Kontrak", field: "tgl_kontrak", width: 250, filterParams:{newRowsAction: 'keep'}},
        ];
   
   

  var gridOptions_warning = {
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
    columnDefs: columnDefs_warning,
    pagination: true ,
    defaultColDef:{
        editable: false,
        enableRowGroup:true,
        enablePivot:true,
        enableValue:true,
        sortable:true,
        resizable: true,
        filter: true
    }
  };
   
  // setup the grid after the page has finished loading 
  var gridDiv = document.querySelector('#myGrid_warning');
  new agGrid.Grid(gridDiv, gridOptions_warning);
  // do http request to get our sample data - not using any framework to keep the example self contained.
  // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
    function loaddata_warning_kontrak(){ 
    var dari = $('#txtdarikontrak').val();
    var sampai = $('#txtsampaikontrak').val();
    var direktoratkontrak = $('#txtdirektoratkontrak').val();
   
    var newdari = dari.split("/").reverse().join("-");
    var newsampai = sampai.split("/").reverse().join("-");
    $.ajax({
      url: url_api+'list_warning_kontrak/'+direktoratkontrak+'/?dari='+newdari+'&&sampai='+newsampai,
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
            $('#txtdarikontrak').val('');
            $('#txtsampaikontrak').val('');
            $('#txtdirektoratkontrak').val('');
            if(data.result !== 'empty'){
                    gridOptions_warning.api.setRowData(data.result);
                    // paging(data.total,'loaddata_warning',data.perpage);
            }else{
              gridOptions_warning.api.setRowData([]);
            }
    }
    ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
  }
  );
  }  
  loaddata_warning_kontrak();
  function downloadformkontrak(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; 
    var yyyy = today.getFullYear();
    var h = today.getHours();
    var i = today.getMinutes();
    var s = today.getSeconds();
    var time = dd + '/' + mm + '/' + yyyy + '/' + h + '/' + i + '/' + s;
    var params = { 
        fileName: 'Warning Kontrak '+time,
        sheetName: 'Warning Kontrak',
        allColumns: true
    };

    gridOptions_warning.api.exportDataAsExcel(params);
  }

  var columnDefs_warning_str = [
           {headerName: "ID", field: "id", width: 70, filterParams:{newRowsAction: 'keep'}},
           {headerName: "NIP", field: "nip", width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Divisi", field: "nama_group", width: 250, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Status STR", field: "tgl_str", width: 250, filterParams:{newRowsAction: 'keep'}},
           
        ];
   
   

  var gridOptions_warning_str = {
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
    columnDefs: columnDefs_warning_str,
    pagination: true ,
    defaultColDef:{
        editable: false,
        enableRowGroup:true,
        enablePivot:true,
        enableValue:true,
        sortable:true,
        resizable: true,
        filter: true
    }
  };
   
  // setup the grid after the page has finished loading 
  var gridDivStr = document.querySelector('#myGrid_warning_str');
  new agGrid.Grid(gridDivStr, gridOptions_warning_str);
  // do http request to get our sample data - not using any framework to keep the example self contained.
  // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
  function loaddata_warning_str(){ 
    var dari = $('#txtdaristr').val();
    var sampai = $('#txtsampaistr').val();
    var direktoratstr = $('#txtdirektoratstr').val();
   
    var newdari = dari.split("/").reverse().join("-");
    var newsampai = sampai.split("/").reverse().join("-");
    $.ajax({
      url: url_api+'list_warning_str/'+direktoratstr+'/?dari='+newdari+'&&sampai='+newsampai,
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
            $('#txtdaristr').val('');
            $('#txtsampaistr').val('');
            $('#txtdirektoratstr').val('');
            if(data.result !== 'empty'){
                    gridOptions_warning_str.api.setRowData(data.result);
                    // paging(data.total,'loaddata_warning',data.perpage);
            }else{
              gridOptions_warning_str.api.setRowData([]);
            }
    }
    ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
     }
   );
  }  

  loaddata_warning_str();

  function downloadformstr(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; 
    var yyyy = today.getFullYear();
    var h = today.getHours();
    var i = today.getMinutes();
    var s = today.getSeconds();
    var time = dd + '/' + mm + '/' + yyyy + '/' + h + '/' + i + '/' + s;
    var params = { 
        fileName: 'Warning STR '+time,
        sheetName: 'Warning STR',
        allColumns: true
    };

    gridOptions_warning_str.api.exportDataAsExcel(params);
  }

  var columnDefs_warning_sip = [
           {headerName: "ID", field: "id", width: 70, filterParams:{newRowsAction: 'keep'}},
           {headerName: "NIP", field: "nip", width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Divisi", field: "nama_group", width: 250, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Status SIP", field: "tgl_sip", width: 250, filterParams:{newRowsAction: 'keep'}},
           
        ];
   
   

  var gridOptions_warning_sip = {
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
    columnDefs: columnDefs_warning_sip,
    pagination: true ,
    defaultColDef:{
        editable: false,
        enableRowGroup:true,
        enablePivot:true,
        enableValue:true,
        sortable:true,
        resizable: true,
        filter: true
    }
  };
   
  // setup the grid after the page has finished loading 
  var gridDivSip = document.querySelector('#myGrid_warning_sip');
  new agGrid.Grid(gridDivSip, gridOptions_warning_sip);
  // do http request to get our sample data - not using any framework to keep the example self contained.
  // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
  function loaddata_warning_sip(){ 
    var dari = $('#txtdarisip').val();
    var sampai = $('#txtsampaisip').val();
    var direktoratsip = $('#txtdirektoratsip').val();
   
    var newdari = dari.split("/").reverse().join("-");
    var newsampai = sampai.split("/").reverse().join("-");
    $.ajax({
      url: url_api+'list_warning_sip/'+direktoratsip+'/?dari='+newdari+'&&sampai='+newsampai,
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
            $('#txtdarisip').val('');
            $('#txtsampaisip').val('');
            $('#txtdirektoratsip').val('');
            if(data.result !== 'empty'){
                    gridOptions_warning_sip.api.setRowData(data.result);
                    // paging(data.total,'loaddata_warning',data.perpage);
            }else{
              gridOptions_warning_sip.api.setRowData([]);
            }
    }
    ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
  }
  );
  }  
  loaddata_warning_sip();
  function downloadformsip(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; 
    var yyyy = today.getFullYear();
    var h = today.getHours();
    var i = today.getMinutes();
    var s = today.getSeconds();
    var time = dd + '/' + mm + '/' + yyyy + '/' + h + '/' + i + '/' + s;
    var params = { 
        fileName: 'Warning SIP '+time,
        sheetName: 'Warning SIP',
        allColumns: true
    };

    gridOptions_warning_sip.api.exportDataAsExcel(params);
  }

  function resetsearch_warning(){
    $('#search_warning').val('');
    loaddata_warning(0);
  }

  function resetsearch_warning_str(){
    $('#search_warning_str').val('');
    loaddata_warning_str(0);
  }

  function resetsearch_warning_sip(){
    $('#search_warning_sip').val('');
    loaddata_warning_sip(0);
  }
   
</script>

<script src="js/login.js">
</script>
