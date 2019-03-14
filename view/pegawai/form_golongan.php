 
	<div class="row ">
	 
		<div class="newtoolbar">
		  <div class="table-toolbar-left" id="demo-custom-toolbar2">
		    <div class="btn-group" style="padding-left:10px">
		      <button class="btn btn-mint btn-labeled fa fa-plus-square btn-sm" onClick="addGolongan();">Add</button>
		      <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onclick="editGolongan();">Edit</button>
          <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onclick="setGolongan();">Set sbg Golongan Saat Ini</button>
		      <button class="btn btn-warning btn-labeled fa fa-close btn-sm" onclick="deletGolongan();">Delete</button>
		    </div>
		  </div>
		</div>
	 
	</div>
    <div class="bootstrap-table">
            <div class="fixed-table-container" style="padding-bottom: 0px;">
              <div class="ag-theme-balham" id="gridGolongan" style="height: 200px;width:100%;"></div>
               
            </div>
          </div>
    
  

<script>
	

var columnGolongan = [ 
            {headerName: "Pangkat", field: "pangkat_id", width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "TMT Golongan", field: "tmt_golongan", width: 190, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "TMT Golongan Akhir", field: "tmt_golongan_akhir", width: 190, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "No.SK", field: "no_sk", width: 100, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "Tgl.SK", field: "tgl_sk", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Penandatangan SK", field: "penanda_tanganan", width: 190, filterParams:{newRowsAction: 'keep'}},
           

        ];

var gridGolonganOpt = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false, 
           onRowDoubleClicked: editGolongan,
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single',
           enableColResize: true, 
           enableRangeSelection: true,
           columnDefs: columnGolongan,
           pagination: false, 
           defaultColDef:{
               editable: false,
               enableRowGroup:false,
               enablePivot:false,
               enableValue:true
           }
        };
        
        


    var gridDiv = document.querySelector('#gridGolongan');
    new agGrid.Grid(gridDiv, gridGolonganOpt);
           
   
            
            
          
           
           
          
</script>