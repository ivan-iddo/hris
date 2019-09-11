<div class="tab-base">
    <!--Nav Tabs-->
    <ul class="nav nav-tabs">
        <div class="alert alert-danger hidden" id="users-blocked" role="alert">
            Akun anda tidak dapat mengajukan pelatihan! Silahkan selesaikan laporan pada pelatihan sebelumnya.
        </div>
        <div class="alert alert-warning hidden" id="users-monev" role="alert">
            Anda memiliki pelatihan & pengembangan saat ini (Monitoring & Evaluasi).
        </div>
        <li class="active"><a data-toggle="tab" href="#demo-lft-tab-2">Users</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade" id="demo-lft-tab-1"></div>
        <div class="tab-pane fade active in" id="demo-lft-tab-2">
            <div class="fixed-table-toolbar">
            </div>
            <div class="panel-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="demo-dt-addrow_wrapper">
                    <div class="newtoolbar">
                        <div class="table-toolbar-left" id="demo-custom-toolbar2">
                            <div class="btn-group">
                                <button class="btn btn-primary btn-labeled fa fa-plus-square btn-sm" id=
                                "demo-bootbox-bounce">Add
                            </button>
                            <button class=
                            "btn btn-warning btn-labeled fa fa-edit btn-sm" onclick=
                            "proses_edit();">Edit
                        </button>
                        <button class=
                        "btn btn-danger btn-labeled fa fa-close btn-sm" onclick=
                        "proses_delete();">Delete
                    </button>
                </div>
            </div>
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
    //<![CDATA[
    // specify the columns
    var columnDefs = [

    {headerName: "ID", field: "id", width : 225, filterParams: {newRowsAction: 'keep'}},
    {headerName: "Nama", field: "nama", width : 250, filterParams: {newRowsAction: 'keep'}},
    {headerName: "Created Date", field: "created", width : 225, filterParams: {newRowsAction: 'keep'}},
    {headerName: "Created By", field: "createdby", width : 225, filterParams: {newRowsAction: 'keep'}},
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
        onRowDoubleClicked: proses_edit,
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
            url: BASE_URL + 'pengembangan_pelatihan_kegiatan_status/list/' + jml + '/' +search,
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
                if (data.is_blocked){
                    $("#users-blocked").removeClass('hidden');
                }
                if (data.is_monev){
                    $("#users-monev").removeClass('hidden')
                }
                gridOptions.api.setRowData(data.result);
                pagingDatatable(data.total, data.limit, 'loaddata');
            },
            error: function (jqXhr, textStatus, errorThrown) {
                alert('error');
            }
        });

    }

    loaddata(0);

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
            submit_get(BASE_URL + 'pengembangan_pelatihan_kegiatan_status/delete/?id=' + selectedRowsString, loaddata);
        }
    }

    function proses_edit() {
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

            $.ajax({
                url: BASE_URL + 'pengembangan_pelatihan_kegiatan_status/get/?id=' + selectedRowsString,
                headers: {
                    'Authorization': localStorage.getItem("Token"),
                    'X_CSRF_TOKEN': 'donimaulana',
                    'Content-Type': 'application/json'
                },
                dataType: 'json',
                type: 'get',
                contentType: 'application/json',
                processData: false,
                success: function (res, textStatus, jQxhr) {
                    $('#id').val(res.data.id);
                    $('#nama').val(res.data.nama);
                },
                error: function (jqXhr, textStatus, errorThrown) {
                    alert('error');
                }
            });


            bootbox.dialog({
                title: "<i class=\"fa fa-users\"><\/i> Edit",
                message: $('<div></div>').load('view/pengembangan_pelatihan_kegiatan_status/add.php'),
                animateIn: 'bounceIn',
                animateOut: 'bounceOut',
                buttons: {
                    success: {
                        label: "Save",
                        className: "btn-primary",
                        callback: function () {

                            if (simpan('edit')) {
                                return true;
                            } else {
                                return false;
                            }

                        }
                    },

                    main: {
                        label: "Cancel",
                        className: "btn-warning",
                        callback: function () {
                            $.niftyNoty({
                                type: 'dark',
                                message: "Bye Bye",
                                container: 'floating',
                                timer: 5000
                            });
                        }
                    }
                }
            });
        }

    }

    $('#demo-bootbox-bounce').on('click', function () {
        bootbox.dialog({
            title: "<i class=\"fa fa-user\"><\/i> Add New",
            message: $('<div></div>').load('view/pengembangan_pelatihan_kegiatan_status/add.php'),
            animateIn: 'bounceIn',
            animateOut: 'bounceOut',
            buttons: {
                success: {
                    label: "Save",
                    className: "btn-primary",
                    callback: function () {

                        if (simpan('add')) {
                            return true;
                        } else {
                            return false;
                        }

                    }
                },

                main: {
                    label: "Cancel",
                    className: "btn-warning",
                    callback: function () {
                        $.niftyNoty({
                            type: 'dark',
                            message: "Bye Bye",
                            container: 'floating',
                            timer: 5000
                        });
                    }
                }
            }
        });
    });
</script>
<script src="js/login.js" type="text/javascript">
</script>

