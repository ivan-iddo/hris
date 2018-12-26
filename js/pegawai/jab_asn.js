

function tabJabatanasn(){
    
	
    $("#page-jabfung").load("view/pegawai/form_jabatan_asn.php");
     loadJasn();
   
}

function tabJabatanViewasn(){
    
	
    $("#page-jabfung").load("view/pegawai/form_jabatan_asn_view.php");
     loadJasn();
   
}



function simpanJasn(action){
    var tgl_skjafung = 	$('#tgl_skjafung').val();
var gouirl = 'pegawai/savejfung';
    if(action==='edit'){
        gouirl = 'pegawai/editjasn';
    }
	if(empty(tgl_skjafung)){
                                      onMessage("Data 'Tanggal' Wajib dipilih");
             
             return false;

                                  }else{
                                  
                                          var data = formJson('form-jfung');//$("#form-upload").serializeArray();
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
                                                                                                                      loadJasn();
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


function loadJasn(){ 
               var id_user = $('#id_user').val();
          $.ajax({
                                  url: BASE_URL+'pegawais/jabatan_asn/listjasn/'+id_user,
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
                     
                       
                    gridJOpt.api.setRowData(data); 
                                  },
                                  error: function( jqXhr, textStatus, errorThrown ){
                                      alert('error');
                                  }
                              });

          }

function addJasn(){
   
              
              
              bootbox.dialog({ 
                message:$('<div></div>').load('view/pegawai/input_jabatan_asn.php'),
                  animateIn: 'bounceIn',
                  animateOut : 'bounceOut',
                                    backdrop: false,
                  size:'large',
                  buttons: {
                      success: {
                          label: "Save",
                          className: "btn-success",
                          callback: function() {
                            var id_user = $('#id_user').val();
                            $('#txtIdUser').val(id_user);
                             simpanJasn('save');
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

                      getOptions("txtjabatan",BASE_URL+"master/direktorat");
                      getOptions("satuan_kerja",BASE_URL+"master/getmaster?id=25");
                      getOptions("kelas_jabatan",BASE_URL+"master/getmaster?id=24");
                      
                     
                     
                      
          }
          
          
function editJasn(){
              var selectedRows = gridJOpt.api.getSelectedRows();
           // alert('>>'+selectedRows+'<<<');
           if(selectedRows == ''){
              onMessage('Silahkan Pilih Jabatan Asn Terlebih dahulu!');
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
                                                 message:$('<div></div>').load('view/pegawai/input_jabatan_asn.php'),
                                                   animateIn: 'bounceIn',
                                                   animateOut : 'bounceOut',
                                                                              backdrop: false,
                                                   size:'large',
                                                   buttons: {
                                                       success: {
                                                           label: "Save",
                                                           className: "btn-success",
                                                           callback: function() {
                                                               
                                                              simpanJasn('edit');
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
                                  url: BASE_URL+'pegawais/jabatan_asn/getjasn/'+selectedRowsString,
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
               
                                     $('#tmt_jabfung').val(data.tmt_jfung); 
                                     $('#no_skjfung').val(data.no_skjfung); 
                                     $('#tgl_skjafung').val(data.tgl_skjafung);
                                     $('#no_pak').val(data.no_pak);
                                     $('#tmt_pak').val(data.tmt_pak);
                                     $('#tgl_pak').val(data.tgl_pak);
                                     $('#nilai_pak').val(data.nilai_pak);
                                     $('#keterangan').val(data.keterangan);
                                     $('#idasn').val(data.id);
                                                                               
                                    getOptionsEdit("satuan_kerja",BASE_URL+"master/getmaster?id=25",data.id_satker);
                                    getOptionsEdit("txtjabatan",BASE_URL+"master/direktorat",data.jabatan);
									getOptionsEdit("txtbagian",BASE_URL+"master/direktoratSub/"+data.jabatan,data.bagian_jabatan);
									getOptionsEdit("unitkerja",BASE_URL+"master/direktoratSub/"+data.bagian_jabatan,data.sub_bagian_jabatan);

                                  } 
                              });
              
          }
  }


function deletJasn(){
            var selectedRows = gridJOpt.api.getSelectedRows();
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
          
          submit_get(BASE_URL+'pegawais/jabatan_asn/deletejasn/?id='+selectedRowsString,loadJasn);
          
          
           }
          }