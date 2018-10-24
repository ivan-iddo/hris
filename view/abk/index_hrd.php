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
                          Persetujuan Penambahan SDM
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
					                     <button style="margin-left:3px" class="btn btn-success" onclick="proses('85')"><i class="fa fa-file-excel-o"></i> Setujui & Kirim ke Direktur</button>
                                         <button style="margin-left:3px" class="btn btn-danger" onclick="tolak()"><i class="fa fa-file-excel-o"></i> Tolak & Beri Arahan</button>
                                       
                                                      
					                     
					                </div>
					                <div class="col-sm-6 table-toolbar-right">
					                   
					                    <div class="btn-group">
                                        <button class="btn btn-default btn-sm" style="border-radius:0px !important" onClick="adddetail();return false;"><i class="fa fa fa-archive"></i> Detail Pengajuan</button>
                                        <button class="btn btn-default btn-sm" style="border-radius:0px !important" onClick="alasan();return false;"><i class="fa fa fa-bullhorn"></i> Alasan Permintaan</button>
                                        <button class="btn btn-default btn-sm" style="border-radius:0px !important" onClick="posisi();return false;"><i class="fa fa fa-sitemap"></i> Posisi Dalam Struktur</button>
					                  </div>
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
  var headerTK = [{headerName: "No", field: "no", width: 90, filterParams:{newRowsAction: "keep"}},
  {headerName: "Status", field: "status", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Tahun", field: "tahun", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Unit Kerja", field: "id_uk", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Kebutuhan SDM", field: "kategori_sdm", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Pendidikan", field: "pendidikan", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Jurusan 1", field: "jurusan_1", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Jurusan 2", field: "jrusan_2", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Jurusan 3", field: "jrusan_3", width: 190, filterParams:{newRowsAction: "keep"}},

{headerName: "Pengalaman Kerja", field: "pengalaman", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Keahlian Komputer", field: "kompi", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Komputer level", field: "kompi_lvl", width: 190, filterParams:{newRowsAction: "keep"}},

{headerName: "Gender", field: "kelamin", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "max usia", field: "max_usia", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "min usia", field: "min_usia", width: 190, filterParams:{newRowsAction: "keep"}},

{headerName: "Bahasa Inggris", field: "bahasa", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Bahasa level", field: "bahasa_level", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Tinggi b min (Cm)", field: "tinggi_b_min", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Tinggi b max (Cm)", field: "tinggi_b_max", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Berat b min (Cm)", field: "berat_b_min", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Berat b max (Cm)", field: "berat_b_max", width: 190, filterParams:{newRowsAction: "keep"}},

{headerName: "buta warna", field: "buta_warna", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "kacamata", field: "kacamata", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Keterbatasan Fisik", field: "fisik_lain", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "Keterbatasan Fisik detail", field: "fisik_lain_detail", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "kompetensi", field: "kompetensi", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "syarat khusus", field: "syarat_khusus", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "test khusus", field: "test_khusus", width: 190, filterParams:{newRowsAction: "keep"}},
{headerName: "lain lain", field: "lain_lain", width: 190, filterParams:{newRowsAction: "keep"}},
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
			   var uri = BASE_URL+'abk/abk/listtkdireksi?year='+thn+'&status=84';
			   if(empty(thn)){
				 var d = new Date();
				 var n = d.getFullYear();
				   thn = n;
			   }
 
			   if(!empty(thn)){
				   uri = BASE_URL+'abk/abk/listtkdireksi?year='+thn+'&id_uk='+uk+'&status=84';
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
			 var uri = BASE_URL+'abk/abk/listtkdireksi?year='+thn+'&id_uk='+uk+'&status=84'; 
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
 

  function addKualifikasi(){
      gopop('view/abk/add_form_kulifikasi.php',add,'large');
  }

  function adddetail(){
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
           gopop('view/abk/form_detail_pengajuan_direksi.php',detailaction,'medium');
           
            }
     
  }

  function tolak(){
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
           gopopOnly('view/abk/form_detail_pengajuan_tolak.php',detailaction,'large');
           
            }
     
  }

  function alasan(){
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
           gopop('view/abk/form_detail_alasan_direksi.php',alasanaction,'large');
           
            }
     
  }

  function alasanaction(){
    var id_alasan = $('#id_alasan').val();
    if(empty(id_alasan)){



        postForm('form-detail-alasan',BASE_URL+"abk/abk/simpandetaialasan",nowhere);
    }else{
        postForm('form-detail-alasan',BASE_URL+"abk/abk/editdetaialasan",nowhere);
    }

  }

  function detailaction(){

if(empty($('#id_uk_det').val())){
onMessage('Rencana penempatan is required');
return false;
}else if(empty($('#gaji').val())){
onMessage('Estimasi Gaji Pasar is required');
return false;
}else if(empty($('#id_kp').val())){
onMessage('Kelompok Profesi is required');
return false;
}else if(empty($('#jml_saatini').val())){
onMessage('Jml yang ada saat in is required');
return false;
}else if(empty($('#kebutuhan_sesuai_abk').val())){
onMessage('Kebutuhan sesuai ABK is required');
return false;
}else if(empty($('#idtk').val())){
onMessage('Data is required');
return false;
}else if(empty($('#jumlah').val())){
onMessage('Jumlah is required');
return false;
}else if(Number($('#jumlah').val()) > Number($('#kebutuhan_sesuai_abk').val())){
    onMessage('Jumlah yang anda ajukan lebih besar dari jumlah perhitungan ABK');
return false;

}else {
    var iddettk = $('#iddettk').val();
    if(empty(iddettk)){
        postForm('form-detail-pengajuan',BASE_URL+"abk/abk/simpandetaipengajuan",nowhere);
    }else{
        postForm('form-detail-pengajuan',BASE_URL+"abk/abk/editdetaipengajuan",nowhere);
    }
    
}

}

function nowhere(){
    return true;
}

  function add(){
if(empty($('#thnadd').val())){
onMessage('Data Tahun tidak boleh kosong');
return false;
}else if(empty($('#katsdmfrm4').val())){
onMessage('Kategori SDM harus dipilih');
return false;
}else if(empty($('#f_kelamin').val())){
onMessage('Data Gender tidak boleh kosong');
return false;
}else if(empty($('#pendidikan').val())){
onMessage('Pendidikan boleh kosong');
return false;
}else if(empty($('#kompi').val())){
onMessage('Pilih Keterampilan Komputer');
return false;
}else if(empty($('#f_level_kompi').val())){
onMessage('Level komputer harus dipilih');
return false;
}else if(empty($('#bahasa').val())){
onMessage('Bahasa Asing wajib dipilih');
return false;
}else if(empty($('#f_level_bahasa').val())){
onMessage('Level Bahasa Wajib dipilih');
return false;
}else if(empty($('#pengalaman').val())){
onMessage('Pengalaman kerja wajib dipilih');
return false;
}else  {
    postForm('form-penajuan',BASE_URL+"abk/abk/addnewpengajuan",gethasil);
}
   
  }

  function gethasil(){
      var thn = $('#thnadd').val();
      var uk = $('#adduk').val();
      var uri = BASE_URL+'abk/abk/listtkdireksi?year='+thn+'&status=84';
			   if(empty(thn)){
				 var d = new Date();
				 var n = d.getFullYear();
				   thn = n;
			   }
 
			   if(!empty(thn)){
				   uri = BASE_URL+'abk/abk/listtkdireksi?year='+thn+'&id_uk='+uk+'&status=84';
			   }
 
			   $('#thn').val(thn);
 
			 getJson(loadfrmtk,uri);
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

          submit_get(BASE_URL+'abk/abk/updatetk/?id='+selectedRowsString+'&type='+a,listFromtk);

           
           
            }
  }

  function editaction(){
    if(empty($('#thnadd').val())){
onMessage('Data Tahun tidak boleh kosong');
return false;
}else if(empty($('#katsdmfrm4').val())){
onMessage('Kategori SDM harus dipilih');
return false;
}else if(empty($('#f_kelamin').val())){
onMessage('Data Gender tidak boleh kosong');
return false;
}else if(empty($('#pendidikan').val())){
onMessage('Pendidikan boleh kosong');
return false;
}else if(empty($('#kompi').val())){
onMessage('Pilih Keterampilan Komputer');
return false;
}else if(empty($('#f_level_kompi').val())){
onMessage('Level komputer harus dipilih');
return false;
}else if(empty($('#bahasa').val())){
onMessage('Bahasa Asing wajib dipilih');
return false;
}else if(empty($('#f_level_bahasa').val())){
onMessage('Level Bahasa Wajib dipilih');
return false;
}else if(empty($('#pengalaman').val())){
onMessage('Pengalaman kerja wajib dipilih');
return false;
}else  {
   
    postForm('form-penajuan',BASE_URL+"abk/abk/edittk",gethasil);
}
   
  }

  function hapustk(){
             var selectedRows = gridTK.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih data Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
           });
           submit_get(BASE_URL+'abk/abk/deletetk/?id='+selectedRowsString,listFromtk);
           
           
            }
           }

           function posisi(){
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
           gopop('view/abk/form_detail_posisi.php',posisiaction,'large');
           
            }
     
  }

  function posisiaction(){
    var id_alasan = $('#id_posisi').val();
    if(empty(id_alasan)){
        postForm('form-detail-posisi',BASE_URL+"abk/abk/simpanposisi",nowhere);
    }else{
        postForm('form-detail-posisi',BASE_URL+"abk/abk/editposisi",nowhere);
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
																			
  
       
   
         
   
  