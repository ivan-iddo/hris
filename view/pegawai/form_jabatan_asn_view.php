 
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
	

var columnJasn = [ 
 {headerName: "Jabatan", field: "jabatan", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Bagian Jabatan", field: "bagian_jabatan", width: 190, filterParams:{newRowsAction: 'keep'}},
 {headerName: "Sub Bagian Jabatan", field: "sub_bagian_jabatan", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "TMT JabFung", field: "tmt_jfung", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "No SK JabFung", field: "no_skjfung", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Tgl SK JabFung", field: "tgl_skjafung", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "No PAK", field: "no_pak", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "TMT PAK", field: "tmt_pak", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Tgl PAK", field: "tgl_pak", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Nilai PAK", field: "nilai_pak", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Satuan Kerja", field: "satuan_kerja", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Keterangan", field: "keterangan", width: 190, filterParams:{newRowsAction: 'keep'}},
            
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
           columnDefs: columnJasn,
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