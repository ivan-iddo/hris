
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
						View Data
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
			<div class="col-sm-6 table-toolbar-left">
					                    <button id="demo-btn-addrow" class="btn btn-purple" onclick="addsjab()"><i class="demo-pli-add"></i> Tambah Persyaratan Jabatan</button>
                                        <button style="margin-left:3px" class="btn btn-mint" onclick="editsj()"><i class="fa fa-file-excel-o"></i> Edit</button>
                                        <button class="btn btn-danger" onclick="hapussj()"><i class="fa fa-file-excel-o"></i> Delete</button>
                                                      
					                     
					                </div>
			   <div class="dataTables_filter" id="demo-dt-addrow_filter">
					<label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="filter-text-box" oninput="onFilterTextBoxChanged()" ></label>
			 </div> 
			 </div>  
			 </div>  
	 
            <div class="ag-theme-balham" id="Gridform1" style="height: 400px;width:100%;">
        </div>
        </div>
		 <div class="tab-pane fade" id="demo-lft-tab-3"></div>
      </div>
    </div>
      
      
  </div>
  
       
  
      
      <script charset="utf-8" type="text/javascript">
          $('.judul-menu').html('Persyaratan Jabatan'); 
          $('.import').hide();
          $('.select-chosen').chosen();
          $('.chosen-container').css({"width": "100%"});
         
          var group = localStorage.getItem('group');

    function downloadform1(){
    var params = { 
        fileName: 'form1',
        sheetName: 'form1'
    };

    Gridform1.api.exportDataAsExcel(params);
}

  function editsj(){
    var selectedRows = Gridform1.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Data di Tabel Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
           }); 
           gopop('view/persyaratan/add_form.php',editjab,'large');
           
            }
  }
  
		function editjab(){
		if(empty($('#name_jab').val())){
		onMessage('Data Nama Jabatan tidak boleh kosong');
		return false;
		}else if(empty($('#mas_jab').val())){
		onMessage('Masa jabatan tidak boleh kosong');
		return false;
		}else if(empty($('#mas_jab_se').val())){
		onMessage('Masa jabatan sekarang tidak boleh kosong');
		return false;
		}else if(empty($('#tufoksi').val())){
		onMessage('Tufoksi tidak boleh kosong');
		return false;
		}else  {
			postForm('form-syarat_jabatan',BASE_URL+"abk/abk/addnewpengajuan",gethasil);
		}
		   
		  }


       function hapussj(){
             var selectedRows = Gridform1.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih data Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
           });
           submit_get(BASE_URL+'abk/abk/deletetk/?id='+selectedRowsString,listFromtk);
           
           
            }
           }

          var headerForm1 = [
           {headerName: "No.", field: "no", width: 80, filterParams:{newRowsAction: 'keep'}},
		   {headerName: "Nama Jabatan", field: "unit_kerja", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Masa Jabatan", field: "kategori_sdm", width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Standar Kompetensi", field: "slta", width: 120, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Formal", field: "d3", width: 100, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "Non Formal", field: "d3", width: 100, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "Jabatan yang Pernah Diemban", field: "s1", width: 80, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Tufoksi", field: "total", width: 80, filterParams:{newRowsAction: 'keep'}},
         
           
        ];

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

        var Gridform1 = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false, 
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single', 
    enableColResize: true,
    onFirstDataRendered: onFirstDataRendered,
           rowGroupPanelShow: 'always',
           pivotPanelShow: 'always',
           enableRangeSelection: true,
           columnDefs: headerForm1,
           pagination: false,
           paginationPageSize: 50,   
           defaultColDef:{
               editable: false,
               enableRowGroup:true,
               enablePivot:true,
               enableValue:true
           },
    onGridReady: function (params) {
        params.api.sizeColumnsToFit();
    }
        };

        function onFirstDataRendered(params) {
    params.api.sizeColumnsToFit();
}

        // setup the grid after the page has finished loading 
           var gridDiv = document.querySelector('#Gridform1');
           new agGrid.Grid(gridDiv, Gridform1);

            function listFrom1(){
              var thn=$('#thn').val();
              if(empty(thn)){
                var d = new Date();
                var n = d.getFullYear();
                  thn = n;
              }

          }

          function loadForm1(result){
              if(result.hasil ==='success'){
                Gridform1.api.setRowData(result.result);
              }
          }

          listFrom1();

		   function addsjab(){
      gopop('view/persyaratan/add_form.php',add,'large');
  }
		function add(){
		if(empty($('#name_jab').val())){
		onMessage('Data Nama Jabatan tidak boleh kosong');
		return false;
		}else if(empty($('#mas_jab').val())){
		onMessage('Masa jabatan tidak boleh kosong');
		return false;
		}else if(empty($('#mas_jab_se').val())){
		onMessage('Masa jabatan sekarang tidak boleh kosong');
		return false;
		}else if(empty($('#tufoksi').val())){
		onMessage('Tufoksi tidak boleh kosong');
		return false;
		}else  {
			postForm('form-syarat_jabatan',BASE_URL+"abk/abk/addnewpengajuan",gethasil);
		}
		   
		  }

  
    </script><script src="js/login.js" type="text/javascript">
  </script>
   
  