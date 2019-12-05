<div class="">
  <div class="fixed-sm-200 fixed-lg-250 pull-sm-left">
	  
	<div class="panel">
	 <div class="table">
		   <table class="table">
			   <tbody id="tabel">
				  
			   </tbody>
		   </table>
	   </div>
      <!-- Simple profile -->
      <div class="text-center pad-all bord-btm">
        <div class="pad-ver"><img alt="Profile Picture" class="img-lg img-border img-circle" id="page_foto" src=""></div>
        <h4 class="text-lg text-overflow mar-no" id="page_nama"></h4>
        <div id="warning-message" class="col-md-4">

        </div>
        <div id="warning-message-str" class="col-md-4">

        </div>
        <div id="warning-message-sip" class="col-md-4">

        </div>
        <hr>
        <button class="btn btn-block btn-success page-jabatan">Follow</button> 
        
		<h4 class="text-overflow text-center" id="page_cuti"></h4><br>
		<h5 class="text-overflow text-left" id="page_surat"></h5>
    
	  </div>
	</div>
  </div>
  <div class="fluid">
    <div class="bg-trans-light pad-all mar-btm clearfix">
      <!-- START TAB -->
      <div class="tab-base mar-all">
        <ul class="nav nav-tabs" id="feedtab">
          <li class="active">
            <input type="hidden" id="f_id_edit">
            <a data-toggle="tab" href="#demo-lft-tab-1a"><span class="block text-center text-success"><i class="fa fa-credit-card fa-2x"></i></span> Akun</a>
          </li>
          <li>
            <a data-toggle="tab" href="#demo-lft-tab-1i" onclick="tabIdentitasView();"><span class="block text-center text-success"><i class="fa fa-user fa-2x"></i></span> Identitas</a>
          </li> <li>
            <a data-toggle="tab" href="#demo-lft-tab-1b" onclick="tabKeluargaView();"><span class="block text-center text-success"><i class="fa fa-group fa-2x"></i></span> Keluarga</a>
          </li>
          <li>
            <a data-toggle="tab" href="#demo-lft-tab-2a" onclick="tabPendidikanView();"><span class="block text-center text-success"><i class="fa fa-graduation-cap fa-2x"></i></span> Pendidikan</a>
          </li>
          <li>
            <a data-toggle="tab" href="#demo-lft-tab-3a" onclick="tabPelatihanView();"><span class="block text-center text-success"><i class="fa fa-briefcase fa-2x"></i></span> Pelatihan</a>
          </li>
          <li>
            <a data-toggle="tab" href="#demo-lft-tab-4a" onclick="tabGolonganView();"><span class="block text-center text-success"><i class="fa fa-cubes fa-2x"></i></span> Golongan/Pangkat</a>
          </li>
          <li>
            <a data-toggle="tab" href="#demo-lft-tab-5a" onclick="tabJabatanView();"><span class="block text-center text-success"><i class="fa fa-home fa-2x"></i></span> Jabatan</a>
          </li>
          <li>
           <a data-toggle="tab" href="#demo-lft-tab-6a" onclick="tabJabatanViewasn();"><span class="block text-center text-success"><i class="fa fa-cubes fa-2x"></i></span>JabFung ASN</a>
         </li>
         <li>
          <div class="dropdown" style="margin: 10px;">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Upload Lainnya
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li>
                  <a data-toggle="tab" href="#tab-kontrak" onclick="$('#page-kontrak').load('view/pegawai/form_kontrakview.php');removeActiveDropDown()">
                    Kontrak
                  </a>
                </li>
                <li onClick="$('#uploadfile').load('view/pegawai/form_file_tugasview.php?id=3');removeActiveDropDown()"><a
                  data-toggle="tab" href="#demo-tabs-box-5"
                  aria-expanded="false">Penugasan</a></li>
                  <li onClick="$('#uploadfile').load('view/pegawai/form_file_skpview.php?id=4');removeActiveDropDown()"><a
                    data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">SKP</a></li>
                    <li onClick="$('#uploadfile').load('view/pegawai/form_file_medikview.php?id=5');removeActiveDropDown()"><a
                      data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">Data
                    Medical</a></li>
                    <li onClick="$('#uploadfile').load('view/pegawai/form_file_skview.php?id=6');removeActiveDropDown()"><a
                      data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">SK</a></li>
                      <li>
                        <a onclick="$('#page-punishment').load('view/pegawai/form_punishmentview.php');removeActiveDropDown()" data-toggle="tab" href="#tab-punishment">
                          Punishment
                        </a>
                      </li>
                      <li>
                        <a onclick="$('#page-str').load('view/pegawai/form_strview.php');removeActiveDropDown()" data-toggle="tab" href="#tab-str">
                          STR
                        </a>
                      </li>
                      <li>
                        <a onclick="$('#page-sip').load('view/pegawai/form_sipview.php');removeActiveDropDown()" data-toggle="tab" href="#tab-sip">
                          SIP
                        </a>
                      </li>
                      <li onClick="$('#uploadfile').load('view/pegawai/form_file_dokview.php?id=9');removeActiveDropDown()"><a
                        data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">Dokumen Lain</a></li>
                        
                      </ul>
                    </div>
                  </li>

<!-- <li onclick="')"><a data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="true">Kontrak</a>
</li>
<li onclick="$('#uploadfile').load('')"><a data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="true">Penugasan</a></li>
<li onclick="$('#uploadfile').load('view/pegawai/form_file.php?id=4')"><a data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">SKP</a></li>
<li onclick="$('#uploadfile').load('view/pegawai/form_file.php?id=5')"><a data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="true">Data
Medical</a></li>
<li onclick="$('#uploadfile').load('view/pegawai/form_file.php?id=6')"><a data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">SK</a></li>
<li onclick="$('#uploadfile').load('view/pegawai/form_penghargaan.php?id=7')"><a data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="true">Penghargaan</a></li>
<li onclick="$('#uploadfile').load('view/pegawai/form_punishment.php?id=8')"><a data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="true">Punishment</a></li>
<li onclick="$('#uploadfile').load('view/pegawai/form_str.php')"><a data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">STR</a></li>
<li onclick="$('#uploadfile').load('view/pegawai/form_sip.php')"><a data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">SIP</a></li> -->










</ul>
<div class="tab-content" style="min-height:200px !important">
  <div class="tab-pane fade active in" id="demo-lft-tab-1a">
    <div class="fixed-sm-200 fixed-lg-250 pull-sm-left"> 

      <form class="form-gantipass" id="form-gantipass" method="post" >
        
       <div class="form-group">
         <label for="demo-inline-inputpass" class="sr-only">Password</label>
         <input id="id_user" name="id_user" style="display:none" value="<?php echo $_GET["id"]?>" type="text">
         <input id="pass" name="pass" style="display:none" type="text">
         <input placeholder="Password Lama" id="passwordlm" name="passwordlm" style="width:300px" class="form-control" type="password">
       </div>
       
       <div class="form-group">
         <label for="demo-inline-inputpass" class="sr-only">Password</label>
         <input placeholder="Password Baru" id="passwordchn" name="passwordchn" style="width:300px" class="form-control" type="password">
       </div>
       
       <button class="btn btn-primary" type="submit" onClick="changePass();return false;">Change</button>
     </form>
     
   </div>
 </div>
 <div class="tab-pane fade" id="demo-lft-tab-1i">
	<div class="row"><!-- left column -->
	<div class="col-md-12">
      <form class="form-update" id="form-update" method="post" >
        <input id="id_user" name="id_user" style="display:none" value="<?php echo $_GET["id"]?>" type="text">
		<div class="form-group">
         <label for="demo-inline-inputpass">Alamat</label>
         <textarea placeholder="Alamat" id="alamat" name="alamat" style="width:400px" class="form-control" type="text"></textarea>
        </div>
		<div class="form-group">
         <label for="demo-inline-inputpass">Rt</label>
         <input placeholder="Rt" id="rt" name="rt" style="width:100px" class="form-control" type="text">
        </div>
		<div class="form-group">
         <label for="demo-inline-inputpass" >Rw</label>
         <input placeholder="Rw" id="rw" name="rw" style="width:100px" class="form-control" type="text">
        </div>
		<label for="demo-inline-inputpass">Provinsi</label>
         
		<div class="form-group">
         <select aria-hidden="true" class="select-chosen"
			id="txtprov" name="txtprov"
			onchange="getKota(this.value,'txtkota')"
			style="width:300px"
			tabindex="-1"></select>
        </div>
		<label for="demo-inline-inputpass">Kota</label>
         
		<div class="form-group">
         <select aria-hidden="true" class="select-chosen"
			id="txtkota" name="txtkota"
			onchange="getKecamatan(this.value,'txtkecamatan')"
			style="width:300px" tabindex="-1">
			<option selected="selected"></option>
		  </select>
        </div>
		<label for="demo-inline-inputpass">Kecamatan</label>
		<div class="form-group">
         
         <select aria-hidden="true" class="select-chosen"
			id="txtkecamatan"
			name="txtkecamatan"
			onchange="getKelurahan(this.value,'txtkelurahan')"
			style="width:300px" tabindex="-1">
			<option selected="selected"></option>
		  </select>
        </div>
		<label for="demo-inline-inputpass">Kelurahan</label>
		<div class="form-group">
        <select aria-hidden="true" class="select-chosen"
		  id="txtkelurahan"
		  name="txtkelurahan"
		  style="width:300px" tabindex="-1">
		  <option selected="selected"></option>
		</select></option>
		  </select>
        </div><!-- End Hori sontal -->
	    <div class="form-group">
         <label for="demo-inline-inputpass">Kode Pos</label>
         <input placeholder="Kode Pos" id="kd_pos" name="kd_pos" style="width:100px" class="form-control" type="text">
        </div>
		<div class="form-group">
         <label for="demo-inline-inputpass">Email RS</label>
         <input placeholder="contoh@pjnhk.co.id" id="email" name="email" style="width:300px" class="form-control" type="email" readonly>
        </div>
		<div class="form-group">
         <label for="demo-inline-inputpass">Email Pribadi</label>
         <input placeholder="contoh@pjnhk.co.id" id="email2" name="email2" style="width:300px" class="form-control" type="email">
        </div>
		<div class="form-group">
         <label for="demo-inline-inputpass">No Hp 1</label>
         <input placeholder="08121*******" id="no_hp" name="no_hp" style="width:300px" class="form-control" type="text">
        </div>
		<div class="form-group">
         <label for="demo-inline-inputpass">No Hp 2</label>
         <input placeholder="08121*******" id="no_hp1" name="no_hp1" style="width:300px" class="form-control" type="text">
        </div>
     
	  <button class="btn btn-primary" type="submit" onClick="update();return false;">Update</button>
	
     </form>
     
   </div>
   </div>
</div>
<div class="tab-pane fade active in" id="demo-lft-tab-1b">
  <div id="page-keluarga"></div>
</div>
<div class="tab-pane fade" id="demo-lft-tab-2a">
  <div id="page-pendidikan"></div>
</div>
<div class="tab-pane fade" id="demo-lft-tab-3a">
  <div id="page-pelatihan"></div>
</div>
<div class="tab-pane fade" id="demo-lft-tab-4a">
  <div id="page-golongan"></div>
</div>
<div class="tab-pane fade" id="demo-lft-tab-5a">
  <div id="page-jabatan"></div>
</div>
<div class="tab-pane fade" id="demo-lft-tab-6a">
  <div id="page-jabfung"></div>
</div>
<div class="tab-pane fade" id="tab-kontrak">
  <div id="page-kontrak"></div>
</div>

<div class="tab-pane fade" id="tab-penghargaan">
  <div id="page-penghargaan"></div>
</div>
<div class="tab-pane fade" id="tab-punishment">
  <div id="page-punishment"></div>
</div>
<div class="tab-pane fade" id="tab-str">
  <div id="page-str"></div>
</div>
<div class="tab-pane fade" id="tab-sip">
  <div id="page-sip"></div>
</div>
<div id="demo-tabs-box-5" class="tab-pane fade">
  <div class="panel-body pad-all" id="uploadfile"></div>
</div></div>
</div>
</div>
</div>
<div class="fixed-fluid">
  <div class="fluid"></div>
</div>
</div><!-- END TAB -->
<script>
  $('.select-chosen').chosen();
  $('.chosen-container').css({"width": "400px"});
  getOptions("txtprovktp", BASE_URL + "master/provinsi");
  
  function removeActiveDropDown(){
    $('ul.dropdown-menu').children().removeClass('active');
  }; 
  function changePass(){
    var passlm = calcMD5($('#passwordlm').val());
    var fld = $('#passwordchn').val();
    var pass = $('#pass').val();
    
    //if(validatePassword(fld)){
      if(passlm==pass){
        postForm('form-gantipass',BASE_URL+'pegawai/changepass',gogo);
      }else{
        onMessage('Pasword Tidak cocok');
      }
   // } 
    
  }
  function update(){
        postForm('form-update',BASE_URL+'pegawai/newupdate',gogo);
  } 

  function gogo(){
    return false;
  }
  
  getJson(reskpi,BASE_URL+'kpi/mpenilaian/listiki_peg?nopeg=<?php echo $_GET["id"]?>&bulan=<?php echo $_GET["bulan"]?>');

    function reskpi(result){
        var Nama = '';
        var Unit = '';
        var Iki = '';
        var Iku ='';


        var table ='';
        $.each( result.result, function( key, value ) {
            bulan = value.bulan;
            tahun = value.tahun;
            Iki = value.nilai;
            Iku = value.iku;
            
            table +='<tr class="text-success h4">';
            table +='<td>';
            table += 'Nilai IKI Bulan<b> '+bulan+' '+tahun+' : '+Iki;
            table +='</td>';
            table +='<td align="right">';
            table += 'Nilai IKU Bulan<b> '+bulan+' '+tahun+' : '+Iku;
            table +='</td>';
            table +='</tr>';
            

        });

        $('#tabel').html(table);



    }
</script>
<script src="js/pegawai/riwayat.js"></script>
<script src="js/pegawai/pendidikan.js"></script>
<script src="js/pegawai/pelatihan.js"></script>
<script src="js/pegawai/golongan.js"></script>
<script src="js/pegawai/jabatan.js"></script>
<script src="js/pegawai/jab_asn.js"></script>