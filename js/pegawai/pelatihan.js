

function tabPelatihan(){
 $("#page-pelatihan").load("view/pegawai/form_pelatihan.php");
 loadPelatihan();  
}

function tabPelatihanView(){
  $("#page-pelatihan").load("view/pegawai/form_pelatihan_view.php");
  loadPelatihan(); 
}


function simpanPelatihan(action){
 var id_pelatihan = $('#id_pelatihan').val();
 var id_user = $('#id_user').val();
 
 var gotourl = 'pegawais/pelatihan/savepelatihan';
 if(id_pelatihan !==''){
   gotourl = 'pegawais/pelatihan/editpelatihan/'+id_pelatihan;
 }
 
var data = formJson('form-pelatihan'); //$("#form-upload").serializeArray();
var obj = JSON.parse(data);
obj['id_user'] = id_user;

$.ajax({
 url: BASE_URL + gotourl,
 headers: {
   'Authorization': localStorage.getItem("Token"),
   'X_CSRF_TOKEN': 'donimaulana',
   'Content-Type': 'application/json'
 },
 dataType: 'json',
 type: 'post',
 contentType: 'application/json',
 processData: false,
 data: JSON.stringify(obj),
 success: function(data, textStatus, jQxhr) {
   hasil = data.hasil;
   message = data.message;
   if (hasil == "success") {
     $.niftyNoty({
       type: 'success',
       title: 'Success',
       message: message,
       container: 'floating',
       timer: 5000
     });
     $("#id_pelatihan").val(data.id);
     loadPelatihan();
               // $('.modal').modal('hide');
             } else {
               return false;
             }
           },
           error: function(jqXhr, textStatus, errorThrown) {
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


function loadPelatihan(){ 
 var id_user = $('#id_user').val();
 $.ajax({
  url: BASE_URL+'pegawais/pelatihan/listpelatihan/'+id_user,
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
   
   
    gridPelatihanOpt.api.setRowData(data); 
  },
  error: function( jqXhr, textStatus, errorThrown ){
    alert('error');
  }
});

}

function addPelatihan(){
  getOptions("tempat",BASE_URL+"master/tempat");
  
  
  bootbox.dialog({ 
    message:$('<div></div>').load('view/pegawai/input_pelatihan.php'),
    backdrop: false,
    size:'large',
    buttons: {
      success: {
        label: "Save",
        className: "btn-success",
        callback: function() {
          
         simpanPelatihan('save');
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
}


function editPelatihan(){
  var selectedRows = gridPelatihanOpt.api.getSelectedRows();
// alert('>>'+selectedRows+'<<<');
if(selectedRows == ''){
  onMessage('Silahkan Pilih Pelatihan Terlebih dahulu!');
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
    message:$('<div></div>').load('view/pegawai/input_pelatihan.php'),
    backdrop: false,
    size:'large',
    buttons: {
      success: {
        label: "Save",
        className: "btn-success",
        callback: function() {

          simpanPelatihan('edit');
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
    url: BASE_URL+'pegawais/pelatihan/getpelatihan/'+selectedRowsString,
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




      $('#nama').val(data.nama);
      $('#penyelenggara').val(data.penyelenggara); 
      $('#durasi').val(data.durasi);
      $('#mulai').val(data.mulai);

      $('#sampai').val(data.sampai);
      $('#jenis_sertifikat').val(data.jenis_sertifikat);
      $('#no_sertifikat').val(data.no_sertifikat); 
      $('#id_pelatihan').val(data.id); 

      if(!empty(data.file)){
        var datafile='';
        datafile+='<tr>';
        datafile+='<td>1.';
        datafile+='</td>';
        datafile+='<td>';
        datafile +=data.file.substring(0, 30)+'...';
        datafile+='</td>';
        datafile+='<td>';

        datafile +='<a title="Lihat File" id="book1-trigger" class="btn btn-default" href="javascript:void(0)" onclick="buildBook(\'api/upload/data/'+data.file+'\')"><i class="fa fa-eye"></i></a>';
        datafile+='</td>';
        datafile+='</tr>';
        $('#fileIjazah').html(datafile);

      }



      getOptionsEdit("kategori",BASE_URL+"master/kategori",data.kategori);  
      getOptionsEdit("penanggung",BASE_URL+"master/penanggung",data.penanggung);  
      getOptionsEdit("tempat",BASE_URL+"master/tempat",data.tempat);  

    } 
  });

}
}


function deletPelatihan(){
  var selectedRows = gridPelatihanOpt.api.getSelectedRows();
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

  submit_get(BASE_URL+'pegawais/pelatihan/deletepelatihan/?id='+selectedRowsString,loadPelatihan);


}
}