<div class="row demo-nifty-panel">
    <div class="col-sm-3">
        <div class="panel panel-colorful panel-primary">
            <div class="panel-heading">
				<h3 class="panel-title">Dokumen Jalan : <span id="jmljalan">0</span></h3>
			</div>
        </div>
    </div>
     <div class="col-sm-3">
        <div class="panel panel-colorful panel-primary">
            <div class="panel-heading">
				<h3 class="panel-title">Dokumen Jembatan : <span id="jmljembatan">0</span></h3>
			</div>
        </div>
    </div>
      <div class="col-sm-3">
        <div class="panel panel-colorful panel-primary">
            <div class="panel-heading">
				<h3 class="panel-title">Dokumen Lainnya : <span id="jmllain">0</span></h3>
			</div>
        </div>
    </div>
      <div class="col-sm-3">
        <div class="panel panel-colorful panel-success">
            <div class="panel-heading">
				<h3 class="panel-title">Total File : <span id="jmlfile">0</span></h3>
			</div>
        </div>
    </div>
</div>

<div id="page-content" class="isi" style="background: #fff">
                    
					<div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">Pencarian Dokumen</h3>
					    </div>
					    <div class="panel-body" style="margin:10px">
					
					        <!-- Inline Form  -->
					        <!--===================================================-->
					        <form class="form-inline">
					           <div class="input-group mar-btm">
					                        <input placeholder="Search" id="search" class="form-control" type="text" style="width:auto">
					                        <span class="input-group-btn">
					                            <button class="btn btn-mint" type="button" onClick="cari()">Search</button>
					                        </span>
					                    </div>
					        </form>
					        <!--===================================================-->
					        <!-- End Inline Form  -->
					
					    </div>
					</div>
                    <div class="ag-theme-balham" id="myGrid" style="height: 400px;width:100%;">
</div>


<script>
     var columnDefs = [
           {headerName: "No.Dokumen", field: "no_dok", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Judul Dokumen", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Tanggal Pembuatan", field: "tgl", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Unit Kerja", field: "uk", width: 190, filterParams:{newRowsAction: 'keep'}},
           
        ];
     
     
     var gridOptions = {
    enableSorting: true,
    enableFilter: true,
    suppressRowClickSelection: false,
    onRowDoubleClicked: viewdata,
    groupSelectsChildren: true,
    debug: true,
    rowSelection: 'single',
    enableColResize: true,
    rowGroupPanelShow: 'always',
    pivotPanelShow: 'always',
    enableRangeSelection: true,
    columnDefs: columnDefs,
    pagination: false ,
    defaultColDef:{
      editable: false 
    }
  };

        var gridDiv = document.querySelector('#myGrid');
           new agGrid.Grid(gridDiv, gridOptions);
           
            var autoGroupColumnDef = {
           headerName: "Group",
           width: 200,
           field: 'nama_group',
           valueGetter: function(params) {
               if (params.node.group) {
                   return params.node.key;
               } else {
                   return params.data[params.colDef.field];
               }
           },
           headerCheckboxSelection: true,
           // headerCheckboxSelectionFilteredOnly: true,
           cellRenderer:'agGroupCellRenderer',
           cellRendererParams: {
               checkbox: true
           }
        };
           
           gridOptions.api.setRowData([]);
           
           dokjalan();
    function dokjalan(){
        $.ajax({
                                   url: BASE_URL+'dokumen/getdok',
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( data, textStatus, jQxhr ){
                       if(data.result !== 'empty'){
                         $.each(data, function(i, item) {
                           if(item.id ==10 ){ 
                            $('#jmljalan').html(item.jumlah);
                           }
                           
                           if(item.id ==11 ){ 
                            $('#jmljembatan').html(item.jumlah);
                           }
                           
                           if(item.id ==12 ){ 
                            $('#jmllain').html(item.jumlah);
                           }
                            
                           })
                       
                          //gridOptions.api.setRowData(data);
                        }else{
                         // gridOptions.api.setRowData([]);
                        }
                         
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
        
        
         $.ajax({
                                   url: BASE_URL+'dokumen/getfile',
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( data, textStatus, jQxhr ){
                       if(data.result !== 'empty'){
                           $('#jmlfile').html(data.jumlah);
                        
                           
                           
                          //gridOptions.api.setRowData(data);
                        }else{
                         // gridOptions.api.setRowData([]);
                        }
                         
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
    }
           
           
    function viewdata(){
           var selectedRows = gridOptions.api.getSelectedRows();
           var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
           });
        
        $(".isi").load('view/dokumen_entry_form.php?id_data='+selectedRowsString+'&id_tipe=<?php echo @$_GET['id_tipe'];?>&id_master=<?php echo @$_GET['id_master'];?>');
    }
    
    function cari(){
        var keyword = $('#search').val();
        //alert(keyword);
        var datas = {keyword:keyword}
        
        $.ajax({
                                   url: BASE_URL+'dokumen/list_entry_dok',
                                    headers: {
                                'Authorization': localStorage.getItem("Token"),
                                                    'X_CSRF_TOKEN':'donimaulana',
                                                                        'Content-Type':'application/json'
                                                                        },
                                                                        dataType: 'json',
                                                                        type: 'post',
                                                                        contentType: 'application/json', 
                                                                        processData: false,
                                                                        data:JSON.stringify(datas),
                                   success: function( data, textStatus, jQxhr ){
                                  if(data.result !== 'empty'){
                          gridOptions.api.setRowData(data);
                        }else{
                          gridOptions.api.setRowData([]);
                        }
                    // gridOptions.api.setRowData(data);
               
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
    }
</script>