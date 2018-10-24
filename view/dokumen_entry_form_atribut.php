  
    <div class="col-xs-12" style="background:#fff;padding:20px">
                            <!--PAGE CONTENT BEGINS-->
                            
<div class="row">
  <div class="col-sm-12">
    <!-- <a href="http://sikumis.binamarga.pu.go.id/survey_data/nodeedit/92/vmode" id="btn-back" class="btn btn-info pull-left" style="margin-right:20px;"><i class="fa fa-chevron-left"></i> Back</a> -->
    <a href="javascript:void(0)" id="btn-back" onClick="gotoatribute();" class="btn btn-info pull-left"><i class="fa fa-chevron-left"></i> Back</a>
    <span style="margin:0 10px;"></span>
     
  </div>
</div>

<div style="height:20px;"></div>

<div class="box">
  <div class="box-header with-border">
    <h4 class="box-title">Detail Dokumen</h4>
     
  </div>
  <div class="box-body">
  <div class="row">
      <div class="col-sm-3"> 
      </div>
      <div class="col-sm-7">
        
      </div>
    </div>
  <div class="row">
      <div class="col-sm-3">
        <strong>Jenis Dokumen</strong>
      </div>
      <div class="col-sm-7">
        : <span id="jenis_dok"></span>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3">
        <strong>Tipe Dokumen</strong>
      </div>
      <div class="col-sm-7">
        : <span id="nama_tipe"></span>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3">
        <strong>No. Dokumen</strong>
      </div>
      <div class="col-sm-9">
        : <span id="no_dok"></span>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3">
        <strong>Nama Dokumen</strong>
      </div>
      <div class="col-sm-7">
        :  <span id="judul"></span>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3">
        <strong>Tanggal Buat</strong>
      </div>
      <div class="col-sm-7">
        : <span id="tanggal_pembuatan"></span>
      </div>
    </div>
    
  </div>
</div>

 <hr>
  
<div class="box">
  <div class="box-header with-border">
    <h4 class="box-title">Input Atribut Khusus Utama</h4>
     
  </div>
  <div class="box-body">
      <form class="form-horizontal" method="post" action="#">
        <input name="id_data" id="id_data"  value="<?php  echo (!empty($_GET['id_data']))? $_GET['id_data']:'';?>" class="form-control easyui-validatebox" style="display:none" type="text">
        <input name="id_atribut" id="id_atribut"  class="form-control easyui-validatebox" style="display:none" type="text">
                <div class="col-xs-12"></div>
                
                                <div class="form-group">
                    <label class="control-label col-sm-3">Nama Kegiatan:</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="nama_kegiatan" placeholder="Nama Kegiatan" name="atribut_khusus[]" type="text"><input name="label_atribut_khusus[]" value="nama_kegiatan" type="hidden"></div>
                </div>
                
                                <div class="form-group">
                    <label class="control-label col-sm-3">Lokasi Kegiatan (Provinsi):</label>
                    <div class="col-sm-9">
                      <select id="f_provinsi1" name="atribut_khusus[]" class="form-control select2 select2-hidden-accessible" style="width:100%" tabindex="-1" aria-hidden="true" onChange="jalanProv(this.value)">
                      </select>    
                    </div>
                                </div>
                                <div class="form-group">
                    <label class="control-label col-sm-3">Nilai Kegiatan (Rp.):</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="nilai_kegiatan" placeholder="Nilai Kegiatan" name="atribut_khusus[]" type="text"><input name="label_atribut_khusus[]" value="nilai_kegiatanj" type="hidden"></div>
                </div>
                
                
                
                
                
                                <div class="form-group">
                    <label class="control-label col-sm-3">Masa Pelaksanaan Kegiatan (Hari):</label>
                    <div class="col-sm-9">
                      <input step="1" id="lama_kegiatan" class="form-control" placeholder="Masa Pelaksanaan Kegiatan" name="atribut_khusus[]" type="number"><input name="label_atribut_khusus[]" value="masa_pelaksanaan_kegiatan" type="hidden"></div>
                </div>
                
                
                
                
                
                
                
                
                
                               
                <div class="form-group">
                <input name="area_identity_id" value="92" type="hidden"><div class="col-sm-10 col-sm-offset-2">
                  <div id="edit1" type="submit" class="btn btn-warning" onClick="simpan_utama()"><i class="fa fa-edit"></i> Edit changes</div>
                  <div id="new1" type="submit" class="btn btn-success" onClick="new1_utama()"><i class="fa fa-save"></i> New </div>
                  <div id="delete1" type="submit" class="btn btn-danger" onClick="delete1()"><i class="fa fa-close"></i> Hapus</div>
           
                  <div id="simpan1" type="submit" class="btn btn-primary" onClick="simpan_utama()"><i class="fa fa-save"></i> Save changes</div>
                  </div>
                </div>
        </form>
  </div><!-- /.box-body -->
</div> 
<div class="box">
  
  <div class="box-body">
    <div class="ag-theme-balham" id="myGrid1" style="height: 250px;width:100%;"></div>
    </div>



    </div>
    <div class="col-xs-12" style="background:#fff;margin-top:10px">
  <div class="panel-group accordion" id="accordion">
					            <div class="panel">
                        <!--Accordion title-->
					                <div class="panel-heading">
					                    <h4 class="panel-title">
					                        <a data-parent="#accordion" data-toggle="collapse" href="#collapseOne" aria-expanded="true" class="">Input Atribut Khusus</a>
					                    </h4>
					                </div>
                          <!--Accordion content-->
					                <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
					                    <div class="panel-body">
                                <div class="box">
    <div class="box-header with-border"> 
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <form class="form-horizontal" method="post" action="http://sikumis.binamarga.pu.go.id/survey_data/save_atribut_khusus">

         

        <div class="form-group">
            <label class="control-label col-sm-2" id="title-ruas">Ruas Jalan</label>
            <div class="col-sm-5">

              <!-- select ruas -->
              <div id="div-sel-ruas">
                <select id="f_ruasjalan" class="form-control select2 select2-hidden-accessible" id="cmb-ruas" name="ruas_data" style="width:100%" tabindex="-1" aria-hidden="true" onChange="getRuasData(this.value)">
                </select>
                  </div>
            </div>
            <div class="col-sm-4">
               <div class="btn btn-xs btn-default btn-success" id="demo-bootbox-bounce">Tambah Jalan Baru</div>
            </div>
        </div>

        
        
        <div class="form-group" id="group-nomor" style="display: block;">
            <label class="control-label col-sm-2">Nomor Jalan </label>
            <div class="col-sm-9">
              <input id="txt-nomor" class="form-control easyui-validatebox extra-field validatebox-text" value="" name="nomor" placeholder="" type="text"></div>
        </div>

        
        <div class="form-group" id="group-nama" style="display: block;">
            <label class="control-label col-sm-2">Nama Jalan</label>
            <div class="col-sm-9">
              <input id="txt-nama" class="form-control easyui-validatebox extra-field validatebox-text" name="nama" value="" placeholder="" type="text">
            <input id="id_atribut2" style="display:none" class="form-control easyui-validatebox extra-field validatebox-text" name="nama" value="" placeholder="" type="text">
            </div>
        </div>

                <div class="form-group">
            <label class="control-label col-sm-2">Jenis Penanganan </label>
            <div class="col-sm-9">
              <input id="jenis_penanganan" class="form-control easyui-validatebox extra-field validatebox-text" name="jenis_penanganan" value="" placeholder="" type="text"></div>
        </div>
        
                <div class="form-group">
            <label class="control-label col-sm-2">Panjang Penanganan (KM)</label>
            <div class="col-sm-9">
              <input id="panjang_penanganan" step="0.01" class="form-control easyui-validatebox extra-field validatebox-text" name="panjang_penanganan" value="" placeholder="" type="number"></div>
        </div>
         
        <input id="id_prov" name="id_prov" style="display:none" value="">
        <input id="id_now" name="id_now" style="display:none" value="">
        
        <div class="form-group">
          <div class="col-sm-9 col-sm-offset-2">
            <div id="edit2" type="submit" class="btn btn-warning" onClick="simpan2()"><i class="fa fa-edit"></i> Edit changes</div>
            
             <div id="new2" type="submit" class="btn btn-success" onClick="new2()"><i class="fa fa-save"></i> New </div>
            <div id="delete2" type="submit" class="btn btn-danger" onClick="delete2()"><i class="fa fa-close"></i> Hapus</div>
           
                  
            <div id="simpan2" type="submit" class="btn btn-primary" onClick="simpan2();"><i class="fa fa-check"></i> Submit</div>
          </div>
        </div>

      </form>
    </div><!-- /.box-body -->
					                    </div>
					                </div>
                        </d>
  </div>
  
  </div>

  <div class="box">
    <div class="box-header with-border">
      <h4 class="box-title">Atribut Khusus</h4>
      
    <div class="box-body">
      <div class="ag-theme-balham" id="myGrid" style="height: 400px;width:100%;">
    </div>
    </div>
  </div>

<style type="text/css">
  .select2-container--default .select2-selection--single{
    border-radius: 0;
    height: 34px;
    border-color:#d2d6de;
  }
</style><script type="text/javascript">
//listAtributUtama($('#id_data').val());
$('#edit1').hide();
$('#new1').hide();
$('#delete1').hide();
$('#delete2').hide();
$('#edit2').hide();
$('#new2').hide();

$.ajax({
        url: BASE_URL+'dokumen_entry/getatribut?id='+$('#id_data').val(),
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
                                   
                $('#jenis_dok').html(res.list_item.jenis_dok);
                $('#nama_tipe').html(res.list_item.nama_tipe);
                $('#judul').html(res.list_item.judul);
                $('#no_dok').html(res.list_item.no_dok);
                 $('#tanggal_pembuatan').html(res.list_item.tanggal_pembuatan); 
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
});
 
  getOptions("f_provinsi1",BASE_URL+"Appdata/getprov");
  //getOptions("f_provinsi2",BASE_URL+"Appdata/getprov");
  if($('#id_prov').val() !==''){
    getOptions("f_ruasjalan",BASE_URL+"ruas_jalan/optiondata?id="+$('#id_prov').val());
  }
  
  
  function gotoatribute(){ 
        if($('#id_data').val() !==''){
            $(".isi").load('view/dokumen_entry_form.php?id_data='+$('#id_data').val()+'&id_tipe=<?php echo $_GET['id_tipe'];?>&id_master=<?php echo $_GET['id_master'];?>');
        }
        return false;
     };
     
     function simpan_utama(){
      
      
                        var nama_kegiatan = $("#nama_kegiatan").get(0).value;
                        var lama_kegiatan = $("#lama_kegiatan").get(0).value;
                        var nilai_kegiatan = $("#nilai_kegiatan").get(0).value;
                        var f_provinsi = $("#f_provinsi1").get(0).value;
                        var id = $('#id_data').val();
                        var id_atribut = $('#id_atribut').val();
                        
                        
                       if(nama_kegiatan==""){
                           onMessage("Nama Kegiatan is required");
                           $("#nama_kegiatan").focus();
                           return false;
                       }else if(f_provinsi==""){
                           onMessage("Pilih Propinsi terlebih dahulu!");
                           $("#f_provinsi1").focus();
                        }else{
                            
                           
                           var datas = {
                                   nama_kegiatan:nama_kegiatan,
                                   lama_kegiatan:lama_kegiatan,
                                   nilai_kegiatan:nilai_kegiatan,
                                   f_provinsi:f_provinsi,
                                   id:id,id_atribut:id_atribut
                               };
                               
                           if($('#id_atribut').val() ===''){
                               URL = BASE_URL+"dokumen_entry/save_atribut_utama";
                           }else{
                               URL = BASE_URL+"dokumen_entry/edit_atribut_utama";
                           }
                            
                            $.ajax({
                            url: URL,
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
                                                        $('#id_atribut').val(data.id);
                                                        $('#edit1').show();
                                                        $('#new1').show();
                                                        $('#simpan1').hide();
                                                        loaddata1();
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
             
             function listAtributUtama(id){
                $.ajax({
                        url: BASE_URL+'dokumen_entry/listatribututama?id='+id,
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
             data_file ='';
             var i =0;
             $.each(res.list , function(index, val) {
                ++i;
                                        data_file += '<tr>';
                                        data_file += '<td>';
                                        data_file += i;
                                        data_file += '</td>';
                                        data_file += '<td>';
                                        data_file += val.nama;
                                        data_file += '</td>';
                                        data_file += '<td>';
                                        data_file += val.provinsi;
                                        data_file += '</td>';
                                        data_file += '<td>';
                                        data_file += val.nilai;
                                        data_file += '</td>';
                                        data_file += '<td>';
                                        data_file += val.lama_kegiatan;
                                        data_file += '</td>';
                                        data_file += '<td>';
                                        data_file += '<a title="Edit" href="javascript:void(0)" onclick="edit_atributumum('+val.id+')" class="btn btn-default" target="_blank" download=""><i class="fa fa-edit"></i></a>';
                                        data_file += '<a title="Hapus File" class="btn btn-danger" href="javascript:void(0)" onclick="hapusfile('+val.id+')"><i class="fa fa-trash"></i></a></td>';
                                                                                                                             
                                        data_file += '</td>';
                                        data_file += '</tr>';
             });
                                $('#isiatribututama').html(data_file);
                                                   },
                                                   error: function( jqXhr, textStatus, errorThrown ){
                                                       alert('error');
                                                   }
                });
             }
             
             function hapusfile(a){
         var id = $('#id_data').val();
        $.ajax({
                                   url: BASE_URL+'dokumen_entry/hapus_atribut?id='+a,
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
                                    listAtributUtama(id);
                                    new1_utama();
                                    
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
    
    function edit_atributumum(){
          var selectedRows = gridOptions1.api.getSelectedRows();
    var selectedRowsString = '';
    selectedRows.forEach( function(selectedRow, index) {
      if (index!==0) {
        selectedRowsString += ', ';
      }
      selectedRowsString += selectedRow.id;
    });
        $.ajax({
                                   url: BASE_URL+'dokumen_entry/getatribututama?id='+selectedRowsString,
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
                                      $("#nama_kegiatan").val(res.list.nama);
                                      $("#lama_kegiatan").val(res.list.lama_kegiatan);
                                      $("#nilai_kegiatan").val(res.list.nilai);
                                      $('#id_atribut').val(res.list.id);
                                      $('#id_prov').val(res.list.id_prov);
                                      $('#id_now').val(res.list.id);
                                      new2();
                                     // alert($('#id_prov').val());
                                      getOptions("f_ruasjalan",BASE_URL+"ruas_jalan/optiondata?id="+$('#id_prov').val());
                                       $('#edit1').show();
                                                        $('#new1').show();
                                                        $('#simpan1').hide();
                                                        
                                      getOptionsEdit("f_provinsi1",BASE_URL+"Appdata/getprov",res.list.id_prov);
                                      loaddata();
                                      
                                    
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
    }
    
    
    function new1_utama(){
      $('#edit1').hide();
      $('#new1').hide();
      $('#simpan1').show();
      $('#id_atribut').val('');
      $("#nama_kegiatan").val('');
      $("#lama_kegiatan").val('');
      $("#nilai_kegiatan").val('');
      $("#f_provinsi1").val('');
      loaddata1();
    }
    
    function new2(){
      $('#delete2').hide();
      $('#edit2').hide();
      $('#new2').hide();
      $('#simpan2').show();
      $('#id_atribut2').val('');
      $("#txt-nomor").val('');
      $("#txt-nama").val('');
      $("#jenis_penanganan").val('');
      $("#panjang_penanganan").val('');
      //$("#f_provinsi2").val('');
      $('#f_ruasjalan').val('');
      
      
    }
    
    $('#demo-bootbox-bounce').on('click', function(){
           //alert($('#id_prov').val());
            getOptionsEdit("f_provinsi",BASE_URL+"Appdata/getprov",$('#id_prov').val());
           var input='<form class="form-horizontal">';
           input += '<div class="panel-body">';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Link ID*<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_link_id" id="f_link_id" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label">Provinsi<\/label>';
           input +='<div class="col-sm-5">';
           input +='<select name="f_provinsi" id="f_provinsi" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Kode Ruas<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_kode_ruas" id="f_kode_ruas" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Kode Keterangan<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_keterangan" id="f_keterangan" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama Ruas*<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_id_edit" id="f_id_edit" style="width: 220px;display:none" class="form-control"/>';
           input +='<input type="text" name="f_user_edit" id="f_user_edit" style="width: 220px;display:none" class="form-control"/>';
           input +='<input type="text" name="f_nama" id="f_nama" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
             
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Panjang Ruas (Km)<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_panjang" id="f_panjang" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">STA Awal<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_sta_awal" id="f_sta_awal" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">STA Akhir<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_sta_akhir" id="f_sta_akhir" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Koordinat Awal<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_kord_awal" id="f_kord_awal" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Koordinat Akhir<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_kord_akhir" id="f_kord_akhir" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Titik Ref Awal<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_titik_ref_awal" id="f_titik_ref_awal" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
           
           input +='<div class="form-group">';
           input +='<label class="col-sm-3 control-label" for="demo-hor-inputemail">Titik Ref Akhir<\/label>';
           input +='<div class="col-sm-5">';
           input +='<input type="text" name="f_titik_ref_akhir" id="f_titik_ref_akhir" style="width: 220px" class="form-control"/>';
           input += '<\/div>';
           input += '<\/div>';
            
           
           input += '<\/div>'; 
           input +='<\/form>';
           
           
                bootbox.dialog({
                   title: "<i class=\"fa fa-user\"><\/i> Tambah Ruas",
                   message:input, 
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-primary",
                           callback: function() {
                               
                               if(simpan_ruas('add')){
                                           return true;
                                       }else{
                                           return false;
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
            
    
    function simpan_ruas(action){
                       var  nama      = $("#f_nama").get(0).value; 
                       var f_id_edit = $("#f_id_edit").get(0).value;
                       var f_user_edit     = $("#f_user_edit").get(0).value;
                       f_link_id = $("#f_link_id").get(0).value;
                       f_provinsi = $("#f_provinsi").get(0).value;
                       f_keterangan = $("#f_keterangan").get(0).value;
                       f_nama = $("#f_nama").get(0).value;
                       f_panjang = $("#f_panjang").get(0).value;
                       f_sta_awal = $("#f_sta_awal").get(0).value;
                       f_sta_akhir = $("#f_sta_akhir").get(0).value;
                       f_kord_awal = $("#f_kord_awal").get(0).value;
                       f_kord_akhir = $("#f_kord_akhir").get(0).value;
                       f_titik_ref_awal = $("#f_titik_ref_awal").get(0).value;
                       f_titik_ref_akhir = $("#f_titik_ref_akhir").get(0).value;
                       f_kode_ruas = $("#f_kode_ruas").get(0).value;
                        
                        
                       if(nama==""){
                           onMessage("Data 'Nama' is required");
                           $("#f_nama").focus();
                           return false;
                       }else if(f_link_id==""){
                           onMessage("Kode Arsip tidak boleh kosong");
                           $("#f_kode_arsip").focus();
                        }else{
                            
                           
                           var datas = {
                                   nama:nama,
                                   f_id_edit:f_id_edit,
                                   f_user_edit:f_user_edit,
                                   f_kode_ruas:f_kode_ruas,
                                  f_link_id : f_link_id,
                                  f_provinsi : f_provinsi,
                                  f_keterangan :f_keterangan,
                                  f_nama :f_nama,
                                  f_panjang :f_panjang,
                                  f_sta_awal :f_sta_awal,
                                  f_sta_akhir:f_sta_akhir,
                                  f_kord_awal :f_kord_awal,
                                  f_kord_akhir :f_kord_akhir,
                                  f_titik_ref_awal :f_titik_ref_awal,
                                  f_titik_ref_akhir :f_titik_ref_akhir
                               };
                               
                           if(action == 'add'){
                               URL = BASE_URL+"ruas_jalan/save";
                           }else if(action == 'edit'){
                               URL = BASE_URL+"ruas_jalan/edit";
                           }
                             
                             var hasil;
    var message;
        $.ajax({
				url: URL,
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
                                            getOptions("f_ruasjalan",BASE_URL+"ruas_jalan/optiondata?id="+$('#id_prov').val());
                                               $.niftyNoty({
                                                               type: 'success',
                                                               title: 'Success',
                                                               message: message,
                                                               container: 'floating',
                                                               timer: 5000
                                                           });
                                              loaddata();
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
             
             function simpan2(){
                    var selectedRows = gridOptions1.api.getSelectedRows();
                  var selectedRowsString = '';
                  selectedRows.forEach( function(selectedRow, index) {
                    if (index!==0) {
                      selectedRowsString += ', ';
                    }
                    selectedRowsString += selectedRow.id;
                  });
      
                        var txt_nomor = $("#txt-nomor").get(0).value;
                        var txt_nama = $("#txt-nama").get(0).value;
                        var jenis_penanganan = $("#jenis_penanganan").get(0).value;
                        var panjang_penanganan = $("#panjang_penanganan").get(0).value;
                        var f_provinsi = $("#id_prov").get(0).value;
                        var id = $('#id_now').val();
                        var id_atribut = $('#id_atribut2').val();
                        var id_ruas = $('#f_ruasjalan').val();
                         var id_jembatan ='';
                        
                        if(selectedRowsString ==''){
                          onMessage("Silahkan Pilih data Nama Kegiatan dari tabel atribut utama dulu!");
                           
                           return false;
                        }else if(txt_nomor==""){
                           onMessage("Nomor Jalan is required");
                           $("#txt-nomor").focus();
                           return false;
                       }else if(txt_nama==""){
                           onMessage("Nama Jalan wajib diisi!");
                           $("#txt-nama").focus();
                        }else if(id_ruas==""){
                           onMessage("Ruas Jalan wajib Dipilih!");
                           $("#txt-nama").focus();
                        }else if(f_provinsi==""){
                           onMessage("Provinsi wajib diisi!"); 
                        }else{
                            
                           
                           var datas = {
                                   txt_nomor:txt_nomor,
                                   txt_nama:txt_nama,
                                   jenis_penanganan:jenis_penanganan,
                                   panjang_penanganan:panjang_penanganan,
                                   f_provinsi:f_provinsi,
                                   id:id,
                                   id_atribut:id_atribut,id_ruas:id_ruas,id_jembatan:id_jembatan
                               };
                               
                           if($('#id_atribut2').val() ===''){
                               URL = BASE_URL+"dokumen_entry/save_atribut_jalan";
                           }else{
                               URL = BASE_URL+"dokumen_entry/edit_atribut_jalan";
                           }
                            
                            $.ajax({
                            url: URL,
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
                                                        $('#id_atribut2').val(data.id);
                                                        $('#delete2').show();
                                                        $('#edit2').show();
                                                        $('#new2').show();
                                                        $('#simpan2').hide();
                                                         
                                                           $.niftyNoty({
                                                                           type: 'success',
                                                                           title: 'Success',
                                                                           message: message,
                                                                           container: 'floating',
                                                                           timer: 5000
                                                                       });
                                                          loaddata(); 
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
             
             var columnDefs1 = [
           {headerName: "No", field: "no", width: 100, filterParams:{newRowsAction: 'keep'}} ,
           {headerName: "Nama Kegiatan", field: "nama", width: 300, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nilai Kegiatan (Rp.)", field: "nilai", width: 200, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Masa Pelaksanaan Kegiatan (Hari):", field: "lama_kegiatan", width: 150, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Provinsi", field: "provinsi", width: 300, filterParams:{newRowsAction: 'keep'}} 
             
        ];

         

        var gridOptions1 = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false,
           onRowClicked: edit_atributumum,
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single',
           enableColResize: true,
           rowGroupPanelShow: 'always',
           pivotPanelShow: 'always',
           enableRangeSelection: true,
           columnDefs: columnDefs1,
           pagination: true,
           paginationPageSize: 50, 
           defaultColDef:{
               editable: true,
               enableRowGroup:true,
               enablePivot:true,
               enableValue:true
           }
        };

        // setup the grid after the page has finished loading 
           var gridDiv1 = document.querySelector('#myGrid1');
           new agGrid.Grid(gridDiv1, gridOptions1);
           
           
             var columnDefs = [
           {headerName: "No", field: "no", width: 100, filterParams:{newRowsAction: 'keep'}} ,
           {headerName: "Nomor Jalan", field: "nomor_jalan", width: 300, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama Jalan", field: "nama", width: 200, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Jenis penanganan", field: "jenis_penanganan", width: 150, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Panjang Penaganan (Km)", field: "panjang_penanganan", width: 300, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Ruas Jalan", field: "nama_ruas", width: 150, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Provinsi", field: "nama_propinsi", width: 150, filterParams:{newRowsAction: 'keep'}} 
             
        ];

         

        var gridOptions = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false,
           onRowClicked: ambilruas,
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single',
           enableColResize: true,
           rowGroupPanelShow: 'always',
           pivotPanelShow: 'always',
           enableRangeSelection: true,
           columnDefs: columnDefs,
           pagination: true,
           paginationPageSize: 50, 
           defaultColDef:{
               editable: true,
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
           function loaddata(){
            var id= $('#id_now').val();
           $.ajax({
                                   url: BASE_URL+'dokumen_entry/list_jalan?id='+id,
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
                      
                        if(data.result !== 'empty'){
                          gridOptions.api.setRowData(data);
                        }else{
                          gridOptions.api.setRowData([]);
                        }
                     
                     
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });

           }
           
           function loaddata1(){
            var id= $('#id_data').val();
           $.ajax({
                                   url: BASE_URL+'dokumen_entry/listatribututama?id='+id,
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
                      
                        if(data.result !== 'empty'){
                          gridOptions1.api.setRowData(data);
                        }else{
                          gridOptions1.api.setRowData([]);
                        }
                     
                     
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });

           }
           
           loaddata();
           loaddata1();
           
           function ambilruas(){
               var selectedRows = gridOptions.api.getSelectedRows();
    var selectedRowsString = '';
    selectedRows.forEach( function(selectedRow, index) {
      if (index!==0) {
        selectedRowsString += ', ';
      }
      selectedRowsString += selectedRow.id;
    });
    
               $.ajax({
      url: BASE_URL+'dokumen_entry/jalan?id='+selectedRowsString,
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
        $('#delete2').show();
        $('#edit2').show();
        $('#new2').show();
        $('#simpan2').hide();
        $('#id_atribut2').val(data[0].id);
        $("#txt-nomor").val(data[0].nomor_jalan);
        $("#txt-nama").val(data[0].nama);
        $("#jenis_penanganan").val(data[0].jenis_penanganan);
        $("#panjang_penanganan").val(data[0].panjang_penanganan);
         
        
        getOptionsEdit("f_ruasjalan",BASE_URL+"ruas_jalan/optiondata?id="+$('#id_prov').val(),data[0].id_ruas);
        
      },error: function( jqXhr, textStatus, errorThrown ){
        alert('error');
      }
    });
    
    
           
           }
           
           
    function delete2(){
         var id = $('#id_atribut2').val();
        $.ajax({
                                   url: BASE_URL+'dokumen_entry/hapus_jalan?id='+id,
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
                                    loaddata();
                                    new2();
                                    
                                                                                            $.niftyNoty({
                                                                                            type: 'success',
                                                                                            title: 'Success',
                                                                                            message: res.message,
                                                                                            container: 'floating',
                                                                                            timer: 5000
                                                                                            }); 
               
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
    }
    
    function getRuasData(a){
       $.ajax({
                                   url: BASE_URL+'ruas_jalan/getuser/?id='+a,
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
                                   $('#txt-nomor').val(res[0].kode_ruas);
                                    $('#txt-nama').val(res[0].nama);
                                                                                            
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
    }
    
    function jalanProv(a){
       
       getOptions("f_ruasjalan",BASE_URL+"ruas_jalan/optiondata?id="+a);
       $('#id_prov').val(a);
    }
</script>
                            
                        </div> 