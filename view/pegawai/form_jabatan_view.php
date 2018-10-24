 
	<div class="row ">
	 
		<div class="newtoolbar">
		  <div class="table-toolbar-left" id="demo-custom-toolbar2">
		    <div class="btn-group" style="padding-left:10px">
		       </div>
		  </div>
		</div>
	 
	</div>
    <div class="bootstrap-table">
            <div class="fixed-table-container" style="padding-bottom: 0px;">
              <div class="ag-theme-balham" id="gridJabatan" style="height: 200px;width:100%;"></div>
               
            </div>
          </div>
    
  

<script>
	

var columnJabatan = [ 
  {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Tgl.Mutasi", field: "tgl", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Keterangan", field: "keterangan", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Direktorat Tujuan", field: "dir_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Bagian Tujuan", field: "bag_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Sub Bagian Tujuan", field: "subbag_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "No.SK", field: "no_sk", width: 190, filterParams:{newRowsAction: 'keep'}},
		  {headerName: "Tgl.SK", field: "tgl_sk", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Kelas Jabatan", field: "kelas", width: 190, filterParams:{newRowsAction: 'keep'}},
            
        ];

var gridJabatanOpt = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false,  
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single',
           enableColResize: true, 
           enableRangeSelection: true,
           columnDefs: columnJabatan,
           pagination: false, 
           defaultColDef:{
               editable: false,
               enableRowGroup:false,
               enablePivot:false,
               enableValue:true
           }
        };
        
        


    var gridDiv = document.querySelector('#gridJabatan');
    new agGrid.Grid(gridDiv, gridJabatanOpt);
           
   
            
            
          
           
           
          
</script>