 
  <div class="tab-base">
    <!--Nav Tabs-->

    <ul class="nav nav-tabs">
      <li><a data-toggle="tab" href="#demo-lft-tab-1">Home</a></li>

      <li class="active"><a data-toggle="tab" href="#demo-lft-tab-2">Users</a></li>

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
           
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Username", field: "username", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "E-Mail", field: "email", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Group", field: "nama_group", width: 190, filterParams:{newRowsAction: 'keep'}}
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
                                   url: BASE_URL+'users/list',
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
                      
                        
                     gridOptions.api.setRowData(data);
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
               
               $.ajax({
                                   url: BASE_URL+'users/getuser/?id='+selectedRowsString,
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
                                   $('#f_user_username').val(res[0].username);
                                   $('#f_user_edit').val(res[0].username);
                                   $('#f_id_edit').val(res[0].id);
                                   $('#f_user_name').val(res[0].nama);
                                   $('#f_user_email').val(res[0].email);
                                   getOptionsEdit("f_user_id_group",BASE_URL+"users/getgroup",res[0].id_group);
                                   getOptionsEdit("f_user_status_aktif",BASE_URL+"Appdata/getstatus",res[0].status);
                    // gridOptions.api.setRowData(data);
               
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
               
           var input='<form class="form-horizontal">';
           input += '<div class="panel-body">';
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Username<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_id_edit" id="f_id_edit" style="width: 220px;display:none" class="form-control"/>';
           input +='<input type="text" name="f_user_edit" id="f_user_edit" style="width: 220px;display:none" class="form-control"/>';
           input +='<input type="text" name="f_user_username" id="f_user_username" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_user_name" id="f_user_name" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label">Group<\/label>';
           input +='<div class="col-sm-5">';
           input +='<select name="f_user_id_group" id="f_user_id_group" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">E-Mail<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_user_email" id="f_user_email" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" >Password<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="password" name="f_user_password" id="f_user_password" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Aktif<\/label>';
           input +='<div class="col-sm-5">';
           input +='<select name="f_user_status_aktif" id="f_user_status_aktif" style="width: 150px" class="form-control"/>     ';
           input += '<\/div>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<\/form>';
           
           
                bootbox.dialog({
                   title: "<i class=\"fa fa-users\"><\/i> Edit Group",
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
            getOptions("f_user_id_group",BASE_URL+"users/getgroup");
            getOptionsEdit("f_user_status_aktif",BASE_URL+"Appdata/getstatus",1);
            
           var input='<form class="form-horizontal">';
           input += '<div class="panel-body">';
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Username<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_id_edit" id="f_id_edit" style="width: 220px;display:none" class="form-control"/>';
           input +='<input type="text" name="f_user_edit" id="f_user_edit" style="width: 220px;display:none" class="form-control"/>';
           input +='<input type="text" name="f_user_username" id="f_user_username" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_user_name" id="f_user_name" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label">Group<\/label>';
           input +='<div class="col-sm-5">';
           input +='<select name="f_user_id_group" id="f_user_id_group" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">E-Mail<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_user_email" id="f_user_email" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" >Password<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="password" name="f_user_password" id="f_user_password" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Aktif<\/label>';
           input +='<div class="col-sm-5">';
           input +='<select name="f_user_status_aktif" id="f_user_status_aktif" style="width: 150px" class="form-control"/>     ';
           input += '<\/div>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<\/form>';
           
           
                bootbox.dialog({
                   title: "<i class=\"fa fa-user\"><\/i> Add New User",
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
                user_username      = $("#f_user_username").get(0).value;
                       user_name       = $("#f_user_name").get(0).value;
                       user_email      = $("#f_user_email").get(0).value; 
                       user_id_group       = $("#f_user_id_group").get(0).value;               
                       status_aktif        = $("#f_user_status_aktif").get(0).value; 
                       f_user_edit     = $("#f_user_edit").get(0).value;
                       user_password       = $("#f_user_password").get(0).value;
                       f_id_edit = $("#f_id_edit").get(0).value;
                                       
                       if(user_username==""){
                           onMessage("Data 'username' is required");
                           $("#username").focus();
                           return false;
                       }else if((user_password=="") && (action=='add')){
                                           onMessage("Data 'Password' is required");
                           $("#f_user_password").focus();
                           return false;
                       }else if(user_name==""){
                                           onMessage("Data 'name' is required");
                           $("#name").focus();
                           return false;
                       }else if(user_id_group==""){
                                           onMessage("Data 'Group User' is required");
                           $("#id_group").focus();
                           return false;
                       }else{
                            
                           
                           var data = {
                                   username:user_username,                                                        
                                   name:user_name,
                                   email:user_email,                                                        
                                   id_group:user_id_group, 
                                   pass:user_password,
                                   status:status_aktif,
                                   f_user_edit:f_user_edit,
                                   f_id_edit:f_id_edit
                               };
                               
                           if(action == 'add'){
                               URL = BASE_URL+"users/save";
                           }else if(action == 'edit'){
                               URL = BASE_URL+"users/edit";
                           }
                            save(URL,data,loaddata);
                       }  
             }
             
             
           
           
  //]]>
  </script><script src="js/login.js" type="text/javascript">
</script>
 
