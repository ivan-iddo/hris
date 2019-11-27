<div class="bootstrap-table">
  <div class="fixed-table-container" style="padding-bottom: 0px;">
    <div class="ag-theme-balham" id="gridGolongan" style="height: 200px;width:100%;"></div>
  </div>
</div>
<script>
  var columnGolongan = [ 
  {headerName: "Dokumen", field: "url", 
  cellRenderer: function(params) {
    return '<i class="fa fa-eye"></i>Lihat Dokumen'
  }},
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
	onRowClicked: golongan,
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
  
  function golongan(){
  var selectedRows = gridGolonganOpt.api.getSelectedRows();
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
    message: $('<div></div>').load('view/pegawai/view_golongan.php'),
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
$('#id_gol').val(selectedRowsString);
}
}
</script>