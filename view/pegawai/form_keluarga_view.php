<div class="bootstrap-table">
  <div class="fixed-table-container" style="padding-bottom: 0px;">
    <div class="ag-theme-balham" id="gridKeluarga" style="height: 200px;width:100%;"></div>

  </div>
</div>
<script>
  var columnKeluarga = [ 
  {headerName: "Dokumen", field: "url", 
  cellRenderer: function(params) {
    return '<i class="fa fa-eye"></i>Lihat Dokumen'
  }},
  {headerName: "NIK", field: "nik", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Tempat Lahir", field: "tpt_lahir", width: 190, filterParams:{newRowsAction: 'keep'}}, 
  {headerName: "Tgl.Lahir", field: "tgl_lahir", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Gender", field: "kelamin", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Hubungan", field: "hubkel", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Kartu Nikah", field: "karn", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Pendidikan", field: "pendidikan", width: 190, filterParams:{newRowsAction: 'keep'}}, 
  {headerName: "Pekerjaan", field: "pekerjaan", width: 190, filterParams:{newRowsAction: 'keep'}},
  
];

var gridKeluargaOpt = {
 enableSorting: true,
 enableFilter: true,
 suppressRowClickSelection: false,  
 groupSelectsChildren: true,
 debug: true,
 onRowClicked: Keluarga,
 rowSelection: 'single',
 enableColResize: true, 
 enableRangeSelection: true,
 columnDefs: columnKeluarga,
 pagination: false, 
 defaultColDef:{
   editable: false,
   enableRowGroup:false,
   enablePivot:false,
   enableValue:true
 }
};
var gridDiv = document.querySelector('#gridKeluarga');
new agGrid.Grid(gridDiv, gridKeluargaOpt);

function Keluarga(){
  var selectedRows = gridKeluargaOpt.api.getSelectedRows();
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
    message: $('<div></div>').load('view/pegawai/view_keluarga.php'),
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
$('#id_keluarga').val(selectedRowsString);
}
}
</script>