 <div class="row">
 	
 	<div class="fixed-fluid">
 		<div class="row">
 			<div class="col-lg-3">
 				<div class="fixed-sm-200 fixed-md-250 pull-sm-left">
 					<div class="panel-group accordion" id="accordion">
 						<div id="dokumen_menu" class="dokumen_menu"></div>
 					</div>
 				</div>
 			</div>
 			
 			<div class="col-lg-9">
 				<div class="panel">
 					<div class="isi">
 						<p>
 							<div class="alert alert-danger">
 								<strong>Perhatian!</strong> Pilih salah satu konten pada panel bagian kiri untuk dapat melakukan
 								proses manajemen konten.
 							</div>
 						</p>
 					</div>
 				</div>
 				
 				
 			</div>
 			
 		</div>
 	</div>
 </div>
 <script>
 	loadmenu();
 	function loadmenu(){
 		$.ajax({
 			url: BASE_URL+'dokumen/menu',
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
 				var menu ='';
 				var nom=0;
 				$.each( data, function( key,value ) {
 					menu += '<div class="panel"><div class="panel-heading">';
 					menu += '<h4 class="panel-title">';
 					menu += '<a data-parent="#demo-acc-info-outline" data-toggle="collapse" class="collapsed"  href="#collapsedok'+nom+'" aria-expanded="false">'+value.nama+'</a>';
 					menu += '</h4>';
 					menu += '</div>'; 
 					
 					if(value.data.length > 0){
 						menu +='<div class="panel-collapse collapse" id="collapsedok'+nom+'" aria-expanded="false" style="height: 0px;">';
 						menu +='<div class="panel-body">';
 						menu +='<div class="list-group bg-trans pad-btm bord-btm">';
 						$.each(value.data,function(keydata,valdata){
												//alert( valdata.nama_menu);
							menu +='<a href="#" onClick="openpage('+valdata.id_tipe+','+valdata.id_dok_master+')" class="list-group-item text-semibold text-main"style="margin-left:10px;padding:3px 15px" >'; 
							menu +='<span class="text-main" style="font-size:11px"> '+valdata.nama_menu+'</span>';
							menu +='</a>';
							
							
						});
 						++nom;
 						
 						menu += '</div>';
 						menu += '</div>';
 						menu += '</div>';
 					}
 					menu +='</div>';
 				});
								//menu +='</ul>';
									//window.location.href = "http://localhost:8888/nittfy/home.html";
									//localStorage.setItem("Token", data.token);
									
					$('#dokumen_menu').html(menu);
					
				},
				error: function( jqXhr, textStatus, errorThrown ){
					alert('error');
				}
			});

 	}
 	
 	function openpage(a,b){
 		$(".isi").load("view/dokumen_list.php?id_tipe="+a+"&id_master="+b);
 		
 	}
 </script>