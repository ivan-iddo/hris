<form role="form" id="form-upload" name="form-upload" method="post" enctype="multipart/form-data">
	<div class="panel">
					    <div class="panel-heading">
					        <h3 class="panel-title">LOGO</h3>
					    </div>
					    <div class="panel-body mar-all" >
						<div class="row"> 
						 <div class="col-md-4">
<div class="form-group">
					                    <label for="demo-vs-definput" class="control-label">Judul</label>
					                    <input id="demo-vs-definput" name="judul" class="form-control judul" type="text">
					                </div>
<div class="form-group">
					                    <label for="demo-vs-definput" class="control-label">Deskripsi</label>
					                    <input id="demo-vs-definput" name="deskripsi" class="form-control deskripsi" type="text">
					                </div>
						 </div>
					    </div>
					         <div class="col-md-4">
                                     
 
 
 
                                    
                                    <img src="" id="img-cover" class="img-responsive pad" style="border:1px solid #999; width:180px; height:200px;">
                                    <label>Upload Logo</label>
                                    <input name="cover_file" id="cover-fl" type="file">
                                    <p class="help-block">jpg, jpeg, png</p>
                                    <button disabled="" style="display:none;" class="btn btn-primary pull-left upload-btn" onclick="upload_cover()"><i class="fa fa-save"></i> Upload</button>
                               
	       <hr>
	       
	        <h3 class="panel-title">Slider 1</h3>
					         <img src="" id="img-cover1" class="img-responsive pad" style="border:1px solid #999; width:180px; height:200px;">
                                    <label>Upload Logo</label>
                                    <input name="cover_file1" id="cover-fl1" type="file">
                                    <p class="help-block">jpg, jpeg, png</p>
                                    <button disabled="" style="display:none;" class="btn btn-primary pull-left upload-btn" onclick="upload_cover()"><i class="fa fa-save"></i> Upload</button>
                              <hr>
	       
	        <h3 class="panel-title">Slider 2</h3>
	      <img src="" id="img-cover2" class="img-responsive pad" style="border:1px solid #999; width:180px; height:200px;">
                                    <label>Upload Logo</label>
                                    <input name="cover_file2" id="cover-fl2" type="file">
                                    <p class="help-block">jpg, jpeg, png</p>
                                    <button disabled="" style="display:none;" class="btn btn-primary pull-left upload-btn" onclick="upload_cover()"><i class="fa fa-save"></i> Upload</button>
                             <hr>
							 <div class="col-lg-4">
					         <div class="btn-group btn-group-justified">
								<a href="javascript:void(0)" class="btn btn-lg btn-info" onCLick="kirimdata()">Submit</a>
							 </div>
							 </div>
					         </div>
							  
							 
</form>
<script>
	
	$.ajax({
			url: BASE_URL+"supplier/get_theme", // Url to which the request is send 
			type: "get",  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				 $('.judul').val(data.title);
				 $('.deskripsi').val(data.description);
				 $('#img-cover').attr('src', BASE_URL+'upload/'+data.logo);
				 $('#img-cover1').attr('src', BASE_URL+'upload/'+data.slider1);
				 $('#img-cover2').attr('src', BASE_URL+'upload/'+data.slider2);
				 
				
				
				}
			});
	
	function kirimdata(){
		var form = $("#form-upload");
		if($('.judul').val() ==''){
			alert('Judul tidak boleh kosong');
			return false;
		}else if($('.deskripsi').val() ==''){
			alert('Deskripsi tidak boleh kosong');
			return false;
		}
		$.ajax({
			url: BASE_URL+"supplier/upload_logo", // Url to which the request is send 
			type: "POST", 
			data: new FormData(form[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				if(data.hasil =='error'){
					alert(data.message);
				}else{
					alert(data.message);
				}
				
				
				}
			});
	}
	 $("#cover-fl").change(function(){
		preview_cover(this);
		
		
	                    });
	 
	 $("#cover-fl1").change(function(){
		
		 if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              $('#img-cover1').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
	                    });
	 
	 
	 $("#cover-fl2").change(function(){
		
		 if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              $('#img-cover2').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
	                    });
	 
	function preview_cover(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              $('#img-cover').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>