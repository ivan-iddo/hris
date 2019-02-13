 

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
            <div class="btn-group ">
                <button id="demo-bootbox-bounce" class="btn btn-mint btn-labeled fa fa-plus-square btn-sm" onCLick="add_kpi();">Add
                </button>
                <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onClick="edit_kpi();">Edit
                </button>
                <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="delete_kpi();">Delete
                </button>
              </div> </div>
            </div>

            <div id="demo-dt-delete_filter" class="dataTables_filter">
              <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search_kpi" onkeydown="if(event.keyCode=='13'){loaddata_kpi(0);}" >
              <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn" onClick="resetsearch_kpi();"><i class="demo-pli-repeat-2 icon-lg"></i></button>
              </label>
              
              </div>

              <div id="myGrid_kpi" style="height: 300px;width:100%" class="ag-theme-balham">
              </div>
              <div class="paging pull-right mar-all"> 
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
  // specify the columns
  var url_view= BASE_URL2+'view/kpi/'; 
  var url_api=BASE_URL+'kpi/';


  var columnDefs_kpi =  [{headerName: "kd kpi", field: "kd_kpi", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kpi", field: "kpi", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kpi id", field: "kpi_id", width: 190, filterParams:{newRowsAction: "keep"}},];
   
   

  var gridOptions_kpi = {
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
    columnDefs: columnDefs_kpi,
    pagination: false ,
    defaultColDef:{
      editable: false,
      enableRowGroup:true,
				enablePivot:true,
				enableValue:true 
    }
  };
   
  // setup the grid after the page has finished loading 
  var gridDiv = document.querySelector('#myGrid_kpi');
  new agGrid.Grid(gridDiv, gridOptions_kpi);
  // do http request to get our sample data - not using any framework to keep the example self contained.
  // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
  function loaddata_kpi(jml){ 
    var search = 0;
            if($('#search_kpi').val() !==''){
              search = $('#search_kpi').val();
            }
    $.ajax({
      url: url_api+'listdata/'+search+'/'+jml,
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
                    gridOptions_kpi.api.setRowData(data.result);
                    paging(data.total,'loaddata_kpi',data.perpage);
            }else{
              gridOptions_kpi.api.setRowData([]);
            }
    }
    ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
  }
  );
  }  
  loaddata_kpi(0);

  function add_kpi(){
    gopop(url_view+'form_kpi.php',save_kpi,'medium');
    window.setTimeout(function(){
      $('#kd_kpi').val('');
    },500);
    
  }

  function edit_kpi(){
    var idcell = getGridId(gridOptions_kpi);
    if(!empty(idcell)){
      gopop(url_view+'form_kpi.php',save_kpi,'medium');
    }else{
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
    }
    
  }

  function resetsearch_kpi(){
    $('#search_kpi').val('');
    loaddata_kpi(0);
  }

   function save_kpi(){
    postForm('form-kpi', url_api+'save',loaddata_kpi);
  }

   function delete_kpi(){
    var idcell = getGridId(gridOptions_kpi,'kd_kpi');
    if(!empty(idcell)){
      submit_get(url_api+'delete?id='+idcell,loaddata_kpi);
    }else{
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
    }
  }
   
</script>
<script src="js/login.js">
</script>
