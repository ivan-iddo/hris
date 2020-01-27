<?php
require_once('../../connectdb.php');

?>
<form id="form-pelatihan"  method="post" role="form" class="pad-all">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
		<input type="text" style="display:none" name="kategorifile" id="kategorifile" value="13">
		  <input type="text" style="display:none" name="id_userfile" id="id_userfile">
          <div class="form-group">
		  <input type="hidden" value="<?php echo $_SESSION['userdata']['_pnc_username'] ; ?>" name="created" id="created">
            <label class="col-sm-4 control-label" for="inputstatus">Pelatihan</label>
            <div class="col-sm-8">
              <input class="form-control" id="nama" name="nama" placeholder="" type="text">
              <input type="text" id="id_pelatihan" name="id_pelatihan" style="display:none">
            </div>
          </div>
                        <!--<div class="form-group">
                          <label class="col-sm-4 control-label" for="inputstatus">Lokasi</label>
                          <div class="col-sm-8">
                            <input class="form-control" id="tempat" name="tempat" placeholder="" type="text">
                          </div>
                        </div>
                      -->
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputrt">Lokasi</label>
                        <div class="col-sm-8">
                          <select class="form-control select2" id="tempat" name="tempat" style="width: 100%;">
                           <option value=1>Afganistan</option>
							<option value=2>Afrika Selatan</option>
							<option value=3>Afrika Tengah</option>
							<option value=4>Albania</option>
							<option value=5>Aljazair</option>
							<option value=6>Amerika Serikat</option>
							<option value=7>Andorra</option>
							<option value=8>Angola</option>
							<option value=9>Antigua dan Barbuda</option>
							<option value=10>Arab Saudi</option>
							<option value=11>Argentina</option>
							<option value=12>Armenia</option>
							<option value=13>Australia</option>
							<option value=14>Austria</option>
							<option value=15>Azerbaijan</option>
							<option value=16>Bahama</option>
							<option value=17>Bahrain</option>
							<option value=18>Bangladesh</option>
							<option value=19>Barbados</option>
							<option value=20>Belanda</option>
							<option value=21>Belarus</option>
							<option value=22>Belgia</option>
							<option value=23>Belize</option>
							<option value=24>Benin</option>
							<option value=25>Bhutan</option>
							<option value=26>Bolivia</option>
							<option value=27>Bosnia dan Herzegovina</option>
							<option value=28>Botswana</option>
							<option value=29>Brasil</option>
							<option value=30>Britania Raya</option>
							<option value=31>Brunei Darussalam</option>
							<option value=32>Bulgaria</option>
							<option value=33>Burkina Faso</option>
							<option value=34>Burundi</option>
							<option value=35>Ceko</option>
							<option value=36>Chad</option>
							<option value=37>Chili</option>
							<option value=38>China</option>
							<option value=39>Denmark</option>
							<option value=40>Djibouti</option>
							<option value=41>Dominika</option>
							<option value=42>Ekuador</option>
							<option value=43>El Salvador</option>
							<option value=44>Eritrea</option>
							<option value=45>Estonia</option>
							<option value=46>Ethiopia</option>
							<option value=47>Fiji</option>
							<option value=48>Filipina</option>
							<option value=49>Finlandia</option>
							<option value=50>Gabon</option>
							<option value=51>Gambia</option>
							<option value=52>Georgia</option>
							<option value=53>Ghana</option>
							<option value=54>Grenada</option>
							<option value=55>Guatemala</option>
							<option value=56>Guinea</option>
							<option value=57>Guinea Bissau</option>
							<option value=58>Guinea Khatulistiwa</option>
							<option value=59>Guyana</option>
							<option value=60>Haiti</option>
							<option value=61>Honduras</option>
							<option value=62>Hongaria</option>
							<option value=63>India</option>
							<option value=64>Indonesia</option>
							<option value=65>Irak</option>
							<option value=66>Iran</option>
							<option value=67>Irlandia</option>
							<option value=68>Islandia</option>
							<option value=69>Israel</option>
							<option value=70>Italia</option>
							<option value=71>Jamaika</option>
							<option value=72>Jepang</option>
							<option value=73>Jerman</option>
							<option value=74>Kamboja</option>
							<option value=75>Kamerun</option>
							<option value=76>Kanada</option>
							<option value=77>Kazakhstan</option>
							<option value=78>Kenya</option>
							<option value=79>Kirgizstan</option>
							<option value=80>Kiribati</option>
							<option value=81>Kolombia</option>
							<option value=82>Komoro</option>
							<option value=83>Republik Kongo</option>
							<option value=84>Korea Selatan</option>
							<option value=85>Korea Utara</option>
							<option value=86>Kosta Rika</option>
							<option value=87>Kroasia</option>
							<option value=88>Kuba</option>
							<option value=89>Kuwait</option>
							<option value=90>Laos</option>
							<option value=91>Latvia</option>
							<option value=92>Lebanon</option>
							<option value=93>Lesotho</option>
							<option value=94>Liberia</option>
							<option value=95>Libya</option>
							<option value=96>Liechtenstein</option>
							<option value=97>Lituania</option>
							<option value=98>Luksemburg</option>
							<option value=99>Madagaskar</option>
							<option value=100>Makedonia</option>
							<option value=101>Maladewa</option>
							<option value=102>Malawi</option>
							<option value=103>Malaysia</option>
							<option value=104>Mali</option>
							<option value=105>Malta</option>
							<option value=106>Maroko</option>
							<option value=107>Marshall</option>
							<option value=108>Mauritania</option>
							<option value=109>Mauritius</option>
							<option value=110>Meksiko</option>
							<option value=111>Mesir</option>
							<option value=112>Mikronesia</option>
							<option value=113>Moldova</option>
							<option value=114>Monako</option>
							<option value=115>Mongolia</option>
							<option value=116>Montenegro</option>
							<option value=117>Mozambik</option>
							<option value=118>Myanmar</option>
							<option value=119>Namibia</option>
							<option value=120>Nauru</option>
							<option value=121>Nepal</option>
							<option value=122>Niger</option>
							<option value=123>Nigeria</option>
							<option value=124>Nikaragua</option>
							<option value=125>Norwegia</option>
							<option value=126>Oman</option>
							<option value=127>Pakistan</option>
							<option value=128>Palau</option>
							<option value=129>Panama</option>
							<option value=130>Pantai Gading</option>
							<option value=131>Papua Nugini</option>
							<option value=132>Paraguay</option>
							<option value=133>Perancis</option>
							<option value=134>Peru</option>
							<option value=135>Polandia</option>
							<option value=136>Portugal</option>
							<option value=137>Qatar</option>
							<option value=138>Republik Demokratik Kongo</option>
							<option value=139>Republik Dominika</option>
							<option value=140>Rumania</option>
							<option value=141>Rusia</option>
							<option value=142>Rwanda</option>
							<option value=143>Saint Kitts and Nevis</option>
							<option value=144>Saint Lucia</option>
							<option value=145>Saint Vincent and the Grenadines</option>
							<option value=146>Samoa</option>
							<option value=147>San Marino</option>
							<option value=148>Sao Tome and Principe</option>
							<option value=149>Selandia Baru</option>
							<option value=150>Senegal</option>
							<option value=151>Serbia</option>
							<option value=152>Seychelles</option>
							<option value=153>Sierra Leone</option>
							<option value=154>Singapura</option>
							<option value=155>Siprus</option>
							<option value=156>Slovenia</option>
							<option value=157>Slowakia</option>
							<option value=158>Solomon</option>
							<option value=159>Somalia</option>
							<option value=160>Spanyol</option>
							<option value=161>Sri Lanka</option>
							<option value=162>Sudan</option>
							<option value=163>Sudan Selatan</option>
							<option value=164>Suriah</option>
							<option value=165>Suriname</option>
							<option value=166>Swaziland</option>
							<option value=167>Swedia</option>
							<option value=168>Swiss</option>
							<option value=169>Tajikistan</option>
							<option value=170>Tanjung Verde</option>
							<option value=171>Tanzania</option>
							<option value=172>Thailand</option>
							<option value=173>Timor Leste</option>
							<option value=174>Togo</option>
							<option value=175>Tonga</option>
							<option value=176>Trinidad and Tobago</option>
							<option value=177>Tunisia</option>
							<option value=178>Turki</option>
							<option value=179>Turkmenistan</option>
							<option value=180>Tuvalu</option>
							<option value=181>Uganda</option>
							<option value=182>Ukraina</option>
							<option value=183>Uni Emirat Arab</option>
							<option value=184>Uruguay</option>
							<option value=185>Uzbekistan</option>
							<option value=186>Vanuatu</option>
							<option value=187>Venezuela</option>
							<option value=188>Vietnam</option>
							<option value=189>Yaman</option>
							<option value=190>Yordania</option>
							<option value=191>Yunani</option>
							<option value=192>Zambia</option>
							<option value=193>Zimbabwe</option>

                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputstatus">Penyelenggara</label>
                        <div class="col-sm-8">
                          <input class="form-control" id="penyelenggara" name="penyelenggara" placeholder="" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputrt">Penanggung Biaya</label>
                        <div class="col-sm-8">
                          <select class="form-control select2" id="penanggung" name="penanggung" style="width: 100%;">
                           <option value="1">Sendiri</option>
						   <option value="2">Kantor</option>     
						   <option value="3">Sponsor</option>     
              
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputtgllahirkel">Lama</label>
                        <div class="col-sm-8">
                          <input class="form-control" id="durasi" name="durasi" placeholder="" type="text">
                        </div>
                      </div><!-- End Hori sontal -->
                    </div>
                  </div><!-- /.box -->
                  <!-- Form Element sizes -->
                  <!-- /.box -->
                  <!-- Input addon -->
                  <div class="box box-info">
                    <!-- /.box-body -->
                  </div><!-- /.box -->
                </div><!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">
                  <!-- Horizontal Form -->
                  <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title"></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputpropinsi">Mulai</label>
                        <div class="col-sm-8">
                          <input class="form-control tgl" id="mulai" name="mulai" placeholder="dd-mm-yyyy" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputpropinsi">Sampai</label>
                        <div class="col-sm-8">
                          <input class="form-control tgl" id="sampai" name="sampai" placeholder="dd-mm-yyyy" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputpropinsi">Bersetifikat</label>
                        <div class="col-sm-8">
                          <input class="form-control" id="jenis_sertifikat" name="jenis_sertifikat" placeholder="" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputpropinsi">No. Sertifikat</label>
                        <div class="col-sm-8">
                          <input class="form-control" id="no_sertifikat" name="no_sertifikat" placeholder="" type="text">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="col-sm-4 control-label" for="inputrt">Kategori</label>
                        <div class="col-sm-8">
                          <select class="form-control select2" id="kategori" name="kategori" style="width: 100%;">
                           <option value="119">Kopetensi</option>
						   <option value="120">Profesi</option>     
		                  </select>
                        </div>
                      </div>
                      
                    </div>
                  </div><!-- /.box -->
                  
                  <!-- general form elements disabled -->
                  <!-- /.box -->
                </div><!--/.col (right) -->
              </div><!-- /.row -->
              <div class="panel pad-all mar-all">
                
                <div class="box-body">
                  
                  <div class="btn-group mar-rgt">
					 <input type="text" placeholder="nama file" class="form-control" id="namafile" name="namafile">
                    <input name="doc_file" id="doc_file" type="file" class="btn btn-success btn-sm fileinput-button dz-clickable">
                    
                  </div>
                  
                  
                  
                  <div class="row text-xs text-danger">
                    *Untuk upload ijazah silahkan simpan data terlebih dahulu
                  </div>
                  
                </div>
                <div class="panel-body">
                  <div class="row pad-all">
                    <div id="uploadbtn" class="btn btn-primary btn-sm pull-left upload-btn" onclick="upload_file()"><i class="fa fa-save"></i> Upload</div>
                  </div>
                  <div class="table-responsive">
                   <table class="table table-striped">
                     <thead>
                       <tr>
                         <th>No.</th>
                         <th>Nama File</th>
                         <th>Action</th>
                       </tr>
                     </thead>
                     <tbody id="file">
                      
                     </tbody>
                   </table>
                 </div>
               </div>
             </div>
           </form>


           <script>
		   
		   function getfilepel(result) {
				$('#file').html(result.isi);
			}

    function loadfilepel() {
	var id_user = $('#id_user').val();
      var selectedRows = gridPelatihanOpt.api.getSelectedRows();
      var selectedRowsString = '';
      selectedRows.forEach( function(selectedRow, index) {
       
        if (index!==0) {
            selectedRowsString += ', ';
        }
        selectedRowsString += selectedRow.id;
    });
      getJson(getfilepel, BASE_URL + 'pegawais/pelatihan/file_pel/?id=' + id_user + '&id_pel=' + selectedRowsString +'&kategori=' + $('#kategorifile').val());
  }

  loadfilepel();
  
            function upload_file(){
			  var id_user = $('#id_user').val();
			  $('#id_userfile').val(id_user);
			  var form = $("#form-pelatihan");
              var id_pelatihan = $('#id_pelatihan').val();
			  if (empty($('#doc_file').val())) {
					swal('PERHATIAN!', 'Anda belum memilih file untuk di upload');
					return false;
				} else if (empty($('#namafile').val())) {
					swal('PERHATIAN!', 'Anda memasukkan nama file');
					return false;
				}
              if(id_pelatihan!==''){
                $.ajax({
                            url: BASE_URL+"pegawais/upload/upload_pelatihan", 
							type: "POST", 
			data: new FormData(form[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
                              hasil=data.hasil;
                               message = data.message;
							if (hasil == "success") {
								swal("Good job!", message, "success");
								loadfilepel();
							}else{
                              alert(message);
                              return false;	
                            }
                          }
                        });
              }else{
                alert('Anda harus menyimpan data pelatihan terlebih dahulu sebelum melakukan upload ijazah!');
              }
            }
            $(document).ready(function () {
             $('.tgl').datepicker({
              format: "dd-mm-yyyy",
            }).on('change', function(){
              $('.datepicker').hide();
            });
          }); 
            $('.select2').chosen();
            $('.chosen-container').css({"width": "100%"});
        
		function filedelete(result) {
    if (result.hasil === 'success') {
        swal("Deleted!", "Data berhail dihapus.", "success");
    } else {
        swal("GAGAL!", "Data gagal dihapus.");
    }
    loadfilepel();
}

function hapusfile(a) {
    swal({
        title: "Apakah Anda sudah Yakin?",
        text: "Data yang sudah dihapus tidak bisa di hidupkan kembali!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus saja!",
        closeOnConfirm: false
    }, function () {
        getJson(filedelete, BASE_URL + 'pegawais/pelatihan/deletelist/?id=' + a);
    });
}

          </script>