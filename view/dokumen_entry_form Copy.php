 <style>
 .wowbook {
			font-family: "Open Sans","Helvetica Neue",Arial,sans-serif;
		}
		.wowbook-page-content {
			padding: 1.5em;
		}
		.wowbook ul {
			padding-left: 1em;
		}
        .book-thumb {
            height: 150px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.5)
        }

		#book1-trigger, #book2-trigger, #book3-trigger {
			cursor: pointer;
		}
		#book1-trigger:hover, #book2-trigger:hover, #book3-trigger:hover {
			background: #f8f8f8;
		}

        .wowbook-lightbox > .wowbook-close {
            background: transparent !important;
            border: none !important;
            color: #222 !important;
            font-size: 2.5em;
        }
        .wowbook-lightbox > .wowbook-close:hover {
            background: #444 !important;
            color: white !important;
            border-radius: 3px;
        }


        .lightbox-images1 .wowbook-book-container {
            background: #6d6b92; /* Old browsers */
            background: -moz-radial-gradient(center, ellipse cover, #ffffff 0%, #6d6b92 100%); /* FF3.6-15 */
            background: -webkit-radial-gradient(center, ellipse cover, #ffffff 0%,#6d6b92 100%); /* Chrome10-25,Safari5.1-6 */
            background: radial-gradient(ellipse at center, #ffffff 0%,#6d6b92 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        }
        .lightbox-images1 > .wowbook-close,
        .lightbox-images2 > .wowbook-close {
            color: #ccc !important;
        }
        .lightbox-images2 .wowbook-book-container {
            background: #1E2831; /* Old browsers */
            background: -moz-radial-gradient(center, ellipse cover, #ffffff 0%, #1E2831 100%); /* FF3.6-15 */
            background: -webkit-radial-gradient(center, ellipse cover, #ffffff 0%,#1E2831 100%); /* Chrome10-25,Safari5.1-6 */
            background: radial-gradient(ellipse at center, #ffffff 0%,#1E2831 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        }



		.lightbox-pdf  .wowbook-book-container {
			background: #e5e5e5 url(img/bg-lightbox-pdf.png); /* Old browsers */
			background: #e5e5e5 -moz-radial-gradient(center, ellipse cover, #ffffff 20%, #bbbbbb 100%); /* FF3.6-15 */
			background: #e5e5e5 -webkit-radial-gradient(center, ellipse cover, #ffffff 20%,#bbbbbb 100%); /* Chrome10-25,Safari5.1-6 */
			background: #e5e5e5 radial-gradient(ellipse at center, #ffffff 20%,#bbbbbb 100%); /* W3C, IE10+, FF16+, Chrome26+,Opera12+, Safari7+*/
		}


		.lightbox-html  .wowbook-book-container {
			background: url(img/book_html/wood.jpg);
		}
		.lightbox-html .wowbook-toolbar {
			margin-top: 1em; /* FIXME */
			box-sizing: content-box !important;
		}

		.lightbox-html .wowbook-controls {
			border-radius: 6px;
			width: auto;
		}

		.lightbox-html.wowbook-mobile .wowbook-toolbar {
			margin: 0;
		}

		.lightbox-html.wowbook-mobile .wowbook-controls {
			border-radius: 0;
			width: 100%;
		}
 </style>
               

    <div style="display: none"> 
        <div class="rubahid" id="book2"></div>  
    </div>
    <div class="mar-all ">
    <div class="box-body" >
            <form role="form" id="form-upload" name="form-upload" method="post" enctype="multipart/form-data">
            <div class="box-group " id="accordion">
                <div class="panel box box-primary" style="border:none;border-top: 1px solid #F44C27;">
                    <div class="box-header">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1a">
                            Area Identitas
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1a" class="panel-collapse collapse ">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input name="editid" value="" type="hidden">
                                        <label>No. Dokumen</label>
                                        <input name="nodoc" id="nodoc" value="" class="form-control easyui-validatebox" placeholder="" data-options="required:true" type="text">
                                        <input name="id_tipe" id="id_tipe" value="<?php echo $_GET['id_tipe']?>" style="display:none" class="form-control easyui-validatebox" placeholder="" data-options="required:true" type="text">
                                        <input name="id_master" id="id_master" value="<?php echo $_GET['id_master']?>" style="display:none" class="form-control easyui-validatebox" placeholder="" data-options="required:true" type="text">
                                    <input id="user_group" name="user_group" class="form-control" placeholder="" data-options="required:true" style="width:150px;display:none" type="text">
                                    <input id="user_id" name="user_id" class="form-control" placeholder="" data-options="required:true" style="width:150px;display:none" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Judul Dokumen</label>
                                        <input name="titledoc" id="titledoc" value="" class="form-control easyui-validatebox" placeholder="" data-options="required:true" type="text">
                                        <input name="id_data" id="id_data"  value="<?php  echo (!empty($_GET['id_data']))? $_GET['id_data']:'';?>" class="form-control easyui-validatebox" style="display:none" type="text">
                                    </div>
                                    <div class="form-group col-md-4">
                                         
                                        <label>Tanggal Pembuatan</label><br>
                                        <input name="created_date" value="<?php echo date('Y-m-d')?>" id="created_date" class="form-control date-dp-txtinput" style="width:150px">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>JRA / Retensi</label><br>
                                        <input name="jra_date" value="<?php echo date('Y-m-d')?>" id="jra_date" class="form-control JRA-dp-txtinput" style="width:150px">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                     
 
 
 
                                    
                                    <img src="" id="img-cover" class="img-responsive pad" style="border:1px solid #999; width:180px; height:200px;">
                                    <label>Upload Cover</label>
                                    <input name="cover_file" id="cover-fl" type="file">
                                    <p class="help-block">jpg, jpeg, png</p>
                                    <button disabled="" style="display:none;" class="btn btn-primary pull-left upload-btn" onclick="upload_cover()"><i class="fa fa-save"></i> Upload</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Unit Kerja</label>
                                <select class="form-control" id="select_uk" name="select_uk">
                                                 
                                </select>
                            </div>

                            
                            <div class="form-group">
                                <label>Tipe Media</label><br>                                
                                 <div id="media_type" class="media_type"></div>
                            </div>
                            <div class="form-group">
                                <label>Kategori Dokumen</label><br>
                                <div id="kategori_dokumen" class="kategori_dokumen"></div>
                            </div>
                         

                            <div class="form-group">
                                <label>Format</label><br>
                                <div id="format_dok" class="format_dok"></div>
                            </div>
                           
                            <div class="form-group">
                                <label>Status</label><br>
                                 <div id="status_dok" class="status_dok"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                     <div class="form-group">
                                <label>Latitude</label>
                                <input  id="lati" name="lati" class="form-control easyui-validatebox" placeholder="" value="" type="text">
                            </div>
                                </div>
                                <div class="col-lg-6">
                                     <div class="form-group">
                                <label>Longitude</label>
                                <input  id="longi" name="longi" class="form-control easyui-validatebox" placeholder="" value="" type="text">
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel box box-primary" style="border:none;border-top: 1px solid #F44C27;">
                    <div class="box-header">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2a">
                            Area Titik Temu
                            </a>
                        </h4>
                    </div>
                    <div id="collapse2a" class="panel-collapse collapse">
                        <div class="box-body">
                            <div>
                                <label>Lokasi Dokumen</label> |                                  
                                <div class="btn btn-xs btn-default btn-success" id="demo-bootbox-bounce">Tambah Lokasi Baru</div>
                                
                                <select id="lokasiarsip" name="lokasiarsip" class="form-control" onchange="setArsipFields(this.value);" style="width:80%">
                                </select>

                            </div>

                            <!-- get lokar detail -->
                            
                            <div class="form-group">
                                <label>Gedung</label>
                                <input readonly="" id="gedung" name="gedung" class="form-control easyui-validatebox" placeholder="" value="" type="text">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea readonly="" id="alamat" name="alamat" class="form-control easyui-validatebox"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Lantai</label>
                                <input readonly="" id="lantai" name="lantai" class="form-control easyui-validatebox" placeholder="" value="" type="text">
                            </div>
                            <div class="form-group">
                                <label>Ruang</label>
                                <input readonly="" id="ruang" name="ruang" class="form-control easyui-validatebox" placeholder="" value="" type="text">
                            </div>
                            <div class="form-group">
                                <label>Rak</label>
                                <input readonly="" id="rak" name="rak" class="form-control easyui-validatebox" placeholder="" value="" type="text">
                            </div>
                            <div class="form-group">
                                <label>Box</label>
                                <input readonly="" id="box" name="box" class="form-control easyui-validatebox" placeholder="" value="" type="text">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                     <div class="form-group">
                                <label>Latitude</label>
                                <input readonly="" id="lat" name="lat" class="form-control easyui-validatebox" placeholder="" value="" type="text">
                            </div>
                                </div>
                                <div class="col-lg-6">
                                     <div class="form-group">
                                <label>Longitude</label>
                                <input readonly="" id="lng" name="lng" class="form-control easyui-validatebox" placeholder="" value="" type="text">
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel box box-primary" style="border:none;border-top: 1px solid #F44C27;">
                    <div class="box-header">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3a">
                            Area Deskripsi
                            </a>
                        </h4>
                    </div>
                    <div id="collapse3a" class="panel-collapse collapse">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Deskripsi Dokumen/Abstrak</label>
                                 <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Kata Kunci</label>
                                <input value="" name="kunci" id="kunci" class="form-control easyui-validatebox" placeholder="" data-options="required:true" type="text">
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="panel box box-primary" style="border:none;border-top: 1px solid #F44C27;">
                    <div class="box-header">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4a">
                            Area Akses
                            </a>
                        </h4>
                    </div>
                    <div id="collapse4a" class="panel-collapse collapse">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Area Akses</label><br>
                                 <div id="area_akses"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel box box-primary" style="border:none;border-top: 1px solid #F44C27;">
                    <div class="box-header">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5a">
                            Area Objek Digital
                            </a>
                        </h4>
                    </div>
                    <div id="collapse5a" class="panel-collapse collapse">
                        <div class="box-body">
                            <div class="row">
                            
                                <div class="col-xs-12"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> Simpan data dokumen terlebih dahulu sebelum melakukan upload file</div></div>
                                <div class="row pad-all mar-all">

                                    <div class="form-group">
                                        <label>Upload Dokumen</label>
                                        <input disabled="" name="doc_file" id="doc_file" type="file">
                                        <p class="help-block">Semua ekstensi file <br> Max. 50 MB</p>
                                    </div>
                                    <div class="form-group">
                                         <div id="uploadbtn" class="btn btn-primary pull-left upload-btn" onclick="upload_file()"><i class="fa fa-save"></i> Upload</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- <ul id="list-file"> -->
                                                                            <!-- </ul> -->

                                                                        <table id="table-files" class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama File</th>
                                                <th>Tanggal</th>
                                                <th>Uploader</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list_file">

                                        
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                
                <div class="panel box box-primary" style="border:none;border-top: 1px solid #F44C27;">
                    <div class="box-header">
                        <h4 class="box-title">
                                                            <a onClick="gotoatribute()"  data-toggle="collapse" data-parent="#accordion" href="#collapse6a">
                                    Area Atribut Khusus
                                </a>
                                                    </h4>
                    </div>
                    <div id="collapse6a" class="panel-collapse collapse">
                        <div class="box-body">
                            <div class="col-xs-12"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> Simpan data dokumen terlebih dahulu sebelum menambahkan Atribut Khusus</div></div>
                            
                            
                        </div>
                    </div>
                </div>
                
            </div> 
            </form>
            <div class="form-group">
                <div id="editBtn" class="btn btn-success pull-right" onclick="getEdit()" style="display: inherit;"><i class="fa fa-pencil"></i> Go to Edit</div>
            <button id="saveBtn" class="btn btn-primary pull-right" onClick="submit_data()"><i class="fa fa-save"></i> Simpan</button>
                   <br><p></p> 
            <br>
            </div>
             
           </div>
     
    </div>

<script>
    
     
    
    
    getOptions("lokasiarsip",BASE_URL+'dokumen/getlokasi_arsip');
    getInputTypeOptions("media_type",BASE_URL+'dokumen/gettaksonomi?id=16');
    getInputTypeOptions("kategori_dokumen",BASE_URL+'dokumen/gettaksonomi?id=17');
    getInputTypeOptions("format_dok",BASE_URL+'dokumen/gettaksonomi?id=18');
    getInputTypeOptions("status_dok",BASE_URL+'dokumen/gettaksonomi?id=19');
    getInputTypeOptions("area_akses",BASE_URL+'dokumen/gettaksonomi?id=20');
    $('#editBtn').hide();
    
     
     
    if($('#id_data').val()===''){
        
          $('#doc_file').prop('disabled', true);
          $('#uploadbtn').hide();
    }else{
        disabledAll();
        $.ajax({
                                   url: BASE_URL+'dokumen_entry/list_entry_detail?id='+$('#id_data').val(),
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( res, textStatus, jQxhr ){
                                    if(res.list){
                                        listdata_file(res);
                                    }
                                    
                                   $('#nodoc').val(res.list_item.no_dok);
                                   $('#titledoc').val(res.list_item.judul);
                                   $('#created_date').val(res.list_item.tanggal_pembuatan);
                                   $('#jra_date').val(res.list_item.JRA);
                                   $('#gedung').val(res.list_item.gedung);
                                   $('#alamat').val(res.list_item.alamat);
                                   $('#lantai').val(res.list_item.lantai);
                                    $('#ruang').val(res.list_item.ruang);
                                     $('#rak').val(res.list_item.no_rak);
                                      $('#box').val(res.list_item.no_box);
                                      $('#lat').val(res.list_item.lat);
                                      $('#lng').val(res.list_item.lng);
                                      $('#lati').val(res.list_item.lati);
                                      $('#longi').val(res.list_item.longi);
                                       $('#deskripsi').val(res.list_item.deskripsi);
                                      $('#kunci').val(res.list_item.keyword);
                                      
                                      $("#img-cover").attr("src",BASE_URL+'upload/'+res.list_item.cover_photo);
                                   getOptionsEdit("select_uk",BASE_URL+'dokumen/getuk?id=<?php echo $_GET['id_tipe']?>',res.list_item.id_uk);
                                   getOptionsEdit("lokasiarsip",BASE_URL+'dokumen/getlokasi_arsip',res.list_item.id_lokasi);
                                   getInputTypeOptionsEdit("media_type",BASE_URL+'dokumen/gettaksonomi?id=16',res.list_item.tipe_media);
                                    getInputTypeOptionsEdit("kategori_dokumen",BASE_URL+'dokumen/gettaksonomi?id=17',res.list_item.kategori_dokumen);
                                    getInputTypeOptionsEdit("format_dok",BASE_URL+'dokumen/gettaksonomi?id=18',res.list_item.format);
                                    getInputTypeOptionsEdit("status_dok",BASE_URL+'dokumen/gettaksonomi?id=19',res.list_item.status);
                                    getInputTypeOptionsEdit("area_akses",BASE_URL+'dokumen/gettaksonomi?id=20',res.list_item.id_area_akses);
                                   
                                   
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
        
        
    }
    
    
   
    function getEdit(){
        $('#doc_file').prop('disabled', false);  
        $('#nodoc').prop('disabled', false);
                                                                                              $('#titledoc').prop('disabled', false);
                                                                                              $('#created_date').prop('disabled', false);
                                                                                              $('#jra_date').prop('disabled', false);
                                                                                              $('#cover-fl').prop('disabled', false);
                                                                                              $('#select_uk').prop('disabled', false);
                                                                                              $('#f_media_type').prop('disabled', false);
                                                                                              $('#f_kategori_dokumen').prop('disabled', false);
                                                                                              $('#f_format_dok').prop('disabled', false);
                                                                                              $('#f_status_dok').prop('disabled', false);
                                                                                              $('#deskripsi').prop('disabled', false);
                                                                                              $('#kunci').prop('disabled', false);
                                                                                              $('#f_area_akses').prop('disabled', false);
                                                                                              $('#lokasiarsip').prop('disabled', false);
                                                                                              $('#uploadbtn').show();
                                                                                              $('#editBtn').hide();
                                                                                              $('#saveBtn').show();
                                                                                                $('#lati').prop('disabled', false);
                                                                                              $('#longi').prop('disabled', false);
    }
    
    function disabledAll(){
                                                          $('#nodoc').prop('disabled', true);
                                                                                              $('#titledoc').prop('disabled', true);
                                                                                              $('#created_date').prop('disabled', true);
                                                                                              $('#jra_date').prop('disabled', true);
                                                                                              $('#cover-fl').prop('disabled', true);
                                                                                              $('#select_uk').prop('disabled', true);
                                                                                              $('#f_media_type').prop('disabled', true);
                                                                                              $('#f_kategori_dokumen').prop('disabled', true);
                                                                                              $('#f_format_dok').prop('disabled', true);
                                                                                              $('#f_status_dok').prop('disabled', true);
                                                                                              $('#deskripsi').prop('disabled', true);
                                                                                              $('#kunci').prop('disabled', true);
                                                                                              $('#f_area_akses').prop('disabled', true);
                                                                                              $('#lokasiarsip').prop('disabled', true);
                                                                                              $('#uploadbtn').hide();
                                                                                              $('#editBtn').show();
                                                                                              $('#saveBtn').hide();
                                                                                              
                                                                                              $('#lati').prop('disabled', true);
                                                                                              $('#longi').prop('disabled', true);
    }
    
    $.ajax({
                                   url: BASE_URL+'Auth/getug',
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( res, textStatus, jQxhr ){
                                   
                                    $('#user_group').val(res.group);
                                    $('#user_id').val(res.user_id);
                                    getOptionsEdit("select_uk",BASE_URL+'dokumen/getuk?id=<?php echo $_GET['id_tipe']?>',res.id_uk);
                                     
                    // gridOptions.api.setRowData(data);
               
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
    
    
     // BOOTSTRAP DATEPICKER
    // =================================================================
    // Require Bootstrap Datepicker
    // http://eternicode.github.io/bootstrap-datepicker/
    // =================================================================
    $('.date-dp-txtinput').datepicker({
    format: "yyyy-mm-dd",
    todayBtn: "linked",
    autoclose: true
    });
$('.JRA-dp-txtinput').datepicker({
    format: "yyyy-mm-dd",
    todayBtn: "linked",
    autoclose: true 
    });

    function setArsipFields(a){
        $.ajax({
                                   url: BASE_URL+'dokumen/getlokasi_arsip?id='+a,
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( res, textStatus, jQxhr ){
                                   $('#gedung').val(res.result.nama);
                                   $('#alamat').val(res.result.alamat);
                                   $('#ruang').val(res.result.ruang);
                                   $('#lantai').val(res.result.lantai);
                                   $('#rak').val(res.result.no_rak);
                                   $('#box').val(res.result.no_box); 
                    // gridOptions.api.setRowData(data);
               
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
    }
     
    $('#demo-bootbox-bounce').on('click', function(){
           
            
           var input='<div class="form-horizontal">';
           input += '<div class="panel-body">';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Kode Arsip*<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_kode_arsip" id="f_kode_arsip" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Gedung*<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_id_edit" id="f_id_edit" style="width: 220px;display:none" class="form-control"/>';
           input +='<input type="text" name="f_user_edit" id="f_user_edit" style="width: 220px;display:none" class="form-control"/>';
           input +='<input type="text" name="f_nama" id="f_nama" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Alamat<\/label>';
           input +='<div class="col-sm-5">';
           input +='<textarea name="f_alamat" id="f_alamat"></textarea>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Lantai<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_lantai" id="f_lantai" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Ruang<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_ruang" id="f_ruang" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">No.Rak<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_norak" id="f_norak" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">No.Box<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_nobox" id="f_nobox" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Deskripsi<\/label>';
           input +='<div class="col-sm-5">';
           input +='<textarea name="f_deskripsi" id="f_deskripsi"></textarea>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Latitude<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_lat" id="f_lat" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Longitude<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_lng" id="f_lng" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input += '<\/div>'; 
           input +='<\/div>';
           
           
                bootbox.dialog({
                   title: "<i class=\"fa fa-user\"><\/i> Tambah Lokasi Dokumen",
                   message:input, 
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-primary",
                           callback: function() {
                               
                               
                                                var  nama      = $("#f_nama").val(); 
                                                var f_id_edit = $("#f_id_edit").val();
                                                var f_user_edit     = $("#f_user_edit").val();
                                                var f_kode_arsip = $("#f_kode_arsip").val();
                                                var f_alamat = $("#f_alamat").val();
                                                var f_lantai = $("#f_lantai").val();
                                                var f_ruang = $("#f_ruang").val();
                                                var f_norak = $("#f_norak").val();
                                                var f_nobox = $("#f_nobox").val();
                                                var f_deskripsi = $("#f_deskripsi").val();
                                                var f_lat = $("#f_lat").get(0).value;
                                                var f_lng = $("#f_lng").get(0).value;
                                                 
                                                if(nama==""){
                                                    onMessage("Data 'Nama' is required");
                                                    $("#f_nama").focus();
                                                    return false;
                                                }else if(f_kode_arsip==""){
                                                    onMessage("Kode Arsip tidak boleh kosong");
                                                    $("#f_kode_arsip").focus();
                                                 }else{
                                                     
                                                    
                                                    var datas = {
                                                            nama:nama,
                                                            f_id_edit:f_id_edit,
                                                            f_user_edit:f_user_edit,
                                                            f_lantai : f_lantai,
                                                             f_ruang : f_ruang,
                                                             f_norak : f_norak,
                                                             f_nobox : f_nobox,
                                                             f_deskripsi : f_deskripsi,
                                                             f_alamat:f_alamat,
                                                             f_kode_arsip:f_kode_arsip,f_lat:f_lat,f_lng:f_lng
                                                        };
                                                        
                                                    var hasil;
                                                    var message;
                                                        $.ajax({
                                                                url: BASE_URL+"dok_lok/save",
                                                                headers: {
                                                                        'Authorization': localStorage.getItem("Token"),
                                                                        'X_CSRF_TOKEN':'donimaulana',
                                                                        'Content-Type':'application/json'
                                                                        },
                                                                        dataType: 'json',
                                                                        type: 'post',
                                                                        contentType: 'application/json', 
                                                                        processData: false,
                                                                        data:JSON.stringify(datas),
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
                                                                                             getOptions("lokasiarsip",BASE_URL+'dokumen/getlokasi_arsip');
                                                                                               $('.modal').modal('hide');
                                                                                         }else{
                                                                                                alert(message);
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
                       },

                       main: {
                           label: "Cancel",
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
           });
    
     
    
    $("#cover-fl").change(function(){
        preview_cover(this);
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
      
     

    function submit_data(){
          
        var nodoc = $("#nodoc").val();
        var titledoc = $('#titledoc').val();
        var created_date = $('#created_date').val();
        var jra_date = $('#jra_date').val();
        var cover = $('#cover-fl').val();
        var media_type = $('#f_media_type').val();
        var kategori_dokumen = $('#f_kategori_dokumen').val();
        var format_dok = $('#f_format_dok').val();
        var status_dok = $('#f_status_dok').val();
        var select_uk = $('#select_uk').val();
        var area_akses = $('#f_area_akses').val();
        var deskripsi = $('#deskripsi').val();
        var kunci = $('#kunci').val();
        var lokasiarsip = $('#lokasiarsip').val();
        var id_master = $('#id_master').val();
        var id_tipe = $('#id_tipe').val();
        var files_cover = cover.files;
       
        
        if(nodoc==""){
                           onMessage("No.Dokumen wajib di isi!");
                           $("#nodoc").focus();
                           return false;
                       }else if(titledoc==""){
                           onMessage("Judul Dokumen tidak boleh kosong");
                           $("#titledoc").focus();
                        }else{
                             
                            
                            
                            
                             var datas = {   nodoc :nodoc,
                                            titledoc :titledoc ,
                                            created_date :created_date,
                                            jra_date : jra_date,
                                            cover :cover ,
                                            media_type :media_type ,
                                            kategori_dokumen :kategori_dokumen ,
                                            format_dok :format_dok ,
                                            status_dok : status_dok,
                                            select_uk :select_uk ,
                                            area_akses :area_akses ,
                                            deskripsi : deskripsi,
                                            kunci : kunci,
                                            lokasiarsip:lokasiarsip,
                                            id_master : id_master,
                                            id_tipe:id_tipe,
                                            files_cover:files_cover,
                                            user_group:user_group
                                        }
                var id_data = $('#id_data').val();
                if(id_data !== ''){
                      URLNYA = 'edit_entry';
                }else{
                      URLNYA = 'save_entry';
                }
var form = $("#form-upload");   
$.ajax({
url: BASE_URL+"supplier/"+URLNYA, // Url to which the request is send 
type: "POST", 
data: new FormData(form[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
    hasil=data.hasil;
   
    
                                                                                message=data.message; 
                                                                                   if(hasil=="success"){         
                                                                                              
                                                                                              $('#id_data').val(data.id);
                                                                                              $('#doc_file').prop('disabled', false);
                                                                                              $('#nodoc').prop('disabled', true);
                                                                                              $('#titledoc').prop('disabled', true);
                                                                                              $('#created_date').prop('disabled', true);
                                                                                              $('#jra_date').prop('disabled', true);
                                                                                              $('#cover-fl').prop('disabled', true);
                                                                                              $('#select_uk').prop('disabled', true);
                                                                                              $('#f_media_type').prop('disabled', true);
                                                                                              $('#f_kategori_dokumen').prop('disabled', true);
                                                                                              $('#f_format_dok').prop('disabled', true);
                                                                                              $('#f_status_dok').prop('disabled', true);
                                                                                              $('#deskripsi').prop('disabled', true);
                                                                                              $('#kunci').prop('disabled', true);
                                                                                              $('#f_area_akses').prop('disabled', true);
                                                                                              $('#lokasiarsip').prop('disabled', true);
                                                                                              $('#uploadbtn').show();
                                                                                              $('#editBtn').show();
                                                                                              $('#saveBtn').hide();
                                                                                               $.niftyNoty({
                                                                                                               type: 'success',
                                                                                                               title: 'Success',
                                                                                                               message: message,
                                                                                                               container: 'floating',
                                                                                                               timer: 5000
                                                                                                           });  
                                                                                         }else{
                                                                                                alert(message);
                                                                                              return false;	
                                                                                         }
}
});
                            
                            
                            
                            
                        }
    }
    
    function listdata_file(data){
        var data_file = '';
        var nom = 0;
        $.each(data.list , function(index, val) {
            ++nom;
                                            data_file += '<tr>';
                                                                                                                             data_file += '<td>';
                                                                                                                             data_file += val.nama;
                                                                                                                             data_file += '</td>';
                                                                                                                             data_file += '<td>';
                                                                                                                             data_file += val.tanggal;
                                                                                                                             data_file += '</td>';
                                                                                                                             data_file += '<td>';
                                                                                                                             data_file += val.author;
                                                                                                                             data_file += '</td>';
                                                                                                                             data_file += '<td>';
                                                                                                                             data_file += '<a title="Lihat File" id="book'+nom+'-trigger" class="btn btn-default" href="javascript:void(0)" onCLick="buildBook(\'#book'+nom+'-trigger\',\''+val.nama+'\')"><i class="fa fa-eye"></i></a>';
                                                                                                                             
                                                                                                                             
                                                                                                                             data_file += '<a title="Download File" class="btn btn-default" href="'+val.nama+'" target="_blank" download=""><i class="fa fa-download"></i></a>';
                                                                                                                             data_file += '<a title="Hapus File" class="btn btn-danger" href="javascript:void(0)" onclick="hapusfile('+val.id+')"><i class="fa fa-trash"></i></a></td>';
                                                                                                                             data_file += '</td>';
                                                                                                                             data_file += '</tr>';
                                                                                                                          });
                                                                                                                         
                                                                                                                        $('#list_file').html(data_file);
    }
    
    function hapusfile(a){
        var id_data = $('#id_data').val();
        $.ajax({
                                   url: BASE_URL+'dokumen_entry/hapus_file?id='+a+'&id_data='+id_data,
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( res, textStatus, jQxhr ){
                                    
                                                                                            $.niftyNoty({
                                                                                            type: 'success',
                                                                                            title: 'Success',
                                                                                            message: res.message,
                                                                                            container: 'floating',
                                                                                            timer: 5000
                                                                                            }); 
               listdata_file(res);
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
    }
     
     function upload_file(){
                var form = $("#form-upload");
                    if($('#id_data').val()!==''){
                            $.ajax({
                            url: BASE_URL+"supplier/upload_data", // Url to which the request is send 
                            type: "POST", 
                            data: new FormData(form[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                            contentType: false,       // The content type used when sending data to the server.
                            cache: false,             // To unable request pages to be cached
                            processData:false,        // To send DOMDocument or non processed data file it is set to false
                            success: function(data)   // A function to be called if request succeeds
                            {
                                hasil=data.hasil;
                               
                                
                                                                                                            message=data.message; 
                                                                                                               if(hasil=="success"){
                                                                                                                 listdata_file(data);
                                                                                                                        
                                                                                                                           $.niftyNoty({
                                                                                                                                           type: 'success',
                                                                                                                                           title: 'Success',
                                                                                                                                           message: message,
                                                                                                                                           container: 'floating',
                                                                                                                                           timer: 5000
                                                                                                                                       });  
                                                                                                                     }else{
                                                                                                                            alert(message);
                                                                                                                          return false;	
                                                                                                                     }
                            }
                            });
                }
    }
     
     
 
 
</script>
 
<?php if($_GET['id_master']=='11'){?>
<script>function gotoatribute(){ 
        if($('#id_data').val() !==''){
            $(".isi").load('view/dokumen_entry_form_jembatan.php?id_data='+$('#id_data').val()+'&id_tipe=<?php echo $_GET['id_tipe'];?>&id_master=<?php echo $_GET['id_master'];?>');
        }
        return false;
     };</script>
<?php }else{ ?>
<script>function gotoatribute(){ 
        if($('#id_data').val() !==''){
            $(".isi").load('view/dokumen_entry_form_atribut.php?id_data='+$('#id_data').val()+'&id_tipe=<?php echo $_GET['id_tipe'];?>&id_master=<?php echo $_GET['id_master'];?>');
        }
        return false;
     };</script>
<?php }?>


   
 <script type="text/javascript">
       
            function fullscreenErrorHandler(){
                if (self!=top) return "The frame is blocking full screen mode. Click on 'remove frame' button above and try to go full screen again."
            }

            // imageBook = ["1", "8"][ Math.floor(Math.random()*2)];
            // imageBookPath = "./img/magazine_template_0"+imageBook+"/";
            // $("#book1-trigger .book-thumb").attr("src", imageBookPath+"image_000.jpg")

            function myBook(urlpdf,elem){
                   
                   var optionsBook2 = {
                 height   : 1024
                ,width    : 725*2 
                ,pageNumbers: false

                ,pdf: urlpdf
                ,pdfFind: true
                ,pdfTextSelectable: true 
                ,lightbox : elem
                ,lightboxClass : "lightbox-pdf"
                ,centeredWhenClosed : true
                ,hardcovers : true
                ,curl: false
                ,toolbar: "lastLeft, left, currentPage, right, lastRight, find, toc, zoomin, zoomout, download, flipsound, fullscreen, thumbnails"
                ,thumbnailsPosition : 'bottom'
                ,responsiveHandleWidth : 50
                ,onFullscreenError: fullscreenErrorHandler
            };
            
            
return optionsBook2;
            }

            
            

           

            function buildBook( elem,urlpdf ){
               var elemen = elem;
                    var isPDF =  urlpdf.substr(-3);
                    var elem = elem.replace("-trigger", "");
                     $('.rubahid').attr('id', elem.replace("#",""));
                // alert(elem);
                    if(isPDF !== 'pdf'){
                         window.open(urlpdf); 
                    }else{
                        
                        var book=$.wowBook(elem);
                  
               // if (!book) {
                   // alert(JSON.stringify(myBook(urlpdf,elemen)));
                    $(elem).wowBook(myBook(urlpdf,elemen));
                      book=$.wowBook(elem);
                //} 
                  
                   
                    
                 
                 
                        
                        // book.opts.onHideLightbox = function(){
                        //     setTimeout( function(){ book.destroy(); }, 1000);
                        // }
                        
                       
                         
                          book.showLightbox();
                         
                          
                        
                    }
                
            }


       
    </script>
   