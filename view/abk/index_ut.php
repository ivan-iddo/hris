<?php session_start()?>
 
            <div class="row"> 
                    <div class="col-md-6"> 
                            <div class="box box-primary"> 
                                <div class="box-body">
                                 
                                <div class="row pad-top"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Tahun</label>
                                            <div class="col-sm-3">
                                                    <select class="form-control select2" id="thnfrm3" name="thnfrm3" style="width: 100%;">
                                                    <option value="">--TAHUN--</option>
                                                     <?php for($i=2010;$i<= date('Y');$i++){?>
                                                        <option value="<?php echo $i?>"><?php echo $i?></option>
                                                        <?php }?>
                                                    </select> 
                                            </div>
                                           
                                    </div> 
                                    </div>
                                    <?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
                                    <div class="admininput">
                                    <div class="row pad-top"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Unit Kerja</label>
                                            <div class="col-sm-9">
                                                    <select class="form-control select-chosen" id="ukfrm3" name="ukfrm3" style="width: 100%;">
                                                     
                                                      
                                                    </select> 
                                            </div>
                                           
                                    </div>
                                    </div>
                                     
                                    
                                                     </div>
                                    <?php }?>
                                    <div class="row "> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus"></label>
                                            <div class="col-sm-5">
                                             
                                            <div class="row  text-left"> 
                                    <button class="btn btn-primary mar-all" onClick="searchfrm3();return false;">Search</button> 
                                   </div>
                                            </div>
                                    </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
            </div> 
            
      

         <div class="pad-btm form-inline" style="border-top:1px solid #dedede;padding:10px">
					            <div class="row">
					                <div class="col-sm-6 table-toolbar-left">
					                    <button id="demo-btn-addrow" class="btn btn-purple" onclick="addfrm3()"><i class="demo-pli-add"></i> Tambah Uraian Tugas</button>
                                        <button style="margin-left:3px" class="btn btn-mint" onclick="editfrm3()"><i class="fa fa-file-excel-o"></i> Update</button>
                                        <button class="btn btn-danger" onclick="hapusform3()"><i class="fa fa-file-excel-o"></i> Delete</button>
                                                      
					                     
					                </div>
					                <div class="col-sm-6 table-toolbar-right">
					                   
					                    <div class="btn-group">
                                       <button class="btn btn-default" style="border-radius:0px !important" onClick="uploadform3();return false;"><i class="fa fa-file-excel-o"></i> Import dari Excel</button>
					               
                                        <button class="btn btn-default"  onCLick="downloadform3();return false;"><i class="fa fa-file-excel-o"></i> Download Excel</button>
					                    </div>
					                </div>
					            </div>
					        </div>
                                            
            <div class="ag-theme-balham" id="Gridform3" style="height: 300px;width:100%;">

            
        </div>
        <div class="row">
					    <div class="col-xs-12">
					        <div class="panel" style="border:none !important">
                            <div class="panel-heading" style="border:none !important">
					                <h3 class="panel-title"> <i class="fa fa-universal-access text-danger"></i>  Langkah Kerja</h3>
					            </div>
                            <div class="panel-body" style="border:none !important">
                            <div class="pad-btm form-inline" style="border-top:1px solid #dedede;padding:10px">
					            <div class="row">
					                <div class="col-sm-6 table-toolbar-left">
					                    <button id="demo-btn-addrow" class="btn btn-purple" onclick="onAddRow()"><i class="demo-pli-add"></i> Tambah Langkah Kerja</button>
                                        <button style="margin-left:3px" class="btn btn-mint" onclick="editfrm4()"><i class="fa fa-file-excel-o"></i> Simpan Perubahan</button>
                                        <button class="btn btn-danger" onclick="hapusform4()"><i class="fa fa-file-excel-o"></i> Delete</button>
                                                      
					                     
					                </div>
					                <div class="col-sm-6 table-toolbar-right">
					                   
					                    <div class="btn-group">
                                       <button class="btn btn-default" style="border-radius:0px !important" onClick="uploadform4();return false;"><i class="fa fa-file-excel-o"></i> Import dari Excel</button>
					               
                                        <button class="btn btn-default"  onCLick="downloadform4();return false;"><i class="fa fa-file-excel-o"></i> Download Excel</button>
					                    </div>
					                </div>
					            </div>
					        </div>
                            <input type="text" id="tmpId" style="display:none">
                            <div class="ag-theme-balham" id="Gridform4" style="height: 300px;width:100%;">
                            </div>
                            <div id="myGridBottom" style="height: 40px;" class="ag-theme-balham"></div>
                            </div>
                        </div>
        </div>
    <script>
      $('.select-chosen').chosen();
     $('.chosen-container').css({"width": "100%"});
     var headerform4 = [
            {headerName: "Kode", field: "id_beban_kerja", width: 80,editable:false,   hide: true},
           {headerName: "Langkah Pelaksanaan Kegiatan ", field: "langkah", width: 280, filterParams:{newRowsAction: 'keep'}},
		   {headerName: "Frekuensi Pelaksanaan Kegiatan", field: "frekuensi", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Waktu (Menit)", field: "waktu", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Ka. Ur ", field: "kaur",editable:true, width: 120},
           {headerName: "Staf Admin", field: "staff_admin",editable:true, width: 120},
           {headerName: "Pekarya", field: "pekarya",editable:true, width: 120, filterParams:{newRowsAction: 'keep'}},
         {
        headerName: 'Jumlah',
        field: 'total',
        valueGetter: 'Number(data.kaur) + Number(data.staff_admin) + Number(data.pekarya)',
        width: 200
    } 
           
        ];

        var dataForBottomGrid = [
                {
                    langkah: 'Total',
                    frekuensi: '',
                    waktu: '',
                    kaur: '',
                    staff_admin: '',
                    pekarya: '' ,
                   /* jumlah: '' */
                }
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

        var Gridform4 = {
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
           columnDefs: headerform4,
           pagination: false,
    alignedGrids: [],
           paginationPageSize: 50,   
           defaultColDef:{
               editable: true,
               enableRowGroup:true,
               enablePivot:true,
               enableValue:true
           },
    onGridReady: function (params) {
        params.api.sizeColumnsToFit();
    }
        };

      
      var gridOptionsBottom = {
    columnDefs: headerform4,
    // we are hard coding the data here, it's just for demo purposes
    rowData: dataForBottomGrid,
    enableColResize: true,
    debug: true,
    rowClass: 'bold-row',
    // hide the header on the bottom grid
    headerHeight: 0,
    alignedGrids: [],
    onGridReady: function (params) {
        params.api.sizeColumnsToFit();
    }
};
        // setup the grid after the page has finished loading 
         //  var gridDiv = document.querySelector('#Gridform4');
          // new agGrid.Grid(gridDiv, Gridform4);

           var gridDivTop = document.querySelector('#Gridform4');
        new agGrid.Grid(gridDivTop, Gridform4);
        var gridDivBottom = document.querySelector('#myGridBottom');
        new agGrid.Grid(gridDivBottom, gridOptionsBottom);



     function listform4(){
              var thn=$('#thnfrm4').val(); 
              if(empty(thn)){
                var d = new Date();
                var n = d.getFullYear();
                  thn = n;
              }

               
               var idpapa=$('#tmpId').val();
            getJson(loadform4,BASE_URL+'abk/abk/listform4?id_ut='+idpapa);
          }

          function loadform4(result){
              if(result.hasil ==='success'){
                Gridform4.api.setRowData(result.result);
              }else{
                Gridform4.api.setRowData([]);
              }
          }


          listform4();

          function createNewRowData() {
            var selectedRows = Gridform3.api.getSelectedRows(); 
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Uraian Tugas Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
           });
              
                var newData = {
                    kode : selectedRowsString,
                    langkah: '',
                    frekuensi: '',
                    waktu: '',
                    kaur: '',
                    staff_admin: '',
                    pekarya: ''
                }; 
                return newData;
            }
            }

          function onAddRow() {
            var selectedRows = Gridform3.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Uraian Tugas Terlebih dahulu!');
               return false;
            }else{
                var newItem = createNewRowData();
                var res = Gridform4.api.updateRowData({add: [newItem]});
            }
                 
            }

     var headerform3 = [
           {headerName: "Kode", field: "no", width: 80,editable:false, filterParams:{newRowsAction: 'keep'}},
		   {headerName: "Unit Kerja", field: "unit_kerja", width: 190,editable:false, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Kegiatan Pokok", field: "kegiatan_pokok", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Uraian Tugas", field: "uraian_tugas", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Produk yang dihasilkan", field: "produk_dihasilkan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "JUMLAH PRODUK PER TAHUN (FREKUENSI)", field: "jumlah", width: 80, filterParams:{newRowsAction: 'keep'}},
          
           
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

        var Gridform3 = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false, 
           groupSelectsChildren: true,
           debug: true,
           onRowClicked: cariLangkahKerja,
            rowSelection: 'single', 
            editType: 'fullRow',
    enableColResize: true, 
           rowGroupPanelShow: 'always',
           pivotPanelShow: 'always',
           enableRangeSelection: true,
           columnDefs: headerform3,
           pagination: false,
           paginationPageSize: 50,   
           defaultColDef:{
               editable: true,
               enableRowGroup:true,
               enablePivot:true,
               enableValue:true
           },
    onGridReady: function (params) {
        params.api.sizeColumnsToFit();
    }
        };

      

        // setup the grid after the page has finished loading 
           var gridDiv = document.querySelector('#Gridform3');
           new agGrid.Grid(gridDiv, Gridform3);

           function cariLangkahKerja(){
            var selectedRows = Gridform3.api.getSelectedRows(); 
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Uraian Tugas Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
                    selectedRows.forEach( function(selectedRow, index) {
                        
                        if (index!==0) {
                            selectedRowsString += ', ';
                        }
                        selectedRowsString += selectedRow.id;
                    });
                    $('#tmpId').val(selectedRowsString);
                    getJson(loadform4,BASE_URL+'abk/abk/listform4?id_ut='+selectedRowsString);
            }
           }

            function listform3(){
              var thn=$('#thnfrm3').val(); 
              if(empty(thn)){
                var d = new Date();
                var n = d.getFullYear();
                  thn = n;
              }

              $('#thnfrm3').val(thn);

            getJson(loadform3,BASE_URL+'abk/abk/listform3?year='+thn);
          }

          function loadform3(result){
              if(result.hasil ==='success'){
                Gridform3.api.setRowData(result.result);
              }
          }

          listform3();

          function searchfrm3(){
            var thn=$('#thnfrm3').val();
            Gridform4.api.setRowData([]);
            var group = localStorage.getItem('group');
            var uri = BASE_URL+'abk/abk/listform3?year='+thn;
             if(empty(thn)){
                    alert('Tahun harus dipilih');
                    return false;
                }
                if((group ==='1') || (group ==='6')){
                    var uk=$('#ukfrm3').val();
                    uri = BASE_URL+'abk/abk/listform3?year='+thn+'&uk='+uk;
                }
            

            getJson(loadform3,uri);
          }

          function downloadform3(){
    var params = { 
        fileName: 'form3',
        sheetName: 'form3'
    };

    Gridform3.api.exportDataAsExcel(params);
}

function downloadform4(){
    var params = { 
        fileName: 'form4',
        sheetName: 'form4'
    };

    Gridform4.api.exportDataAsExcel(params);
}
    
    </script>


<?php //if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
    <script>
    function uploadform3(){
        bootbox.dialog({ 
                   message:$('<div></div>').load('view/abk/uploadxls_form3.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'medium',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-primary",
                           callback: function() {
                               
                               if(upload_file_form3()){
                                $('.modal').modal('hide');
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
     }

     function uploadform4(){
        bootbox.dialog({ 
                   message:$('<div></div>').load('view/abk/uploadxls_form4.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'medium',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-primary",
                           callback: function() {
                               
                               if(upload_file_form4()){
                                $('.modal').modal('hide');
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
     }

     function upload_file_form3(){
                var form = $("#form3-upload"); 
                var tahun = $('#thnfrm3add').val();
	if(empty(tahun)){
        alert('Tahun Wajib dipilih');
        return false;
    }else{

    
	$.ajax({
                            url: BASE_URL+"supplier/uploadform3", // Url to which the request is send 
                            type: "POST", 
                            data: new FormData(form[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                            contentType: false,       // The content type used when sending data to the server.
                            cache: false,             // To unable request pages to be cached
                            processData:false,        // To send DOMDocument or non processed data file it is set to false
                            success: function(data)   // A function to be called if request succeeds
                            {
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
                                                                                                                                       $('#thnfrm3').val(tahun);
                                                                                                                                       listform3();   
                                                                                                                     }else{
                                                                                                                            alert(message);
                                                                                                                          return false;	
                                                                                                                     }
                            }
                            });
	
	
	
                        }  
                
    }

     function upload_file_form4(){
                var form = $("#form4-upload");  
 
    
	$.ajax({
                            url: BASE_URL+"supplier/uploadform4", // Url to which the request is send 
                            type: "POST", 
                            data: new FormData(form[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                            contentType: false,       // The content type used when sending data to the server.
                            cache: false,             // To unable request pages to be cached
                            processData:false,        // To send DOMDocument or non processed data file it is set to false
                            success: function(data)   // A function to be called if request succeeds
                            {
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
                                                                                                                                       listform4();   
                                                                                                                     }else{
                                                                                                                            alert(message);
                                                                                                                          return false;	
                                                                                                                     }
                            }
                            });
	
	
	
                       
                
    }

    function editfrm3(){ 
    var rowData = [];
    Gridform3.api.forEachLeafNode( function(node) {
        rowData.push(node.data);
    });
    //console.log('Row Data:'); 
    save(BASE_URL+'abk/abk/editfrm3',rowData,listform3);
 
}

function editfrm4(){ 
    var rowData = [];
    Gridform4.api.forEachLeafNode( function(node) {
        rowData.push(node.data);
    });
    //console.log('Row Data:'); 
    save(BASE_URL+'abk/abk/editfrm4',rowData,listform4);
 
}

function addfrm3(){
        bootbox.dialog({ 
                   message:$('<div></div>').load('view/abk/add_from3.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'medium',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-primary",
                           callback: function() {
                               
                               if(frm3addnew()){
                                         $('.modal').modal('hide');
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
                               
                           }
                       }
                   }
                       });
     }

      function frm3addnew(){
         if(empty($('#thnadd').val())){
             alert('Tahun wajib dipilih');
             return false;
         }else{
            postForm('form3-addnew',BASE_URL+"abk/abk/addnewfrm3",listform3);
         }
       
     }

     function hapusform3(){
        var selectedRows = Gridform3.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih data yg akan dihapus Terlebih dahulu!');
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
                   message:'<center><h4 class="pad-all mar-all">Anda yakin ingin menghapus data ini?</h4></center>',
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'medium',
                   buttons: {
                       success: {
                           label: "Hapus",
                           className: "btn-primary",
                           callback: function() {
                               
                            getJson(listform3,BASE_URL+'abk/abk/hapusfrm3?id='+selectedRowsString);
                           }
                       },

                       main: {
                           label: "Close",
                           className: "btn-warning",
                           callback: function() {
                               
                           }
                       }
                   }
                       });
            

            }
     }

     function hapusform4(){
        var selectedRows = Gridform4.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih data yg akan dihapus Terlebih dahulu!');
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
                   message:'<center><h4 class="pad-all mar-all">Anda yakin ingin menghapus data ini?</h4></center>',
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'medium',
                   buttons: {
                       success: {
                           label: "Hapus",
                           className: "btn-primary",
                           callback: function() {
                               
                            getJson(listform4,BASE_URL+'abk/abk/hapusfrm4?id='+selectedRowsString);
                           }
                       },

                       main: {
                           label: "Close",
                           className: "btn-warning",
                           callback: function() {
                               
                           }
                       }
                   }
                       });
            

            }
     }

     

    </script>
    <?php //}?>

<?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
 <script>
 getOptions("ukfrm3",BASE_URL+"master/direktoratSub");
 </script>
 <?php } ?>
 
   