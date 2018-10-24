

function tabGolongan(){
    
	
    $("#page-golongan").load("view/pegawai/form_golongan.php");
     loadGolongan();
   
}

function tabGolonganView(){
    
	
    $("#page-golongan").load("view/pegawai/form_golongan_view.php");
     loadGolongan();
   
}

function simpanGolongan(action){
   var id_golongan = $('#id_golongan').val();
    var id_user = $('#id_user').val();
    
    var gotourl = 'pegawais/golongan/savegolongan';
    if(!empty(id_golongan)){
         gotourl = 'pegawais/golongan/editgolongan/'+id_golongan;
    }
    
var data = formJson('form-golongan'); //$("#form-upload").serializeArray();
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
               $("#id_golongan").val(data.id);
               loadGolongan();
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


function loadGolongan(){ 
               var id_user = $('#id_user').val();
          $.ajax({
                                  url: BASE_URL+'pegawais/golongan/listgolongan/'+id_user,
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
                     
                       
                    gridGolonganOpt.api.setRowData(data); 
                                  },
                                  error: function( jqXhr, textStatus, errorThrown ){
                                      alert('error');
                                  }
                              });

          }

function addGolongan(){
            getOptions("golongan_id",BASE_URL+"master/golongan_pegawai");
              
              
              bootbox.dialog({ 
                message:$('<div></div>').load('view/pegawai/input_golongan.php'),
                  animateIn: 'bounceIn',
                  animateOut : 'bounceOut',
                                    backdrop: false,
                  size:'large',
                  buttons: {
                      success: {
                          label: "Save",
                          className: "btn-success",
                          callback: function() {
                              
                             simpanGolongan('save');
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
          
          
function editGolongan(){
              var selectedRows = gridGolonganOpt.api.getSelectedRows();
           // alert('>>'+selectedRows+'<<<');
           if(selectedRows == ''){
              onMessage('Silahkan Pilih Golongan Terlebih dahulu!');
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
                                                 message:$('<div></div>').load('view/pegawai/input_golongan.php'),
                                                   animateIn: 'bounceIn',
                                                   animateOut : 'bounceOut',
                                                                              backdrop: false,
                                                   size:'large',
                                                   buttons: {
                                                       success: {
                                                           label: "Save",
                                                           className: "btn-success",
                                                           callback: function() {
                                                               
                                                              simpanGolongan('edit');
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
                                  url: BASE_URL+'pegawais/golongan/getgolongan/'+selectedRowsString,
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
              
             
              
                                              
              $('#tmt_golongan').val(data.tmt_golongan);
              $('#no_sk').val(data.no_sk); 
              $('#tgl_sk').val(data.tgl_sk);
              $('#penanda_tanganan').val(data.penanda_tanganan);
              $('#id_golongan').val(data.id);

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
              

                                             
              getOptionsEdit("golongan_id",BASE_URL+"master/golongan_pegawai",data.golongan_id);  
              
                                  } 
                              });
              
          }
  }


function deletGolongan(){
            var selectedRows = gridGolonganOpt.api.getSelectedRows();
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
          
          submit_get(BASE_URL+'pegawais/golongan/deletegolongan/?id='+selectedRowsString,loadGolongan);
          
          
           }
          }