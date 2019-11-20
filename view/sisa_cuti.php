<div class="tab-base">
    <!--Nav Tabs-->
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#demo-lft-tab-2">Update Sisa Cuti</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade" id="demo-lft-tab-1"></div>
        <div class="tab-pane fade active in" id="demo-lft-tab-2">
            <div class="fixed-table-toolbar">
            </div>
            <div class="panel-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="demo-dt-addrow_wrapper">
                    <div class="newtoolbar">
                       <button style="margin-left:3px" class="btn btn-primary" onclick="update()"><i class="fa fa-file-excel-o"></i> Simpan</button>
                       <button style="margin-left:3px" class="btn btn-danger" onclick="res()"><i class="fa fa-file-excel-o"></i> Reset</button>
                    </div>
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

        <div class="tab-pane fade" id="demo-lft-tab-3"></div>
    </div>
</div>
<script charset="utf-8" type="text/javascript">
$('.judul-menu').html('Master Jpl');
    //<![CDATA[
    // specify the columns
    var columnDefs = [
		{headerName: "No", field: "no", width: 60,  headerCheckboxSelection: true, checkboxSelection: true},
        {headerName: "Nopeg", field: "id", width : 100, filterParams: {newRowsAction: 'keep'}},
		{headerName: "Nama", field: "nama", width : 200, filterParams: {newRowsAction: 'keep'}},
		{headerName: "Unit Kerja", field: "nama_uk", width : 540, filterParams: {newRowsAction: 'keep'}},
        {headerName: "Jumlah", field: "jum", width : 80, editable:true},
    ];

    var autoGroupColumnDef = {
        headerName: "Group",
        width: 200,
        field: 'nama_group',
        valueGetter: function (params) {
            if (params.node.group) {
                return params.node.key;
            } else {
                return params.data[params.colDef.field];
            }
        },
        headerCheckboxSelection: true,
        // headerCheckboxSelectionFilteredOnly: true,
        cellRenderer: 'agGroupCellRenderer',
        cellRendererParams: {
            checkbox: true
        }
    };

    var gridOptions = {
        enableSorting: true,
        enableFilter: true,
        suppressRowClickSelection: false,
        groupSelectsChildren: true,
        debug: true,
        rowSelection: 'single',
        enableColResize: true,
        rowGroupPanelShow: 'always',
        pivotPanelShow: 'always',
        enableRangeSelection: true,
        columnDefs: columnDefs,
        pagination: false,
        paginationPageSize: 50,
        autoGroupColumnDef: autoGroupColumnDef,
        defaultColDef: {
            editable: false,
            enableRowGroup: true,
            enablePivot: true,
            enableValue: true
        }
    };

    // setup the grid after the page has finished loading
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);

    // do http request to get our sample data - not using any framework to keep the example self contained.
    // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
    function loaddata(jml = 0) {
        var search = 0;
        if ($('#search').val() !== '') {
            search = $('#search').val();
        }
        $.ajax({
            url: BASE_URL + 'users/list_usernew/' + jml + '/' +search,
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
                gridOptions.api.setRowData(data.result);
                pagingDatatable(data.total, data.limit, 'loaddata');
            },
            error: function (jqXhr, textStatus, errorThrown) {
                alert('error');
            }
        });

    }

    loaddata(0);

	
	function update() {
    var rowData = [];
    gridOptions.api.forEachLeafNode( function(node) {
      rowData.push(node.data);
    });
    //console.log('Row Data:'); 
    save(BASE_URL+'cuti/proses',rowData,loaddata);
	}
	
	function res() {
    var rowData = [];
    gridOptions.api.forEachLeafNode( function(node) {
      rowData.push(node.data);
    });
    //console.log('Row Data:'); 
    save(BASE_URL+'cuti/reset',rowData,loaddata);
	}
  
    function proses_delete() {
        var selectedRows = gridOptions.api.getSelectedRows();
        if (selectedRows == '') {
            onMessage('Silahkan Pilih Group Terlebih dahulu!');
            return false;
        } else {
            var selectedRowsString = '';
            selectedRows.forEach(function (selectedRow, index) {

                if (index !== 0) {
                    selectedRowsString += ', ';
                }
                selectedRowsString += selectedRow.id;
            });
            submit_get(BASE_URL + 'jpl/delete/?id=' + selectedRowsString, loaddata);
        }
    }
</script>
<script src="js/login.js" type="text/javascript">
</script>
 
