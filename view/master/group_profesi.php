 

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
                <button id="demo-bootbox-bounce" class="btn btn-mint btn-labeled fa fa-plus-square btn-sm" onCLick="add_m_kode_profesi_group();">Add
                </button>
                <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onClick="edit_m_kode_profesi_group();">Edit
                </button>
                <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="delete_m_kode_profesi_group();">Delete
                </button>
              </div> </div>
            </div>

            <div id="demo-dt-delete_filter" class="dataTables_filter">
              <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search_m_kode_profesi_group" onkeydown="if(event.keyCode=='13'){loaddata_m_kode_profesi_group(0);}" >
              <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn" onClick="resetsearch_m_kode_profesi_group();"><i class="demo-pli-repeat-2 icon-lg"></i></button>
              </label>
              
              </div>

              <div id="myGrid_m_kode_profesi_group" style="height: 300px;width:100%" class="ag-theme-balham">
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
  $('.judul-menu').html('Group Profesi');
  // specify the columns
  var url_view= BASE_URL2+'view/master/'; 
  var url_api=BASE_URL+'masterp/group_profesi/';


  var columnDefs_m_kode_profesi_group =  [{headerName: "Id", field: "id", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Kode Group Profesi", field: "kd_grp_job_profesi", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Group Jabatan", field: "ds_group_jabatan", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Update Date", field: "tgl_update", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Updateby", field: "no_peg_update", width: 190, filterParams:{newRowsAction: "keep"}},];
   
   

  var gridOptions_m_kode_profesi_group = {
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
    columnDefs: columnDefs_m_kode_profesi_group,
    pagination: false ,
    defaultColDef:{
      editable: false 
    }
  };
   
  // setup the grid after the page has finished loading 
  var gridDiv = document.querySelector('#myGrid_m_kode_profesi_group');
  new agGrid.Grid(gridDiv, gridOptions_m_kode_profesi_group);
  // do http request to get our sample data - not using any framework to keep the example self contained.
  // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
  function loaddata_m_kode_profesi_group(jml){ 
    var search = 0;
            if($('#search_m_kode_profesi_group').val() !==''){
              search = $('#search_m_kode_profesi_group').val();
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
                    gridOptions_m_kode_profesi_group.api.setRowData(data.result);
                    paging(data.total,'loaddata_m_kode_profesi_group',data.perpage);
            }else{
              gridOptions_m_kode_profesi_group.api.setRowData([]);
            }
    }
    ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
  }
  );
  }  
  loaddata_m_kode_profesi_group(0);

  function add_m_kode_profesi_group(){
    gopop(url_view+'form_m_kode_profesi_group.php',save_m_kode_profesi_group,'medium');
    window.setTimeout(function(){
      $('#id').val('');
    },500);
    
  }

  function edit_m_kode_profesi_group(){
    var idcell = getGridId(gridOptions_m_kode_profesi_group);
    if(!empty(idcell)){
      gopop(url_view+'form_m_kode_profesi_group.php',save_m_kode_profesi_group,'medium');
    }else{
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
    }
    
  }

  function resetsearch_m_kode_profesi_group(){
    $('#search_m_kode_profesi_group').val('');
    loaddata_m_kode_profesi_group(0);
  }

  function save_m_kode_profesi_group(){
	var kd_grp_job_profesi = $('#kd_grp_job_profesi').val();
	var ds_group_jabatan = $('#ds_group_jabatan').val();
     
     if(empty(kd_grp_job_profesi)){
        onMessage('Kode Group Wajib diisi!');
               return false;
     }else if(empty(ds_group_jabatan)){
        onMessage('Keterangan Wajib diisi!');
               return false;
     }else{
		postForm('form-m_kode_profesi_group', url_api+'save',loaddata_m_kode_profesi_group);
	 }
  }

   function delete_m_kode_profesi_group(){
    var idcell = getGridId(gridOptions_m_kode_profesi_group,'id');
    if(!empty(idcell)){
      submit_get(url_api+'delete?id='+idcell,loaddata_m_kode_profesi_group);
    }else{
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
    }
  }
   
</script>
<script src="js/login.js">
</script>
