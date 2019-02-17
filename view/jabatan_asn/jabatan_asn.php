 

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
                <button id="demo-bootbox-bounce" class="btn btn-mint btn-labeled fa fa-plus-square btn-sm" onCLick="add_m_index_jabatan_asn();">Add
                </button>
                <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onClick="edit_m_index_jabatan_asn();">Edit
                </button>
                <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="delete_m_index_jabatan_asn();">Delete
                </button>
              </div> </div>
            </div>

            <div id="demo-dt-delete_filter" class="dataTables_filter">
              <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search_m_index_jabatan_asn" onkeydown="if(event.keyCode=='13'){loaddata_m_index_jabatan_asn(0);}" >
              <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn" onClick="resetsearch_m_index_jabatan_asn();"><i class="demo-pli-repeat-2 icon-lg"></i></button>
              </label>
              
              </div>

              <div id="myGrid_m_index_jabatan_asn" style="height: 300px;width:100%" class="ag-theme-balham">
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
  $('.judul-menu').html('Jabatan ASN');
  // specify the columns
  var url_view= BASE_URL2+'view/jabatan_asn/'; 
  var url_api=BASE_URL+'jabatan_asn/jabatan_asn/';


  var columnDefs_m_index_jabatan_asn =  [{headerName: "Id", field: "migrasi_index_jabatan_id", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Kode Pekerjaan", field: "kd_job_index", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Pekerjaan", field: "ds_job_index", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Tipe ij", field: "tipe_ij", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Nilai ij", field: "nilai_ij", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Seq Pekerjaan", field: "seq_job_index", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Update Date", field: "tgl_update", width: 190, filterParams:{newRowsAction: "keep"}},{headerName: "Updateby", field: "no_peg_update", width: 190, filterParams:{newRowsAction: "keep"}},];
   
   

  var gridOptions_m_index_jabatan_asn = {
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
    columnDefs: columnDefs_m_index_jabatan_asn,
    pagination: false ,
    defaultColDef:{
      editable: false 
    }
  };
   
  // setup the grid after the page has finished loading 
  var gridDiv = document.querySelector('#myGrid_m_index_jabatan_asn');
  new agGrid.Grid(gridDiv, gridOptions_m_index_jabatan_asn);
  // do http request to get our sample data - not using any framework to keep the example self contained.
  // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
  function loaddata_m_index_jabatan_asn(jml){ 
    var search = 0;
            if($('#search_m_index_jabatan_asn').val() !==''){
              search = $('#search_m_index_jabatan_asn').val();
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
                    gridOptions_m_index_jabatan_asn.api.setRowData(data.result);
                    paging(data.total,'loaddata_m_index_jabatan_asn',data.perpage);
            }else{
              gridOptions_m_index_jabatan_asn.api.setRowData([]);
            }
    }
    ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
  }
  );
  }  
  loaddata_m_index_jabatan_asn(0);

  function add_m_index_jabatan_asn(){
    gopop(url_view+'form_m_index_jabatan_asn.php',save_m_index_jabatan_asn,'medium');
    window.setTimeout(function(){
      $('#migrasi_index_jabatan_id').val('');
    },500);
    
  }

  function edit_m_index_jabatan_asn(){
    var idcell = getGridId(gridOptions_m_index_jabatan_asn);
    if(!empty(idcell)){
      gopop(url_view+'form_m_index_jabatan_asn.php',save_m_index_jabatan_asn,'medium');
    }else{
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
    }
    
  }

  function resetsearch_m_index_jabatan_asn(){
    $('#search_m_index_jabatan_asn').val('');
    loaddata_m_index_jabatan_asn(0);
  }

   function save_m_index_jabatan_asn(){
    postForm('form-m_index_jabatan_asn', url_api+'save',loaddata_m_index_jabatan_asn);
  }

   function delete_m_index_jabatan_asn(){
    var idcell = getGridId(gridOptions_m_index_jabatan_asn,'migrasi_index_jabatan_id');
    if(!empty(idcell)){
      submit_get(url_api+'delete?id='+idcell,loaddata_m_index_jabatan_asn);
    }else{
      onMessage('Silahkan Pilih Group Terlebih dahulu!');
    }
  }
   
</script>
<script src="js/login.js">
</script>
