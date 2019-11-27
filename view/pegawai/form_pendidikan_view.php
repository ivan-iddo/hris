 
<div class="bootstrap-table">
  <div class="fixed-table-container" style="padding-bottom: 0px;">
    <div class="ag-theme-balham" id="gridPendidikan" style="height: 200px;width:100%;"></div>
    
  </div>
</div>



<script>
	

  var columnPendidikan = [ 
  {headerName: "Dokumen", field: "url", 
  cellRenderer: function(params) {
    return '<i class="fa fa-eye"></i>Lihat Dokumen'
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
   onRowClicked: pendidikan,
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
 
 function pendidikan(){
  var selectedRows = gridPendidikanOpt.api.getSelectedRows();
// alert('>>'+selectedRows+'<<<');
if(selectedRows == ''){
  onMessage('Silahkan Pilih Keluarga Terlebih dahulu!');
  return false;
}else{
  var selectedRowsString = '';
  selectedRows.forEach( function(selectedRow, index) {

    if (index!==0) {
      selectedRowsString += ', ';
    }
    selectedRowsString += selectedRow.id;
  });

  bootbox.dialog({ 
    message: $('<div></div>').load('view/pegawai/view_pendidikan.php'),
    backdrop: false,
    size:'large',
    buttons: {
	main: {
	  label: "Close",
	  className: "btn-warning",
	  callback: function() {
		$.niftyNoty({
		  type: 'dark',
		  message : "Bye Bye",
		  container : 'floating',
		  timer : 5000
		});
	  }
	}
}
});
$('#id_pen').val(selectedRowsString);
}
}
 
 
 
 
 
 
</script>