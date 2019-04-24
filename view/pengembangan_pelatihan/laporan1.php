<div class="row">
	
    <div class="tab-base mar-all">
      <!--Nav Tabs-->
  
      <ul class="nav nav-tabs">
        <li class="active">
            <a href="#demo-lft-tab-1" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Perbulan
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-2" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Jenis Pegawai
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-3" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Nama Pegawai
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-4" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Jenis Nama Pegawai Pelatihan
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-5" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Unit Kerja
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-6" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Unit Kerja Pelatihan
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-7" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Jenis Kegiatan
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-8" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Compare Jenis Kegiatan
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-9" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Resume 1
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-10" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Resume 2
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-11" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Resume 3
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-12" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Resume 4
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-13" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span>
                Resume 5
            </a>
        </li><li class="">
            <a href="#demo-lft-tab-14" data-toggle="tab">
                <span class="block text-center">
                     <i class="fa fa-check-square-o fa-2x text-danger"></i> 
                </span> 
                Pembatalan
            </a>
        </li>
      </ul>
  
      <div class="tab-content">
        <div class="tab-pane fade active in" id="demo-lft-tab-1">
        <div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview1();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak1();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div>
        </div>
  
        <div class="tab-pane fade " id="demo-lft-tab-2" >
		<div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview2();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak2();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div> 
        </div> 

        <div class="tab-pane fade" id="demo-lft-tab-3">
        <div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Nama Pegawai</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview3();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak3();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div>
        </div>

		<div class="tab-pane fade" id="demo-lft-tab-4">
        <div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Nama Pegawai</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview4();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak4();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div>
        </div>
		
		
		<div class="tab-pane fade " id="demo-lft-tab-5" >
		<div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview5();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak5();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div> 
        </div> 
		
		<div class="tab-pane fade " id="demo-lft-tab-6" >
		<div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview6();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak6();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div> 
        </div> 
		
		<div class="tab-pane fade " id="demo-lft-tab-7" >
		<div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview7();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak7();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div> 
        </div> 
		
		<div class="tab-pane fade " id="demo-lft-tab-8" >
		<div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview8();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak8();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div> 
        </div> 
		
		<div class="tab-pane fade " id="demo-lft-tab-9" >
		<div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview9();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak9();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div> 
        </div> 
		
		<div class="tab-pane fade " id="demo-lft-tab-10" >
		<div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview10();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak10();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div> 
        </div> 
		
		<div class="tab-pane fade " id="demo-lft-tab-11" >
		<div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview11();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak11();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div> 
        </div> 
		
		<div class="tab-pane fade " id="demo-lft-tab-12" >
		<div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview12();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak12();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div> 
        </div> 
		<div class="tab-pane fade " id="demo-lft-tab-13" >
		<div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview13();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak13();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div> 
        </div> 
		
		<div class="tab-pane fade " id="demo-lft-tab-14" >
		<div class="row"> 
        <div class="col-md-6"> 
            <div class="box box-primary"> 
                <div class="box-body">
                <div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Awal</label>
					<div class="col-sm-7">
						<input  id="tgl_awal" name="tgl_awal" class="form-control tanggal" placeholder="Awal dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Tanggal Akhir</label>
					<div class="col-sm-7">
						<input  name="tgl_akhir" id="tgl_akhir" class="form-control tanggal" placeholder="Akhir dd-mm-yyyy" type="text">
					</div>                          
                </div>
                </div>                 
                </div>
				<div class="admininput">
                <div class="row pad-top"> 
                <div class="form-group">
					<label class="col-sm-3 control-label" for="inputstatus">Unit Kerja</label>
					<div class="col-sm-7">
						<select class="form-control select-chosen" id="txtdirektorat" name="txtdirektorat" style="width: 100%;">                                                                                        
						</select> 
					</div>                          
                </div>
                </div>                 
                </div>
                <div class="row "> 
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputstatus"></label>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="preview14();return false;">Preview</button> 
					</div>
					</div>
					<div class="col-sm-2"> 
					<div class="row  text-left"> 
						<button class="btn btn-primary mar-all" onClick="cetak14();return false;">Cetak</button> 
					</div>
					</div>
                </div>
            </div>                      
          </div>
          </div>
		</div>
        </div> 
        </div> 
		
	
      </div>
    </div>    
  </div>
<script>
	$(document).ready(function () {
		$('.tanggal').datepicker({
            format: "dd-mm-yyyy",
        }).on('change', function(){
			$('.datepicker').hide();
		  });
    });
	function preview1(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan1',pdf_rak,'large');
    }
	function preview2(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan2',pdf_rak,'large');
    }
	function preview3(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan3',pdf_rak,'large');
    }
	function preview4(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan4',pdf_rak,'large');
    }
	function preview5(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan5',pdf_rak,'large');
    }
	function preview6(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan6',pdf_rak,'large');
    }
	function preview7(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan7',pdf_rak,'large');
    }
	function preview8(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan8',pdf_rak,'large');
    }
	function preview9(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan9',pdf_rak,'large');
    }
	function preview10(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan10',pdf_rak,'large');
    }
	function preview11(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan11',pdf_rak,'large');
    }
	function preview12(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan12',pdf_rak,'large');
    }
	function preview13(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan13',pdf_rak,'large');
    }
	function preview14(){
      gopop(BASE_URL + 'pengembangan_pelatihan/preview_laporan/?&surat=laporan14',pdf_rak,'large');
    }
	
</script>