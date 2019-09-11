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
   <input  id="awal" name="awal" class="form-control" placeholder="Awal dd-mm-yyyy" type="text">
</div>
<div class="form-group">
   <input  name="akhir" id="akhir" class="form-control" placeholder="Akhir dd-mm-yyyy" type="text">
</div>
</div>
<div class="table-toolbar-left" id="demo-custom-toolbar2">
    <div class="btn-group">
        <button class="btn btn-success btn-sm" onclick="filter1()">Biaya & Pelatihan
        </button>
    </div>
    <div class="btn-group">
        <button class="btn btn-success btn-sm" onclick="filter2()">Unit
        </button>
    </div>
    <div class="btn-group">
        <button class="btn btn-success btn-sm" onclick="filter3()">Profesi & Biaya
        </button>
    </div>
    <div class="btn-group">
        <button class="btn btn-success btn-sm" onclick="filter4()">Profesi & Unit
        </button>
    </div>
    <div class="btn-group">
        <button class="btn btn-success btn-sm" onclick="filter5()">Pegawai
        </button>
    </div>
    <div class="btn-group">
        <button class="btn btn-success btn-sm" onclick="filter6()">Kegiatan
        </button>
    </div>
    <div class="btn-group">
        <button class="btn btn-success btn-sm" onclick="filter7()">Kegiatan & Profesi
        </button>
    </div>
    <div class="btn-group">
        <button class="btn btn-success btn-sm" onclick="filter8()">Unit Profesi & Biaya
        </button>
    </div>
    <div class="btn-group">
        <button class="btn btn-success btn-sm" onclick="filter9()">Tipe biaya & Profesi
        </button>
    </div>
    <div class="btn-group">
        <button class="btn btn-success btn-sm" onclick="filter11()">Tipe & Profesi
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
                    <h3 class="panel-title">Data Laporan Latbang</h3>
                    <div class="ag-theme-balham" id="myGrid" style="height: 400px;width:100%;">
                    </div>

                    <div class="paging pull-right mar-all">
                    </div>
                </div>
            </div>
            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="demo-dt-addrow_wrapper">
                <div class="dataTables_filter" id="demo-dt-addrow_filter">
                    <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder=""
                       type="search" id="searchdel"
                       onkeydown="if(event.keyCode=='13'){loaddatadel(0, this);}"></label>
                   </div>
               </div>
               <div class="bootstrap-table">
                <div class="fixed-table-container" style="padding-bottom: 0px;">
                   <h3 class="panel-title">Data Latbang yang telah di Delete</h3>
                   <div class="ag-theme-balham" id="myGriddel" style="height: 400px;width:100%;">
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
    
    var columnListDatadel = [
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
        loaddata();
        gridOptionsListdel.columnApi.setPivotMode(true);
        gridOptionsListdel.columnApi.setPivotColumns(['jenis_perjalanan']);
        gridOptionsListdel.columnApi.setRowGroupColumns(['jenis_biaya','nama_pelatihan']);
        loaddatadel();
    } 
    function filter2() {
        gridOptionsList.columnApi.setPivotMode(false);
        gridOptionsList.columnApi.setPivotColumns([]);
        gridOptionsList.columnApi.setRowGroupColumns(['grup']);
        loaddata();
        gridOptionsListdel.columnApi.setPivotMode(false);
        gridOptionsListdel.columnApi.setPivotColumns([]);
        gridOptionsListdel.columnApi.setRowGroupColumns(['grup']);
        loaddatadel();
    }
    function filter3() {
        gridOptionsList.columnApi.setPivotMode(false);
        gridOptionsList.columnApi.setPivotColumns([]);
        gridOptionsList.columnApi.setRowGroupColumns(['profesi','jenis_biaya']);
        loaddata();
        gridOptionsListdel.columnApi.setPivotMode(false);
        gridOptionsListdel.columnApi.setPivotColumns([]);
        gridOptionsListdel.columnApi.setRowGroupColumns(['profesi','jenis_biaya']);
        loaddatadel();
    }
    function filter4() {
        gridOptionsList.columnApi.setPivotMode(true);
        gridOptionsList.columnApi.setPivotColumns(['profesi']);
        gridOptionsList.columnApi.setRowGroupColumns(['grup']);
        loaddata();
        gridOptionsListdel.columnApi.setPivotMode(true);
        gridOptionsListdel.columnApi.setPivotColumns(['profesi']);
        gridOptionsListdel.columnApi.setRowGroupColumns(['grup']);
        loaddatadel();
    }
    function filter5() {
        gridOptionsList.columnApi.setPivotMode(false);
        gridOptionsList.columnApi.setPivotColumns([]);
        gridOptionsList.columnApi.setRowGroupColumns(['pengembangan_pelatihan_detail.nama_pegawai']);
        loaddata();
        gridOptionsListdel.columnApi.setPivotMode(false);
        gridOptionsListdel.columnApi.setPivotColumns([]);
        gridOptionsListdel.columnApi.setRowGroupColumns(['pengembangan_pelatihan_detail.nama_pegawai']);
        loaddatadel();
    }
    function filter6() {
        gridOptionsList.columnApi.setPivotMode(false);
        gridOptionsList.columnApi.setPivotColumns([]);
        gridOptionsList.columnApi.setRowGroupColumns(['pengembangan_pelatihan_kegiatan.nama']);
        loaddata(); 
        gridOptionsListdel.columnApi.setPivotMode(false);
        gridOptionsListdel.columnApi.setPivotColumns([]);
        gridOptionsListdel.columnApi.setRowGroupColumns(['pengembangan_pelatihan_kegiatan.nama']);
        loaddatadel();
    } 
    function filter7() {
        gridOptionsList.columnApi.setPivotMode(true);
        gridOptionsList.columnApi.setPivotColumns(['profesi']);
        gridOptionsList.columnApi.setRowGroupColumns(['pengembangan_pelatihan_kegiatan.nama','pengembangan_pelatihan_detail.golongan']);
        loaddata();
        gridOptionsListdel.columnApi.setPivotMode(true);
        gridOptionsListdel.columnApi.setPivotColumns(['profesi']);
        gridOptionsListdel.columnApi.setRowGroupColumns(['pengembangan_pelatihan_kegiatan.nama','pengembangan_pelatihan_detail.golongan']);
        loaddatadel();
    }
    function filter8() {
        gridOptionsList.columnApi.setPivotMode(true);
        gridOptionsList.columnApi.setPivotColumns(['profesi','jenis_biaya']);
        gridOptionsList.columnApi.setRowGroupColumns(['grup']);
        loaddata();
        gridOptionsListdel.columnApi.setPivotMode(true);
        gridOptionsListdel.columnApi.setPivotColumns(['profesi','jenis_biaya']);
        gridOptionsListdel.columnApi.setRowGroupColumns(['grup']);
        loaddatadel();
    } 
    function filter9() {
        gridOptionsList.columnApi.setPivotMode(true);
        gridOptionsList.columnApi.setPivotColumns(['jenis_biaya']);
        gridOptionsList.columnApi.setRowGroupColumns(['jenis','profesi']);
        loaddata();
        gridOptionsListdel.columnApi.setPivotMode(true);
        gridOptionsListdel.columnApi.setPivotColumns(['jenis_biaya']);
        gridOptionsListdel.columnApi.setRowGroupColumns(['jenis','profesi']);
        loaddatadel();
    }
    function filter11() {
        gridOptionsList.columnApi.setPivotMode(false);
        gridOptionsList.columnApi.setPivotColumns(['jenis_biaya']);
        gridOptionsList.columnApi.setRowGroupColumns(['jenis','profesi']);
        loaddata();
        gridOptionsListdel.columnApi.setPivotMode(false);
        gridOptionsListdel.columnApi.setPivotColumns(['jenis_biaya']);
        gridOptionsListdel.columnApi.setRowGroupColumns(['jenis','profesi']);
        loaddatadel();
    }
    function loaddata(jml = 0) {
       var awal=$('#awal').val();
       var akhir=$('#akhir').val();
       var search = 0;
       if ($('#search').val() !== '') {
        search = $('#search').val();
    }
    $.ajax({
        url: BASE_URL + 'pengembangan_pelatihan/listlap/' + jml + '/' +search + '/' +awal + '/' + akhir,
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
            pagingDatatable(data.total,data.limit,'loaddatadel');
            
        },
        error: function (jqXhr, textStatus, errorThrown) {
            alert('error');
        }
    });
    
}
loaddata();

function loaddatadel(jml = 0) {
	var awal=$('#awal').val();
	var akhir=$('#akhir').val();
	var search = 0;
    if ($('#searchdel').val() !== '') {
        search = $('#searchdel').val();
    }
    $.ajax({
        url: BASE_URL + 'pengembangan_pelatihan/listlapdel/' + jml + '/' +search + '/' +awal + '/' + akhir,
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
            gridOptionsListdel.api.setRowData(data.result);
            pagingDatatable(data.totaldel,data.limitdel,'loaddatadel');
            
        },
        error: function (jqXhr, textStatus, errorThrown) {
            alert('error');
        }
    });
    
}
loaddatadel();

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

var gridOptionsListdel = {
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
        columnDefs: columnListDatadel,
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

var myGriddel = document.querySelector('#myGriddel');
new agGrid.Grid(myGriddel, gridOptionsListdel);

$(document).ready(function () {
    $('#awal').datepicker({
        format: "dd-mm-yyyy",
    }).on('change', function(){
     $('.datepicker').hide();
 });
    $('#akhir').datepicker({
        format: "dd-mm-yyyy",
    }).on('change', function(){
     $('.datepicker').hide();
 });
});


</script>