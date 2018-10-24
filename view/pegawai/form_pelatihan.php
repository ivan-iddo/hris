 
	<div class="row ">
	 
		<div class="newtoolbar">
		  <div class="table-toolbar-left" id="demo-custom-toolbar2">
		    <div class="btn-group" style="padding-left:10px">
		      <button class="btn btn-mint btn-labeled fa fa-plus-square btn-sm" onClick="addPelatihan();">Add</button>
		      <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onclick="editPelatihan();">Edit</button>
		      <button class="btn btn-warning btn-labeled fa fa-close btn-sm" onclick="deletPelatihan();">Delete</button>
		    </div>
		  </div>
		</div>
	 
	</div>
    <div class="bootstrap-table">
            <div class="fixed-table-container" style="padding-bottom: 0px;">
              <div class="ag-theme-balham" id="gridPelatihan" style="height: 200px;width:100%;"></div>
               
            </div>
          </div>
    
  

<script>
	

var columnPelatihan = [ 
            {headerName: "Pelatihan", field: "nama", width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Tempat", field: "tempat", width: 190, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "Penyelenggara", field: "penyelenggara", width: 100, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "Penanggung Biaya", field: "penanggung", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Lama Pelatihan", field: "durasi", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Mulai", field: "mulai", width: 190, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "Berakhir", field: "sampai", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Bersertifikat", field: "jenis_sertifikat", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "No.Sertifikat", field: "no_sertifikat", width: 190, filterParams:{newRowsAction: 'keep'}},
           

        ];

var gridPelatihanOpt = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false, 
           onRowDoubleClicked: editPelatihan,
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single',
           enableColResize: true, 
           enableRangeSelection: true,
           columnDefs: columnPelatihan,
           pagination: false, 
           defaultColDef:{
               editable: false,
               enableRowGroup:false,
               enablePivot:false,
               enableValue:true
           }
        };
        
        


    var gridDiv = document.querySelector('#gridPelatihan');
    new agGrid.Grid(gridDiv, gridPelatihanOpt);
           
   
            
            
          
           
           
          
</script>