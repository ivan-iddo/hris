
<div class="row">
	
  <div class="tab-base mar-all">
    <!--Nav Tabs-->

    <ul class="nav nav-tabs">
      <li>
				<a href="#demo-lft-tab-1" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-home fa-2x text-danger"></i> 
						</span>
						Dashboard
					</a>
			</li>

      <li class="active">
				<a href="#demo-lft-tab-2" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-laptop fa-2x text-danger"></i> 
						</span>
						View Data
					</a> 
			</li>
            <li>
				<a href="#demo-lft-tab-mutasi" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-mail-forward fa-2x text-danger"></i> 
						</span>
						List Mutasi
					</a>
			</li>
      <li> 
			<a href="#demo-lft-tab-3" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-lightbulb-o fa-2x text-warning"></i> 
						</span>
						Help
					</a> 
			</li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane fade" id="demo-lft-tab-1"></div>

      <div class="tab-pane fade active in" id="demo-lft-tab-2">
        <div class="fixed-table-toolbar">
         
        </div>
				
<div class="panel-group accordion" id="accordion" >
	<div class="panel" style="border:none">
					
					                <!--Accordion title-->
					                <div class="panel-heading">
					                    <h4 class="panel-title">
					                        <a data-parent="#accordion" data-toggle="collapse" href="#collapseOne" aria-expanded="true" class="text-warning"><i class="fa fa-folder"></i> Data Pegawai</a>
					                    </h4>
					                </div>
													
													<div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
        <div class="panel-body">
          <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="demo-dt-addrow_wrapper">
            <div class="newtoolbar">
              <div class="table-toolbar-left" id="demo-custom-toolbar2">
                 <div class="btn-group">
              <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onclick="proses_mutasi();">Proses Mutasi Jabatan</button> 
								 </div>
              </div>
            </div>
            <div class="dataTables_filter" id="demo-dt-addrow_filter">
              <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search" onkeydown="if(event.keyCode=='13'){loaddata(0);}" ></label>
             
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
      </div>
</div>
      <div class="tab-pane fade" id="demo-lft-tab-mutasi">
      <div class="ag-theme-balham" id="myGridMutasi" style="height: 400px;width:100%;">
              </div>
          </div>
      <div class="tab-pane fade" id="demo-lft-tab-3">
           
      </div>
    </div>
  </div>
	
	
</div>

	<div class="row pad-all">
	 
							<div id="profilePage"></div>
	 
							</div>

	
	<script charset="utf-8" type="text/javascript">
		$('.judul-menu').html('Mutasi Jabatan Pegawai');
//<![CDATA[
           // specify the columns
           var columnDefs = [
            {headerName: "NIP", field: "nip", width: 190, filterParams:{newRowsAction: 'keep'}},
			{headerName: "NIK", field: "nik", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Direktorat", field: "nama_group", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Jabatan", field: "nama_uk", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Username", field: "username", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "E-Mail", field: "email", width: 190, filterParams:{newRowsAction: 'keep'}},
           
        ];

        var autoGroupColumnDef = {
           headerName: "Group",
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

        var gridOptions = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false,
           onRowDoubleClicked: proses_mutasi, 
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
           defaultColDef:{
               editable: false,
               enableRowGroup:true,
               enablePivot:true,
               enableValue:true
           }
        };

        // setup the grid after the page has finished loading 
           var gridDiv = document.querySelector('#myGrid');
           new agGrid.Grid(gridDiv, gridOptions);

           // do http request to get our sample data - not using any framework to keep the example self contained.
           // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
           function loaddata(jml){
            var search = 0;
            if($('#search').val() !==''){
              search = $('#search').val();
            }
           $.ajax({
                                   url: BASE_URL+'users/list/'+search+'/'+jml,
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( data, textStatus, jQxhr ){
                      
                        
                     gridOptions.api.setRowData(data.result);
                     paging(data.total,'loaddata');
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });

           }
           
           loaddata(0);
					 
					 
        
        function proses_mutasi(){
            var selectedRows = gridOptions.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Pegawai yang akan dimutasi Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
           });
          

//POPUP
bootbox.dialog({ 
                   message:$('<div></div>').load('view/pegawai/input_mutasi.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'large',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-primary",
                           callback: function() {
                            $('#txtIdUser').val(selectedRowsString);
                               if(simpan()){
                                           return true;
                                       }else{
                                           return false;
                                       }
                                       
                           }
                       },

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

                     
                       
    getOptions("txtdirektorat",BASE_URL+"master/direktorat");
    getOptions("satuan_kerja",BASE_URL+"master/getmaster?id=25");
    getOptions("kelas_jabatan",BASE_URL+"master/getmaster?id=24");
    getOptions("txtjabatan",BASE_URL+"master/jabatan_struktural");
    





						}

        }


             function simpan(){
                  var direktorat	= $('#txtdirektorat').val();
                  var tgl_mutasi = 	$('#tgl_mutasi').val();
                     if(empty(direktorat)){
												 onMessage("Data 'Direktorat' Wajib dipilih");
                           
                           return false;
												}else if(empty(tgl_mutasi)){
                                                    onMessage("Data 'Tanggal Mutasi' Wajib dipilih");
                           
                           return false;

                                                }else{
												
														var data = formJson('form-mutasi');//$("#form-upload").serializeArray();
														$.ajax({
														url: BASE_URL+'pegawai/savemutasi',
														headers: {
																'Authorization': localStorage.getItem("Token"),
																'X_CSRF_TOKEN':'donimaulana',
																'Content-Type':'application/json'
																},
																dataType: 'json',
																type: 'post',
																contentType: 'application/json', 
																processData: false,
																data:data,
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
																																	// $("#f_id_edit").val(data.id);
                                                                                                                                     loaddata(0);
                                                                                                                                     loadMutasi();
																																	 $('.modal').modal('hide');
																														 }else{
																																		 
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
             
             
           
           
  //]]>
  
  

    
  var columnDefsHis = [
            {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Tgl.Mutasi", field: "tgl", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Keterangan", field: "keterangan", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Direktorat Tujuan", field: "dir_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Bagian Tujuan", field: "bag_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Sub Bagian Tujuan", field: "subbag_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Direktorat Asal", field: "dir_asal", width: 190, filterParams:{newRowsAction: 'keep'}},
		  {headerName: "Bagian Asal", field: "bag_asal", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Sub Bagian Asal", field: "subbag_asal", width: 190, filterParams:{newRowsAction: 'keep'}},
            
        ];

        var gridOptionsMutasi = {
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
           columnDefs: columnDefsHis,
           pagination: false,
           paginationPageSize: 50,
           autoGroupColumnDef: autoGroupColumnDef,
           defaultColDef:{
               editable: false,
               enableRowGroup:true,
               enablePivot:true,
               enableValue:true
           }
        };

        // setup the grid after the page has finished loading 
           var gridDiv = document.querySelector('#myGridMutasi');
           new agGrid.Grid(gridDiv, gridOptionsMutasi);
   
           function loadMutasi(){
            $.ajax({
                                   url: BASE_URL+'pegawai/listmutasi',
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( data, textStatus, jQxhr ){
                      
                        
                                    gridOptionsMutasi.api.setRowData(data.result); 
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
           }
     

           loadMutasi();



  </script><script src="js/login.js" type="text/javascript">
</script>
 
