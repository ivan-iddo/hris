<!--Nav Tabs-->
<ul class="nav nav-tabs">
  <li class="active">
    <a data-toggle="tab" href="#demo-lft-tab-1">
      <i class="demo-psi-home">
      </i> List
    </a>
  </li>
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
    var columnListData = [
            {headerName: "Nama Pelatihan", field: "nama_pelatihan", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Tujuan", field: "tujuan", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Institusi", field: "institusi", width: 190, filterParams: {newRowsAction: 'keep'}},

            {headerName: "Nopeg", field: "pengembangan_pelatihan_detail.nopeg", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Nama pegawai", field: "pengembangan_pelatihan_detail.nama_pegawai", width: 190, rowGroup: true, hide: true, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Golongan", field: "pengembangan_pelatihan_detail.golongan", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Jabatan", field: "pengembangan_pelatihan_detail.jabatan", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Pangkat", field: "pengembangan_pelatihan_detail.pangkat", width: 190, filterParams: {newRowsAction: 'keep'}},

            {headerName: "Kegiatan", field: "pengembangan_pelatihan_kegiatan.nama", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Pengembangan Pelatihan Status", field: "pengembangan_pelatihan_kegiatan_status.nama", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Tipe", field: "jenis", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Jenis Perjalanan", field: "jenis_perjalanan", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Jenis Biaya", field: "jenis_biaya", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Status Pengajuan", field: "nama_status", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Created Date", field: "created", width: 190, filterParams: {newRowsAction: 'keep'}},
            {headerName: "Created By", field: "createdby", width: 190, filterParams: {newRowsAction: 'keep'}}
    ];

    var gridOptionsList = {
        enableSorting: true,
        enableFilter: true,
        suppressRowClickSelection: false,
        groupDefaultExpanded: 2,
        groupSelectsChildren: true,
        debug: true,
        rowSelection: 'single',
        enableColResize: true,
        rowGroupPanelShow: 'always',
        pivotPanelShow: 'always',
        enableRangeSelection: true,
        columnDefs: columnListData,
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
        onGridReady: function (params) {
            params.api.sizeColumnsToFit();
        },
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
        var search = 0;
        if ($('#search').val() !== '') {
            search = $('#search').val();
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
    
    loaddata(0);

</script>