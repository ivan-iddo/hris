<?php $namaControler='ruas_jalan';?> 
<div class="tab-base">
  <!--Nav Tabs-->

  <ul class="nav nav-tabs">
    <li><a data-toggle="tab" href="#demo-lft-tab-1">Home</a></li>

    <li class="active"><a data-toggle="tab" href="#demo-lft-tab-2">Form Ruas</a></li>

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
           {headerName: "Link ID", field: "link_id", width: 100, filterParams:{newRowsAction: 'keep'}} ,
           {headerName: "Nama Ruas", field: "nama", width: 300, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Provinsi", field: "nama_propinsi", width: 200, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Kode Ruas", field: "kode_ruas", width: 150, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Kode keterangan", field: "deskripsi", width: 300, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Panjang Ruas (Km)", field: "panjang_ruas", width: 150, filterParams:{newRowsAction: 'keep'}},
           {headerName: "STA awal", field: "STA_awal", width: 150, filterParams:{newRowsAction: 'keep'}},
           {headerName: "STA akhir", field: "STA_akhir", width: 150, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Koordinat Awal", field: "kord_awal", width: 150, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Koordinat Akhir", field: "kord_akhir", width: 150, filterParams:{newRowsAction: 'keep'}}
           
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
             onMessage('Silahkan Pilih Data Ruas  Terlebih dahulu!');
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
             onMessage('Silahkan Pilih Data Ruas  Terlebih dahulu!');
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
               
               $("#f_link_id").val(res[0].link_id); 
               $("#f_keterangan").val(res[0].deskripsi);
               $("#f_panjang").val(res[0].panjang_ruas);
               $("#f_sta_awal").val(res[0].STA_awal);
               $("#f_sta_akhir").val(res[0].STA_akhir);
               $("#f_kord_awal").val(res[0].kord_awal);
               $("#f_kord_akhir").val(res[0].kord_akhir);
               $("#f_titik_ref_awal").val(res[0].titikref_awal);
               $("#f_titik_ref_akhir").val(res[0].titikref_akhir);
               $("#f_kode_ruas").val(res[0].kode_ruas);
               getOptionsEdit("f_provinsi",BASE_URL+"Appdata/getprov",res[0].id_propinsi);
               
               
               
                    // gridOptions.api.setRowData(data);
                    
                  },
                  error: function( jqXhr, textStatus, errorThrown ){
                   alert('error');
                 }
               });
            
            var input='<form class="form-horizontal">';
            input += '<div class="panel-body">';
            input +='<div class="form-group">';
            input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Link ID*<\/label>';
            input +='<div class="col-sm-5">';
            input +='<input type="text" name="f_link_id" id="f_link_id" style="width: 220px" class="form-control"/>';
            input += '<\/div>';
            input += '<\/div>';
            
            input +='<div class="form-group">';
            input +='<label class="col-sm-3 control-label">Provinsi<\/label>';
            input +='<div class="col-sm-5">';
            input +='<select name="f_provinsi" id="f_provinsi" class="form-control"/>';
            input += '<\/div>';
            input += '<\/div>';
            
            input +='<div class="form-group">';
            input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Kode Ruas<\/label>';
            input +='<div class="col-sm-5">';
            input +='<input type="text" name="f_kode_ruas" id="f_kode_ruas" style="width: 220px" class="form-control"/>';
            input += '<\/div>';
            input += '<\/div>';
            
            input +='<div class="form-group">';
            input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Kode Keterangan<\/label>';
            input +='<div class="col-sm-5">';
            input +='<input type="text" name="f_keterangan" id="f_keterangan" style="width: 220px" class="form-control"/>';
            input += '<\/div>';
            input += '<\/div>';
            
            input +='<div class="form-group">';
            input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Ruas*<\/label>';
            input +='<div class="col-sm-5">';
            input +='<input type="text" name="f_id_edit" id="f_id_edit" style="width: 220px;display:none" class="form-control"/>';
            input +='<input type="text" name="f_user_edit" id="f_user_edit" style="width: 220px;display:none" class="form-control"/>';
            input +='<input type="text" name="f_nama" id="f_nama" style="width: 220px" class="form-control"/>';
            input += '<\/div>';
            input += '<\/div>';
            
            input +='<div class="form-group">';
            input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Panjang Ruas (Km)<\/label>';
            input +='<div class="col-sm-5">';
            input +='<input type="text" name="f_panjang" id="f_panjang" style="width: 220px" class="form-control"/>';
            input += '<\/div>';
            input += '<\/div>';
            
            input +='<div class="form-group">';
            input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">STA Awal<\/label>';
            input +='<div class="col-sm-5">';
            input +='<input type="text" name="f_sta_awal" id="f_sta_awal" style="width: 220px" class="form-control"/>';
            input += '<\/div>';
            input += '<\/div>';
            
            input +='<div class="form-group">';
            input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">STA Akhir<\/label>';
            input +='<div class="col-sm-5">';
            input +='<input type="text" name="f_sta_akhir" id="f_sta_akhir" style="width: 220px" class="form-control"/>';
            input += '<\/div>';
            input += '<\/div>';
            
            input +='<div class="form-group">';
            input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Koordinat Awal<\/label>';
            input +='<div class="col-sm-5">';
            input +='<input type="text" name="f_kord_awal" id="f_kord_awal" style="width: 220px" class="form-control"/>';
            input += '<\/div>';
            input += '<\/div>';
            
            input +='<div class="form-group">';
            input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Koordinat Akhir<\/label>';
            input +='<div class="col-sm-5">';
            input +='<input type="text" name="f_kord_akhir" id="f_kord_akhir" style="width: 220px" class="form-control"/>';
            input += '<\/div>';
            input += '<\/div>';
            
            input +='<div class="form-group">';
            input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Titik Ref Awal<\/label>';
            input +='<div class="col-sm-5">';
            input +='<input type="text" name="f_titik_ref_awal" id="f_titik_ref_awal" style="width: 220px" class="form-control"/>';
            input += '<\/div>';
            input += '<\/div>';
            
            input +='<div class="form-group">';
            input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Titik Ref Akhir<\/label>';
            input +='<div class="col-sm-5">';
            input +='<input type="text" name="f_titik_ref_akhir" id="f_titik_ref_akhir" style="width: 220px" class="form-control"/>';
            input += '<\/div>';
            input += '<\/div>';
            
            input += '<\/div>';
            
            input +='<\/form>';
            
            
            bootbox.dialog({
             title: "<i class=\"fa fa-users\"><\/i> Edit Ruas",
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
         
          getOptions("f_provinsi",BASE_URL+"Appdata/getprov");
          var input='<form class="form-horizontal">';
          input += '<div class="panel-body">';
          
          input +='<div class="form-group">';
          input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Link ID*<\/label>';
          input +='<div class="col-sm-5">';
          input +='<input type="text" name="f_link_id" id="f_link_id" style="width: 220px" class="form-control"/>';
          input += '<\/div>';
          input += '<\/div>';
          
          input +='<div class="form-group">';
          input +='<label class="col-sm-3 control-label">Provinsi<\/label>';
          input +='<div class="col-sm-5">';
          input +='<select name="f_provinsi" id="f_provinsi" class="form-control"/>';
          input += '<\/div>';
          input += '<\/div>';
          
          input +='<div class="form-group">';
          input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Kode Ruas<\/label>';
          input +='<div class="col-sm-5">';
          input +='<input type="text" name="f_kode_ruas" id="f_kode_ruas" style="width: 220px" class="form-control"/>';
          input += '<\/div>';
          input += '<\/div>';
          
          input +='<div class="form-group">';
          input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Kode Keterangan<\/label>';
          input +='<div class="col-sm-5">';
          input +='<input type="text" name="f_keterangan" id="f_keterangan" style="width: 220px" class="form-control"/>';
          input += '<\/div>';
          input += '<\/div>';
          
          input +='<div class="form-group">';
          input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Ruas*<\/label>';
          input +='<div class="col-sm-5">';
          input +='<input type="text" name="f_id_edit" id="f_id_edit" style="width: 220px;display:none" class="form-control"/>';
          input +='<input type="text" name="f_user_edit" id="f_user_edit" style="width: 220px;display:none" class="form-control"/>';
          input +='<input type="text" name="f_nama" id="f_nama" style="width: 220px" class="form-control"/>';
          input += '<\/div>';
          input += '<\/div>';
          
          input +='<div class="form-group">';
          input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Panjang Ruas (Km)<\/label>';
          input +='<div class="col-sm-5">';
          input +='<input type="text" name="f_panjang" id="f_panjang" style="width: 220px" class="form-control"/>';
          input += '<\/div>';
          input += '<\/div>';
          
          input +='<div class="form-group">';
          input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">STA Awal<\/label>';
          input +='<div class="col-sm-5">';
          input +='<input type="text" name="f_sta_awal" id="f_sta_awal" style="width: 220px" class="form-control"/>';
          input += '<\/div>';
          input += '<\/div>';
          
          input +='<div class="form-group">';
          input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">STA Akhir<\/label>';
          input +='<div class="col-sm-5">';
          input +='<input type="text" name="f_sta_akhir" id="f_sta_akhir" style="width: 220px" class="form-control"/>';
          input += '<\/div>';
          input += '<\/div>';
          
          input +='<div class="form-group">';
          input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Koordinat Awal<\/label>';
          input +='<div class="col-sm-5">';
          input +='<input type="text" name="f_kord_awal" id="f_kord_awal" style="width: 220px" class="form-control"/>';
          input += '<\/div>';
          input += '<\/div>';
          
          input +='<div class="form-group">';
          input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Koordinat Akhir<\/label>';
          input +='<div class="col-sm-5">';
          input +='<input type="text" name="f_kord_akhir" id="f_kord_akhir" style="width: 220px" class="form-control"/>';
          input += '<\/div>';
          input += '<\/div>';
          
          input +='<div class="form-group">';
          input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Titik Ref Awal<\/label>';
          input +='<div class="col-sm-5">';
          input +='<input type="text" name="f_titik_ref_awal" id="f_titik_ref_awal" style="width: 220px" class="form-control"/>';
          input += '<\/div>';
          input += '<\/div>';
          
          input +='<div class="form-group">';
          input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Titik Ref Akhir<\/label>';
          input +='<div class="col-sm-5">';
          input +='<input type="text" name="f_titik_ref_akhir" id="f_titik_ref_akhir" style="width: 220px" class="form-control"/>';
          input += '<\/div>';
          input += '<\/div>';
          
          
          input += '<\/div>'; 
          input +='<\/form>';
          
          
          bootbox.dialog({
           title: "<i class=\"fa fa-user\"><\/i> Tambah Ruas",
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
 f_link_id = $("#f_link_id").get(0).value;
 f_provinsi = $("#f_provinsi").get(0).value;
 f_keterangan = $("#f_keterangan").get(0).value;
 f_nama = $("#f_nama").get(0).value;
 f_panjang = $("#f_panjang").get(0).value;
 f_sta_awal = $("#f_sta_awal").get(0).value;
 f_sta_akhir = $("#f_sta_akhir").get(0).value;
 f_kord_awal = $("#f_kord_awal").get(0).value;
 f_kord_akhir = $("#f_kord_akhir").get(0).value;
 f_titik_ref_awal = $("#f_titik_ref_awal").get(0).value;
 f_titik_ref_akhir = $("#f_titik_ref_akhir").get(0).value;
 f_kode_ruas = $("#f_kode_ruas").get(0).value;
 
 
 if(nama==""){
   onMessage("Data 'Nama' is required");
   $("#f_nama").focus();
   return false;
 }else if(f_link_id==""){
   onMessage("Kode Arsip tidak boleh kosong");
   $("#f_kode_arsip").focus();
 }else{
  
   
   var data = {
     nama:nama,
     f_id_edit:f_id_edit,
     f_user_edit:f_user_edit,
     f_kode_ruas:f_kode_ruas,
     f_link_id : f_link_id,
     f_provinsi : f_provinsi,
     f_keterangan :f_keterangan,
     f_nama :f_nama,
     f_panjang :f_panjang,
     f_sta_awal :f_sta_awal,
     f_sta_akhir:f_sta_akhir,
     f_kord_awal :f_kord_awal,
     f_kord_akhir :f_kord_akhir,
     f_titik_ref_awal :f_titik_ref_awal,
     f_titik_ref_akhir :f_titik_ref_akhir
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

