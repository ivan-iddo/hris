<?php session_start()?>
 
            <div class="row"> 
                    <div class="col-md-9"> 
                            <div class="box box-primary"> 
                                <div class="box-body">
                                <div class="row pad-top"> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="inputstatus">Tahun</label>
                                            <div class="col-sm-4">
                                                    <select class="form-control select2" id="thnfrm6" name="thnfrm6" style="width: 100%;" >
                                                    <option value="">--TAHUN--</option>
                                                     <?php for($i=date('Y')+9;$i>=date('Y')-1;$i--){?>
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
                                                    <select class="form-control select-chosen" id="ukfrm6" name="ukfrm6" style="width: 100%;">
                                                     
                                                      
                                                    </select> 
                                            </div>
                                           
                                    </div>
                                    </div>
                                     
                                    
                                                     </div>
                                    <?php } ?>
                                    
                                    <div class="row "> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="inputstatus"></label>
                                            <div class="col-sm-6">
                                             
                                            <div class="row  text-left">  <button class="btn btn-primary mar-all" onClick="searchForm5();return false;">Search</button> 
                                  
                                   </div>
                                            </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
            </div> 
            
      

         <div class="pad-btm form-inline" style="border-top:1px solid #dedede;padding:10px">
					           
					        </div>
                                      <h4>Kebutuhan SDM (Shift)</h4>      
            <div class="ag-theme-balham" id="gridShift" style="height: 300px;width:100%;">
            
        </div>
        <div class="row pad-all">
        <h4>Kebutuhan SDM (Non-Shift)</h4>  
        <div class="ag-theme-balham" id="gridnonShift" style="height: 300px;width:100%;">  
        </div>

        
    <script>
      var headerShift = [ 
		   {headerName: "Kategori SDM", field: "kategori_sdm", width: 100,editable:false, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Beban Kerja/Thn", field: "beban",editable:false, width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Waktu Tersdia/Thn", field: "waktu", width: 80, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Sub Kebutuhan SDM", field: "subSDM", width: 80, filterParams:{newRowsAction: 'keep'}},
           {headerName: "SKK", field: "skk", width: 80, filterParams:{newRowsAction: 'keep'}},
           {headerName: "SKI", field: "ski", width: 80, filterParams:{newRowsAction: 'keep'}} ,
           {headerName: "Kebutuhan SDM", field: "sdm", width: 80, filterParams:{newRowsAction: 'keep'}}  
           
        ];

        var gridShift = {
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
           columnDefs: headerShift,
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

          var gridDiv = document.querySelector('#gridShift');
           new agGrid.Grid(gridDiv, gridShift);

           
           function listShift(){
              var thn=$('#thnfrm6').val();
              var uk=$('#txtdirektorat').val();
              if(empty(thn)){
                var d = new Date();
                var n = d.getFullYear();
                  thn = n;
              }

              $('#thnfrm6').val(thn);

            getJson(loadShift,BASE_URL+'abk/abk/listshift?year='+thn+'&uk='+uk);
          }

          function loadShift(result){
            console.log("shift Result", result);
              if(result.hasil ==='success'){
                gridShift.api.setRowData(result.result);
              }
          }

          listShift();


          /** NON SHIFT */
          var headernonShift = [ 
		   {headerName: "Kategori SDM", field: "kategori_sdm", width: 100,editable:false, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Beban Kerja/Thn", field: "beban",editable:false, width: 100, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Waktu Tersdia/Thn", field: "waktu", width: 80, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Sub Kebutuhan SDM", field: "subSDM", width: 80, filterParams:{newRowsAction: 'keep'}},
           {headerName: "SKK", field: "skk", width: 80, filterParams:{newRowsAction: 'keep'}},
           {headerName: "SKI", field: "ski", width: 80, filterParams:{newRowsAction: 'keep'}} ,
           {headerName: "Kebutuhan SDM", field: "sdm", width: 80, filterParams:{newRowsAction: 'keep'}}  
           
        ];

        var gridnonShift = {
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
           columnDefs: headernonShift,
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

          var gridDiv = document.querySelector('#gridnonShift');
           new agGrid.Grid(gridDiv, gridnonShift);

           function listnonShift(){
              var thn=$('#thnfrm6').val();
              var uk=$('#txtdirektorat').val();
              if(empty(thn)){
                var d = new Date();
                var n = d.getFullYear();
                  thn = n;
              }

              $('#thnfrm6').val(thn);

            getJson(loadnonShift,BASE_URL+'abk/abk/listnonshift?year='+thn+'&uk='+uk);
          }

          function loadnonShift(result){
              console.log("nonShift Result", result);
              if(result.hasil ==='success'){
                gridnonShift.api.setRowData(result.result);
              }
          }

          listnonShift();

          function searchForm5(){
               var thn = $('#thnfrm6').val();
               var uk =  $('#ukfrm6').val();

               if(empty(thn)){
                onMessage('Pilih Tahun Terlebih dahulu!');
               return false;
               }else{
                getJson(loadShift,BASE_URL+'abk/abk/listshift?year='+thn+'&uk='+uk);
                getJson(loadnonShift,BASE_URL+'abk/abk/listnonshift?year='+thn+'&uk='+uk);
               }
          }

    </script> 

<?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
 <script>
    $('.select-chosen').chosen();
     $('.chosen-container').css({"width": "100%"});
 getOptions("ukfrm6",BASE_URL+"master/direktoratSub");
 </script>
 <?php } ?>
 
   