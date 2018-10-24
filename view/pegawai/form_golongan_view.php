 
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
              <div class="ag-theme-balham" id="gridGolongan" style="height: 200px;width:100%;"></div>
               
            </div>
          </div>
    
  

<script>
	

var columnGolongan = [ 
            {headerName: "Golongan", field: "namaGolongan", width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "TMT Golongan", field: "tmt_golongan", width: 190, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "No.SK", field: "no_sk", width: 100, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "Tgl.SK", field: "tgl_sk", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Penandatangan SK", field: "penanda_tanganan", width: 190, filterParams:{newRowsAction: 'keep'}},
           

        ];

var gridGolonganOpt = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false,  
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