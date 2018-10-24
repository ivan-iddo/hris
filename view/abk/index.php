
<div class="row">
	
    <div class="tab-base mar-all">
      <!--Nav Tabs-->
  
      <ul class="nav nav-tabs">
        <li class="active">
                  <a href="#demo-lft-tab-1" data-toggle="tab">
                          <span class="block text-center">
                              <i class="fa fa-street-view fa-2x text-danger"></i> 
                          </span>
                          Form 1
                      </a>
              </li>
  
        <li >
                  <a href="#demo-lft-tab-2" data-toggle="tab" onClick="$('#page-sp').load('view/abk/index_sp.php')">
                          <span class="block text-center">
                              <i class="fa fa-repeat fa-2x text-danger"></i> 
                          </span>
                          Form 2
                      </a> 
              </li>
  
        <li> 
              <a href="#demo-lft-tab-3" data-toggle="tab" onClick="$('#page-ut').load('view/abk/index_ut.php')">
                          <span class="block text-center">
                              <i class="fa fa-list fa-2x text-danger"></i> 
                          </span>
                          Form 3 & 4
                      </a> 
              </li>
              <li>
                  <a href="#demo-lft-tab-lk" data-toggle="tab" onClick="$('#page-lk').load('view/abk/index_lk.php')">
                          <span class="block text-center">
                              <i class="fa fa-universal-access fa-2x text-danger"></i> 
                          </span>
                          Form 5
                      </a>
              </li>
   
  
        <li> 
              <a href="#demo-lft-tab-kebut" data-toggle="tab" onClick="$('#page-kebut').load('view/abk/index_kebut.php')">
                          <span class="block text-center">
                              <i class="fa fa-users fa-2x text-danger"></i> 
                          </span>
                          Form 6
                      </a> 
              </li>
      </ul>
  
      <div class="tab-content">
        <div class="tab-pane fade active in" id="demo-lft-tab-1">
         
            <div class="row"> 
                    <div class="col-md-6"> 
                            <div class="box box-primary"> 
                                <div class="box-body">
                                <div class="row pad-top"> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="inputstatus">Kode Unit kerja:</label>
                                            <div class="col-sm-3">
                                            <span id="unitkerjakode" class="text-2x text-semibold text-main">75.9</span>
                                                  
                                            </div>
                                           
                                    </div> 
                                    </div>
                                <div class="row pad-top"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Tahun</label>
                                            <div class="col-sm-3">
                                                    <select class="form-control select2" id="thn" name="thn" style="width: 100%;">
                                                    <option value="">--TAHUN--</option>
                                                     <?php for($i=2010;$i<= date('Y');$i++){?>
                                                        <option value="<?php echo $i?>"><?php echo $i?></option>
                                                        <?php }?>
                                                    </select> 
                                            </div>
                                           
                                    </div> 
                                    </div>
                                    <div class="admininput">
                                    <div class="row pad-top"> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus">Unit Kerja</label>
                                            <div class="col-sm-9">
                                                    <select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">
                                                     
                                                      
                                                    </select> 
                                            </div>
                                           
                                    </div>
                                    </div>
                                     
                                    
                                                     </div>
                                    
          
                                    <div class="row "> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="inputstatus"></label>
                                            <div class="col-sm-5">
                                             
                                            <div class="row  text-left"> 
                                    <button class="btn btn-primary mar-all" onClick="searchfrm1();return false;">Search</button> 
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
					                    <button id="demo-btn-addrow" class="btn btn-purple" onclick="addnewfrm1()"><i class="demo-pli-add"></i> Tambah Kebutuhan SDM</button>
                                        <button style="margin-left:3px" class="btn btn-mint" onclick="editfrm1()"><i class="fa fa-file-excel-o"></i> Update</button>
                                        <button class="btn btn-danger" onclick="hapusform1()"><i class="fa fa-file-excel-o"></i> Delete</button>
                                                      
					                     
					                </div>
					                <div class="col-sm-6 table-toolbar-right">
					                   
					                    <div class="btn-group">
                                        <button class="btn btn-default" style="border-radius:0px !important" onClick="uploadxls();return false;"><i class="fa fa-file-excel-o"></i> Import dari Excel</button>
					               
                                        <button class="btn btn-default"  onCLick="downloadform1();return false;"><i class="fa fa-file-excel-o"></i> Download Excel</button>
					                    </div>
					                </div>
					            </div>
					        </div>
                                            
            <div class="ag-theme-balham" id="Gridform1" style="height: 900px;width:100%;">
        </div>
        </div>
  
        <div class="tab-pane fade " id="demo-lft-tab-2" >
          <div id="page-sp"></div>
        </div> 
 
       
 
      
  
        <div class="tab-pane fade" id="demo-lft-tab-3">
        <div id="page-ut"></div>
        </div>

         <div class="tab-pane fade" id="demo-lft-tab-lk">
        <div id="page-lk"></div>
        </div>
        <div class="tab-pane fade" id="demo-lft-tab-kebut">
        <div id="page-kebut"></div>
        </div>
      </div>
    </div>
      
      
  </div>
  
       
  
      
      <script charset="utf-8" type="text/javascript">
          $('.judul-menu').html('Analisa Beban Kerja'); 
          $('.import').hide();
          $('.select-chosen').chosen();
          $('.chosen-container').css({"width": "100%"});
         
          var group = localStorage.getItem('group');

    function downloadform1(){
    var params = { 
        fileName: 'form1',
        sheetName: 'form1'
    };

    Gridform1.api.exportDataAsExcel(params);
}

function editfrm1(){ 
    var rowData = [];
    Gridform1.api.forEachLeafNode( function(node) {
        rowData.push(node.data);
    });
    //console.log('Row Data:'); 
    save(BASE_URL+'abk/abk/editfrm1',rowData,listFrom1);
 
}

         
     if((group ==='1') || (group ==='6')){
        getOptions("txtdirektorat",BASE_URL+"master/direktoratSub");
        $('.admininput').show();
     }else{
         $('#unitkerjakode').html(group); 
        
         $('.admininput').hide();
     }

     function hapusform1(){
        var selectedRows = Gridform1.api.getSelectedRows();
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
                               
                            getJson(listFrom1,BASE_URL+'abk/abk/hapusfrm1?id='+selectedRowsString);
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

     function uploadxls(){
        bootbox.dialog({ 
                   message:$('<div></div>').load('view/abk/uploadxls.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'medium',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-primary",
                           callback: function() {
                               
                               if(upload_file()){
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


      function addnewfrm1(){
        bootbox.dialog({ 
                   message:$('<div></div>').load('view/abk/add_from1.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'medium',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-primary",
                           callback: function() {
                               
                               if(frm1addnew()){
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

     function frm1addnew(){
         if(empty($('#thnadd').val())){
             alert('Tahun wajib dipilih');
             return false;
         }else{
            postForm('form1-addnew',BASE_URL+"abk/abk/addnewfrm1",listFrom1);
         }
       
     }

     function upload_file(){
                var form = $("#form1-upload"); 
	
	$.ajax({
                            url: BASE_URL+"supplier/uploadform1", // Url to which the request is send 
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

                                                                                                                                     listFrom1();   
                                                                                                                     }else{
                                                                                                                            alert(message);
                                                                                                                          return false;	
                                                                                                                     }
                            }
                            });
	
	
	
                             
                
    }
         
 

         
 

          function onAddRow() {
    var newItem = createNewRowData();
    var res = Gridform1.api.updateRowData({add: [newItem]});
   
}

function createNewRowData() {
    var newData = {
        no: '',
        unit_kerja: '',
        kategori_sdm: '',
        slta: '',
        d3: '',
        s1: '',
        s2:''
    };

    return newData;
}


          var headerForm1 = [
           {headerName: "No.", field: "no", width: 80, filterParams:{newRowsAction: 'keep'}},
		   {headerName: "Unit Kerja", field: "unit_kerja", width: 190,editable:false, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Kategori SDM", field: "kategori_sdm",editable:false, width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "SLTA", field: "slta", width: 80, filterParams:{newRowsAction: 'keep'}},
           {headerName: "D-III", field: "d3", width: 80, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "S1", field: "s1", width: 80, filterParams:{newRowsAction: 'keep'}},
           {headerName: "S2", field: "s2", width: 80, filterParams:{newRowsAction: 'keep'}},
           {
        headerName: 'Jumlah',
        field: 'total',
        valueGetter: 'Number(data.slta) + Number(data.d3) + Number(data.s1)+ Number(data.s2)',
        width: 200
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

        var Gridform1 = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false, 
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single', 
    enableColResize: true,
    onFirstDataRendered: onFirstDataRendered,
           rowGroupPanelShow: 'always',
           pivotPanelShow: 'always',
           enableRangeSelection: true,
           columnDefs: headerForm1,
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

        function onFirstDataRendered(params) {
    params.api.sizeColumnsToFit();
}

        // setup the grid after the page has finished loading 
           var gridDiv = document.querySelector('#Gridform1');
           new agGrid.Grid(gridDiv, Gridform1);

            function listFrom1(){
              var thn=$('#thn').val();
              var uk=$('#txtdirektorat').val();
              if(empty(thn)){
                var d = new Date();
                var n = d.getFullYear();
                  thn = n;
              }

              

            getJson(loadForm1,BASE_URL+'abk/abk/listForm1?year='+thn+'&uk='+uk);
          }

          function loadForm1(result){
              if(result.hasil ==='success'){
                Gridform1.api.setRowData(result.result);
              }
          }

          listFrom1();

          function searchfrm1(){
            var thn=$('#thn').val();
            var uk=$('#txtdirektorat').val();
            var group = localStorage.getItem('group');

             if(empty(thn)){
                    alert('Tahun harus dipilih');
                    return false;
                }

            if((group ==='1') || (group ==='6')){
                if(empty(uk)){
                    alert('Unit kerja harus dipilih');
                    return false;
                }
            }

            getJson(loadForm1,BASE_URL+'abk/abk/listForm1?year='+thn+'&uk='+uk);
          }
  
    </script><script src="js/login.js" type="text/javascript">
  </script>
   
  