<?php session_start();?>
<div class="row">
	
    <div class="tab-base mar-all">
      <!--Nav Tabs-->
  
      <ul class="nav nav-tabs">
        <li class="active">
                  <a href="#demo-lft-tab-1" data-toggle="tab">
                          <span class="block text-center">
                              <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                          </span>
                          Persetujuan KPI Unit Kerja
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
                                        <label class="col-sm-2 control-label" for="inputstatus">Tahun</label>
                                            <div class="col-sm-3">
                                                    <select class="form-control select2" id="thn" name="thn" style="width: 100%;">
                                                    <option value="">--TAHUN--</option>
                                                      <?php for($i=date('Y');$i>=2010;$i--){?>
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
                                                    <select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">
                                                     
                                                      
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
                                    <button class="btn btn-primary mar-all" onClick="searchtk();return false;">Search</button> 
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
					                     <button style="margin-left:3px" class="btn btn-success" onclick="proses('2')"><i class="fa fa-file-excel-o"></i> Setujui Permohonan</button>
                                         <button style="margin-left:3px" class="btn btn-danger" onclick="tolak('3')"><i class="fa fa-file-excel-o"></i> Tolak</button>
                                       
                                                      
					                     
					                </div>
					            </div>
					        </div>
                                            
            <div class="ag-theme-balham" id="gridTK" style="height: 300px;width:100%;">
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
  <script>
  var headerTK = [
  {headerName: "No", field: "no", width: 60, filterParams:{newRowsAction: "keep"}},
  {headerName: "No.Pegawai", field: "nopeg", width: 90, filterParams:{newRowsAction: "keep"}},
  {headerName: "Nama Pegawai", field: "nama", width: 160, filterParams:{newRowsAction: "keep"}},
  {headerName: "Unit Kerja", field: "unit", width: 190, filterParams:{newRowsAction: "keep"}},
  {headerName: "Nilai IKI", field: "nilai", width: 190, filterParams:{newRowsAction: "keep"}},
  {headerName: "Status", field: "status", width: 120, filterParams:{newRowsAction: "keep"}},
  {headerName: "Bulan", field: "bulan", width: 90, filterParams:{newRowsAction: "keep"}},
  {headerName: "Tahun", field: "tahun", width: 90, filterParams:{newRowsAction: "keep"}},
]; 
		
		


		 var autoGroupColumnDef = {
			headerName: 'Group',
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
 
		 var gridTK = {
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
			columnDefs: headerTK,
			pagination: false,
			paginationPageSize: 50,   
			defaultColDef:{
				editable: false,
				enableRowGroup:true,
				enablePivot:true,
				enableValue:true
			} 
		 };
 
	   
 
		 // setup the grid after the page has finished loading 
			var gridDiv = document.querySelector('#gridTK');
			new agGrid.Grid(gridDiv,gridTK);
			
			 function listFromtk(){
			   var thn= $('#thn').val(); 
			   var uk =  $('#txtdirektorat').val();
			   var uri = BASE_URL+'kpi/mpenilaian/listiki?tahun='+thn+'&status=16';
			   if(empty(thn)){
				 var d = new Date();
				 var n = d.getFullYear();
				   thn = n;
			   }
 
			   if(!empty(thn)){
				   uri = BASE_URL+'kpi/mpenilaian/listiki?tahun='+thn+'&id_uk='+uk+'&status=16';
			   }
 
			   $('#thn').val(thn);
 
			 getJson(loadfrmtk,uri);
		   }
 
		   function loadfrmtk(result){
               if(!empty(result)){
			   if(result.hasil ==='success'){
                gridTK.api.setRowData(result.result);
			   }else{
                gridTK.api.setRowData([]);
               }
               }else{
                gridTK.api.setRowData([]);
               }
		   }
 
		   listFromtk();
 
		   function searchtk(){
			 var thn=$('#thn').val();
			 var uk=$('#txtdirektorat').val();
			 var group = localStorage.getItem('group');
			 var uri = BASE_URL+'kpi/mpenilaian/listiki?tahun='+thn+'&id_uk='+uk+'&status=16'; 
			  if(empty(thn)){
					 alert('Tahun harus dipilih');
					 return false;
				 }
 
		 
 
			 getJson(loadfrmtk,uri);
		   }
 
		   function downloadform2(){
	 var params = { 
		 fileName: 'form2',
		 sheetName: 'form2'
	 };
 
	 gridTK.api.exportDataAsExcel(params);
 }
 

  function tolak(a){
    var selectedRows = gridTK.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Data di Tabel Kebutuhan SDM Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
           }); 
           submit_get(BASE_URL+'kpi/mpenilaian/updateiki/?id='+selectedRowsString+'&type='+a);
           
            }
     
  }

  function proses(a){
    var selectedRows = gridTK.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Data di Tabel Kebutuhan SDM Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
           });

          submit_get(BASE_URL+'kpi/mpenilaian/updateiki/?id='+selectedRowsString+'&type='+a);

           
           
            }
  }
 
  </script>
<?php if(($_SESSION['userdata']['group']=='1') OR ($_SESSION['userdata']['group']=='6') ){?>
 <script>
    $('.select-chosen').chosen();
     $('.chosen-container').css({"width": "100%"});
 getOptions("txtdirektorat",BASE_URL+"master/direktoratSub");
 </script>
 <?php } ?> 