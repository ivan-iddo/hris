

function tabPendidikan(){
    
	
     $("#page-pendidikan").load("view/pegawai/form_pendidikan.php");
      loadPendidikan();
    
}

function tabPendidikanView(){
    
	
    $("#page-pendidikan").load("view/pegawai/form_pendidikan_view.php");
     loadPendidikan();
   
}


function simpanPendidikan(action){
	var id_pendidikan = $('#id_pendidikan').val();
     var id_user = $('#id_user').val();
     
     var gotourl = 'pegawai/savependidikan';
     if(id_pendidikan !==''){
          gotourl = 'pegawai/editpendidikan/'+id_pendidikan;
     }
	 
var data = formJson('form-pendidikan'); //$("#form-upload").serializeArray();
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
				$("#id_pendidikan").val(data.id);
				loadPendidikan();
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


 function loadPendidikan(){ 
                var id_user = $('#id_user').val();
           $.ajax({
                                   url: BASE_URL+'pegawai/listpendidikan/'+id_user,
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
                      
                        
                     gridPendidikanOpt.api.setRowData(data); 
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });

           }

           function addPendidikan(){
               getOptions("txtStatusLulus",BASE_URL+"master/statuslulus");
			   getOptions("txtJakreditasi",BASE_URL+"master/akreditas");
               getOptions("txtJPend",BASE_URL+"master/getmaster?id=29");
			  
               
               
               bootbox.dialog({ 
                 message:$('<div></div>').load('view/pegawai/input_pendidikan.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'large',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-success",
                           callback: function() {
                               
                              simpanPendidikan('save');
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
           
           
function editPendidikan(){
               var selectedRows = gridPendidikanOpt.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Pendidikan Terlebih dahulu!');
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
                                                  message:$('<div></div>').load('view/pegawai/input_pendidikan.php'),
                                                    animateIn: 'bounceIn',
                                                    animateOut : 'bounceOut',
                                                                               backdrop: false,
                                                    size:'large',
                                                    buttons: {
                                                        success: {
                                                            label: "Save",
                                                            className: "btn-success",
                                                            callback: function() {
                                                                
                                                               simpanPendidikan('edit');
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
                                   url: BASE_URL+'pegawai/getpendidikan/'+selectedRowsString,
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
               
              
               
                                              
               $('#txtNamaSekolah').val(data.pen_name);
               $('#txtTahunLulus').val(data.pen_tahn);
               $('#txtNoIjazah').val(data.pen_nijz);
               $('#txtTglIjazah').val(data.pen_dijz);
               $('#txtKepalaSekolah').val(data.pen_nkep);
               $('#id_pendidikan').val(data.id);
               $('#txtJspesialis').val(data.pen_spe);
               $('#txtJjurusan').val(data.pen_jur);

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
               

                                              
               getOptionsEdit("txtJPend",BASE_URL+"master/getmaster?id=29",data.pen_code);
			   getOptionsEdit("txtJakreditasi",BASE_URL+"master/akreditas",data.pen_akr);
               getOptionsEdit("txtStatusLulus",BASE_URL+"master/statuslulus",data.pen_desc);
               
                                   } 
                               });
               
           }
   }


function deletPendidikan(){
             var selectedRows = gridPendidikanOpt.api.getSelectedRows();
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
           submit_get(BASE_URL+'pegawai/deletependidikan/?id='+selectedRowsString,loadPendidikan);
           
           
            }
           }

           function setPendidikan(){
            var selectedRows = gridPendidikanOpt.api.getSelectedRows();
            var id_user = $('#id_user').val();
          // alert('>>'+selectedRows+'<<<');
          if(selectedRows == ''){
             onMessage('Silahkan Pilih Pendidikan Terlebih dahulu!');
             return false;
          }else{
              var selectedRowsString = '';
         selectedRows.forEach( function(selectedRow, index) {
          
             if (index!==0) {
                 selectedRowsString += ', ';
             }
             selectedRowsString += selectedRow.id;
         });

         getJson(resedit,BASE_URL+'pegawai/setpendidikan/?id='+selectedRowsString+'&user_id='+id_user)
       
         
         
          }
          }
          
        function resedit(result){
            if(result.hasil==='success'){
              swal('BERHASIL!',result.message,'success');
            }else{
              swal('Oops!',result.message);
            }
        }
         
         