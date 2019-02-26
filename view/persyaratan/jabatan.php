
<div class="row">
	
    <div class="tab-base mar-all">
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
						Persyaratan Jabatan
					</a> 
			</li>

      <li>
        <a href="#demo-lft-tab-pengajuan" data-toggle="tab">
            <span class="block text-center">
              <i class="fa fa-mail-forward fa-2x text-danger"></i> 
            </span>
            Riwayat Kompetensi Jabatan
          </a>
      </li>

      <li> 
			<a href="#demo-lft-tab-3" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-lightbulb-o fa-2x text-warning"></i> 
						</span>
						Help
					</a> 
			</li>
      </ul>
  
      <div class="tab-content">
  	    <div class="tab-pane fade" id="demo-lft-tab-1"></div>

          <div class="tab-pane fade active in" id="demo-lft-tab-2">
      			<div class="panel-body">
              <div class="dataTables_filter" id="demo-dt-addrow_filter" style="text-align:left">
          			<div class="col-sm-8 table-toolbar-left">
                  <button id="demo-btn-addrow" class="btn btn-purple" onclick="add_persyaratan()"><i class="demo-pli-add"></i> Tambah Persyaratan Jabatan</button>
                  <button style="margin-left:3px" class="btn btn-mint" onclick="lihat_pengajuan()"><i class="fa fa-eye"></i> Lihat Detail Pengajuan</button>
                  <button style="margin-left:3px" class="btn btn-warning" onclick="edit_persyaratan()"><i class="fa fa-file-excel-o"></i> Edit</button>
                  <button class="btn btn-danger" onclick="delete_persyaratan()"><i class="fa fa-file-excel-o"></i> Delete</button>
                                              
                       
                </div>
      			    <div id="demo-dt-delete_filter" class="dataTables_filter">
                  <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search_persyaratan" onkeydown="if(event.keyCode=='13'){loaddata_persyaratan(0);}" >
                  <button id="demo-panel-network-refresh" data-toggle="panel-overlay" data-target="#demo-panel-network" class="btn" onClick="resetsearch_persyaratan();"><i class="demo-pli-repeat-2 icon-lg"></i></button>
                  </label>
                    
                </div>
      			  </div>  
      			</div>  
      	 
              <div class="ag-theme-balham" id="myGrid_persyaratan" style="height: 400px;width:100%;">
            </div>
          </div>

          <div id="demo-lft-tab-pengajuan" class="tab-pane fade">
   
          <div class="panel-body">
            <div class="bootstrap-table">
              <div class="fixed-table-container " style="padding-bottom: 0px;">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      
                    <div class="toolbar">
                    <div id="demo-custom-toolbar" class="table-toolbar-left">
                        <button class="btn btn-purple btn-labeled fa fa-eye btn-sm" onClick="lihat_pengajuan_detail();">Lihat Detail Pengaju
                        </button>
                        <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="delete_pengajuan();">Delete
                        </button>
                    </div>
                    </div>

                    <div id="demo-dt-delete_filter" class="dataTables_filter">
                      <input type="hidden" id="id_persyaratan_search" name="id_persyaratan_search" >
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

  		 <div class="tab-pane fade" id="demo-lft-tab-3"></div>

      </div>

    </div>
      
      
  </div>
  
  <script type="text/javascript" charset="utf-8">
  // specify the columns
  var url_view= BASE_URL2+'view/persyaratan/'; 
  var url_api=BASE_URL+'persyaratan/persyaratan/';
  var url_api2=BASE_URL+'persyaratan/pengajuan/';


  var columnDefs_persyaratan =  
  [
    {headerName: "Id Persyaratan", field: "id", width: 50, filterParams:{newRowsAction: "keep"}},
    {headerName: "Jabatan", field: "jabatan_baru", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Masa Jabatan", field: "masa_jabatan", width: 100, filterParams:{newRowsAction: "keep"}},
    {headerName: "Kompetensi", field: "kompetensi", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Pendidikan Formal", field: "formal", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Pendidikan Non Formal", field: "nonformal", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Jabatan Sebelumnya", field: "jabatan_lama", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Tufoksi", field: "tufoksi", width: 190, filterParams:{newRowsAction: "keep"}},
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

  function add_persyaratan(){
    gopop(url_view+'form_persyaratan.php',save_persyaratan,'medium');
    window.setTimeout(function(){
      $('#id_persyaratan').val('');
    },500);
    
  }

  function edit_persyaratan(){
    var idcell = getGridId(gridOptions_persyaratan,'id');
    if(!empty(idcell)){
      gopop(url_view+'form_persyaratan.php',save_persyaratan,'medium');
    }else{
      onMessage('Silahkan Pilih Jabatan Terlebih dahulu!');
    }
  }



  function resetsearch_persyaratan(){
    $('#search_persyaratan').val('');
    loaddata_persyaratan(0);
  }

  function save_persyaratan(){
    if(empty($('#txtjabatan').val())){
    onMessage('Data Nama Jabatan tidak boleh kosong');
    return false;
    }else if(empty($('#masajbt').val())){
    onMessage('Masa jabatan tidak boleh kosong');
    return false;
    }else if(empty($('#txtjabatans').val())){
    onMessage('Data Nama Jabatan yang pernah diemban tidak boleh kosong');
    return false;
    }else if(empty($('#tufoksi').val())){
    onMessage('Tufoksi tidak boleh kosong');
    return false;
    }else  {
    postForm('form-persyaratan', url_api+'save',loaddata_persyaratan);
    }
  }

   function delete_persyaratan(){
    var idcell = getGridId(gridOptions_persyaratan,'id');
    if(!empty(idcell)){
      submit_get(url_api+'delete?id='+idcell,loaddata_persyaratan);
    }else{
      onMessage('Silahkan Pilih Jabatan Terlebih dahulu!');
    }
  }

  function lihat_pengajuan(){
    var idcell = getGridId(gridOptions_persyaratan,'id');
    $('#id_persyaratan_search').val(idcell);
    if(!empty(idcell)){
      // gopop(url_view+'form_persyaratan.php',save_persyaratan,'medium');
      loaddata_pengajuan(0);
    }else{
      onMessage('Silahkan Pilih Jabatan Terlebih dahulu!');
    }
  }
   
  function loaddata_pengajuan(jml){ 
    var search = 0;
            if($('#search_pengajuan').val() !==''){
              search = $('#search_pengajuan').val();
            }
            if($('#id_persyaratan_search').val() !==''){
              id = $('#id_persyaratan_search').val();
            }
    $.ajax({
      url: url_api2+'listdata/'+search+'/'+jml+'/?id='+id,
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
                    $('.nav-tabs a[href="#demo-lft-tab-pengajuan"]').tab('show');
            }else{
              gridOptions_pengajuan.api.setRowData([]);
              $('.nav-tabs a[href="#demo-lft-tab-pengajuan"]').tab('show');
            }
    }
    ,
      error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
    }
    );
  }

  var columnDefs_pengajuan =  
  [
    {headerName: "Id Pengajuan", field: "id", width: 50, filterParams:{newRowsAction: "keep"}},
    {headerName: "Nama Pengaju", field: "nama", width: 100, filterParams:{newRowsAction: "keep"}},
    {headerName: "Masa Jabatan", field: "masa_jabatan", width: 100, filterParams:{newRowsAction: "keep"}},
    {headerName: "Kompetensi", field: "kompetensi", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Pendidikan Formal", field: "formal", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Pendidikan Non Formal", field: "nonformal", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Jabatan Sebelumnya", field: "jabatan", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Tufoksi", field: "tufoksi", width: 190, filterParams:{newRowsAction: "keep"}},
    {headerName: "Status", field: "status", width: 190, filterParams:{newRowsAction: "keep"}},
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

  var gridDivPengajuan = document.querySelector('#myGrid_pengajuan');
  new agGrid.Grid(gridDivPengajuan, gridOptions_pengajuan);

  function lihat_pengajuan_detail(){
    var idcell = getGridId(gridOptions_pengajuan,'id');
    if(!empty(idcell)){
      gopop(url_view+'form_pengajuan_detail.php',save_pengajuan,'large');
    }else{
      onMessage('Silahkan Pilih Nama Pengaju Terlebih dahulu!');
    }
    
  }

  function resetsearch_pengajuan(){
    $('#search_pengajuan').val('');
    loaddata_pengajuan(0);
  }

   function save_pengajuan(){
    if(empty($('#status').val())){
    onMessage('Data Status tidak boleh kosong');
    return false;
    }else if(empty($('#keterangan').val())){
    onMessage('Data Keterangan tidak boleh kosong');
    return false;
    } else {
      postForm('form-pengajuan-detail', url_api2+'save',loaddata_pengajuan);
    }
    
  }

   function delete_pengajuan(){
    var idcell = getGridId(gridOptions_pengajuan,'id');
    if(!empty(idcell)){
      submit_delete_pengajuan_get(url_api2+'delete?id='+idcell,loaddata_pengajuan);
    }else{
      onMessage('Silahkan Pilih Jabatan Terlebih dahulu!');
    }
  }

  function submit_delete_pengajuan_get(urlp, loaddata) {
    var hasil;
    var message;
    swal({
        title: "Apakah Anda sudah Yakin?",
        text: "Data segera di proses!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Segera proses!",
        closeOnConfirm: false
    }, function () {
        $.ajax({
            url: urlp,
            headers: {
                'Authorization': localStorage.getItem("Token"),
                'X_CSRF_TOKEN': 'donimaulana',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            processData: false,
            success: function (data, textStatus, jQxhr) {

                hasil = data.hasil;
                message = data.message;
                if (hasil == "success") {


                    // return 'hore';
                    loaddata(0,data.id_persyaratan);
                } else {
                    $.niftyNoty({
                        type: 'danger',
                        title: 'Error',
                        message: message,
                        container: 'floating',
                        timer: 5000
                    });

                    // return 'gakhore';
                }


            },
            error: function (jqXhr, textStatus, errorThrown) {
                $.niftyNoty({
                    type: 'danger',
                    title: 'Warning!',
                    message: message,
                    container: 'floating',
                    timer: 5000
                });
                // return 'error';
            }
        });
        swal("Sukses!", "Data Diproses.", "success");
    });


    //statusEnding();
}

</script>
<script src="js/login.js"></script>