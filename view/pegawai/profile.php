<div class="fixed-fluid">
    <div class="fixed-sm-200 fixed-lg-250 pull-sm-left">
      <div class="panel">
        <!-- Simple profile -->
        <div class="text-center pad-all bord-btm">
          <div class="pad-ver"><img alt="Profile Picture" class="img-lg img-border img-circle" id="page_foto" src=""></div>
          <h4 class="text-lg text-overflow mar-no" id="page_nama"></h4>
          <hr>
          <button class="btn btn-block btn-success page-jabatan">Follow</button> 
        </div>
      </div>
    </div>
    <div class="fluid">
      <div class="bg-trans-light pad-all mar-btm clearfix">
        <!-- START TAB -->
        <div class="tab-base mar-all">
          <ul class="nav nav-tabs">
            <li class="active">
              <a data-toggle="tab" href="#demo-lft-tab-1a"><span class="block text-center text-success"><i class="fa fa-credit-card fa-2x"></i></span> Pegawai</a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-1b" onclick="tabKeluarga();"><span class="block text-center text-success"><i class="fa fa-group fa-2x"></i></span> Keluarga</a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-2a" onclick="tabPendidikan();"><span class="block text-center text-success"><i class="fa fa-graduation-cap fa-2x"></i></span> Pendidikan</a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-3a" onclick="tabPelatihan();"><span class="block text-center text-success"><i class="fa fa-briefcase fa-2x"></i></span> Pelatihan</a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-4a" onclick="tabGolongan();"><span class="block text-center text-success"><i class="fa fa-cubes fa-2x"></i></span> Golongan/Ruang</a>
            </li>
            <li>
              <a data-toggle="tab" href="#demo-lft-tab-5a" onclick="tabJabatan();"><span class="block text-center text-success"><i class="fa fa-home fa-2x"></i></span> Jabatan</a>
            </li>
          </ul>
          <div class="tab-content">
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
          </div>
        </div>
      </div>
    </div>
    <div class="fixed-fluid">
      <div class="fluid"></div>
    </div>
  </div><!-- END TAB -->
  <script>
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