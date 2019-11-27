

function tabJabatan(){
  $("#page-jabatan").load("view/pegawai/form_jabatan.php");
  loadJabatan();
}

function tabJabatanView(){
  $("#page-jabatan").load("view/pegawai/form_jabatan_view.php");
  loadJabatan();
}



function simpanJabatan(action){
  var direktorat	= $('#txtdirektorat').val();
  var tgl_mutasi = 	$('#tgl_mutasi').val();
  var gouirl = 'pegawai/savejabatan';
  if(action==='edit'){
    gouirl = 'pegawai/editjabatan';
  }
  if(empty(direktorat)){
    onMessage("Data 'Direktorat' Wajib dipilih");

    return false;
  }else if(empty(tgl_mutasi)){
    onMessage("Data 'Tanggal Mutasi' Wajib dipilih");

    return false;

  }else{

var data = formJson('form-jabatan');//$("#form-upload").serializeArray();
$.ajax({
  url: BASE_URL+gouirl,
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
        loadJabatan();
        $('.modal').modal('hide');
      }else{
        $.niftyNoty({
          type: 'danger',
          title: 'PERHATIAN!',
          message: message,
          container: 'floating',
          timer: 5000
        });    
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


function loadJabatan(){ 
  var id_user = $('#id_user').val();
  $.ajax({
    url: BASE_URL+'pegawais/jabatan/listjabatan/'+id_user,
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


      gridJabatanOpt.api.setRowData(data); 
    },
    error: function( jqXhr, textStatus, errorThrown ){
      alert('error');
    }
  });

}

function addJabatan(){
  bootbox.dialog({ 
    message:$('<div></div>').load('view/pegawai/input_jabatan.php'),
    backdrop: false,
    size:'large',
    buttons: {
      success: {
        label: "Save",
        className: "btn-success",
        callback: function() {
          var id_user = $('#id_user').val();
          $('#txtIdUser').val(id_user);
          simpanJabatan('save');
          return false;


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
  getOptions("jabatan",BASE_URL+"master/jabatan_struktural_fix_label");
  getOptions("jabatan2",BASE_URL+"master/jabatan_struktural_fix_label");
  getOptions("jabatan3",BASE_URL+"master/jabatan_struktural_fix_label");
}


function editJabatan(){
  var selectedRows = gridJabatanOpt.api.getSelectedRows();
// alert('>>'+selectedRows+'<<<');
if(selectedRows == ''){
  onMessage('Silahkan Pilih Jabatan Terlebih dahulu!');
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
    message:$('<div></div>').load('view/pegawai/input_jabatan.php'),
    backdrop: false,
    size:'large',
    buttons: {
      success: {
        label: "Save",
        className: "btn-success",
        callback: function() {

          simpanJabatan('edit');
          return false;
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

  $.ajax({
    url: BASE_URL+'pegawais/jabatan/getjabatan/'+selectedRowsString,
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


      $('#tgl_mutasi').val(data.tgl);  
      $('#no_sk').val(data.no_sk); 
      $('#tgl_sk').val(data.tgl_sk); 
      $('#keterangan').val(data.keterangan);
      $('#idjabatan').val(data.id);

      getOptionsEdit("txtdirektorat",BASE_URL+"master/direktorat",data.direktorat_tujuan);
      getOptionsEdit("satuan_kerja",BASE_URL+"master/getmaster?id=25",data.id_satker);
      getOptionsEdit("kelas_jabatan",BASE_URL+"master/getmaster?id=24",data.id_kelas);
      getOptionsEdit("jabatan",BASE_URL+"master/jabatan_struktural_fix",data.jabatan);
      getOptionsEdit("jabatan2",BASE_URL+"master/jabatan_struktural_fix",data.jabatan2);
      getOptionsEdit("jabatan3",BASE_URL+"master/jabatan_struktural_fix",data.jabatan3);
      getOptionsEdit("txtbagian",BASE_URL+"master/direktoratSub/"+data.direktorat_tujuan,data.bagian_tujuan);
      getOptionsEdit("unitkerja",BASE_URL+"master/direktoratSub/"+data.bagian_tujuan,data.sub_bagian_tujuan);
      getOptionsEdit("kaunit",BASE_URL+"master/direktoratSub/"+data.sub_bagian_tujuan,data.kaunit_tujuan);
      getOptionsEdit("staff",BASE_URL+"master/direktoratSub/"+data.kaunit,data.staff_tujuan);
    } 
  });

}
}


function deletJabatan(){
  var selectedRows = gridJabatanOpt.api.getSelectedRows();
// alert('>>'+selectedRows+'<<<');
if(selectedRows == ''){
  onMessage('Silahkan Pilih Group Terlebih dahulu!');
  return false;
}else{
  var selectedRowsString = '';
  selectedRows.forEach( function(selectedRow, index) {

    if (index!==0) {
      selectedRowsString += ', ';
    }
    selectedRowsString += selectedRow.id;
  });

  submit_get(BASE_URL+'pegawais/jabatan/deletejabatan/?id='+selectedRowsString,loadJabatan);
}
}

function setJabatan(){
  var selectedRows = gridJabatanOpt.api.getSelectedRows();
  var id_user = $('#id_user').val();
// alert('>>'+selectedRows+'<<<');
if(selectedRows == ''){
  onMessage('Silahkan Pilih Jabatan Terlebih dahulu!');
  return false;
}else{
  var selectedRowsString = '';
  selectedRows.forEach( function(selectedRow, index) {

    if (index!==0) {
      selectedRowsString += ', ';
    }
    selectedRowsString += selectedRow.id;
  });
  getJson(reseditJabatan,BASE_URL+'pegawai/setjabatan/?id='+selectedRowsString+'&user_id='+id_user)
}
}

function reseditJabatan(result){
  if(result.hasil==='success'){
    swal('BERHASIL!',result.message,'success');
  }else{
    swal('Oops!',result.message);
  }
}