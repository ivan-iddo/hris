 

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

      <!-- <li>
        <a href="#demo-lft-tab-pengajuan" data-toggle="tab">
            <span class="block text-center">
              <i class="fa fa-mail-forward fa-2x text-danger"></i> 
            </span>
            Riwayat Pengajuan Jabatan
          </a>
      </li> -->

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
          <div class="fixed-table-container" style="padding-bottom: 0px;">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                
                <div class="toolbar">
                  <div id="demo-custom-toolbar" class="table-toolbar-left">
                        <button id="demo-bootbox-bounce" class="btn btn-purple btn-labeled fa fa-eye btn-sm" onCLick="ajukan_jabatan();">Lihat Persyaratan Jabatan
                        </button>&nbsp;
                        <!-- <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onClick="edit_pengajuan();">Edit
                        </button>&nbsp;
                        <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="delete_pengajuan();">Delete
                        </button> -->
                  </div>
                </div>

                <div id="demo-dt-delete_filter" class="dataTables_filter">
                  <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search_persyaratan" onkeydown="if(event.keyCode=='13'){loaddata_persyaratan(0);}" >
                  <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn" onClick="resetsearch_persyaratan();"><i class="demo-pli-repeat-2 icon-lg"></i></button>
                  </label>
                  
                </div>

                <div id="myGrid_persyaratan" style="height: 300px;width:100%" class="ag-theme-balham">
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


    <!-- <div id="demo-lft-tab-pengajuan" class="tab-pane fade">
   
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
    </div> -->

    <div id="demo-lft-tab-3" class="tab-pane fade ">
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8">
  // specify the columns
  var url_view= BASE_URL2+'view/persyaratan/'; 
  var url_api=BASE_URL+'persyaratan/pengajuan/';
  var url_api2=BASE_URL+'persyaratan/persyaratan/';

  var columnDefs_persyaratan =  
  [
    {headerName: "Id Persyaratan", field: "id", width: 50, filterParams:{newRowsAction: "keep"}},
    {headerName: "Jabatan", field: "jabatan_baru", width: 290, filterParams:{newRowsAction: "keep"}},
    {headerName: "Masa Jabatan", field: "masa_jabatan", width: 100, filterParams:{newRowsAction: "keep"}},
    {headerName: "Kompetensi", field: "kompetensi", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Pendidikan Formal", field: "formal", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Pendidikan Non Formal", field: "nonformal", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Jabatan Sebelumnya", field: "jabatan_lama", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Tupoksi", field: "tufoksi", width: 190, filterParams:{newRowsAction: "keep"}},
  ];
   
   

  var gridOptions_persyaratan = {
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
    columnDefs: columnDefs_persyaratan,
    pagination: false ,
    defaultColDef:{
      editable: false,
      enableRowGroup:true,
        enablePivot:true,
        enableValue:true 
    }
  };
   
  // setup the grid after the page has finished loading 
  var gridDiv = document.querySelector('#myGrid_persyaratan');
  new agGrid.Grid(gridDiv, gridOptions_persyaratan);
  // do http request to get our sample data - not using any framework to keep the example self contained.
  // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
  function loaddata_persyaratan(jml){ 
    var search = 0;
            if($('#search_persyaratan').val() !==''){
              search = $('#search_persyaratan').val();
            }
    $.ajax({
      url: url_api2+'listdata/'+search+'/'+jml,
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
                    gridOptions_persyaratan.api.setRowData(data.result);
                    paging(data.total,'loaddata_persyaratan',data.perpage);
            }else{
              gridOptions_persyaratan.api.setRowData([]);
            }
    }
    ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
  }
  );
  }  
  loaddata_persyaratan(0);

  function resetsearch_persyaratan(){
    $('#search_persyaratan').val('');
    loaddata_persyaratan(0);
  }

  function ajukan_jabatan(){
    var idcell = getGridId(gridOptions_persyaratan,'id');
    if(!empty(idcell)){
      bootbox.dialog({
        message: $('<div></div>').load(url_view+'form_pengajuan.php'),
        animateIn: 'bounceIn',
        animateOut: 'bounceOut',
        backdrop: false,
        size: 'medium',
        buttons: {
            success: {
                label: "Ajukan Jabatan",
                className: "btn-primary",
                callback: function () {

                    if (save_pengajuan()) {
                        $('.modal').modal('hide');
                        return true;
                    } else {
                        return false;
                    }

                }
            },

            main: {
                label: "Close",
                className: "btn-warning",
                callback: function () {

                }
            }
        }
    });
      // gopop(url_view+'form_pengajuan.php',save_pengajuan,'medium');
    }else{
      onMessage('Silahkan Pilih Jabatan Terlebih dahulu!');
    }
  }

  function save_pengajuan(){
    if(empty($('#kompetensiAnda').val())){
    onMessage('Data Kompetensi Yang Dimiliki tidak boleh kosong');
    return false;
    } else if(empty($('#tufoksipengaju').val())){
    onMessage('Data Tupoksi Kompetensi Yang Dimiliki tidak boleh kosong');
    return false;
    } else  {
    postForm('form-pengajuan', url_api+'save',loaddata_persyaratan);
    }
  }

</script>
<script src="js/login.js">
</script>
