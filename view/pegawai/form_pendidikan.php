 
	<div class="row ">
	 
		<div class="newtoolbar">
		  <div class="table-toolbar-left" id="demo-custom-toolbar2">
		    <div class="btn-group" style="padding-left:10px">
		      <button class="btn btn-mint btn-labeled fa fa-plus-square btn-sm" onClick="addPendidikan();">Add</button>
          <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onclick="editPendidikan();">Edit</button>
          <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onclick="setPendidikan();">Set sbg Pendidikan Terakhir</button>
		      <button class="btn btn-warning btn-labeled fa fa-close btn-sm" onclick="deletPendidikan();">Delete</button>
		    </div>
		  </div>
		</div>
	 
	</div>
    <div class="bootstrap-table">
            <div class="fixed-table-container" style="padding-bottom: 0px;">
              <div class="ag-theme-balham" id="gridPendidikan" style="height: 200px;width:100%;"></div>
               
            </div>
          </div>
    
  

<script>
	

var columnPendidikan = [ 
            {headerName: "Jenjang", field: "jenjang", width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama Sekolah", field: "nama_sekolah", width: 190, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "Tahun Lulus", field: "tahun", width: 100, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "No.Ijazah", field: "no_ijazah", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Tgl.Ijazah", field: "tgl_ijazah", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Kepala Sekolah", field: "pen_nkep", width: 190, filterParams:{newRowsAction: 'keep'}}, 
        ];

var gridPendidikanOpt = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false, 
           onRowDoubleClicked: editPendidikan,
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single',
           enableColResize: true, 
           enableRangeSelection: true,
           columnDefs: columnPendidikan,
           pagination: false, 
           defaultColDef:{
               editable: false,
               enableRowGroup:false,
               enablePivot:false,
               enableValue:true
           }
        };
        
        


    var gridDiv = document.querySelector('#gridPendidikan');
    new agGrid.Grid(gridDiv, gridPendidikanOpt);
           
   
           
          
</script>