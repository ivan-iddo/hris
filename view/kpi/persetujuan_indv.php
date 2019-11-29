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
          Persetujuan KPI Individu
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
                  <label class="col-sm-2 control-label" for="inputstatus">Bulan</label>
                  <div class="col-sm-3">
                    <select class="form-control select2" id="bulan" name="bulan" style="width: 100%;">
                      <option value="">Bulan</option>
                      <?php for($i=1;$i<=12;$i++){?>
                        <option value="<?php echo $i?>"><?php echo $i?></option>
                      <?php }?>
                    </select> 
                  </div>
                  
                </div> 
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
         <div class="col-sm-8 table-toolbar-left">  		
		<?php if(($_SESSION['data']['_pnc_id_jab']=='1345') OR ($_SESSION['data']['_pnc_id_jab']=='2553')OR ($_SESSION['data']['_pnc_id_jab']=='3')OR ($_SESSION['data']['_pnc_id_jab']=='2663')OR ($_SESSION['data']['_pnc_id_jab']=='2642')){?>
          <button style="margin-left:3px" class="btn btn-success" onclick="proses('2')"><i class="fa fa-file-excel-o"></i> Setujui Permohonan</button>
          <button style="margin-left:3px" class="btn btn-danger" onclick="proses('3')"><i class="fa fa-file-excel-o"></i> Tolak</button>
          <button style="margin-left:3px" class="btn btn-primary" onclick="filters()"><i class="fa fa-file-excel-o"></i> Filter iki 1</button>
          <button style="margin-left:3px" class="btn btn-danger" onclick="reset()"><i class="fa fa-file-excel-o"></i> Reset</button> 
		  <?php }else{?>
		   <button style="margin-left:3px" class="btn btn-primary" onclick="update()"><i class="fa fa-file-excel-o"></i> Simpan</button>
		  <button style="margin-left:3px" class="btn btn-warning" onclick="proses('1')"><i class="fa fa-file-excel-o"></i> Perbaikan </button>		  
		  <button class="btn btn-default"  onCLick="downloadindv();return false;"><i class="fa fa-file-excel-o"></i> Download Excel</button>
		 <?php }?>
        </div>
     </div>
   </div>
   
   <div class="ag-theme-balham" id="gridTK" style="height: 300px;width:100%;">
   </div>
 </div> 
</div>
</div>
</div>
<?php if(($_SESSION['data']['_pnc_id_jab']=='1345') OR ($_SESSION['data']['_pnc_id_jab']=='2553')OR ($_SESSION['data']['_pnc_id_jab']=='3')OR ($_SESSION['data']['_pnc_id_jab']=='2663')OR ($_SESSION['data']['_pnc_id_jab']=='2642')){?>
<?php }else{?><div class="row">
	<div class="col-sm-8 table-toolbar-left">
		<button style="margin-left:3px" class="btn btn-mint" onclick="getRowData()"><i class="fa fa-file-excel-o"></i> Simpan Perubahan</button>
   <button class="btn btn-success" onclick="get()"><i class="fa fa-file-excel-o"></i> Selesai kirim ke SDM</button>                                                   				                     
   <button class="btn btn-danger" onclick="hapus()"><i class="fa fa-file-excel-o"></i> Delete</button>                                                   				                     
 </div>
 <div class="col-sm-4 table-toolbar-right">
  <div class="btn-group">
    <button class="btn btn-default"  onCLick="downloadKPI()"><i class="fa fa-file-excel-o"></i> Download Excel</button>
  </div>
</div>
</div>
<div id="myGrid"  style="width:100%;height: 900px;" class="ag-theme-balham"></div> 
<?php }?>
<script>
	$('.select-chosen').chosen();
    $('.chosen-container').css({"width": "100%"});
    getOptions("txtdirektorat",BASE_URL+"master/direktoratSub");
  $('.judul-menu').html('Persetujuan KPI Individu'); 
  
  var headerTK = [
  {headerName: "No", field: "no", width: 60,  headerCheckboxSelection: true, checkboxSelection: true},
  {headerName: "No.Pegawai", field: "nopeg", width: 90, filterParams:{newRowsAction: "keep"}},
  {headerName: "Nama Pegawai", field: "nama", width: 160, filterParams:{newRowsAction: "keep"}},
  {headerName: "Unit Kerja", field: "unit", width: 190, filterParams:{newRowsAction: "keep"}},
  {headerName: "Nilai IKI", field: "nilai", width: 90, filterParams:{newRowsAction: "keep"}},
  {headerName: "Nilai IKI Awal", field: "nilai_awal", width: 130, filterParams:{newRowsAction: "keep"}},
  {headerName: "Nilai IKU", field: "iku", width: 90, filterParams:{newRowsAction: "keep"}},
  {headerName: "Status", field: "status", width: 120, cellRenderer: CellRenderer},
  {headerName: "Keterangan", field: "ket", width: 120, editable:true},
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
     enableColResize: true, 
     onRowClicked: bukaPI,
     rowSelection: 'multiple',
     rowGroupPanelShow: 'always',
     onRowDoubleClicked: getkpi,
     pivotPanelShow: 'always',
     enableRangeSelection: true,
     columnDefs: headerTK,
     pagination: true,
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
    
    function getkpi(){
      var selectedRows = gridTK.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
             onMessage('Silahkan Pilih Unit kerja Terlebih dahulu!');
             return false;
           }else{
            var selectedRowsString = '';
            var nilai = '';
            var nilai_awal = '';
            selectedRows.forEach( function(selectedRow, index) {
              
             if (index!==0) {
               selectedRowsString += ', ';
             }
             selectedRowsString += selectedRow.id;
             nilai += selectedRow.nilai;
             nilai_awal += selectedRow.nilai_awal;
           });

            bootbox.dialog({ 
             message:$('<div></div>').load('view/kpi/listkpi.php?id=5&awal='+nilai_awal+'&akhir='+nilai+'&pid='+selectedRowsString),
             animateIn: 'bounceIn',
             animateOut : 'bounceOut',
             backdrop: false,
             size:'large',
             buttons: {
              

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
        
        function listFromtk(){
          var thn= $('#thn').val(); 
          var uk =  $('#txtdirektorat').val();
          var uri = BASE_URL+'kpi/mpenilaian/listiki?tahun='+thn+'&status=5';
          if(empty(thn)){
           var d = new Date();
           var n = d.getFullYear();
           thn = n;
         }
         
         if(!empty(thn)){
           uri = BASE_URL+'kpi/mpenilaian/listiki?tahun='+thn+'&id_uk='+uk+'&status=5';
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
      
      function filters() {
        gridTK.api.setFilterModel({nilai: ['1.0']});
      }
      function reset() {
        gridTK.api.setFilterModel(null);
      }
      function searchtk(){
        var thn=$('#thn').val();
        var bulan=$('#bulan').val();
        var uk=$('#txtdirektorat').val();
        var group = localStorage.getItem('group');
        var uri = BASE_URL+'kpi/mpenilaian/listiki?bulan='+bulan+'&tahun='+thn+'&id_uk='+uk+'&status=5'; 
        if(empty(thn)){
          onMessage('Tahun harus dipilih');
          return false;
        }
        
        
        
        getJson(loadfrmtk,uri);
      }
      
      function downloadindv(){
        var params = { 
         fileName: 'KPI Individu',
         sheetName: 'KPI Individu'
       };
       
       gridTK.api.exportDataAsExcel(params);
     }
     function getRowData() {
      var rowData = [];
      gridOptions.api.forEachLeafNode( function(node) {
        rowData.push(node.data);
      });
    //console.log('Row Data:'); 
    save(BASE_URL+'kpi/mpenilaian/savedetail',rowData,tektok);
  }
  
  function update() {
    var rowData = [];
    gridTK.api.forEachLeafNode( function(node) {
      rowData.push(node.data);
    });
    //console.log('Row Data:'); 
    save(BASE_URL+'kpi/mpenilaian/editproses',rowData,tektok);
  }
  
  function tektok(){
    var selectedRows = gridTK.api.getSelectedRows();
    var selectedRowsString = '';
    selectedRows.forEach( function(selectedRow, index) {
      
     if (index!==0) {
       selectedRowsString += ', ';
     }
     selectedRowsString += selectedRow.id; 
   });
    
    getJson(prosesData,BASE_URL+'kpi/mpenilaian/getitemkpi?id=5&pid='+selectedRowsString);
  }
  
  function bukaPI(){
    var selectedRows = gridTK.api.getSelectedRows();
    var nip='';
    var nama_pegawai='';
    var awal ='';
    var akhir ='';
    var id_pi='';
    var id_user='';
    var id_uk='';
    var nama_group=''

            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
             onMessage('Silahkan Pilih Pegawai Terlebih dahulu!');
             return false;
           }else{
            var selectedRowsString = '';
            selectedRows.forEach( function(selectedRow, index) {
              
             if (index!==0) {
               selectedRowsString += ', ';
             }
             selectedRowsString += selectedRow.id;
             nip += selectedRow.nip;
             nama_pegawai += selectedRow.nama;
             awal += selectedRow.awal;
             akhir += selectedRow.akhir;
             id_uk += selectedRow.id_uk;
             id_user += selectedRow.id_user;
             nama_group += selectedRow.nama_group;
           });
          }
          $('#id_pi').val(selectedRowsString);
          $('#nama_pegawai').val(nama_pegawai);
          $('#nip').val(nip);
          $('#awal').val(awal);
          $('#akhir').val(akhir); 
          $('#simpan').hide(); 
          $('.buttoenedit').show(); 
          $('#id_grup').val(id_uk);
          $('#id_user').val(id_user);
          $('#uk').val(nama_group);
          
          getJson(prosesData,BASE_URL+'kpi/mpenilaian/getitemkpi?id=5&pid='+selectedRowsString);
        }

        function prosesDataPI(result){
          gridPI.api.setRowData(result.result);
        } 

        function loadDataPI(jml){
          var search = 0;
          var group = localStorage.getItem("group");
          var url = BASE_URL + 'kpi/mpenilaian/listpi/5/' + search + '/' + jml;
          
          if($('#search').val() !==''){
            search = $('#search').val();
            url = BASE_URL + 'kpi/mpenilaian/listpi/5/' + search + '/' + jml;
          }
          
          if ((group !== '1') && (group !== '6')) {
            url = BASE_URL + 'kpi/mpenilaian/listpi/5/' + search + '/' + jml + "/" + group;
          }
          getJson(prosesDataPI,url);
        }

        loadDataPI(0);
        
        var columnDefs = [ 
        {headerName: 'Parameter', field: 'n', width: 100,editable:false},
        {headerName: 'Indek Kinerja', field: 'nama', width: 160,},
        {headerName: 'Bobot (%)', field: 'no', width: 160,},
        {headerName: 'Target Kinerja', field: 'target_kinerja', width: 120},
        {headerName: 'Capaian', field: 'capaian', width: 120},
        {headerName: 'Capaian (%)', field: 'capaian_persen', width: 120},
        {headerName: 'Nilai', field: 'nilai', width: 120},
        {headerName: 'Bobot x Nilai', field: 'nilai_bobot', width: 120, editable:false,},
        {headerName: 'Keterangan', field: 'keterangan', width: 120},
        {headerName: 'pid', field: 'pid',  hide:true},
        {headerName: 'child', field: 'child',  hide:true},
        {headerName: 'max', field: 'max',  hide:true},

        ];

        var gridOptions = {
          enableSorting: true,
          enableFilter: true,
          suppressRowClickSelection: false, 
          groupDefaultExpanded: 2,
          groupSelectsChildren: true,
          debug: true,
          rowSelection: 'single',
          enableColResize: true,
          pivotPanelShow: 'always',
          enableRangeSelection: true,
          columnDefs: columnDefs,
          pagination: false,
          defaultColDef: {
            editable: true
          },
          onGridReady: function (params) {
            params.api.sizeColumnsToFit();
          },
          onCellEditingStarted: function(event) {
            console.log('cellEditingStarted');
          },
          onCellEditingStopped: function(event) {
            console.log('cellEditingStopped');
          }
        };

        
        function get() {
          var rowData = [];
          gridOptions.api.forEachLeafNode( function(node) {
            rowData.push(node.data);
          });
    //console.log('Row Data:'); 
    save(BASE_URL+'kpi/mpenilaian/saveikubaru/',rowData,listFromtk);
  }

  var gridDiv = document.querySelector('#myGrid');
  new agGrid.Grid(gridDiv, gridOptions);

  function prosesData(result){
   gridOptions.api.setRowData(result);
 } 

 function loadData(){
   getJson(prosesData,BASE_URL+'kpi/mpenilaian/getitemkpi?child=5&id=5&pid=0');
 }

 loadData();

 function hapus(){
  var selectedRows = gridOptions.api.getSelectedRows();
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
             selectedRowsString += selectedRow.id_kpi_d;
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
                   
                  getJson(tektok,BASE_URL+'kpi/mpenilaian/hapus?id='+selectedRowsString,tektok);
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
        function CellRenderer (params){
          var closeSpan = document.createElement("span");
          if(params.value ==='Ditolak'){
            closeSpan.setAttribute("class","badge badge-danger");
            closeSpan.textContent = "Ditolak";
          }else if(params.value ==='Disetujui'){
           closeSpan.setAttribute("class","badge badge-success");
           closeSpan.textContent = "Disetujui";
         }else if(params.value ==='Belum Disetujui'){
           closeSpan.setAttribute("class","badge badge-light");
           closeSpan.textContent = "Belum Disetujui";
         }else if(params.value ==='Baru'){
           closeSpan.setAttribute("class","badge badge-info");
           closeSpan.textContent = "Baru";
         }
         return closeSpan;
       }
       

       function detailaction(){
        var iddettk = $('#iddettk').val();	
      }
      
      function proses(a){
        var selectedRows = gridTK.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
             onMessage('Silahkan Pilih Data di Tabel Pegawai Terlebih dahulu!');
             return false;
           }else{
            var selectedRowsString = '';
            selectedRows.forEach( function(selectedRow, index) {
              
             if (index!==0) {
               selectedRowsString += ', ';
             }
             selectedRowsString += selectedRow.id;
           });
            submit_get(BASE_URL+'kpi/mpenilaian/updateiki/?id='+selectedRowsString+'&type='+a,listFromtk);
          }
        }
      </script>