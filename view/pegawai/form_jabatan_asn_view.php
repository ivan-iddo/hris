<div class="bootstrap-table">
  <div class="fixed-table-container" style="padding-bottom: 0px;">
    <div class="ag-theme-balham" id="gridj" style="height: 200px;width:100%;"></div>

  </div>
</div>
<script>
  var columnJabatan = [ 
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
   onRowDoubleClicked: editJasn,
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
</script>