 

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
                <button id="demo-bootbox-bounce" class="btn btn-mint btn-labeled fa fa-plus-square btn-sm" onCLick="add_m_kode_profesi();">Add
                </button>
                <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onClick="edit_m_kode_profesi();">Edit
                </button>
                <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="delete_m_kode_profesi();">Delete
                </button>
              </div> </div>
            </div>

            <div id="demo-dt-delete_filter" class="dataTables_filter">
              <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search_m_kode_profesi" onkeydown="if(event.keyCode=='13'){loaddata_m_kode_profesi(0);}" >
              <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn" onClick="resetsearch_m_kode_profesi();"><i class="demo-pli-repeat-2 icon-lg"></i></button>
              </label>
              
              </div>

              <div id="myGrid_m_kode_profesi" style="height: 300px;width:100%" class="ag-theme-balham">
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
  $('.judul-menu').html('Profesi');
  var url_view= BASE_URL2+'view/master/'; 
  var url_api=BASE_URL+'masterp/profesi/';


  var columnDefs_m_kode_profesi =  [{headerName: "Id", field: "id", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Kode Profesi", field: "kd_profesi", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Profesi", field: "ds_profesi", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Group Profesi", field: "grup", width: 190, filterParams:{newRowsAction: "keep"}},];
   
   

  var gridOptions_m_kode_profesi = {
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
    columnDefs: columnDefs_m_kode_profesi,
    pagination: false ,
    defaultColDef:{
      editable: false 
    }
  };
   
  // setup the grid after the page has finished loading 
  var gridDiv = document.querySelector('#myGrid_m_kode_profesi');
  new agGrid.Grid(gridDiv, gridOptions_m_kode_profesi);
  // do http request to get our sample data - not using any framework to keep the example self contained.
  // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
  function loaddata_m_kode_profesi(jml){ 
    var search = 0;
            if($('#search_m_kode_profesi').val() !==''){
              search = $('#search_m_kode_profesi').val();
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
                    gridOptions_m_kode_profesi.api.setRowData(data.result);
                    paging(data.total,'loaddata_m_kode_profesi',data.perpage);
            }else{
              gridOptions_m_kode_profesi.api.setRowData([]);
            }
    }
    ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
  }
  );
  }  
  loaddata_m_kode_profesi(0);

  function add_m_kode_profesi(){
    gopop(url_view+'form_m_kode_profesi.php',save_m_kode_profesi,'medium');
    window.setTimeout(function(){
      $('#id').val('');
    },500);
    
  }

  function edit_m_kode_profesi(){
    var idcell = getGridId(gridOptions_m_kode_profesi);
    if(!empty(idcell)){
      gopop(url_view+'form_m_kode_profesi.php',save_m_kode_profesi,'medium');
    }else{
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
    }
    
  }

  function resetsearch_m_kode_profesi(){
    $('#search_m_kode_profesi').val('');
    loaddata_m_kode_profesi(0);
  }

   function save_m_kode_profesi(){
	 var kd_profesi = $('#kd_profesi').val();
     var ds_profesi =  $('#ds_profesi').val();
     var kd_grp_job_profesi =  $('#kd_grp_job_profesi').val();
     
     if(empty(kd_profesi)){
        onMessage('Kode Profesi Wajib diisi!');
               return false;
     }else if(empty(ds_profesi)){
        onMessage('Profesi Wajib diisi!');
               return false;
	 }else if(empty(kd_grp_job_profesi)){
        onMessage('Grup Profesi Wajib diisi!');
               return false;
	 }else{
		postForm('form-m_kode_profesi', url_api+'save',loaddata_m_kode_profesi);
	 }
	 
  }

   function delete_m_kode_profesi(){
    var idcell = getGridId(gridOptions_m_kode_profesi,'id');
    if(!empty(idcell)){
      submit_get(url_api+'delete?id='+idcell,loaddata_m_kode_profesi);
    }else{
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
    }
  }
   
</script>
<script src="js/login.js">
</script>
