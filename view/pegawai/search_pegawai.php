<div class="panel" style="border:none">
					
                    <!--Accordion title-->
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-parent="#accordion" data-toggle="collapse" href="#collapseOne" aria-expanded="true" class="text-warning"><i class="fa fa-folder"></i> Data Pegawai</a>
                        </h4>
                    </div>
                                    
                                    <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
<div class="panel-body pad-all">
<div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="demo-dt-addrow_wrapper">
 
<div class="dataTables_filter" id="demo-dt-addrow_filter">
<label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="searchPegawai" onkeydown="if(event.keyCode=='13'){loaddata(0);}" ></label>

        </div>
        
</div>
<div class="bootstrap-table">
<div class="fixed-table-container" style="padding-bottom: 0px;">
<div class="ag-theme-balham" id="gridSearchPegawai" style="height: 300px;width:100%;">
</div>

<div class="paging pull-right mar-all"> 
        </div>
            
</div>
</div>
</div>
</div>
                                    </div>
</div>

	
	<script charset="utf-8" type="text/javascript">
		$('.judul-menu').html('Data Pegawai');
//<![CDATA[
           // specify the columns
           var ColPegawaiSearch = [
            {headerName: "NIP", field: "nip", width: 190, filterParams:{newRowsAction: 'keep'}},
						 {headerName: "NIK", field: "nik", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Devisi", field: "nama_group", width: 190, filterParams:{newRowsAction: 'keep'}},
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

        var gridSearchPegawai = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false, 
					 onRowClicked: bukaProfile,
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single',
           enableColResize: true,
           rowGroupPanelShow: 'always',
           pivotPanelShow: 'always',
           enableRangeSelection: true,
           columnDefs: ColPegawaiSearch,
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
           var gridDiv = document.querySelector('#gridSearchPegawai');
           new agGrid.Grid(gridDiv, gridSearchPegawai);

           // do http request to get our sample data - not using any framework to keep the example self contained.
           // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
           function loaddata(jml){
            var search = 0;
			var group = localStorage.getItem("group");
			var url = BASE_URL + 'kpi/mpenilaian/list_us/' + search + '/' + jml;
             
            if($('#searchPegawai').val() !==''){
              search = $('#searchPegawai').val();
			  url = BASE_URL + 'kpi/mpenilaian/list_us/' + search + '/' + jml ;
            }
			
			if ((group !== '1') && (group !== '6')) {
            url = BASE_URL + 'kpi/mpenilaian/list_us/' + search + '/' + jml + "/" + group;
			}
           $.ajax({
                                   url: url,
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
                      
                        
                                    gridSearchPegawai.api.setRowData(data.result);
                     paging(data.total,'loaddata');
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });

           }
           
           loaddata(0);
					 
					 function bukaProfile(){
                         
						 var selectedRows = gridSearchPegawai.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Pegawai Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
                var nip='';
                var nama='';
                var id_grup='';
                var id_user='';
                var nama_group ='';
                selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.nip;
               nip += selectedRow.nip;
               nama += selectedRow.nama;
               id_grup += selectedRow.id_grup;
               id_user += selectedRow.id;
               nama_group +=  selectedRow.nama_group;
                 });
                
                 $('#nama_pegawai').val(nama);
                 $('#nip').val(nip);
                 $('#id_grup').val(id_grup);
                 $('#id_user').val(id_user);
                 $('.modal').modal('hide');
                 $('#uk').val(nama_group);
                 
						}
						
					 
                         
					 }
           
           function proses_delete(){
             var selectedRows = gridOptions.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Group Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
           });
           submit_get(BASE_URL+'users/delete/?id='+selectedRowsString,loaddata);
           
           
            }
           }
           
           function proses_edit(){
            var selectedRows = gridOptions.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Group Terlebih dahulu!');
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
                   message:$('<div></div>').load('view/pegawai/form_riwayat_pegawai.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'large',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-primary",
                           callback: function() {
                               
                               if(simpan('edit')){
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
							 
               $.ajax({
                                   url: BASE_URL+'pegawai/getuser/?id='+selectedRowsString,
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( res, textStatus, jQxhr ){
																		///alert('Loading data..');
																		 window.setTimeout(function(){
    var element = document.getElementById('f_id_edit');
    if(element){
       var f_id_edit = $("#f_id_edit").val();
      
       $('#f_user_password').val('');
			 $('#f_user_username').val(res[0].username);
                                   $('#f_user_edit').val(res[0].username);
                                   $('#f_id_edit').val(res[0].id);
                                   $('#f_user_name').val(res[0].nama);
                                   $('#f_user_email').val(res[0].email);
																	 $('#txttmtcpns').val(res[0].tmt_cpns);
																	 $('#txttmtpns').val(res[0].tmt_pns);
																	 $('#txttmtjabatan').val(res[0].tmt_jabatan);
																	 $('#txttmtjabfung').val(res[0].tmt_jabatan_asn);
																	 $('#txttmtgolongan').val(res[0].tmt_golongan);
																	 $('#txttmtbergabung').val(res[0].tgl_bergabung);
																	 $('#txtperingkat').val(res[0].peringkat);
																	 $('#txtindex').val(res[0].no_index_dok);
																	 $('#txtAlamat').val(res[0].alamat_tinggal);
																	 $('#inputrt').val(res[0].rt_tinggal);
																	 $('#inputrw').val(res[0].rw_tinggal);
																	 $('#inputkpos').val(res[0].kode_pos);
																	 
																	 $('#txtAlamatKtp').val(res[0].alamat_ktp);
																	 $('#inputrtktp').val(res[0].rt_ktp);
																	 $('#inputrwktp').val(res[0].rw_ktp);
																	 $('#inputkposktp').val(res[0].kode_posktp);
																	 
																	 $('#txtnip').val(res[0].nip);
																	 $('#txtnik').val(res[0].nik);
																	 $('#txtnopeg').val(res[0].nopeg);
																	 $('#txtkarpeg').val(res[0].karpeg);
																	 $('#txttglnikah').val(res[0].tgl_nikah);
																	 $('#txtgelardepan').val(res[0].gelar_depan);
																	 $('#txtgelarbelakang').val(res[0].gelar_belakang);
																	 $('#txttlahir').val(res[0].tempat_lahir);
																	 $('#txtphone').val(res[0].phone);
																	 $('#txttgllahir').val(res[0].tgl_lahir);
																	 $('#img-cover').attr('src', res[0].foto);
	 
    }
  },1000);
                                   
																	
																	 
																	 
																	 
																	 
																	 
																	  getOptionsEdit("txtkelamin",BASE_URL+"master/kelamin",res[0].kelamin);
																		getOptionsEdit("f_user_status_aktif",BASE_URL+"Appdata/getstatus",res[0].status);
																		getOptionsEdit("txtagama",BASE_URL+"master/agama",res[0].agama);
																		getOptionsEdit("txtpendidikan",BASE_URL+"master/pendidikan",res[0].pendidikan);
																		getOptionsEdit("txtprov",BASE_URL+"master/provinsi",res[0].prov);
																		getOptionsEdit("txtprovktp",BASE_URL+"master/provinsi",res[0].prov_ktp);
																			getOptionsEdit("txtinputstatus",BASE_URL+"master/status_pegawai",res[0].status_pegawai);
																			getOptionsEdit("txtdirektorat",BASE_URL+"master/direktorat",res[0].direktorat);
																			getOptionsEdit("txtjabfung",BASE_URL+"master/jabatan_asn",res[0].jabatan_asn);
																			getOptionsEdit("txtjabatan",BASE_URL+"master/jabatan_struktural",res[0].jabatan_struktural);
																			getOptionsEdit("txtgolongan",BASE_URL+"master/golongan_pegawai",res[0].golongan);
																			getOptionsEdit("txtbagian",BASE_URL+"master/direktoratSub/"+res[0].direktorat,res[0].bagian);
																			getOptionsEdit("unitkerja",BASE_URL+"master/direktoratSub/"+res[0].bagian,res[0].sub_bagian);
																		
																			 
																	//	alert(res[0].kota);
																	
																		if(res[0].prov !=='0'){
																			getOptionsEdit("txtkota",BASE_URL+"master/kota/"+res[0].prov,res[0].kota);
																		}
																		
																		if(res[0].kota !=='0'){ 
																			getOptionsEdit("txtkecamatan",BASE_URL+"master/kecamatan/"+res[0].kota,res[0].kecamatan);
																		}
																		if(res[0].kecamatan !=='0'){
																			
																			getOptionsEdit("txtkelurahan",BASE_URL+"master/kelurahan/"+res[0].kecamatan,res[0].kelurahan);
																		}
																		if(res[0].prov_ktp !=='0'){
																			getOptionsEdit("txtkotaktp",BASE_URL+"master/kota/"+res[0].prov_ktp,res[0].kota_ktp);
																		}
																		if(res[0].kota_ktp !== '0'){
																			getOptionsEdit("txtkecamatanktp",BASE_URL+"master/kecamatan/"+res[0].kota_ktp,res[0].kecamatan_ktp);
																		}
																		if(res[0].kecamatan_ktp !=='0'){
																			getOptionsEdit("txtkelurahanktp",BASE_URL+"master/kelurahan/"+res[0].kecamatan_ktp,res[0].kelurahan_ktp);
																		}
																		 
																		
																		
                                  // getOptionsEdit("f_user_id_group",BASE_URL+"users/getgroup",res[0].id_group); 
                                   
																	
                    // gridOptions.api.setRowData(data);
               
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
                
                
            }
            
        }

            $('#demo-bootbox-bounce').on('click', function(){ 
						
						  
           
                bootbox.dialog({ 
                 message:$('<div></div>').load('view/pegawai/form_riwayat_pegawai.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'large',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-success",
                           callback: function() {
                               
                              simpan() ;
                                           return false;
                                       
                                       
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
           });
            
             


            
             
             function simpan(){
                       user_username      = $("#f_user_username").get(0).value;
                       user_name       = $("#f_user_name").get(0).value;
                       user_email      = $("#f_user_email").get(0).value;
											 direktorat = $("#txtdirektorat").get(0).value;
                                   
                       status_aktif        = $("#f_user_status_aktif").get(0).value; 
                       f_user_edit     = $("#f_user_edit").get(0).value;
                       user_password       = $("#f_user_password").get(0).value;
                       f_id_edit = $("#f_id_edit").get(0).value;
											 txtjabatan = $("#txtjabatan").val();
											 
											var action ='pegawai/edit';
											
											if(f_id_edit===''){
												action ='pegawai/save';
											}
											
											 
											
                       if(!validateUsername(user_username)){ 
                           $("#username").focus();
                           return false;
                       }else if(user_name===""){ 
                           
                           return false;
                       }else if(direktorat===""){
                                           onMessage("Data 'Direktorat' is required");
                           
                           return false;
                       }else if(txtjabatan === ''){
												 onMessage("Data 'Jabatan Struktural' is required");
                           
                           return false;
												}else{
												
														var data = formJson('form-upload');//$("#form-upload").serializeArray();
														$.ajax({
														url: BASE_URL+action,
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
																																	 $("#f_id_edit").val(data.id);
																																	  loaddata(0);
																																	// $('.modal').modal('hide');
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
  
  

    
	 
   
     





  </script><script src="js/login.js" type="text/javascript">
</script>
 
