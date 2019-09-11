<?php session_start();?>
<div class="row">

	<div class="tab-base mar-all">
		<!--Nav Tabs-->

		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#demo-lft-tab-1" data-toggle="tab">
					<span class="block text-center">
						<i class="fa fa-check-square-o fa-2x text-danger"></i> 
					</span>
					Laporan Tenaga Kerja
				</a>
			</li>
		</ul>

		<div class="tab-content">
			<div class="pad-btm form-inline" style="border-top:1px solid #dedede;padding:10px">
				<div class="row">
					<div class="col-sm-6">
						<div class="btn-group">
							<button class="btn btn-success btn-sm" onclick="dir()">Direktorat
							</button>
						</div>
						<div class="btn-group">
							<button class="btn btn-success btn-sm" onclick="unit()">Unit Kerja
							</button>
						</div>
						<div class="btn-group">
							<button class="btn btn-success btn-sm" onclick="profesi()"> Kelompok Profesi
							</button>
						</div>
						<div class="btn-group">
							<button class="btn btn-success btn-sm" onclick="jabatan()">Jabatan
							</button>
						</div>
						<div class="btn-group">
							<button class="btn btn-success btn-sm" onclick="pendidikan()">Pendidikan
							</button>
						</div>
					</div>
					<div class="col-sm-6 table-toolbar-right">
						<div class="btn-group">
							<button class="btn btn-default btn-sm" style="border-radius:0px !important" onClick="download();"><i class="fa fa-download"></i>  Download </button>
						</div>
					</div>
				</div>
				<div class="tab-pane fade active in" id="demo-lft-tab-1"> 
					<div class="ag-theme-balham" id="gridTK" style="height: 300px;width:100%;">
					</div>
				</div>
			</div>
		</div>


	</div>
	<script>
		var headerTK = [
		{headerName: "Tahun", field: "tahun", width: 190, rowGroup: true, enableRowGroup:true, hide:true, filterParams:{newRowsAction: "keep"}},
		{headerName: "Unit Kerja", field: "id_uk", width: 190, rowGroup: true, aggFunc: 'count', filterParams:{newRowsAction: "keep"}},
		{headerName: "Kebutuhan SDM", field: "kategori_sdm", width: 190, rowGroup: true, filterParams:{newRowsAction: "keep"}},
		{headerName: "Profesi", field: "profesi", width: 190, rowGroup: true, filterParams:{newRowsAction: "keep"}},
		{headerName: "Pendidikan", field: "pendidikan", width: 190, rowGroup: true, filterParams:{newRowsAction: "keep"}},
		{headerName: "Jurusan 1", field: "jurusan_1", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "Jurusan 2", field: "jrusan_2", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "Jurusan 3", field: "jrusan_3", width: 190, filterParams:{newRowsAction: "keep"}},

		{headerName: "Pengalaman Kerja", field: "pengalaman", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "Keahlian Komputer", field: "kompi", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "Komputer level", field: "kompi_lvl", width: 190, filterParams:{newRowsAction: "keep"}},

		{headerName: "Gender", field: "kelamin", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "max usia", field: "max_usia", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "min usia", field: "min_usia", width: 190, filterParams:{newRowsAction: "keep"}},

		{headerName: "Bahasa Inggris", field: "bahasa", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "Bahasa level", field: "bahasa_level", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "Tinggi b min (Cm)", field: "tinggi_b_min", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "Tinggi b max (Cm)", field: "tinggi_b_max", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "Berat b min (Cm)", field: "berat_b_min", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "Berat b max (Cm)", field: "berat_b_max", width: 190, filterParams:{newRowsAction: "keep"}},

		{headerName: "buta warna", field: "buta_warna", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "kacamata", field: "kacamata", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "Keterbatasan Fisik", field: "fisik_lain", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "Keterbatasan Fisik detail", field: "fisik_lain_detail", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "kompetensi", field: "kompetensi", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "syarat khusus", field: "syarat_khusus", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "test khusus", field: "test_khusus", width: 190, filterParams:{newRowsAction: "keep"}},
		{headerName: "lain lain", field: "lain_lain", width: 190, filterParams:{newRowsAction: "keep"}},
		]; 

		function unit() {
			gridTK.columnApi.setPivotMode(false);
			gridTK.columnApi.setPivotColumns([]);
			gridTK.columnApi.setRowGroupColumns(['tahun','id_uk']);
		}	
		function jabatan() {
			gridTK.columnApi.setPivotMode(false);
			gridTK.columnApi.setPivotColumns([]);
			gridTK.columnApi.setRowGroupColumns(['kategori_sdm','tahun']);
		} 
		function profesi() {
			gridTK.columnApi.setPivotMode(false);
			gridTK.columnApi.setPivotColumns([]);
			gridTK.columnApi.setRowGroupColumns(['profesi','tahun']);
		}
		function pendidikan() {
			gridTK.columnApi.setPivotMode(false);
			gridTK.columnApi.setPivotColumns([]);
			gridTK.columnApi.setRowGroupColumns(['pendidikan','tahun']);
		}		



		var autoGroupColumnDef = {
			headerName: 'Group',
			width: 200,
			field: 'nama_group',
			valueGetter: function(params) {
				if (params.node.group) {
					return params.node.key;
				} else {
					return params.data[params.colDef.field];
				}
			},
			headerCheckboxSelection: true,
// headerCheckboxSelectionFilteredOnly: true,
cellRenderer:'agGroupCellRenderer',
cellRendererParams: {
	checkbox: true
}
};

var gridTK = {
	enableSorting: true,
	enableFilter: true,
	suppressAggFuncInHeader: true,
	suppressRowClickSelection: false, 
	groupSelectsChildren: true,
	debug: true,
	rowSelection: 'single', 
	enableColResize: true, 
	rowGroupPanelShow: 'always',
	pivotPanelShow: 'always',
	enableRangeSelection: true,
	columnDefs: headerTK,
	pagination: false,
	paginationPageSize: 50,
	groupIncludeFooter: true,
	groupIncludeTotalFooter: true,
	defaultColDef:{
		editable: false,
		enableRowGroup:true,
		enablePivot:true,
		enableValue:true
	} 
};



// setup the grid after the page has finished loading 
var gridDiv = document.querySelector('#gridTK');
new agGrid.Grid(gridDiv,gridTK);

function listFromtk(){
	var uri = BASE_URL+'abk/abk/listlaptk';
	getJson(loadfrmtk,uri);
}

function loadfrmtk(result){
	if(!empty(result)){
		if(result.hasil ==='success'){
			gridTK.api.setRowData(result.result);
		}else{
			gridTK.api.setRowData([]);
		}
	}else{
		gridTK.api.setRowData([]);
	}
}

listFromtk();


function download(){
	var params = { 
		fileName: 'Laporan Tenaga Kerja',
		sheetName: 'Laporan Tenaga Kerja'
	};

	gridTK.api.exportDataAsExcel(params);
}
</script>






