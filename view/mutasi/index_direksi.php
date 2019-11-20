
<div class="row">
	
  <div class="tab-base mar-all">
    <!--Nav Tabs-->

    <ul class="nav nav-tabs">
      <li>
        <a href="#demo-lft-tab-1" data-toggle="tab">
          <span class="block text-center">
           <i class="fa fa-home fa-2x text-danger"></i> 
         </span>
         Dashboard
       </a>
     </li>

     <li class="active">
      <a href="#demo-lft-tab-2" data-toggle="tab">
        <span class="block text-center">
         <i class="fa fa-laptop fa-2x text-danger"></i> 
       </span>
       Permohonan Baru
     </a> 
   </li>
   <li>
    <a href="#demo-lft-tab-mutasi" data-toggle="tab">
      <span class="block text-center">
       <i class="fa fa-mail-forward fa-2x text-danger"></i> 
     </span>
     Riwayat Permohonan Mutasi
   </a>
 </li>
 <li> 
   <a href="#demo-lft-tab-3" data-toggle="tab">
    <span class="block text-center">
     <i class="fa fa-lightbulb-o fa-2x text-warning"></i> 
   </span>
   Help
 </a> 
</li>
</ul>

<div class="tab-content">
  <div class="tab-pane fade" id="demo-lft-tab-1"></div>

  <div class="tab-pane fade active in" id="demo-lft-tab-2">
    <div class="fixed-table-toolbar">
     
    </div>
    
    <div class="panel-group accordion" id="accordion" >
     <div class="panel" style="border:none">
       
       <!--Accordion title-->
       <div class="panel-heading">
         <h4 class="panel-title">
           <a data-parent="#accordion" data-toggle="collapse" href="#collapseOne" aria-expanded="true" class="text-warning"><i class="fa fa-folder"></i> List Mutasi </a>
         </h4>
       </div>
       
       <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
        <div class="panel-body">
          <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="demo-dt-addrow_wrapper">
            <div class="newtoolbar">
              <div class="table-toolbar-left" id="demo-custom-toolbar2">
               <div class="btn-group">
                 <button style="margin-left:3px" class="btn btn-success" onclick="editmutasi()"><i class="fa fa-gear"></i> Proses  Permohonan</button>
               </div>
             </div>
           </div>
           <div class="dataTables_filter" id="demo-dt-addrow_filter">
            <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search" onkeydown="if(event.keyCode=='13'){loaddata(0);}" ></label>
            
          </div>
          
        </div>
        <div class="bootstrap-table">
          <div class="fixed-table-container" style="padding-bottom: 0px;">
            <div class="ag-theme-balham" id="myGrid" style="height: 400px;width:100%;">
            </div>
            
            <div class="paging pull-right mar-all"> 
            </div>
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="tab-pane fade " id="demo-lft-tab-mutasi">
  <div class="col-sm-6 table-toolbar-left">
    
   
   <button style="margin-left:3px" class="btn btn-primary" onclick="cetak()"><i class="fa fa fa-print"></i> Cetak  Permohonan</button>
   
   
   
   
 </div>
 <div class="dataTables_filter" id="demo-dt-addrow_filter">
  <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="filter-text-box" oninput="onFilterTextBoxChanged()" ></label>
  
</div> 

<div class="ag-theme-balham" id="myGridMutasi" style="height: 400px;width:100%;">
</div>
</div>
<div class="tab-pane fade" id="demo-lft-tab-3">
 
</div>
</div>
</div>


</div>

<div class="row pad-all">
  
 <div id="profilePage"></div>
 
</div>


<script charset="utf-8" type="text/javascript">
  $('.judul-menu').html('Mutasi Jabatan Pegawai');
//<![CDATA[
           // specify the columns
           var columnDefs =[
           {headerName: "Status", field: "status", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Tgl.Mutasi", field: "tgl", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Keterangan", field: "keterangan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Direktorat Tujuan", field: "dir_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Bagian Tujuan", field: "bag_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Sub Bagian Tujuan", field: "subbag_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Direktorat Asal", field: "dir_asal", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Bagian Asal", field: "bag_asal", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Sub Bagian Asal", field: "subbag_asal", width: 190, filterParams:{newRowsAction: 'keep'}},
           
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
           onRowDoubleClicked: proses_mutasi, 
           groupSelectsChildren: true,
           debug: true,
           rowSelection: 'single',
           enableColResize: true,
           rowGroupPanelShow: 'always',
           pivotPanelShow: 'always',
           enableRangeSelection: true,
           columnDefs: columnDefs,
           pagination: false,
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
           function loaddata(jml){
            var search = 0;
            if($('#search').val() !==''){
              search = $('#search').val();
            }
            $.ajax({
             url: BASE_URL+'pegawai/listmutasidireksi?status=113',
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
              
              
               gridOptions.api.setRowData(data.result);
               paging(data.total,'loaddata');
             },
             error: function( jqXhr, textStatus, errorThrown ){
               alert('error');
             }
           });

          }
          
          loaddata(0);
          
          
          
          function proses_mutasi(){
            var selectedRows = gridOptions.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
             onMessage('Silahkan Pilih Pegawai yang akan dimutasi Terlebih dahulu!');
             return false;
           }else{
            var selectedRowsString = '';
            selectedRows.forEach( function(selectedRow, index) {
              
             if (index!==0) {
               selectedRowsString += ', ';
             }
             selectedRowsString += selectedRow.id;
           });
            

//POPUP
bootbox.dialog({ 
 message:$('<div></div>').load('view/pegawai/input_mutasi.php'),
 animateIn: 'bounceIn',
 animateOut : 'bounceOut',
 backdrop: false,
 size:'large',
 buttons: {
   success: {
     label: "Save",
     className: "btn-primary",
     callback: function() {
      $('#txtIdUser').val(selectedRowsString);
      if(simpan()){
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



getOptions("txtdirektorat",BASE_URL+"master/direktorat");
getOptions("satuan_kerja",BASE_URL+"master/getmaster?id=25");
getOptions("kelas_jabatan",BASE_URL+"master/getmaster?id=24");







}

}







function simpan(){
  var direktorat	= $('#txtdirektorat').val();
  var tgl_mutasi = 	$('#tgl_mutasi').val();
  if(empty(direktorat)){
   onMessage("Data 'Direktorat' Wajib dipilih");
   
   return false;
 }else if(empty(tgl_mutasi)){
  onMessage("Data 'Tanggal Mutasi' Wajib dipilih");
  
  return false;

}else{
  
														var data = formJson('form-mutasi');//$("#form-upload").serializeArray();
														$.ajax({
                              url: BASE_URL+'pegawai/savemutasi',
                              headers: {
                                'Authorization': localStorage.getItem("Token"),
                                'X_CSRF_TOKEN':'donimaulana',
                                'Content-Type':'application/json'
                              },
                              dataType: 'json',
                              type: 'post',
                              contentType: 'application/json', 
                              processData: false,
                              data:data,
                              success: function( data, textStatus, jQxhr ){
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
																																	// $("#f_id_edit").val(data.id);
                                                                 loaddata(0);
                                                                 loadMutasi();
                                                                 $('.modal').modal('hide');
                                                               }else{
                                                                 
                                                                 return false;	
                                                               }
                                                               
                                                               
                                                             },
                                                             error: function( jqXhr, textStatus, errorThrown ){
                                                              $.niftyNoty({
                                                                type: 'danger',
                                                                title: 'Warning!',
                                                                message: message,
                                                                container: 'floating',
                                                                timer: 5000
                                                              });
                                                            }
                                                          });
                            
                         }  
                       }
                       
                       
                       
                       
  //]]>
  
  

  
  var columnDefsHis = [
  {headerName: "Status", field: "status", width: 190, rowGroup:true, cellRenderer: CellRenderer},
  {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Tanggal Usulan Mutasi", field: "tgl", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Keterangan", field: "keterangan", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Direktorat Tujuan", field: "dir_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Bagian Tujuan", field: "bag_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Sub Bagian Tujuan", field: "subbag_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Direktorat Asal", field: "dir_asal", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Bagian Asal", field: "bag_asal", width: 190, filterParams:{newRowsAction: 'keep'}},
  {headerName: "Sub Bagian Asal", field: "subbag_asal", width: 190, filterParams:{newRowsAction: 'keep'}},
  
  ];

  var gridOptionsMutasi = {
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
   columnDefs: columnDefsHis,
   pagination: false,
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
        var gridDiv = document.querySelector('#myGridMutasi');
        new agGrid.Grid(gridDiv, gridOptionsMutasi);

        function onFilterTextBoxChanged() {
          gridOptionsMutasi.api.setQuickFilter(document.getElementById('filter-text-box').value);
        }
        
        function loadMutasi(){
          $.ajax({
           url: BASE_URL+'pegawai/listmutasidireksi',
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
            
            
            gridOptionsMutasi.api.setRowData(data.result); 
          },
          error: function( jqXhr, textStatus, errorThrown ){
           alert('error');
         }
       });
        }
        

        loadMutasi();
        function editmutasi(){
          var selectedRows = gridOptions.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
             onMessage('Silahkan Pilih Pegawai yang akan dimutasi Terlebih dahulu!');
             return false;
           }else{
            var selectedRowsString = '';
            selectedRows.forEach( function(selectedRow, index) {
              
             if (index!==0) {
               selectedRowsString += ', ';
             }
             selectedRowsString += selectedRow.id;
           });


            
            getJson(setPengajuan,BASE_URL+'hrd/mutasi/listdata?id='+selectedRowsString);
//POPUP
bootbox.dialog({ 
 message:$('<div></div>').load('view/pegawai/input_mutasi_direksi.php'),
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



getOptions("txtdirektorat",BASE_URL+"master/direktorat");
getOptions("satuan_kerja",BASE_URL+"master/getmaster?id=25");
getOptions("kelas_jabatan",BASE_URL+"master/getmaster?id=24");






}

}

function setPengajuan(a) {


    setTimeout(function () {
        Pace.restart();
        getOptionsEdit("txtdirektorat", BASE_URL + "master/direktorat", a.result[0].direktorat_tujuan);
        getOptionsEdit("txtbagian", BASE_URL + "master/direktoratsub/" + a.result[0].direktorat_tujuan, a.result[0].bagian_tujuan);
        getOptionsEdit("unitkerja", BASE_URL + "master/direktoratsub/" + a.result[0].bagian_tujuan, a.result[0].sub_bagian_tujuan);
		$('#txtdirektorat').change(function() {
			var a=$('#txtdirektorat').val();
			getOptions("txtjabatan", BASE_URL +"master/jabatan_struktural_fix?id="+a);
		});
		$('#txtbagian').change(function() {
			var b=$('#txtbagian').val();
			getOptions("txtjabatan", BASE_URL +"master/jabatan_struktural_fix?id="+b);
		});
		$('#unitkerja').change(function() {
			var c=$('#unitkerja').val();
			getOptions("txtjabatan", BASE_URL +"master/jabatan_struktural_fix?id="+c);
		});

        getOptionsEdit("satuan_kerja", BASE_URL + "master/getmaster?id=25", a.result[0].id_satker);
        getOptionsEdit("kelas_jabatan", BASE_URL + "master/getmaster?id=24", a.result[0].id_kelas);
        getOptionsEdit("txtjabatan", BASE_URL + "master/jabatan_struktural_fix_label", a.result[0].jabatan_struktural);
        getOptionsEdit("jenis_mutasi", BASE_URL + "master/getmaster?id=43", a.result[0].jm);
        $('#idtk').val(a.result[0].id);
        $('#tgl_mutasi').val(a.result[0].tgl_mutasi);
        $('#keterangan').val(a.result[0].keterangan);
        $('#no_sk').val(a.result[0].no_sk);
        $('#tgl_sk').val(a.result[0].tgl_sk);
        $('#isi').val('');
        $('#txtIdUser').val(a.result[0].user_id);
        $('#iddok').val(a.result[0].id);
        id = $('#idtk').val();
        getJson(listchat, BASE_URL + 'abk/abk/getchatall?kategori=1&id=' + id);
    }, 1000);


}

function listchat(obj){
  var isi = '';
  var idgue = localStorage.getItem("id_user");
  $.each( obj.result, function( key, value ) {
						//alert(value.isi);
						if(idgue===value.id_user){
              isi+='<li class="mar-btm">';
              isi+='<div class="media-left">';
              isi+='<img src="img/profile-photos/1.png" class="img-circle img-sm" alt="Profile Picture">';
              isi+='</div>';
              isi+='<div class="media-body pad-hor">';
              isi+='<div class="speech">';
              isi+='<a href="#" class="media-heading">'+value.username+'</a>';
              isi+='<p>'+value.isi+'</p>';
              isi+='<p class="speech-time">';
              isi+='<i class="demo-pli-clock icon-fw"></i> '+value.tgl;
              isi+='</p>';
              isi+=' </div>';
              isi+='</div>';
              isi+='</li>';
            }else{
             isi+='<li class="mar-btm">';
             isi+='<div class="media-right">';
             isi+='<img src="img/profile-photos/8.png" class="img-circle img-sm" alt="Profile Picture">';
             isi+='</div>';
             isi+='<div class="media-body pad-hor speech-right">';
             isi+='<div class="speech">';
             isi+=' <a href="#" class="media-heading">'+value.username+'</a>';
             isi+='<p>'+value.isi+'</p>';
             isi+='<p class="speech-time">';
             isi+='<i class="demo-pli-clock icon-fw"></i> '+value.tgl;
             isi+='</p>';
             isi+=' </div>';
             isi+='</div>';
             isi+='</li>';
           }
           
         });
  
  $( ".media-block" ).append( isi );
}

function listchatAll(obj){
  var isi = '';
  var idgue = localStorage.getItem("id_user");
  $.each( obj.result, function( key, value ) {
						//alert(value.isi);
						if(idgue===value.id_user){
              isi+='<li class="mar-btm">';
              isi+='<div class="media-left">';
              isi+='<img src="img/profile-photos/1.png" class="img-circle img-sm" alt="Profile Picture">';
              isi+='</div>';
              isi+='<div class="media-body pad-hor">';
              isi+='<div class="speech">';
              isi+='<a href="#" class="media-heading">'+value.username+'</a>';
              isi+='<p>'+value.isi+'</p>';
              isi+='<p class="speech-time">';
              isi+='<i class="demo-pli-clock icon-fw"></i> '+value.tgl;
              isi+='</p>';
              isi+=' </div>';
              isi+='</div>';
              isi+='</li>';
            }else{
             isi+='<li class="mar-btm">';
             isi+='<div class="media-right">';
             isi+='<img src="img/profile-photos/8.png" class="img-circle img-sm" alt="Profile Picture">';
             isi+='</div>';
             isi+='<div class="media-body pad-hor speech-right">';
             isi+='<div class="speech">';
             isi+=' <a href="#" class="media-heading">'+value.username+'</a>';
             isi+='<p>'+value.isi+'</p>';
             isi+='<p class="speech-time">';
             isi+='<i class="demo-pli-clock icon-fw"></i> '+value.tgl;
             isi+='</p>';
             isi+=' </div>';
             isi+='</div>';
             isi+='</li>';
           }
           
         });
  
  $( ".media-block" ).append( isi );
}



	function prosesmutasi(){
       // postForm('form-mutasi',BASE_URL+'pegawai/editmutasi',loaddata); 
	   status=$('#sts').val();
	   if(status==113){
       getJson(hasilstat,BASE_URL+'pegawai/updatestatusmutasi?id='+$('#idtk').val()+'&status=84');
       }
	   if(status==116){
	   getJson(hasilstat,BASE_URL+'pegawai/updatestatusmutasi?id='+$('#idtk').val()+'&status=117');
	   }
     }

     function chat(){
      if(empty($('#isi').val())){
       alert('Tidakada text untuk dikirim');
       return false;
     }
     postFormMore('form-mutasi',BASE_URL+'abk/abk/chat',getchat);
     return false;
   }

   function getchat(){
    $('#isi').val('');
    
    getJson(listchat,BASE_URL+'abk/abk/getchat?kategori=1&id='+$('#idtk').val());
  }
  
  function updatestatus(a){
    
    getJson(hasilstat,BASE_URL+'pegawai/updatestatusmutasi?id='+$('#idtk').val()+'&status='+a);

  }

  function hasilstat(res){
    if(res.hasil ==='success'){
      swal('Sukses!',res.message,'success');
      loaddata(0);
    }else{
      swal('Gagal!',res.message);
    }

    
  }

  function cetak(){
   var selectedRowsSelesai = gridOptionsMutasi.api.getSelectedRows();
   if (selectedRowsSelesai.length <= 0) {
    onMessage('Silahkan Pilih Data Terlebih dahulu!');
    return false;
  }
  else {
    if (selectedRowsSelesai[0].stat!='91') {
      onMessage('Maaf tidak dapat di cetak belom di setujui direktur!');
      return false;
    }else {
     window.open(BASE_URL+'hrd/Supplier/cetak/?tgl_mutasi=' + selectedRowsSelesai[0].tgl_mutasi);
   }
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
 }else if(params.value ==='Dikembalikan untuk dilengkapi'){
   closeSpan.setAttribute("class","badge badge-warning");
   closeSpan.textContent = "Dikembalikan untuk dilengkapi";
 }else if(params.value ==='Disetujui Direksi, menunggu Dirum'){
   closeSpan.setAttribute("class","badge badge-light");
   closeSpan.textContent = "Disetujui Direksi, menunggu Dirum";
 }else if(params.value ==='Disetujui Dirum,menunggu SDM'){
   closeSpan.setAttribute("class","badge badge-light");
   closeSpan.textContent = "Disetujui Dirum,menunggu SDM";
 }else if(params.value ==='Disetujui SDM, menunggu UK'){
   closeSpan.setAttribute("class","badge badge-light");
   closeSpan.textContent = "Disetujui SDM, menunggu UK";
 }else if(params.value ==='Disetujui Ka. Unit,menunggu Direksi'){
   closeSpan.setAttribute("class","badge badge-light");
   closeSpan.textContent = "Disetujui Ka. Unit,menunggu Direksi";
 }else if(params.value ==='Disetujui Direksi,Belum Diferivikasi HRD'){
   closeSpan.setAttribute("class","badge badge-light");
   closeSpan.textContent = "Disetujui Direksi,Belum Diferivikasi HRD";
 }else if(params.value ==='Pengajuan Baru'){
   closeSpan.setAttribute("class","badge badge-info");
   closeSpan.textContent = "Pengajuan Baru";
 }else if(params.value ==='Pengajuan Unit,menunggu Direksi'){
   closeSpan.setAttribute("class","badge badge-info");
   closeSpan.textContent = "Pengajuan Unit,menunggu Direksi";
 }else if(params.value ==='Disetujui, Kirim Ke HI'){
   closeSpan.setAttribute("class","badge badge-info");
   closeSpan.textContent = "Disetujui, Kirim Ke HI";
 }else if(params.value ==='Selesai'){
   closeSpan.setAttribute("class","badge badge-success");
   closeSpan.textContent = "Selesai";
 }
 return closeSpan;
}
</script><script src="js/login.js" type="text/javascript">
</script>

