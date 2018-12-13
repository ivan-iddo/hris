<?php session_start()?>
<div class="panel-heading">
					                <div class="panel-control">
                                    <?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
                                    <button class="btn btn-info btn-sm" style="border-radius:0px !important" onClick="uploadform2();return false;"><i class="fa fa-file-excel-o"></i> Import dari Excel</button>
<?php }?>
                                    <button class="btn btn-info btn-sm" style="border-radius:0px !important" onCLick="downloadform2();return false;"><i class="fa fa-file-excel-o"></i> Download Excel</button>
					                     
					                </div> 
					            </div>
            <div class="row"> 
                    <div class="col-md-6"> 
                            <div class="box box-primary"> 
                                <div class="box-body">
                                 
                                <div class="row pad-top"> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="inputstatus">Tahun</label>
                                            <div class="col-sm-4">
                                                    <select class="form-control select2" id="thnfrm2" name="thnfrm2" style="width: 100%;">
                                                    <option value="">--TAHUN--</option>
                                                     <?php for($i=2010;$i<= date('Y');$i++){?>
                                                        <option value="<?php echo $i?>"><?php echo $i?></option>
                                                        <?php }?>
                                                    </select> 
                                            </div>
                                           
                                    </div> 
                                    </div>
                                    <div class="row pad-top"> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="inputstatus">Shift Pegawai</label>
                                            <div class="col-sm-4">
                                                    <select class="form-control select2" id="shiftpeg" name="shiftpeg" style="width: 100%;">
                                                    
                                                    </select> 
                                            </div>
                                           
                                    </div> 
                                    </div>
                                    
          
                                    <div class="row "> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="inputstatus"></label>
                                            <div class="col-sm-5">
                                             
                                            <div class="row  text-left"> 
                                    <button class="btn btn-primary mar-all" onClick="searchfrm2();">Search</button> 
                                   </div>
                                            </div>
                                    </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
            </div> 
            
            <div class="btn-group btn-group-xs pad-top text-right">
            <?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
				<button style="margin-left:3px" class="btn btn-mint" onclick="editfrm2()"><i class="fa fa-file-excel-o"></i> Update</button>
            <?php }?>                             
                                            </div>
                                            
            <div class="ag-theme-balham" id="Gridform2" style="height: 900px;width:100%;">
        </div>
    <script>

    getOptions("shiftpeg",BASE_URL+"master/getmaster?id=27");
     var headerform2 = [
           {headerName: "No.", field: "no", width: 80,editable:false, filterParams:{newRowsAction: 'keep'}},
		   {headerName: "Shift", field: "shift", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Faktor", field: "faktor", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Waktu Kerja", field: "waktu_kerja", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Keterangan", field: "keterangan", width: 80, filterParams:{newRowsAction: 'keep'}},
          
           
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

        var Gridform2 = {
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
           columnDefs: headerform2,
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
           var gridDiv = document.querySelector('#Gridform2');
           new agGrid.Grid(gridDiv, Gridform2);
           
            function listFrom2(){
              var thn= $('#thnfrm2').val(); 
              var shift =  $('#shiftpeg').val();
              var uri = BASE_URL+'abk/abk/listform2?year='+thn;
              if(empty(thn)){
                var d = new Date();
                var n = d.getFullYear();
                  thn = n;
              }

              if(!empty(shift)){
                  uri = BASE_URL+'abk/abk/listform2?year='+thn+'&id_shift='+shift;
              }

              $('#thnfrm2').val(thn);

            getJson(loadform2,uri);
          }

          function loadform2(result){
              if(result.hasil ==='success'){
                Gridform2.api.setRowData(result.result);
              }
          }

          listFrom2();

          function searchfrm2(){
            var thn=$('#thnfrm2').val();
            var uk=$('#txtdirektorat').val();
            var group = localStorage.getItem('group');
            var uri = BASE_URL+'abk/abk/listform2?year='+thn;
            var shift =  $('#shiftpeg').val();
             if(empty(thn)){
                    alert('Tahun harus dipilih');
                    return false;
                }

             if(!empty(shift)){
                  uri = BASE_URL+'abk/abk/listform2?year='+thn+'&id_shift='+shift;
              }

            getJson(loadform2,uri);
          }

          function downloadform2(){
    var params = { 
        fileName: 'form2',
        sheetName: 'form2'
    };

    Gridform2.api.exportDataAsExcel(params);
}
    
    </script>


<?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
    <script>
    function uploadform2(){
        bootbox.dialog({ 
                   message:$('<div></div>').load('view/abk/uploadxls_form2.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'medium',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-primary",
                           callback: function() {
                               
                               if(upload_file_form2()){
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

     function upload_file_form2(){
                var form = $("#form2-upload"); 
                var tahun = $('#thnfrm2add').val();
	if(empty(tahun)){
        alert('Tahun Wajib dipilih');
        return false;
    }else{

    
	$.ajax({
                            url: BASE_URL+"supplier/uploadform2", // Url to which the request is send 
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
                                                                                                                                       $('#thnfrm2').val(tahun);
                                                                                                                                     listFrom2();   
                                                                                                                     }else{
                                                                                                                            alert(message);
                                                                                                                          return false;	
                                                                                                                     }
                            }
                            });
	
	
	
                        }  
                
    }

    function editfrm2(){ 
    var rowData = [];
    Gridform2.api.forEachLeafNode( function(node) {
        rowData.push(node.data);
    });
    //console.log('Row Data:'); 
    save(BASE_URL+'abk/abk/editfrm2',rowData,listFrom1);
 
}


    </script>
    <?php }?>



 
   