  
<div class="row">
  <div class="eq-height">
   <div class="col-sm-3 eq-box-sm ">
     
     <!--Basic Panel-->
     <!--===================================================-->
     <div class="panel pad-all">
       <div class="panel-body">
        <form class="form-horizontal  pad-all" name="form-pi" id="form-pi" method="post">
          <div class="row">
            <input style="display:none" type="text" id="id_jenis" name="id_jenis" value="5">
            <input  style="display:none" type="text" id="id_pi" name="id_pi">
            <input style="display:none" type="text" id="id_grup" name="id_grup">
            <input style="display:none" type="text" id="id_user" name="id_user">
            <input style="display:none" type="text" id="id_jab" name="id_jab">
            <div class="col-sm-4">
             <div class="form-group">
               <label class="control-label">NIP</label>

               <input disabled id="nip" name="nip" class="form-control" type="text" style="width:100px">
             </div>
           </div>
           <div class="col-sm-4">
             <div class="form-group">
               <label class="control-label">Nama Pimpinan Unit</label>
               <div class="input-group mar-btm">
                <input disabled style="width:150px" name="nama_pegawai" id="nama_pegawai" placeholder="Search" class="form-control" type="text">
                <span class="input-group-addon" onCLick="search()"><i class="fa fa-search"></i></span>
                
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-9">
           <div class="form-group">
             <label class="control-label">Unit Kerja </label>
             <input  id="uk" name="uk" class="form-control" type="text">
           </div>
         </div>
       </div>
       <div class="row">
         <div class="col-sm-5">
           <div class="form-group">
             <label class="control-label">Periode </label>
             <input  id="awal" name="awal" class="form-control" placeholder="dd-mm-yyyy" type="text">
           </div>
         </div>
         <div class="col-sm-5">
           <div class="form-group">
             <label class="control-label">Sampai</label>
             <div class="input-group mar-btm">
              <input  name="akhir" id="akhir" placeholder="dd-mm-yyyy" class="form-control" type="text">
              
            </div>
          </div>
        </div>
      </div>  
      <div class="row">
       <div class="col-sm-9 text-left">
         <a href="javascript:void(0)" class="btn btn-mint" id="simpan" name="simpan" type="submit" onClick="simpanPI();return false;">Save</a> 
       </div>
       <div class="col-sm-9 text-left buttoenedit">
         <a href="javascript:void(0)" class="btn btn-warning" id="edit" name="edit" type="submit" onClick="simpanPI();return false;">Edit</a> 
         <a href="javascript:void(0)" class="btn btn-mint" id="simpan" name="simpan" type="submit" onClick="$('#simpan').show('slow');$('.buttoenedit').hide('slow');document.getElementById('form-pi').reset(); return false;">Buat Baru</a> 
         
       </div>
     </div>
     
     
   </form>

 </div>
</div>
</div>
<!--===================================================-->
<!--End Basic Panel-->
<div class="col-sm-4 eq-box-sm">
 
  <!--Panel with Header-->
  <!--===================================================-->
  <div class="panel">
    <div class="panel-heading">
      <h3 class="panel-title">List Data Penilaian Kerja Staf</h3>
    </div>
    <div class="panel-body">
      <div class="dataTables_filter" id="demo-dt-addrow_filter" style="margin-right:5px">
        <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search" onkeydown="if(event.keyCode=='13'){loadDataPI(0);}" ></label>
        
      </div>
      <div id="gridPI"  style="width:100%;height: 300px;" class="ag-theme-balham"></div>
      <div class="paging pull-right mar-all"> 
      </div>
    </div>
  </div>
  <!--===================================================-->
  <!--End Panel with Header-->
  
</div>
</div>

</div>
<div class="row">
	<div class="col-sm-8 table-toolbar-left">
		<button id="demo-btn-addrow" class="btn btn-purple" onclick="onAddRow()"><i class="demo-pli-add"></i> Tambah Langkah Kerja</button>
		<button style="margin-left:3px" class="btn btn-mint" onclick="getRowData()"><i class="fa fa-file-excel-o"></i> Simpan Perubahan</button>
		<button class="btn btn-danger" onclick="hapus()"><i class="fa fa-file-excel-o"></i> Delete</button>                                                   				                     
		<button class="btn btn-success" onclick="get()"><i class="fa fa-file-excel-o"></i> Selesai kirim ke SDM</button>                                                   				                     
	</div>
	<div class="col-sm-4 table-toolbar-right">				                   
		<div class="btn-group">
      <button class="btn btn-default"  onCLick="downloadKPI()"><i class="fa fa-file-excel-o"></i> Download Excel</button>
    </div>
  </div>
</div><div id="myGrid"  style="width:100%;height: 900px;" class="ag-theme-balham"></div> 



<script> 
 $('.judul-menu').html('Penilaian Kerja Individu');
 $('.buttoenedit').hide();
 function downloadKPI(){
  var params = { 
    fileName: 'kpi',
    sheetName: 'kpisheet'
  };

  gridOptions.api.exportDataAsExcel(params);
}
function simpanPI(){
 var nip = $('#nip').val();
 var id_grup = $('#id_grup').val();
 var id_user = $('#id_user').val();
 var id_jab = $('#id_jab').val();
 var nama_pegawai = $('#nama_pegawai').val();
 var awal = $('#awal').val();
 var akhir = $('#akhir').val();
 var id_pi =  $('#id_pi').val();
 
 if(empty(nip)){
  onMessage('NIP Wajib diisi!');
  return false;
}else if(empty(id_grup)){
  onMessage('NIP dan Nama Wajib diisi!');
  return false;
}else if(empty(nama_pegawai)){
  onMessage('Nama Pegawai Wajib diisi!');
  return false;
}else if(empty(awal)){
  onMessage('Periode awal Wajib diisi!');
  return false;
}else if(empty(akhir)){
  onMessage('Periode akhir Wajib diisi!');
  return false;
}else{
  $("#nip").prop("disabled", false );
  $("#nama_pegawai").prop("disabled", false );
  var action ='savepi';
  if(!empty(id_pi)){
    action='editpi';
  }
  postForm('form-pi',BASE_URL+'kpi/mpenilaian/'+action,loadDataPI)
  $('#form-pi')[0].reset();
  
  $('#id_grup').val(id_grup)
  $('#id_user').val(id_user)
  $('#id_jab').val(id_jab)
  $('.buttoenedit').hide();
  $('#simpan').show();
  $( "#nip" ).prop( "disabled", true );
  $( "#nama_pegawai" ).prop( "disabled", true );
}

}



var listPI = [
{headerName: "NIP", field: "nip", width: 190, filterParams:{newRowsAction: 'keep'}},
{headerName: "NIK", field: "nik", width: 190, filterParams:{newRowsAction: 'keep'}},
{headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
{headerName: "Unit Kerja", field: "nama_group", width: 190, filterParams:{newRowsAction: 'keep'}},
{headerName: "Periode Awal", field: "awal", width: 190, filterParams:{newRowsAction: 'keep'}},
{headerName: "Akhir", field: "akhir", width: 190, filterParams:{newRowsAction: 'keep'}},

];



var gridPI = {
 enableSorting: true,
 enableFilter: true,
 suppressRowClickSelection: false, 
 onRowClicked: bukaPI,
 groupSelectsChildren: true,
 debug: true,
 rowSelection: 'multiple',
 enableColResize: true,
 pivotPanelShow: 'always',
 enableRangeSelection: true,
 columnDefs: listPI,
 pagination: false,
 paginationPageSize: 50, 
 defaultColDef:{
   editable: false,
   enablePivot:true,
   enableValue:true
 }
};

        // setup the grid after the page has finished loading 
        var gridDiv = document.querySelector('#gridPI');
        new agGrid.Grid(gridDiv, gridPI);

        function bukaPI(){
          var selectedRows = gridPI.api.getSelectedRows();
          var nip='';
          var nama_pegawai='';
          var awal ='';
          var akhir ='';
          var id_pi='';
          var id_user='';
          var id_jab='';
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
             id_jab += selectedRow.id_jab;
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
          $('#id_jab').val(id_jab);
          $('#uk').val(nama_group);
          
          getJson(prosesData,BASE_URL+'kpi/mpenilaian/getitemkpi?id=5&pid='+selectedRowsString);
        }

        function prosesDataPI(result){
          gridPI.api.setRowData(result.result);
        } 

        function loadDataPI(jml){
          var search = 0;
          var group = localStorage.getItem("group");
          var url = BASE_URL + 'kpi/mpenilaian/list_pi/5/' + search + '/' + jml;
          
          if($('#search').val() !==''){
            search = $('#search').val();
            url = BASE_URL + 'kpi/mpenilaian/list_pi/5/' + search + '/' + jml;
          }
          
          if ((group !== '1') && (group !== '6')) {
            url = BASE_URL + 'kpi/mpenilaian/list_pi/5/' + search + '/' + jml + "/" + group;
          }
          getJson(prosesDataPI,url);
        }

        loadDataPI(0);

           ///////////////////////////////////////////////

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

          function getRowData() {
            var rowData = [];
            gridOptions.api.forEachLeafNode( function(node) {
              rowData.push(node.data);
            });
    //console.log('Row Data:'); 
    save(BASE_URL+'kpi/mpenilaian/savedetail',rowData,tektok);
  }

  function get() {
    var rowData = [];
    gridOptions.api.forEachLeafNode( function(node) {
      rowData.push(node.data);
    });
    //console.log('Row Data:'); 
    save(BASE_URL+'kpi/mpenilaian/saveiku/',rowData,tektok);
  }

  function tektok(){
    var selectedRows = gridPI.api.getSelectedRows();
    var selectedRowsString = '';
    selectedRows.forEach( function(selectedRow, index) {
      
     if (index!==0) {
       selectedRowsString += ', ';
     }
     selectedRowsString += selectedRow.id; 
   });
    
    getJson(prosesData,BASE_URL+'kpi/mpenilaian/getitemkpi?id=5&pid='+selectedRowsString);
  }
  
  function onBtForEachLeafNode() {
   console.log('### api.forEachLeafNode() ###');
   gridOptions.api.forEachLeafNode(printNode);
 }

 function printNode(node, index) {
   var key = node.data.id;
   var value =  node.data.capaian; 
   var year_array = new Array();
 if ( !year_array.hasOwnProperty(node.data.id) ) // if year is not in array yet
 {
        year_array[node.data.id] = new Array(); // create an empty array for it
      }

      year_array[node.data.id].push({
        "capaian": node.data.capaian,
        "persen": node.data.persen 
      });
      console.log(index + ' -> data: ' + JSON.stringify(year_array));

      
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

   function createNewRowData() {
    var selectedRows = gridPI.api.getSelectedRows(); 
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
      });
      
      var newData = {
        pid : selectedRowsString,
        child : 5,
        max : 20,
        nama: '',
        no: 0,
        target_kinerja: 0,
        capaian: 0,
        capaian_persen: 0,
        nilai: 0,
        nilai_bobot: 0,
        keterangan: '',
      }; 
      return newData;
    }
  }

  function onAddRow() {
    var selectedRows = gridPI.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
              onMessage('Silahkan Pilih Pegawai Terlebih dahulu!');
              return false;
            }else{
              var newItem = createNewRowData();
              var res = gridOptions.api.updateRowData({add: [newItem]});
            }
          }

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
                   
                  getJson(tektok,BASE_URL+'kpi/mpenilaian/hapus?id='+selectedRowsString);
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
        function getCharCodeFromEvent(event) {
         event = event || window.event;
         return typeof event.which === 'undefined' ? event.keyCode : event.which;
       }

       function isCharNumeric(charStr) {
         return !!/\d/.test(charStr);
       }

       function isKeyPressedNumeric(event) {
         var charCode = getCharCodeFromEvent(event);
         var charStr = String.fromCharCode(charCode);
         return isCharNumeric(charStr);
       }

       function search(){
        bootbox.dialog({ 
         message:$('<div></div>').load('view/pegawai/search_pegawai.php'),
         animateIn: 'bounceIn',
         animateOut : 'bounceOut',
         backdrop: false,
         size:'large',
         buttons: {
          

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
      $(document).ready(function () {
        $('#awal').datepicker({
          format: "dd-mm-yyyy",
          autoclose: true
        });
        $('#akhir').datepicker({
          format: "dd-mm-yyyy",
          autoclose: true
        });
      });
    </script>