 

<div class="tab-base">
  <!--Nav Tabs-->
  <ul class="nav nav-tabs">
      <li>
				<a href="#demo-lft-tab-1" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-home fa-2x text-danger"></i> 
						</span>
						Dashboard
					</a>
			</li>

      <li class="active">
				<a href="#demo-lft-tab-2" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-laptop fa-2x text-danger"></i> 
						</span>
						View Data
					</a> 
			</li>

      <li> 
			   <a href="#demo-lft-tab-3" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-lightbulb-o fa-2x text-success"></i> 
						</span>
						Help
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
                
                <div class="toolbar">
                  <div id="demo-custom-toolbar" class="table-toolbar-left">
                    <h3>Status Kontrak</h3> 
                  </div>
                  <br>
                </div>
                               
                <div id="demo-dt-delete_filter" class="dataTables_filter">
                <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search_warning" onkeydown="if(event.keyCode=='13'){loaddata_warning(0);}" >
                <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn" onClick="resetsearch_warning();"><i class="demo-pli-repeat-2 icon-lg"></i></button>
                </label>
                
                </div>

                <div id="myGrid_warning" style="height: 300px;width:100%" class="ag-theme-balham">
                </div>
                <div class="paging pull-right mar-all"> 
  					    </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12">
                
                <div class="toolbar">
                  <div id="demo-custom-toolbar" class="table-toolbar-left">
                    <h3>Status STR</h3> 
                  </div>
                  <br>
                </div>
                               
                <div id="demo-dt-delete_filter" class="dataTables_filter">
                  <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search_warning_str" onkeydown="if(event.keyCode=='13'){loaddata_warning_str(0);}" >
                  <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn" onClick="resetsearch_warning_str();"><i class="demo-pli-repeat-2 icon-lg"></i></button>
                  </label>
                  
                </div>

                <div id="myGrid_warning_str" style="height: 300px;width:100%" class="ag-theme-balham">
                </div>
                <div class="paging pull-right mar-all"> 
                </div>

              </div>

              <div class="col-lg-12 col-md-12 col-sm-12">
                
                <div class="toolbar">
                  <div id="demo-custom-toolbar" class="table-toolbar-left">
                    <h3>Status SIP</h3> 
                  </div>
                  <br>
                </div>
                               
                <div id="demo-dt-delete_filter" class="dataTables_filter">
                  <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search_warning_sip" onkeydown="if(event.keyCode=='13'){loaddata_warning_sip(0);}" >
                  <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn" onClick="resetsearch_warning_sip();"><i class="demo-pli-repeat-2 icon-lg"></i></button>
                  </label>
                  
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

    <div class="tab-pane fade" id="demo-lft-tab-3">
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8">
  // specify the columns
  var url_view= BASE_URL2+'view/warning_pegawai/'; 
  var url_api=BASE_URL+'warning_pegawai/warning/';


  var columnDefs_warning = [
           {headerName: "ID", field: "id", width: 70, filterParams:{newRowsAction: 'keep'}},
           {headerName: "NIP", field: "nip", width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Devisi", field: "nama_group", width: 250, filterParams:{newRowsAction: 'keep'}},
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
  function loaddata_warning(jml){ 
    var search = 0;
            if($('#search_warning').val() !==''){
              search = $('#search_warning').val();
            }
    $.ajax({
      url: url_api+'list_warning/'+search+'/'+jml,
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
  loaddata_warning(0);

  var columnDefs_warning_str = [
           {headerName: "ID", field: "id", width: 70, filterParams:{newRowsAction: 'keep'}},
           {headerName: "NIP", field: "nip", width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Devisi", field: "nama_group", width: 250, filterParams:{newRowsAction: 'keep'}},
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
  function loaddata_warning_str(jml){ 
    var search = 0;
            if($('#search_warning_str').val() !==''){
              search = $('#search_warning_str').val();
            }
    $.ajax({
      url: url_api+'list_warning_str/'+search+'/'+jml,
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
  loaddata_warning_str(0);

  var columnDefs_warning_sip = [
           {headerName: "ID", field: "id", width: 70, filterParams:{newRowsAction: 'keep'}},
           {headerName: "NIP", field: "nip", width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Devisi", field: "nama_group", width: 250, filterParams:{newRowsAction: 'keep'}},
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
  function loaddata_warning_sip(jml){ 
    var search = 0;
            if($('#search_warning_sip').val() !==''){
              search = $('#search_warning_sip').val();
            }
    $.ajax({
      url: url_api+'list_warning_sip/'+search+'/'+jml,
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
  loaddata_warning_sip(0);

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
