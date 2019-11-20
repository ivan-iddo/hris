 
<div class="bootstrap-table">
  <div class="fixed-table-container" style="padding-bottom: 0px;">
    <div class="ag-theme-balham" id="gridPendidikan" style="height: 200px;width:100%;"></div>
    
  </div>
</div>



<script>
	

  var columnPendidikan = [ 
  {headerName: "Dokumen", field: "url", 
  cellRenderer: function(params) {
    return '<a href="api/upload/data/'+params.value+'" target="_blank"><i class="fa fa-eye"></i>Lihat Dokumen</a>'
  }},
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