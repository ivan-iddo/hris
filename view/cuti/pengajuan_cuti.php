<?php
require_once('../../connectdb.php');

?>

 
<div class="row">
					    <div class="col-sm-6">
					        <div class="panel">
					             
					
					            <!--Block Styled Form -->
					            <!--===================================================-->
					            <form>
					                <div class="panel-body">
                                    <div class="row pad-top pad-all">
                                         <?php 
                                        // print_r($_SESSION['userdata'] );
										  $thn = date('Y');
                      $query= pg_query('select sum(total)as jml from his_cuti where status=103 and EXTRACT(YEAR FROM his_cuti.tgl_cuti)='.$thn.' and tampilkan=1 and id_user = '.$_SESSION['userdata']['id'].'');
                      $rowcount=pg_num_rows($query);
                      $row   = pg_fetch_row($query);
                      $total_cuti = 0;
                      
                      if(!empty($rowcount)){
                        $total_cuti = $row[0];
                      }
                      $persen = round(($total_cuti/22)*100);
                      //mysqli_close($con);
                      
                     ?>
					
					                    <div class="col-lg-4">
					                        <p class="text-semibold text-main">Total Cuti Anda</p>
					                        <ul class="list-unstyled">
					                            <li>
					                                <div class="media">
					                                    <div class="media-left">
					                                        <span class="text-2x text-semibold text-main">
                                                            <?php echo $total_cuti; ?></span>
					                                    </div>
					                                    <div class="media-body">
					                                        <p class="mar-no">Hari</p>
					                                    </div>
					                                </div>
					                            </li>
					                            <li>
					                                <div class="clearfix">
					                                    <p class="pull-left mar-no">Outcome</p>
					                                    <p class="pull-right mar-no"><?php echo $persen?>%</p>
					                                </div>
					                                <div class="progress progress-xs">
					                                    <div class="progress-bar progress-bar-info" style="width: <?php echo $persen?>%;">
					                                        <span class="sr-only"><?php echo $persen?>%</span>
					                                    </div>
					                                </div>
					                            </li>
					                        </ul>
					                    </div>
					                </div>
					                </div>
					                
					            </form>
					            <!--===================================================-->
					            <!--End Block Styled Form -->
                                <div class="table-responsive">
					                    <table class="table table-striped">
					                        <thead>
					                            <tr>
					                                <th>Jenis Cuti</th>
					                                <th>Mulai</th>
					                                <th>Sampai</th>
                                          <th>Hari</th>
                                          <th>Status</th>
                                          <th>Action</th>
					                            </tr>
					                        </thead>
					                        <tbody id="isicuti">
                                            
					                        </tbody>
					                    </table>
					                </div>
					
					        </div>
					    </div>
					    <div class="col-sm-6">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Form Permohonan Cuti</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form id="form-cuti" name="form-cuti" method="post" class="form-horizontal pad-all form-cuti">
					                <div class="panel-body">
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label">Jenis Cuti</label>
					                        <div class="col-sm-9">
                                            <input style="display:none" type="text" id="id_user" name="id_user" value="<?php echo $_SESSION['userdata']['id']?>">
                                            <input style="display:none" type="text" id="id_group" name="id_group" value="<?php echo $_SESSION['userdata']['group']?>">
                                            <select class="select-chosen" name="jenis_cuti" id="jenis_cuti" style="width: 100%;" tabindex="-1" onChange="cekCuti(this.value)">
									 
								            </select>
					                        </div>
					                    </div>
                                        <div class="form-group">
					                        <label class="col-sm-3 control-label">Jumlah Cuti</label>
					                        <div class="col-sm-9">
                                             <select class="select-chosen" name="jumlahCuti" id="jumlahCuti" style="width: 100%;" onChange="hitungTanggal(this.value)">
                                              <option value="">Pilih Jumlah</option>
									 
								            </select>
					                        </div>
					                    </div>
                                        <div class="form-group">
					                        <label class="col-sm-3 control-label">Tanggal Mulai Cuti</label>
					                        <div class="col-sm-9">
                                             <input class="form-control datepickerbootstrap" type="text" id="tgl_cuti" name="tgl_cuti" onChange="hitungTanggalB(this.value)" autocomplete="off">
					                        </div>
					                    </div>
                                       
                                        <div class="form-group">
					                        <label class="col-sm-3 control-label">Tanggal Berakhir</label>
					                        <div class="col-sm-9">
                                            <input class="form-control datepickerbootstrap" type="text" id="sampai" name="sampai" readonly>
					                        </div>
					                    </div>

                                        <div class="form-group">
					                        <label class="col-sm-3 control-label">Keterangan </label>
					                        <div class="col-sm-9">
                                             <textarea class="form-control" type="text" id="keterangan" name="keterangan"  > </textarea>
					                        </div>
					                    </div>
										<div class="form-group">
					                        <label class="col-sm-3 control-label">Alamat Selama Libur</label>
					                        <div class="col-sm-9">
                                             <textarea class="form-control" type="text" id="alamat" name="alamat"  > </textarea>
					                        </div>
					                    </div>
										<div class="form-group">
					                        <label class="col-sm-3 control-label">No Telp</label>
					                        <div class="col-sm-9">
                                             <input class="form-control" type="number" id="no_telp" name="no_telp"  > </textarea>
					                        </div>
					                    </div>
										<div class="form-group">
					                        <label class="col-sm-3 control-label">Selama Libur Tangung Jawab di berikan ke</label>
					                        <div class="col-sm-9">
                                             <input class="form-control" type="text" id="tanggung_jawab" name="tanggung_jawab"  > </textarea>
					                        </div>
					                    </div>
                                       
					                     
					                </div>
                                    <div class="form-group pad-all">
                                    <div id="pesan"></div>
                                    </div>
					                <div class="panel-footer text-left">
					                    <button class="btn btn-primary " type="submit" id="disable" href="javascript:void(0);" onCLick="ajukan();return false;">Ajukan Cuti</button>
					                </div>
					            </form>
					            <!--===================================================-->
					            <!--End Horizontal Form-->
					
					        </div>
					    </div>
					</div>
<script>
$('.judul-menu').html('Pengajuan Cuti'); 
  $(document).ready(function(){
    $('.datepickerbootstrap').datepicker({
      format: 'dd/mm/yyyy',
      autoclose: true
    });     
  })

$('.judul-menu').html('Pengajuan Cuti');
$('.select-chosen').chosen();
 $('.chosen-container').css({"width": "100%"});
 getOptions("jenis_cuti",BASE_URL+"master/jenis_cuti");

 function cekCuti(nilai){
    $.ajax({
       url: BASE_URL+'cuti/cekcuti/?id='+nilai+'&id_user='+$('#id_user').val(),
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
            $('#jumlahCuti').prop('disabled', false);
            $('#tgl_cuti').val('');
            $('#sampai').val('');
            if (res.warning != "") {
              onMessage(res.warning);
              getOptions("jenis_cuti",BASE_URL+"master/jenis_cuti");
            }
            if (res.message != "") {
              $('#pesan').html(res.message);
               $('#jumlahCuti').empty();
               if (res.cuti) {
                 for( var i = 0; i < res.cuti; i++ ){
                   $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                 }
               }
               if (res.cuti_besar) {
                  $('#jumlahCuti').append('<option value="'+res.cuti_besar+'" >'+res.cuti_besar+'</option>');
               }
               if (res.cuti_melahirkan) {
                  $('#jumlahCuti').append('<option value="'+res.cuti_melahirkan+'" >'+res.cuti_melahirkan+'</option>');
               }
               if (res.cuti_khusus) {
                  for( var i = 0; i < res.cuti_khusus; i++ ){
                    $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                  }
               }
               if (res.cuti_umroh) {
                  $('#jumlahCuti').append('<option value="'+res.cuti_umroh+'" >'+res.cuti_umroh+'</option>');
               }
               if (res.cuti_haji) {
                  $('#jumlahCuti').append('<option value="'+res.cuti_haji+'" >'+res.cuti_haji+'</option>');
               }
               if (res.izin_nikah_pribadi) {
                  for( var i = 0; i < res.izin_nikah_pribadi; i++ ){
                    $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                  }
               }
               if (res.izin_nikah_anak) {
                  for( var i = 0; i < res.izin_nikah_anak; i++ ){
                    $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                  }
               }
               if (res.izin_sakit_keluarga) {
                  for( var i = 0; i < res.izin_sakit_keluarga; i++ ){
                    $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                  }
               }
               if (res.izin_istri_melahirkan) {
                  $('#jumlahCuti').append('<option value="'+res.izin_istri_melahirkan+'" >'+res.izin_istri_melahirkan+'</option>');
               }
               if (res.izin_khitan) {
                  $('#jumlahCuti').append('<option value="'+res.izin_khitan+'" >'+res.izin_khitan+'</option>');
               }
               if (res.izin_pemakaman) {
                  for( var i = 0; i < res.izin_pemakaman; i++ ){
                    $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                  }
               }
               if (res.izin_kerusakan) {
                  for( var i = 0; i < res.izin_kerusakan; i++ ){
                    $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                  }
               }
               if (res.izin_lainnya) {
                  for( var i = 0; i < res.izin_lainnya; i++ ){
                    $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                  }
               }
               if (res.izin_kegiatan_profesi) {
                  for( var i = 0; i < res.izin_kegiatan_profesi; i++ ){
                    $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                  }
               }
               if (res.izin_dua_hari) {
                  for( var i = 0; i < res.izin_dua_hari; i++ ){
                    $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                  }
               }
               if (res.sakit_rawat_inap) {
                  for( var i = 0; i < res.sakit_rawat_inap; i++ ){
                    $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                  }
               }
               if (res.sakit_rawat_jalan) {
                  for( var i = 0; i < res.sakit_rawat_jalan; i++ ){
                    $('#jumlahCuti').append('<option value="'+(i+1)+'" >'+(i+1)+'</option>');
                  }
               }
               if (res.dinas_prajabatan) {
                  $('#jumlahCuti').append('<option value="'+res.dinas_prajabatan+'" >'+res.dinas_prajabatan+'</option>');
               }
               if (res.dinas_post_basic) {
                  $('#jumlahCuti').append('<option value="'+res.dinas_post_basic+'" >'+res.dinas_post_basic+'</option>');
               }
               if (res.dinas_kardiologi) {
                  $('#jumlahCuti').append('<option value="'+res.dinas_kardiologi+'" >'+res.dinas_kardiologi+'</option>');
               }
               if (res.dinas_pendidikan) {
                  $('#jumlahCuti').append('<option value="'+res.dinas_pendidikan+'" >'+res.dinas_pendidikan+'</option>');
               }
               if (res.dinas_pelatihan) {
                  $('#jumlahCuti').append('<option value="'+res.dinas_pelatihan+'" >'+res.dinas_pelatihan+'</option>');
               }
               if (res.dinas_tkhi) {
                  $('#jumlahCuti').append('<option value="'+res.dinas_tkhi+'" >'+res.dinas_tkhi+'</option>');
               }
               if (res.dinas_luar) {
                  $('#jumlahCuti').append('<option value="'+res.dinas_luar+'" >'+res.dinas_luar+'</option>');
               }

            }
        $('#jumlahCuti').trigger("chosen:updated");

       }
    });
 }
 listcuti();
 function listcuti(){
    $.ajax({
       url: BASE_URL+'cuti/listcuti/?id_user='+$('#id_user').val(),
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
           $('#isicuti').html(res.isi);
       }
    });
 }
				
function hitungTanggal(jml){
    var tt = document.getElementById('tgl_cuti').value;
    var id_jenis_cuti = $('#jenis_cuti').val();
    var id_user = $('#id_user').val();
    var newdate = tt.split("/").reverse().join("-");
	$.ajax({
      url: BASE_URL+'cuti/tglcuti/'+jml+'/'+newdate+'/?id_user='+id_user+'&id_jenis_cuti='+id_jenis_cuti,
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
          var newdates = res[0].tgl_selesai.split("-").reverse().join("/");
          $('#sampai').val(newdates);
       },
       error: function( jqXhr, textStatus, errorThrown ){
           alert('error');
       }
   });
 }

 function hitungTanggalB(tgl){
    var tt = document.getElementById('jumlahCuti').value;
    var id_user = $('#id_user').val();
    var id_jenis_cuti = $('#jenis_cuti').val();
    var newdate = tgl.split("/").reverse().join("-");
  $.ajax({
      url: BASE_URL+'cuti/tglcuti/'+tt+'/'+newdate+'/?id_user='+id_user+'&id_jenis_cuti='+id_jenis_cuti,
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
       console.log(res);
        if (res.pesan_eror != "") {
          onMessage(res.pesan_eror);
          document.getElementById("tgl_cuti").value = "";
        } else if (res[0].tgl_selesai != ""){
          var datatgl = res[0].tgl_selesai;
          var newdates = datatgl.split("-").reverse().join("/");
          $('#sampai').val(newdates);
        }
       
       },
       error: function( jqXhr, textStatus, errorThrown ){
           alert('error');
       }
   });

 }

 function incrementDate(dateInput,increment) {
        var dateFormatTotime = new Date(dateInput);
        var increasedDate = new Date(dateFormatTotime.getTime() +(increment *86400000));
        return increasedDate;
    }

    function ajukan(){
        var jml = $('#jumlahCuti').val();
        var tgl = $('#tgl_cuti').val();
        var sampai = $('#sampai').val();
        var jenis = $('#jenis_cuti').val();
        var keterangan = $('#keterangan').val();
        var tglnew = tgl.split("/").reverse().join("-");
        var sampainew = sampai.split("/").reverse().join("-");
	  if(empty(jenis)){
		  alert('jenis cuti wajib diisi');
		  return false;
	  }else if(empty(tgl)){
		alert('Tanggal cuti wajib diisi');
		  return false;
	  }else if(empty(jml)){
		alert('Jumlah cuti wajib diisi');
		  return false;
	  }else if(empty(keterangan)){
		alert('Keterangan wajib diisi');
		  return false;
	  } else {
    var data = formJson('form-cuti');
    var form = $("#form-cuti");
    $.ajax({
       url: BASE_URL + 'cuti/savecuti/?tgl_cuti='+tglnew+'&sampai='+sampainew,
       headers: {
           'Authorization': localStorage.getItem("Token"),
           'X_CSRF_TOKEN': 'donimaulana',
           'Content-Type': 'application/json'
       },
       dataType: 'json',
       type: 'post',
       contentType: 'application/json',
       processData: false,
       data: data,
       success: function(data, textStatus, jQxhr) {
             getOptions("jenis_cuti",BASE_URL+"master/jenis_cuti");
            $('#jumlahCuti').empty();
            $('#jumlahCuti').remove();
            $("#jumlahCuti").prop('selectedIndex', 0);
			$("#jumlahCuti").trigger('chosen:updated');
			$("#jumlahCuti").trigger('change');
           if(data.hasil ==='success'){
            $('#tgl_cuti').val('');
            $('#jenis_cuti').val('');
            $('#sampai').val('');
            $('#keterangan').val('');
            $('#alamat').val('');
            $('#no_telp').val('');
            $('#tanggung_jawab').val('');
            document.getElementById("disable").disabled = true;
            $.niftyNoty({
                    type: 'success',
                    title: 'Sukses!',
                    message: 'Berhasil Mengajukan Cuti',
                    container: 'floating',
                    timer: 5000
                });
            listcuti();
           }
           
       } 
   });
   
  }
   
    }

    function prosesCuti(idcuti){

      swal({
          title: 'Apakah Anda Yakin Menghapus Data Ini?',
          text: 'Data segera di proses!',
          type: "warning",
          confirmButtonColor: '#d9534f',
          confirmButtonText: "Ya, Segera proses!",
          showCancelButton: true,
          },function(){
                 $.ajax({
                     url: BASE_URL+'cuti/beristratuscuti/?id='+idcuti+'&status=0',
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
                      listcuti();
                     }
                });
      });
      return false;
        
    }
	
</script>