<div class="">
    <div class="fixed-sm-200 fixed-lg-250 pull-sm-left">
      <div class="panel">
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
              <a data-toggle="tab" href="#demo-lft-tab-1a"><span class="block text-center text-success"><i class="fa fa-credit-card fa-2x"></i></span> Pegawai</a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-1b" onclick="tabKeluargaView();"><span class="block text-center text-success"><i class="fa fa-group fa-2x"></i></span> Keluarga</a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-2a" onclick="tabPendidikanView();"><span class="block text-center text-success"><i class="fa fa-graduation-cap fa-2x"></i></span> Pendidikan</a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-3a" onclick="tabPelatihanView();"><span class="block text-center text-success"><i class="fa fa-briefcase fa-2x"></i></span> Pelatihan</a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-4a" onclick="tabGolonganView();"><span class="block text-center text-success"><i class="fa fa-cubes fa-2x"></i></span> Golongan/Ruang</a>
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
                    <a data-toggle="tab" href="#tab-kontrak" onclick="$('#page-kontrak').load('view/pegawai/form_kontrak.php')">
                      Kontrak
                    </a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab-penugasaan" onclick="$('#page-penugasaan').load('view/pegawai/form_file.php?id=3');removeActiveDropDown()">
                      Penugasaan
                    </a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab-skp" onclick="$('#page-skp').load('view/pegawai/form_file.php?id=4');removeActiveDropDown()">
                      Skp
                    </a>
                  </li>
                  <li>
                    <a onclick="$('#page-data-medical').load('view/pegawai/form_file.php?id=5');removeActiveDropDown()" data-toggle="tab" href="#tab-data-medical">
                      Data medical
                    </a>
                  </li>
                  <li>
                    <a onclick="$('#page-sk').load('view/pegawai/form_file.php?id=6');removeActiveDropDown()" data-toggle="tab" href="#tab-sk">
                      SK
                    </a>
                  </li>
                  <li>
                    <a onclick="$('#page-penghargaan').load('view/pegawai/form_penghargaan.php');removeActiveDropDown()" data-toggle="tab" href="#tab-penghargaan">
                      Penghargaan
                    </a>
                  </li>
                  <li>
                    <a onclick="$('#page-punishment').load('view/pegawai/form_punishment.php');removeActiveDropDown()" data-toggle="tab" href="#tab-punishment">
                      Punishment
                    </a>
                  </li>
                  <li>
                    <a onclick="$('#page-str').load('view/pegawai/form_str.php');removeActiveDropDown()" data-toggle="tab" href="#tab-str">
                      STR
                    </a>
                  </li>
                  <li>
                    <a onclick="$('#page-sip').load('view/pegawai/form_sip.php');removeActiveDropDown()" data-toggle="tab" href="#tab-sip">
                      SIP
                    </a>
                  </li>

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
                          <input id="id_user" name="id_user" style="display:none" type="text">
					                <input placeholder="Password" id="passwordchn" name="passwordchn" style="width:300px" class="form-control" type="password">
					            </div>
					             
					            <button class="btn btn-primary" type="submit" onClick="changePass();return false;">Change</button>
                  </form>
                  
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
            <div class="tab-pane fade" id="tab-penugasaan">
              <div id="page-penugasaan"></div>
            </div>
            <div class="tab-pane fade" id="tab-skp">
              <div id="page-skp"></div>
            </div>
            <div class="tab-pane fade" id="tab-data-medical">
              <div id="page-data-medical"></div>
            </div>
            <div class="tab-pane fade" id="tab-sk">
              <div id="page-sk"></div>
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
          </div>
        </div>
      </div>
    </div>
    <div class="fixed-fluid">
      <div class="fluid"></div>
    </div>
  </div><!-- END TAB -->
  <script>
    function removeActiveDropDown(){
      $('ul.dropdown-menu').children().removeClass('active');
    }; 
    function changePass(){
      var fld = $('#passwordchn').val();
      
      if(validatePassword(fld)){
        postForm('form-gantipass',BASE_URL+'pegawai/changepass',gogo);
      } 
      
    }

    function gogo(){
      return false;
    }
    </script>
  <script src="js/pegawai/riwayat.js"></script>
  <script src="js/pegawai/pendidikan.js"></script>
  <script src="js/pegawai/pelatihan.js"></script>
  <script src="js/pegawai/golongan.js"></script>
  <script src="js/pegawai/jabatan.js"></script>
  <script src="js/pegawai/jab_asn.js"></script>