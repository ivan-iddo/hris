<!--Nav Tabs-->
<ul class="nav nav-tabs">
  <li class="active">
    <a data-toggle="tab" href="#demo-lft-tab-1">
      <i class="demo-psi-home">
      </i> List
    </a>
  </li>
	<div class="table-toolbar-left" id="demo-custom-toolbar2">
	 <div class="form-group">
         <input  id="awal" name="awal" class="form-control" placeholder="dd-mm-yyyy" type="text">
	 </div>
	 <div class="form-group">
         <input  name="akhir" id="akhir" class="form-control" placeholder="dd-mm-yyyy" type="text">
	 </div>
    </div>
  	<div class="table-toolbar-left" id="demo-custom-toolbar2">
				<div class="btn-group">
                    <button class="btn btn-success btn-sm" onclick="filter1()">Filter Data 1
                    </button>
                </div>
				<div class="btn-group">
                    <button class="btn btn-success btn-sm" onclick="filter2()">Filter Data 2
                    </button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-success btn-sm" onclick="filter3()">Filter Data 3
                    </button>
                </div>
				<div class="btn-group">
                    <button class="btn btn-success btn-sm" onclick="filter4()">Filter Data 4
                    </button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-success btn-sm" onclick="filter5()">Filter Data 5
                    </button>
                </div>
				<div class="btn-group">
                    <button class="btn btn-success btn-sm" onclick="filter6()">Filter Data 6
                    </button>
                </div>
				<div class="btn-group">
                    <button class="btn btn-success btn-sm" onclick="filter7()">Filter Data 7
                    </button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-success btn-sm" onclick="filter8()">Filter Data 8
                    </button>
                </div>
				<div class="btn-group">
                    <button class="btn btn-success btn-sm" onclick="filter9()">Filter Data 9
                    </button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-success btn-sm" onclick="filter10()">Filter Data 10
                    </button>
                </div>
            </div>
			<div class="row">
			<div class="table-toolbar-right">
				<div class="btn-group">
				<button class="btn btn-default"  onCLick="download()"><i class="fa fa-file-excel-o"></i> Download Excel</button>
				</div>
			</div>
		</div>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active in" id="demo-lft-tab-1">
        <div class="fixed-table-toolbar">
        </div>
        <div class="panel-body">
            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="demo-dt-addrow_wrapper">
                <div class="dataTables_filter" id="demo-dt-addrow_filter">
                    <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder=""
                                         type="search" id="search"
                                         onkeydown="if(event.keyCode=='13'){loaddata(0, this);}"></label>
                </div>
            </div>
            <div class="bootstrap-table">
                <div class="fixed-table-container" style="padding-bottom: 0px;">
                    <div class="ag-theme-balham" id="myGrid" style="height: 400px;width:100%;">
                    </div>

                    <div class="paging pull-right mar-all">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('.judul-menu').html('Laporan Latihan dan Pengembangan');
function download(){
    var params = { 
        fileName: 'latbang',
        sheetName: 'latbang'
    };
    gridOptionsList.api.exportDataAsExcel(params);
}
    var columnListData = [
			{headerName: "Jenis Perjalanan", field: "jenis_perjalanan", width: 190, rowGroup: true, enableRowGroup:true, hide:true, filterParams: {newRowsAction: 'keep'}},
			{headerName: 'Pegawai',
			children: [
			{headerName: "Nama pegawai", field: "pengembangan_pelatihan_detail.nama_pegawai", width: 190, aggFunc: 'count', filterParams: {newRowsAction: 'keep'}},
            {headerName: "Unit", field: "grup", width: 190, filterParams: {newRowsAction: 'keep'}},
			{headerName: "Profesi", field: "profesi", width: 190, filterParams: {newRowsAction: 'keep'}},
			{headerName: "Golongan", field: "pengembangan_pelatihan_detail.golongan", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Pangkat", field: "pengembangan_pelatihan_detail.pangkat", width: 190, filterParams: {newRowsAction: 'keep'}},
			]},
			{headerName: 'Pelatihan',
			children: [
            {headerName: "Nama Pelatihan", field: "nama_pelatihan", width: 190, rowGroup: true, enableRowGroup:true, enablePivot:true, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Kegiatan", field: "pengembangan_pelatihan_kegiatan.nama", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Pengembangan Pelatihan Status", field: "pengembangan_pelatihan_kegiatan_status.nama", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Institusi", field: "institusi", width: 190, filterParams: {newRowsAction: 'keep'}},
			{headerName: "Tipe", field: "jenis", width: 190, filterParams: {newRowsAction: 'keep'}},
			]},
			{headerName: 'Biaya',
			children: [
            {headerName: "Jenis Biaya", field: "jenis_biaya", width: 190, filterParams: {newRowsAction: 'keep'}},
			{headerName: "Biaya", field: "uraian_total", width: 190, filterParams: {newRowsAction: 'keep'}},
			]},
			{headerName: 'create',
			children: [
            {headerName: "Created Date", field: "created", width: 190, hide:true, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Created By", field: "createdby", width: 190, filterParams: {newRowsAction: 'keep'}},
            ]},
  ];
  
  function filter1() {
    gridOptionsList.columnApi.setPivotMode(true);
    gridOptionsList.columnApi.setPivotColumns(['jenis_perjalanan']);
    gridOptionsList.columnApi.setRowGroupColumns(['jenis_biaya','nama_pelatihan']);
  } 
  function filter2() {
    gridOptionsList.columnApi.setPivotMode(false);
    gridOptionsList.columnApi.setPivotColumns([]);
    gridOptionsList.columnApi.setRowGroupColumns(['grup']);
  }
  function filter3() {
    gridOptionsList.columnApi.setPivotMode(false);
    gridOptionsList.columnApi.setPivotColumns([]);
    gridOptionsList.columnApi.setRowGroupColumns(['profesi','jenis_biaya']);
  }
  function filter4() {
    gridOptionsList.columnApi.setPivotMode(true);
    gridOptionsList.columnApi.setPivotColumns(['profesi']);
    gridOptionsList.columnApi.setRowGroupColumns(['grup']);
  }
  function filter5() {
    gridOptionsList.columnApi.setPivotMode(false);
    gridOptionsList.columnApi.setPivotColumns([]);
    gridOptionsList.columnApi.setRowGroupColumns(['pengembangan_pelatihan_detail.nama_pegawai']);
  }
  function filter6() {
    gridOptionsList.columnApi.setPivotMode(false);
    gridOptionsList.columnApi.setPivotColumns([]);
    gridOptionsList.columnApi.setRowGroupColumns(['pengembangan_pelatihan_kegiatan.nama']);
  } 
  function filter7() {
    gridOptionsList.columnApi.setPivotMode(true);
    gridOptionsList.columnApi.setPivotColumns(['profesi']);
    gridOptionsList.columnApi.setRowGroupColumns(['pengembangan_pelatihan_kegiatan.nama','pengembangan_pelatihan_detail.golongan']);
  }
  function filter8() {
    gridOptionsList.columnApi.setPivotMode(true);
    gridOptionsList.columnApi.setPivotColumns(['profesi','jenis_biaya']);
    gridOptionsList.columnApi.setRowGroupColumns(['grup']);
  } 
  function filter9() {
    gridOptionsList.columnApi.setPivotMode(true);
    gridOptionsList.columnApi.setPivotColumns(['jenis_biaya']);
    gridOptionsList.columnApi.setRowGroupColumns(['jenis','profesi']);
  }
  function filter10() {
    gridOptionsList.columnApi.setPivotMode(false);
    gridOptionsList.columnApi.setPivotColumns(['jenis_biaya']);
    gridOptionsList.columnApi.setRowGroupColumns(['jenis','profesi']);
  }

    var gridOptionsList = {
        enableSorting: true,
        enableFilter: true,
		suppressAggFuncInHeader: true,
        suppressRowClickSelection: false,
        //groupDefaultExpanded: 2,
        groupSelectsChildren: true,
        debug: true,
        rowSelection: 'single',
        enableColResize: true,
        rowGroupPanelShow: 'always',
        pivotPanelShow: 'always',
        enableRangeSelection: true,
        columnDefs: columnListData,
		groupIncludeFooter: true,
		groupIncludeTotalFooter: true,
        pagination: false,
        autoGroupColumnDef: {
            headerName: 'Group',
            field: 'athlete'
        },
        defaultColDef: {
            editable: false,
            enableRowGroup: true,
            enablePivot: true,
            enableValue: true
        },
        //onGridReady: function (params) {
        //    params.api.sizeColumnsToFit();
       // },
        onCellEditingStarted: function (event) {
            console.log('cellEditingStarted');
        },
        onCellEditingStopped: function (event) {
            console.log('cellEditingStopped');
        }
    };

    var myGrid = document.querySelector('#myGrid');
    new agGrid.Grid(myGrid, gridOptionsList);

    function loaddata(jml = 0) {
		var awal= 0;
		var akhir= 0;
        var search = 0;
        if ($('#search').val() !== '') {
            search = $('#search').val();
        }if ($('#awal').val() !== '') {
            awal=$('#akhir').val();
        }if ($('#search').val() !== '') {
            akhir=$('#akhir').val();
        }
        $.ajax({
            url: BASE_URL + 'pengembangan_pelatihan/list/' + jml + '/' +search,
            headers: {
                'Authorization': localStorage.getItem("Token"),
                'X_CSRF_TOKEN': 'donimaulana',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            processData: false,
            success: function (data, textStatus, jQxhr) {
                if (data.is_blocked == true){
                    $("#users-blocked").removeClass('hidden');
                }
                else{
                    $("#users-blocked").addClass('hidden');
                }
                if (data.is_monev == true){
                    $("#users-monev").removeClass('hidden')
                }
                else{
                    $("#users-monev").addClass('hidden');
                }
                gridOptionsList.api.setRowData(data.result);
                pagingDatatable(data.total, data.limit, 'loaddata');
            },
            error: function (jqXhr, textStatus, errorThrown) {
                alert('error');
            }
        });
    }
    
    loaddata();
			
	$(document).ready(function () {
        $('#awal').datepicker({
            format: "dd-mm-yyyy",
        });
		$('#akhir').datepicker({
            format: "dd-mm-yyyy",
        });
    });
	

</script>