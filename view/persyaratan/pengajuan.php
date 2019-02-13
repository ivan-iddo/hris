 

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
                <button id="demo-bootbox-bounce" class="btn btn-mint btn-labeled fa fa-plus-square btn-sm" onCLick="add_pengajuan();">Add
                </button>
                <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onClick="edit_pengajuan();">Edit
                </button>
                <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="delete_pengajuan();">Delete
                </button>
              </div> </div>
            </div>

            <div id="demo-dt-delete_filter" class="dataTables_filter">
              <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search_pengajuan" onkeydown="if(event.keyCode=='13'){loaddata_pengajuan(0);}" >
              <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn" onClick="resetsearch_pengajuan();"><i class="demo-pli-repeat-2 icon-lg"></i></button>
              </label>
              
              </div>

              <div id="myGrid_pengajuan" style="height: 300px;width:100%" class="ag-theme-balham">
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
  var url_view= BASE_URL2+'view/persyaratan/'; 
  var url_api=BASE_URL+'persyaratan/pengajuan/';


  var columnDefs_pengajuan =  
  [
    {headerName: "kd pengajuan", field: "kd_pengajuan", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "pengajuan", field: "pengajuan", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "pengajuan id", field: "pengajuan_id", width: 190, filterParams:{newRowsAction: "keep"}},
  ];
   
   

  var gridOptions_pengajuan = {
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
    columnDefs: columnDefs_pengajuan,
    pagination: false ,
    defaultColDef:{
      editable: false,
      enableRowGroup:true,
				enablePivot:true,
				enableValue:true 
    }
  };
   
  // setup the grid after the page has finished loading 
  var gridDiv = document.querySelector('#myGrid_pengajuan');
  new agGrid.Grid(gridDiv, gridOptions_pengajuan);
  // do http request to get our sample data - not using any framework to keep the example self contained.
  // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
  function loaddata_pengajuan(jml){ 
    var search = 0;
            if($('#search_pengajuan').val() !==''){
              search = $('#search_pengajuan').val();
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
                    gridOptions_pengajuan.api.setRowData(data.result);
                    paging(data.total,'loaddata_pengajuan',data.perpage);
            }else{
              gridOptions_pengajuan.api.setRowData([]);
            }
    }
    ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
  }
  );
  }  
  loaddata_pengajuan(0);

  function add_pengajuan(){
    gopop(url_view+'form_pengajuan.php',save_pengajuan,'medium');
    window.setTimeout(function(){
      $('#kd_pengajuan').val('');
    },500);
    
  }

  function edit_pengajuan(){
    var idcell = getGridId(gridOptions_pengajuan);
    if(!empty(idcell)){
      gopop(url_view+'form_pengajuan.php',save_pengajuan,'medium');
    }else{
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
    }
    
  }

  function resetsearch_pengajuan(){
    $('#search_pengajuan').val('');
    loaddata_pengajuan(0);
  }

   function save_pengajuan(){
    postForm('form-pengajuan', url_api+'save',loaddata_pengajuan);
  }

   function delete_pengajuan(){
    var idcell = getGridId(gridOptions_pengajuan,'kd_pengajuan');
    if(!empty(idcell)){
      submit_get(url_api+'delete?id='+idcell,loaddata_pengajuan);
    }else{
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
    }
  }
   
</script>
<script src="js/login.js">
</script>
