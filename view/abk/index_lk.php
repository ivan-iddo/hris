<?php session_start()?>
 
            <div class="row"> 
                    <div class="col-md-9"> 
                            <div class="box box-primary"> 
                                <div class="box-body">
                                 
                                <div class="row pad-top"> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="inputstatus">Tahun</label>
                                            <div class="col-sm-4">
                                                    <select class="form-control select2" id="thnfrm4" name="thnfrm4" style="width: 100%;" >
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
                                        <label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
                                            <div class="col-sm-6">
                                                    <select class="form-control select-chosen" id="ukfrm4" name="ukfrm4" style="width: 100%;">
                                                     
                                                      
                                                    </select> 
                                            </div>
                                           
                                    </div>
                                    </div>
                                     
                                    
                                                     </div>
                                    <?php }?>
                                    
                                    <div class="row "> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="inputstatus"></label>
                                            <div class="col-sm-6">
                                             
                                            <div class="row  text-left">  <button class="btn btn-primary mar-all" onClick="searchfrm5();return false;">Search</button> 
                                  
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
					                    <button id="demo-btn-addrow" class="btn btn-purple" onclick="addfrm4()"><i class="demo-pli-add"></i> Tambah Langkah Kerja</button>
                                        <button style="margin-left:3px" class="btn btn-mint" onclick="editfrm4()"><i class="fa fa-file-excel-o"></i> Update</button>
                                        <button class="btn btn-danger" onclick="hapusform5()"><i class="fa fa-file-excel-o"></i> Delete</button>
                                                      
					                     
					                </div>
					                <div class="col-sm-6 table-toolbar-right">
					                   
					                    <div class="btn-group">
                                       <button class="btn btn-default" style="border-radius:0px !important" onClick="uploadform5();return false;"><i class="fa fa-file-excel-o"></i> Import dari Excel</button>
					               
                                        <button class="btn btn-default"  onCLick="downloadform5();return false;"><i class="fa fa-file-excel-o"></i> Download Excel</button>
					                    </div>
					                </div>
					            </div>
					        </div>
                                            
            <div class="ag-theme-balham" id="Gridform5" style="height: 900px;width:100%;">
        </div>
    <script>
     $('.select-chosen').chosen();
     $('.chosen-container').css({"width": "100%"});

     
    
     var headerform4 = [
        {headerName: "Tahun", field: "tahun", width: 190,editable:false, filterParams:{newRowsAction: 'keep'}},
          
           {headerName: "Kategori SDM", field: "kategsdm", width: 190,editable:false, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Kegiatan", field: "kegiatan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Frekuensi/thn", field: "frekuensi", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Waktu (menit)", field: "waktu", width: 190, filterParams:{newRowsAction: 'keep'}},
           {
        headerName: 'Jumlah (menit)',
        field: 'total',
        valueGetter: 'Number(data.frekuensi) * Number(data.waktu)',
        width: 200
    } ,
 {field: "faktor", rowGroup:true, hide:true},
 {field: "shift", rowGroup:true, hide:true} 
           
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

        var Gridform5 = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false, 
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single', 
    enableColResize: true, 
    groupDefaultExpanded: 2,
           rowGroupPanelShow: 'always',
           pivotPanelShow: 'always',
           enableRangeSelection: true,
           columnDefs: headerform4,
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
           var gridDiv = document.querySelector('#Gridform5');
           new agGrid.Grid(gridDiv, Gridform5);

            function listform5(){
              var thn=$('#thnfrm4').val(); 
              if(empty(thn)){
                var d = new Date();
                var n = d.getFullYear();
                  thn = n;
              }

               

            getJson(loadform5,BASE_URL+'abk/abk/listform5?year='+thn);
          }

          function loadform5(result){
              if(result.hasil ==='success'){
                Gridform5.api.setRowData(result.result);
              }else{
                Gridform5.api.setRowData([]);
              }
          }

          listform5();

          function searchfrm5(){
            var thn=$('#thnfrm4').val();
            var uk=$('#ukfrm4').val();
            
            var group = localStorage.getItem('group');
            var uri = BASE_URL+'abk/abk/listform5?thn='+thn+'&uk='+uk;
             if(empty(thn)){
                    alert('Tahun harus dipilih');
                    return false;
                }
                if((group ==='1') || (group ==='6')){
                    var uk=$('#ukfrm4').val();
                    uri = BASE_URL+'abk/abk/listform5?year='+thn+'&uk='+uk;
                }
            

            getJson(loadform5,uri);
          }

          function downloadform5(){
    var params = { 
        fileName: 'faktorkelonggaran',
        sheetName: 'faktorkelonggaran'
    };

    Gridform5.api.exportDataAsExcel(params);
}
    
    </script>


<?php //if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
    <script>
    function uploadform5(){
        bootbox.dialog({ 
                   message:$('<div></div>').load('view/abk/uploadxls_form5.php'),
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

     function upload_file_form4(){
                var form = $("#form5-upload"); 
                var tahun = $('#thnfrm3add').val();
	 
    
	$.ajax({
                            url: BASE_URL+"supplier/uploadform5", // Url to which the request is send 
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
                                                                                                                                       $('#thnfrm4').val(tahun);
                                                                                                                                       listform5();   
                                                                                                                     }else{
                                                                                                                            alert(message);
                                                                                                                          return false;	
                                                                                                                     }
                            }
                            });
	
	
	
                       
                
    }

    function editfrm4(){ 
    var rowData = [];
    Gridform5.api.forEachLeafNode( function(node) {
        rowData.push(node.data);
    });
    //console.log('Row Data:'); 
    save(BASE_URL+'abk/abk/editfrm5',rowData,listform5);
 
}

function createNewRowData() {
    var newData = {
        make: "Toyota " + newCount,
        model: "Celica " + newCount,
        price: 35000 + (newCount * 17),
        zombies: 'Headless',
        style: 'Little',
        clothes: 'Airbag'
    };
    newCount++;
    return newData;
}

function addfrm4(){
        bootbox.dialog({ 
                   message:$('<div></div>').load('view/abk/add_form4.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'medium',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-success",
                           callback: function() {
                               
                               if(frm4addnew('show')){
                                       //  $('.modal').modal('hide');
                                           return true;
                                       }else{
                                           return false;
                                       }
                                       
                           }
                       }, add: {
                           label: "Save and Close",
                           className: "btn-primary",
                           callback: function() {
                            if(frm4addnew('close')){
                                       //  $('.modal').modal('hide');
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

      function frm4addnew(a){ 
         $("#shiftfrm4").val();
         $("#faktorfrm4").val();
         $("#katsdmfrm4").val();

         if(empty($('#thnadd').val())){
             alert('Tahun wajib dipilih');
             return false;
         }else if(empty($('#shiftfrm4').val())){
             alert('Jenis Shift Wajib dipilih');
             return false;
         }else if(empty($('#faktorfrm4').val())){
             alert('Kategori Faktor wajib dipilih');
             return false;
         }else  if(empty($('#katsdmfrm4').val())){
             alert('Kategori SDM wajib dipilih');
             return false;
         }else{
             if(a ==='close'){
                postForm('form4-addnew',BASE_URL+"abk/abk/addnewfrm4",listform5);
             }else{
                postFormMore('form4-addnew',BASE_URL+"abk/abk/addnewfrm4",listform5);
             }
           
         }
       
     }

     function hapusform5(){
        var selectedRows = Gridform5.api.getSelectedRows();
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
                            getJson(listform5,BASE_URL+'abk/abk/hapusfrm5?id='+selectedRowsString);
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
 getOptions("ukfrm4",BASE_URL+"master/direktoratSub");
 </script>
 <?php } ?>
 
   