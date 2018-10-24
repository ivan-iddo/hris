 
   <div class="mar-all">
  <div class="fixed-table-toolbar">
          <div class="btn-group">
            <button class="btn btn-primary btn-labeled fa fa-plus-square btn-sm" id=
            "demo-bootbox-bounce">Add</button>
            <button class=
            "btn btn-warning btn-labeled fa fa-edit btn-sm" onclick=
            "proses_edit();">Edit</button> <button class=
            "btn btn-danger btn-labeled fa fa-close btn-sm" onclick=
            "proses_delete();">Delete</button>
          </div>
        </div>
  <br>
  <div class="ag-theme-balham" id="myGrid" style="height: 400px;width:100%;">
    </div>
  <script charset="utf-8" type="text/javascript">
         
//<![CDATA[
           // specify the columns
           var columnDefs = [
           {headerName: "No.Dokumen", field: "no_dok", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Judul Dokumen", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Tanggal Pembuatan", field: "tgl", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Unit Kerja", field: "uk", width: 190, filterParams:{newRowsAction: 'keep'}},
           
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
           onRowDoubleClicked: proses_edit,
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
           
          
           function loaddata(){
           $.ajax({
                                   url: BASE_URL+'dokumen/list_entry?id_tipe=<?php echo $_GET['id_tipe'];?>&id_master=<?php echo $_GET['id_master'];?>',
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
               
            }
            
            
            $(".isi").load('view/dokumen_entry_form.php?id_data='+selectedRowsString+'&id_tipe=<?php echo $_GET['id_tipe'];?>&id_master=<?php echo $_GET['id_master'];?>');
        }

            $('#demo-bootbox-bounce').on('click', function(){
            
	  $(".isi").load('view/dokumen_entry_form.php?id_tipe=<?php echo $_GET['id_tipe'];?>&id_master=<?php echo $_GET['id_master'];?>');
     
   
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
 
