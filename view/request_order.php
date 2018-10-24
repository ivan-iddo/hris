<div class="tab-base">
    <!--Nav Tabs-->

    <ul class="nav nav-tabs">
        <li><a data-toggle="tab" href="#demo-lft-tab-1"><i class="demo-psi-home"></i> Home</a></li>

        <li class="active"><a data-toggle="tab" href="#demo-lft-tab-2"><i class="fa fa-pencil"></i> New RO</a></li>
		<li><a data-toggle="tab" href="#demo-lft-tab-3"><i class="fa fa-pencil"></i> Approved RO</a></li>

        <li><a data-toggle="tab" href="#demo-lft-tab-4"><i class="demo-psi-idea-2"></i> Help</a></li>
    </ul>
    <div class="tab-content">
        <div id="demo-lft-tab-1" class="tab-pane fade"></div>
        <div id="demo-lft-tab-2" class="tab-pane fade active in">

            <div class="panel-body">
                 
 
                <div class="fixed-table-container">
                    <div class="fixed-table-toolbar mar-top mar-btm">
                        <div class="btn-group ">
                            <button id="save-button" class="btn btn-primary btn-labeled fa fa-plus-square btn-sm" onClick="showModal()">Add</button>
                            <button class="btn btn-warning btn-labeled fa fa-edit btn-sm" onClick="proses_edit();">Edit</button>
                            <button class="btn btn-danger btn-labeled fa fa-close btn-sm" onClick="proses_delete();">Delete</button>
                        </div>
                    </div>
                    <div id="myGrid" style="height: 300px;" class="ag-theme-balham"></div>
                </div>

            </div>
            <hr class="hr-sm">
            <div class="panel-body">
                <div class="fixed-table-container pad-top">
                    <div class="fixed-table-toolbar">
                        <div class="btn-group ">
                            <button id="demo-bootbox-bounce" class="btn btn-primary btn-labeled fa fa-plus-square btn-sm">Add</button>
                        </div>
                    </div>
                    <div id="myGrida" style="height: 300px;" class="ag-theme-balham"></div>
                </div>
            </div>
        </div>
		
		<div id="demo-lft-tab-3" class="tab-pane fade">

            <div class="panel-body">
                <form class="form-inline mar-btm ">
                    <div class="form-group">
                        <input placeholder="Nomor RO" id="demo-inline-inputmail" class="form-control" type="email">
                    </div>

                    <div class="form-group">
                        <div id="demo-dp-range">
                            <div class="input-daterange input-group" id="datepicker">
                                <input placeholder="Tgl Start" class="form-control" name="start" type="text">
                                <span class="input-group-addon">to</span>
                                <input placeholder="Tgl End" class="form-control" name="end" type="text">
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success" type="submit">Cari</button>

                </form>

                <hr class="hr-sm">
                <div class="fixed-table-container">
                    
                    <div id="myGridd" style="height: 300px;" class="ag-theme-balham"></div>
                </div>

            </div>
            <hr class="hr-sm">
            <div class="panel-body">
                <div class="fixed-table-container pad-top">
                     
                    <div id="myGride" style="height: 300px;" class="ag-theme-balham"></div>
                </div>
            </div>
        </div>

        <div id="demo-lft-tab-4" class="tab-pane fade"></div>
    </div>
</div>


 


<script type="text/javascript" charset="utf-8">
    // specify the columns
    var columnDefs = [

        {
            headerName: "No RO",
            field: "id",
            width: 190,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Tanggal",
            field: "tgl",
            width: 150,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Deadline",
            field: "deadline",
            width: 100,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Keterangan",
            field: "keterangan",
            width: 120,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Suplier",
            field: "nama_suplier",
            width: 100,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Status RO",
            field: "status_proses",
            width: 120,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Status Approve",
            field: "status_approve",
            width: 150,
            filterParams: {
                newRowsAction: 'keep'
            }
        }
    ];

     

    var gridOptions = {
        enableSorting: true,
        enableFilter: true,
        suppressRowClickSelection: false,
        onRowClicked: bukaDetail,
        groupSelectsChildren: true,
        debug: true,
        rowSelection: 'multiple',
        enableColResize: true,
        rowGroupPanelShow: 'always',
        pivotPanelShow: 'always',
        enableRangeSelection: true,
        columnDefs: columnDefs,
        pagination: true,
        paginationPageSize: 50, 
        defaultColDef: {
            editable: false 
        }
    };
	
	 // setup the grid after the page has finished loading 
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
	
	 var columnDetail = [

        {
            headerName: "No",
            field: "no",
            width: 190,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Kode Produk",
            field: "kode",
            width: 150,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Nama Produk",
            field: "nama",
            width: 100,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Jumlah",
            field: "qty",
            width: 120,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Satuan",
            field: "satuan",
            width: 100,
            filterParams: {
                newRowsAction: 'keep'
            }
        } 
    ];
	 
	 
	var gridOptionsDetail = {
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
    columnDefs: columnDetail,
    pagination: false ,
    defaultColDef:{
        editable: false 
    }
};
 
	var gridDiv2 = document.querySelector('#myGrida');
    new agGrid.Grid(gridDiv2, gridOptionsDetail);
	
	
	var columnDefsApproved = [

        {
            headerName: "No RO",
            field: "id",
            width: 190,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Tanggal",
            field: "tgl",
            width: 150,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Deadline",
            field: "deadline",
            width: 100,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Keterangan",
            field: "keterangan",
            width: 120,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Suplier",
            field: "nama_suplier",
            width: 100,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Status RO",
            field: "status_proses",
            width: 120,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Status Approve",
            field: "status_approve",
            width: 150,
            filterParams: {
                newRowsAction: 'keep'
            }
        }
    ];

     

    var gridOptionsApproved = {
        enableSorting: true,
        enableFilter: true,
        suppressRowClickSelection: false,
        onRowClicked: bukaDetailApproved,
        groupSelectsChildren: true,
        debug: true,
        rowSelection: 'multiple',
        enableColResize: true,
        rowGroupPanelShow: 'always',
        pivotPanelShow: 'always',
        enableRangeSelection: true,
        columnDefs: columnDefsApproved,
        pagination: true,
        paginationPageSize: 50, 
        defaultColDef: {
            editable: false 
        }
    };
	
	 // setup the grid after the page has finished loading 
    var gridDivd = document.querySelector('#myGridd');
    new agGrid.Grid(gridDivd, gridOptionsApproved);
	loaddataApproved();
	
	var columnDetailApproved = [

        {
            headerName: "No",
            field: "no",
            width: 190,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Kode Produk",
            field: "kode",
            width: 150,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Nama Produk",
            field: "nama",
            width: 100,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Jumlah",
            field: "qty",
            width: 120,
            filterParams: {
                newRowsAction: 'keep'
            }
        },
        {
            headerName: "Satuan",
            field: "satuan",
            width: 100,
            filterParams: {
                newRowsAction: 'keep'
            }
        } 
    ];
	 
	 
	var gridOptionsDetailApproved = {
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
    columnDefs: columnDetailApproved,
    pagination: false ,
    defaultColDef:{
        editable: false 
    }
};
 
	var gridDiv5 = document.querySelector('#myGride');
    new agGrid.Grid(gridDiv5, gridOptionsDetailApproved);

    // do http request to get our sample data - not using any framework to keep the example self contained.
    // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
    function loaddata() {
        $.ajax({
            url:  BASE_URL +'inventory/list/?status=unapproved',
            headers: {
                'Authorization': localStorage.getItem("Token"),
                'X_CSRF_TOKEN': 'donimaulana',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            processData: false,
            success: function(data, textStatus, jQxhr) {


                gridOptions.api.setRowData(data);
				gridOptionsDetail.api.setRowData([]);
            },
            error: function(jqXhr, textStatus, errorThrown) {
                alert('error');
            }
        });

    }
	
	function loaddataApproved() {
        $.ajax({
            url:  BASE_URL +'inventory/list/?status=approved',
            headers: {
                'Authorization': localStorage.getItem("Token"),
                'X_CSRF_TOKEN': 'donimaulana',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            processData: false,
            success: function(data, textStatus, jQxhr) {


                gridOptionsApproved.api.setRowData(data);
				gridOptionsDetailApproved.api.setRowData([]);
            },
            error: function(jqXhr, textStatus, errorThrown) {
                alert('error');
            }
        });

    }

    function bukaDetail() {
        var selectedRows = gridOptions.api.getSelectedRows();
        var selectedRowsString = '';
        selectedRows.forEach(function(selectedRow, index) {

            if (index !== 0) {
                selectedRowsString += ', ';
            }
            selectedRowsString += selectedRow.id;
        });

        $.ajax({
            url: BASE_URL + 'inventory/loadData_detail_ro/' + selectedRowsString,
            headers: {
                'Authorization': localStorage.getItem("Token"),
                'X_CSRF_TOKEN': 'donimaulana',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            processData: false,
            success: function(data, textStatus, jQxhr) {

				if(data.status ==='ok'){
					 
					 gridOptionsDetail.api.setRowData(data.data);
						gridOptionsDetail.api.forEachLeafNode(function(node, index) {
							//node.setExpanded(true);
							if (node.data.front === '1') {
								node.setSelected(true, false);
							}
		
						});
				}else{
					gridOptionsDetail.api.setRowData([]);
				}
               

            },
            error: function(jqXhr, textStatus, errorThrown) {
                alert('error');
            }
        });


    }
	
	function bukaDetailApproved() {
        var selectedRows = gridOptionsApproved.api.getSelectedRows();
        var selectedRowsString = '';
        selectedRows.forEach(function(selectedRow, index) {

            if (index !== 0) {
                selectedRowsString += ', ';
            }
            selectedRowsString += selectedRow.id;
        });

        $.ajax({
            url: BASE_URL + 'inventory/loadData_detail_ro/' + selectedRowsString,
            headers: {
                'Authorization': localStorage.getItem("Token"),
                'X_CSRF_TOKEN': 'donimaulana',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            processData: false,
            success: function(data, textStatus, jQxhr) {

				if(data.status ==='ok'){
					 
					 gridOptionsDetailApproved.api.setRowData(data.data);
						gridOptionsDetailApproved.api.forEachLeafNode(function(node, index) {
							//node.setExpanded(true);
							if (node.data.front === '1') {
								node.setSelected(true, false);
							}
		
						});
				}else{
					gridOptionsDetailApproved.api.setRowData([]);
				}
               

            },
            error: function(jqXhr, textStatus, errorThrown) {
                alert('error');
            }
        });


    }

    loaddata();
	 
   
    
    $('#demo-dp-range .input-daterange').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true
    });
	   $('#f_tgl_start').datepicker({
    format: "yyyy-mm-dd"
 });
	    $('#f_tgl_end').datepicker({
    format: "yyyy-mm-dd"
 });
		
function showModal(){
	// var uid = $(this).data('id');
	getOptions("f_supplier",BASE_URL+"supplier/list");
	$("#myModal").modal();
	}
	
function add(){ 
	var noro = $('#f_no_ro').val();
	var start = $('#f_tgl_start').val();
	var end = $('#f_tgl_end').val();
	var keterangan = $('#f_keterangan').val();
	var supplier = $('#f_supplier').val();
	
	if(noro ===''){
		alert('No Ro tidak boleh kosong');
		return false;
	}else if(start===''){
		alert('Tanggal tidak boleh kosong');
		return false;
	}else if(end===''){
		alert('Deadline tidak boleh kosong');
		return false;
	}else if(supplier===''){
		alert('Silahkan Pilih Supplier terlebih dahulu');
		return false;
	}else if(keterangan===''){
		alert('Keterangan tidak boleh kosong');
		return false;
	}else{
		var data = {
		noro:noro,
		start:start,
		end:end,
		keterangan:keterangan,
		supplier:supplier 
		};
		
		//ajax post
		$.ajax({
				url: urlp,
				headers: {
						'Authorization': localStorage.getItem("Token"),
						'X_CSRF_TOKEN':'donimaulana',
						'Content-Type':'application/json'
						},
						dataType: 'json',
						type: 'post',
						contentType: 'application/json', 
						processData: false,
                        data:JSON.stringify(data),
						success: function( data, textStatus, jQxhr ){
                                hasil=data.hasil;
                                message=data.message; 
                                   if(hasil=="success"){         
                                            
                                               $.niftyNoty({
                                                               type: 'success',
                                                               title: 'Success',
                                                               message: message,
                                                               container: 'floating',
                                                               timer: 5000
                                                           });
                                              loaddata();
                                               $('.modal').modal('hide');
                                         }else{
                                                alert(message);
                                              return false;	
                                         }
								 
								 
							},
							error: function( jqXhr, textStatus, errorThrown ){
								   $.niftyNoty({
                                        type: 'danger',
                                        title: 'Warning!',
                                        message: message,
                                        container: 'floating',
                                        timer: 5000
                                    });
							}
						});
    
	}
	
	
	 
}
</script>
<div id="demo-sm-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title" id="mySmallModalLabel">Small modal</h4>
                </div>
                <div class="modal-body">
                    <p>kosong</p>
                </div>
            </div>
        </div>
    </div>
<!-- Button trigger modal --> 
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> Add New Request Order</h4>

            </div>
            <div class="modal-body">
            <form class="form-horizontal"> 
			<div class="panel-body"> 
			<div class="form-group"> 
			<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nomor RO</label> 
			<div class="col-sm-5"> 
			<input placeholder="No.RO" id="f_no_ro" class="form-control" type="text"> 
			<input placeholder="No.RO" id="id_group" style="display:none" class="form-control" type="text"> 
			</div> 
			</div> 
			<div class="form-group"> 
			<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tgl RO</label> 
			<div class="col-sm-5"> 
			<input placeholder="Tgl.RO" id="f_tgl_start" class="form-control f_tgl_start" type="text">  
			</div> 
			</div> 
			<div class="form-group"> 
			<label class="col-sm-3 control-label" for="demo-hor-inputemail">Tgl Deadline</label> 
			<div class="col-sm-5"> 
			<input placeholder="Tgl Deadline" id="f_tgl_end" class="form-control" type="text">  
			</div> 
			</div> 
			<div class="form-group"> 
			<label class="col-sm-3 control-label" for="demo-hor-inputemail">Supplier</label> 
			<div class="col-sm-5"> 
			<select name="f_supplier" id="f_supplier" class="form-control"/> 
			</div> 
			</div> 
			<div class="form-group"> 
			<label class="col-sm-3 control-label" for="demo-hor-inputemail">Keterangan</label> 
			<div class="col-sm-5"> 
			<textarea id="f_keterangan" placeholder="Keterangan" rows="2" class="form-control"></textarea> 
			</div> 
			</div> 
			</div>  
		 </form> 
                <div class="modal-footer">
					<button data-bb-handler="success" type="button" class="btn btn-primary" onClick="add()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
	
	
<script src="js/login.js"></script>