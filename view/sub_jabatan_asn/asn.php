 

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
                <button id="demo-bootbox-bounce" class="btn btn-mint btn-labeled fa fa-plus-square btn-sm" onCLick="add_m_index_jabatan_asn_detail();">Add
                </button>
                <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onClick="edit_m_index_jabatan_asn_detail();">Edit
                </button>
                <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="delete_m_index_jabatan_asn_detail();">Delete
                </button>
              </div> </div>
            </div>

            <div id="demo-dt-delete_filter" class="dataTables_filter">
              <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search_m_index_jabatan_asn_detail" onkeydown="if(event.keyCode=='13'){loaddata_m_index_jabatan_asn_detail(0);}" >
              <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn" onClick="resetsearch_m_index_jabatan_asn_detail();"><i class="demo-pli-repeat-2 icon-lg"></i></button>
              </label>
              
              </div>

              <div id="myGrid_m_index_jabatan_asn_detail" style="height: 300px;width:100%" class="ag-theme-balham">
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
  var url_view= BASE_URL2+'view/sub_jabatan_asn/'; 
  var url_api=BASE_URL+'sub_jabatan_asn/asn/';


  var columnDefs_m_index_jabatan_asn_detail =  [{headerName: "migrasi jabatan detail id", field: "migrasi_jabatan_detail_id", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd jabatan", field: "kd_jabatan", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "ds jabatan", field: "ds_jabatan", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "level job", field: "level_job", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "detil", field: "detil", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd jab induk", field: "kd_jab_induk", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd grp job profesi", field: "kd_grp_job_profesi", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd group grade", field: "kd_group_grade", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "ringkasan jabatan", field: "ringkasan_jabatan", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "wewenang jabatan", field: "wewenang_jabatan", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd pendidikan", field: "kd_pendidikan", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd jbt pengalaman", field: "kd_jbt_pengalaman", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "lama kd jbt pengalaman", field: "lama_kd_jbt_pengalaman", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "real value", field: "real_value", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd profesi", field: "kd_profesi", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "jab aktif", field: "jab_aktif", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "periode jab", field: "periode_jab", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "fung struk", field: "fung_struk", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd lokasi", field: "kd_lokasi", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "tgl update", field: "tgl_update", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "no peg update", field: "no_peg_update", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "staf kpl", field: "staf_kpl", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "sdn lvl", field: "sdn_lvl", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd group grade n", field: "kd_group_grade_n", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "corp grade", field: "corp_grade", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "job value", field: "job_value", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd job index 1", field: "kd_job_index_1", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd job index 2", field: "kd_job_index_2", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd job index 3", field: "kd_job_index_3", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "kd job index 4", field: "kd_job_index_4", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "nilai ij 1", field: "nilai_ij_1", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "nilai ij 2", field: "nilai_ij_2", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "nilai ij 3", field: "nilai_ij_3", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "nilai ij 4", field: "nilai_ij_4", width: 190, filterParams:{newRowsAction: "keep"}},];
   
   

  var gridOptions_m_index_jabatan_asn_detail = {
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
    columnDefs: columnDefs_m_index_jabatan_asn_detail,
    pagination: false ,
    defaultColDef:{
      editable: false 
    }
  };
   
  // setup the grid after the page has finished loading 
  var gridDiv = document.querySelector('#myGrid_m_index_jabatan_asn_detail');
  new agGrid.Grid(gridDiv, gridOptions_m_index_jabatan_asn_detail);
  // do http request to get our sample data - not using any framework to keep the example self contained.
  // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
  function loaddata_m_index_jabatan_asn_detail(jml){ 
    var search = 0;
            if($('#search_m_index_jabatan_asn_detail').val() !==''){
              search = $('#search_m_index_jabatan_asn_detail').val();
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
                    gridOptions_m_index_jabatan_asn_detail.api.setRowData(data.result);
                    paging(data.total,'loaddata_m_index_jabatan_asn_detail',data.perpage);
            }else{
              gridOptions_m_index_jabatan_asn_detail.api.setRowData([]);
            }
    }
    ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
  }
  );
  }  
  loaddata_m_index_jabatan_asn_detail(0);

  function add_m_index_jabatan_asn_detail(){
    gopop(url_view+'form_m_index_jabatan_asn_detail.php',save_m_index_jabatan_asn_detail,'medium');
    window.setTimeout(function(){
      $('#migrasi_jabatan_detail_id').val('');
    },500);
    
  }

  function edit_m_index_jabatan_asn_detail(){
    var idcell = getGridId(gridOptions_m_index_jabatan_asn_detail);
    if(!empty(idcell)){
      gopop(url_view+'form_m_index_jabatan_asn_detail.php',save_m_index_jabatan_asn_detail,'medium');
    }else{
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
    }
    
  }

  function resetsearch_m_index_jabatan_asn_detail(){
    $('#search_m_index_jabatan_asn_detail').val('');
    loaddata_m_index_jabatan_asn_detail(0);
  }

   function save_m_index_jabatan_asn_detail(){
    postForm('form-m_index_jabatan_asn_detail', url_api+'save',loaddata_m_index_jabatan_asn_detail);
  }

   function delete_m_index_jabatan_asn_detail(){
    var idcell = getGridId(gridOptions_m_index_jabatan_asn_detail,'migrasi_jabatan_detail_id');
    if(!empty(idcell)){
      submit_get(url_api+'delete?id='+idcell,loaddata_m_index_jabatan_asn_detail);
    }else{
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
    }
  }
   
</script>
<script src="js/login.js">
</script>
