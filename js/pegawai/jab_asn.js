

function tabJabatanasn(){
    
	
    $("#page-jabfung").load("view/pegawai/form_jabatan_asn.php");
     loadJabatan();
   
}

function tabJabatanViewasn(){
    
	
    $("#page-jabfung").load("view/pegawai/form_jabatan_asn_view.php");
     loadJabatan();
   
}



function simpanJasn(action){
    var tgl_skjafung = 	$('#tgl_skjafung').val();
var gouirl = 'pegawai/savejfung';
    if(action==='edit'){
        gouirl = 'pegawai/editjabatan';
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

                      getOptions("txtdirektorat",BASE_URL+"master/direktorat");
                      getOptions("satuan_kerja",BASE_URL+"master/getmaster?id=25");
                      getOptions("kelas_jabatan",BASE_URL+"master/getmaster?id=24");
                      
                     
                     
                      
          }
          
          
function editJasn(){
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

                                    getOptionsEdit("txtbagian",BASE_URL+"master/direktoratSub/"+data.direktorat_tujuan,data.bagian_tujuan);
									getOptionsEdit("unitkerja",BASE_URL+"master/direktoratSub/"+data.bagian_tujuan,data.sub_bagian_tujuan);
																		
              

                                              
              
                                  } 
                              });
              
          }
  }


function deletJasn(){
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