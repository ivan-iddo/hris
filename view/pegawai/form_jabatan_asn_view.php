<div class="bootstrap-table">
  <div class="fixed-table-container" style="padding-bottom: 0px;">
    <div class="ag-theme-balham" id="gridj" style="height: 200px;width:100%;"></div>

  </div>
</div>
<script>
  var columnJabatan = [ 
  {headerName: "Dokumen", field: "url", 
  cellRenderer: function(params) {
    return '<i class="fa fa-eye"></i>Lihat Dokumen'
  }},
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

  var gridJOpt = {
   enableSorting: true,
   enableFilter: true,
   suppressRowClickSelection: false, 
   onRowDoubleClicked: Jasn,
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
 var gridDiv = document.querySelector('#gridj');
 new agGrid.Grid(gridDiv, gridJOpt);
 
 function Jasn(){
  var selectedRows = gridJOpt.api.getSelectedRows();
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
    message: $('<div></div>').load('view/pegawai/view_jabatan_asn.php'),
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
$('#id_jans').val(selectedRowsString);
}
}
</script>