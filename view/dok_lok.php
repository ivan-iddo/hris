<?php $namaControler='dok_lok';?> 
  <div class="tab-base">
    <!--Nav Tabs-->

    <ul class="nav nav-tabs">
      <li><a data-toggle="tab" href="#demo-lft-tab-1">Home</a></li>

      <li class="active"><a data-toggle="tab" href="#demo-lft-tab-2">Form Lokasi</a></li>

      <li><a data-toggle="tab" href="#demo-lft-tab-3">Help</a></li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane fade" id="demo-lft-tab-1"></div>

      <div class="tab-pane fade active in" id="demo-lft-tab-2">
        <div class="fixed-table-toolbar">
          <div class="btn-group">
            <button class="btn btn-primary btn-labeled fa fa-plus-square btn-sm" id=
            "demo-bootbox-bounce">Add</button> <button class=
            "btn btn-warning btn-labeled fa fa-edit btn-sm" onclick=
            "proses_edit();">Edit</button> <button class=
            "btn btn-danger btn-labeled fa fa-close btn-sm" onclick=
            "proses_delete();">Delete</button>
          </div>
        </div>

        <div class="panel-body">
          <div class="bootstrap-table">
            <div class="fixed-table-container" style="padding-bottom: 0px;">
              <div class="ag-theme-balham" id="myGrid" style="height: 400px;width:100%;">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="demo-lft-tab-3"></div>
    </div>
  </div><script charset="utf-8" type="text/javascript">
//<![CDATA[
           // specify the columns
           var columnDefs = [
           {headerName: "Kode Arsip", field: "kode_arsip", width: 100, filterParams:{newRowsAction: 'keep'}} ,
           {headerName: "Nama", field: "nama", width: 300, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Alamat", field: "alamat", width: 300, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Lantai", field: "lantai", width: 100, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Ruang", field: "ruang", width: 100, filterParams:{newRowsAction: 'keep'}},
            {headerName: "No.Rak", field: "no_rak", width: 100, filterParams:{newRowsAction: 'keep'}},
            {headerName: "No.Box", field: "no_box", width: 100, filterParams:{newRowsAction: 'keep'}},
            {headerName: "latitude", field: "lat", width: 100, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Longitude", field: "lng", width: 100, filterParams:{newRowsAction: 'keep'}} 
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
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single',
           enableColResize: true,
           rowGroupPanelShow: 'always',
           pivotPanelShow: 'always',
           enableRangeSelection: true,
           columnDefs: columnDefs,
           pagination: true,
           paginationPageSize: 50,
           autoGroupColumnDef: autoGroupColumnDef,
           defaultColDef:{
               editable: true,
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
           function loaddata(){
           $.ajax({
                                   url: BASE_URL+'<?php echo $namaControler;?>/list',
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
                      
                        if(data.result !== 'empty'){
                          gridOptions.api.setRowData(data);
                        }else{
                          gridOptions.api.setRowData([]);
                        }
                     
                     
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });

           }
           
           loaddata();
           
           function proses_delete(){
             var selectedRows = gridOptions.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Lokasi Dokumen Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
           });
           submit_get(BASE_URL+'<?php echo $namaControler;?>/delete/?id='+selectedRowsString,loaddata);
           
           
            }
           }
           
           function proses_edit(){
            var selectedRows = gridOptions.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Lokasi Dokumen Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
           });
               
               $.ajax({
                                   url: BASE_URL+'<?php echo $namaControler;?>/getuser/?id='+selectedRowsString,
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
                                   $('#f_nama').val(res[0].nama);
                                   $('#f_user_edit').val(res[0].nama);
                                   $('#f_id_edit').val(res[0].id);
                                   
                                    $('#f_kode_arsip').val(res[0].kode_arsip);
                                     $('#f_alamat').val(res[0].alamat);
                                      $('#f_lantai').val(res[0].lantai);
                                       $('#f_ruang').val(res[0].ruang);
                                        $('#f_norak').val(res[0].no_rak);
                                         $('#f_nobox').val(res[0].no_box);
                                          $('#f_deskripsi').val(res[0].deskripsi);
                                    $('#f_lat').val(res[0].lat);
                                          $('#f_lng').val(res[0].lng);
                       
                    // gridOptions.api.setRowData(data);
               
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
               
           var input='<form class="form-horizontal">';
           input += '<div class="panel-body">';
            input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Kode Arsip*<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_kode_arsip" id="f_kode_arsip" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Gedung*<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_id_edit" id="f_id_edit" style="width: 220px;display:none" class="form-control"/>';
           input +='<input type="text" name="f_user_edit" id="f_user_edit" style="width: 220px;display:none" class="form-control"/>';
           input +='<input type="text" name="f_nama" id="f_nama" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Alamat<\/label>';
           input +='<div class="col-sm-5">';
           input +='<textarea name="f_alamat" id="f_alamat"></textarea>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Lantai<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_lantai" id="f_lantai" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Ruang<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_ruang" id="f_ruang" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">No.Rak<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_norak" id="f_norak" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">No.Box<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_nobox" id="f_nobox" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Deskripsi<\/label>';
           input +='<div class="col-sm-5">';
           input +='<textarea name="f_deskripsi" id="f_deskripsi"></textarea>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Latitude<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_lat" id="f_lat" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Longitude<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_lng" id="f_lng" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
          
           input += '<\/div>';
           
           input +='<\/form>';
           
           
                bootbox.dialog({
                   title: "<i class=\"fa fa-users\"><\/i> Edit Kategori Dokumen",
                   message:input, 
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
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
                           label: "Cancel",
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
            }
            
        }

            $('#demo-bootbox-bounce').on('click', function(){
           
            
           var input='<form class="form-horizontal">';
           input += '<div class="panel-body">';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Kode Arsip*<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_kode_arsip" id="f_kode_arsip" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Gedung*<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_id_edit" id="f_id_edit" style="width: 220px;display:none" class="form-control"/>';
           input +='<input type="text" name="f_user_edit" id="f_user_edit" style="width: 220px;display:none" class="form-control"/>';
           input +='<input type="text" name="f_nama" id="f_nama" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Alamat<\/label>';
           input +='<div class="col-sm-5">';
           input +='<textarea name="f_alamat" id="f_alamat"></textarea>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Lantai<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_lantai" id="f_lantai" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Ruang<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_ruang" id="f_ruang" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">No.Rak<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_norak" id="f_norak" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">No.Box<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_nobox" id="f_nobox" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Deskripsi<\/label>';
           input +='<div class="col-sm-5">';
           input +='<textarea name="f_deskripsi" id="f_deskripsi"></textarea>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Latitude<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_lat" id="f_lat" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Longitude<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_lng" id="f_lng" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input += '<\/div>'; 
           input +='<\/form>';
           
           
                bootbox.dialog({
                   title: "<i class=\"fa fa-user\"><\/i> Tambah Lokasi Dokumen",
                   message:input, 
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-primary",
                           callback: function() {
                               
                               if(simpan('add')){
                                           return true;
                                       }else{
                                           return false;
                                       }
                                       
                           }
                       },

                       main: {
                           label: "Cancel",
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
            
             
             function simpan(action){
                       var  nama      = $("#f_nama").get(0).value; 
                       var f_id_edit = $("#f_id_edit").get(0).value;
                       var f_user_edit     = $("#f_user_edit").get(0).value;
                       var f_kode_arsip = $("#f_kode_arsip").get(0).value;
                       var f_alamat = $("#f_alamat").get(0).value;
                       var f_lantai = $("#f_lantai").get(0).value;
                       var f_ruang = $("#f_ruang").get(0).value;
                       var f_norak = $("#f_norak").get(0).value;
                       var f_nobox = $("#f_nobox").get(0).value;
                       var f_deskripsi = $("#f_deskripsi").get(0).value;
                       
                       var f_lat = $("#f_lat").get(0).value;
                       var f_lng = $("#f_lng").get(0).value;
                        
                       if(nama==""){
                           onMessage("Data 'Nama' is required");
                           $("#f_nama").focus();
                           return false;
                       }else if(f_kode_arsip==""){
                           onMessage("Kode Arsip tidak boleh kosong");
                           $("#f_kode_arsip").focus();
                        }else{
                            
                           
                           var data = {
                                   nama:nama,
                                   f_id_edit:f_id_edit,
                                   f_user_edit:f_user_edit,
                                   f_lantai : f_lantai,
                                    f_ruang : f_ruang,
                                    f_norak : f_norak,
                                    f_nobox : f_nobox,
                                    f_deskripsi : f_deskripsi,
                                    f_alamat:f_alamat,
                                    f_kode_arsip:f_kode_arsip,f_lng:f_lng,f_lat:f_lat
                               };
                               
                           if(action == 'add'){
                               URL = BASE_URL+"<?php echo $namaControler;?>/save";
                           }else if(action == 'edit'){
                               URL = BASE_URL+"<?php echo $namaControler;?>/edit";
                           }
                            save(URL,data,loaddata);
                       }  
             }
             
             
           
           
  //]]>
  </script><script src="js/login.js" type="text/javascript">
</script>
 
