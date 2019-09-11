<style>
	.span-group-addon{
		border:none !important; 
	}

</style>
<form id="form-detail-alasan" method="post">
	<div class="box-body pad-all">

		<div class="row">
			<div class="form-group row pad-top">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX">Alasan permintaan</label>
				<div class="col-md-8 col-sm-4 col-xs-12">
					<div class="span-group">
						<span class="span-group-addon">
							<span aria-label="..." type="checkbox">
							</span>
							<span class="span-group-addon">Menggantikan Karyawan :</span>
							<span class="span-group-addon">&nbsp;</span>
							&nbsp;

						</div><!-- /span-group -->
					</div>

				</div>
			</div>
			<div class="row">
				<div class="form-group row pad-top">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX">&nbsp;</label>
					<div class="col-md-6 col-sm-4 col-xs-12">
						<div class="span-group">
							<span class="span-group-addon"> 
							</span>

							<span class="span-group-addon">Nama Karyawan yang digantikan :</span>
							<span  id="nama_karyawan" name="nama_karyawan"  style="font-weight:bold" ></span>
						</div><!-- /span-group -->
					</div>

				</div>
			</div>
			<div class="form-group row pad-top">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX">&nbsp;</label>
				<div class="col-md-6 col-sm-4 col-xs-12">
					<div class="span-group">
						<span class="span-group-addon"> 
						</span>

						<span class="span-group-addon">Keluar/Pensiun per :</span>
						<span  id="tgl_keluar" name="tgl_keluar"  style="font-weight:bold" ></span>
					</div><!-- /span-group -->
				</div>

			</div>


			<div class="row">
				<div class="form-group row pad-top">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX"></label>
					<div class="col-md-8 col-sm-4 col-xs-12">
						<div class="span-group">
							<span class="span-group-addon">
								<span aria-label="..." type="checkbox">
								</span>
								<span class="span-group-addon">Penambahan / Rekrutmen baru, alasan :</span>
								<span  id="alasan_rekrut" name="alasan_rekrut"  style="font-weight:bold" ></span>
							</div><!-- /span-group -->
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group row pad-top">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX"></label>
						<div class="col-md-8 col-sm-4 col-xs-12">
							<div class="span-group">
								<span class="span-group-addon">
								</span>
								<span class="span-group-addon">Dampak yang diharapkan :</span>
								<span  id="dampak_diharapkan" name="dampak_diharapkan"  style="font-weight:bold" ></span>
							</div><!-- /span-group -->
						</div>
					</div>
				</div>			
				<div class="row">
					<div class="form-group row pad-top">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX"></label>
						<div class="col-md-8 col-sm-4 col-xs-12">
							<div class="span-group">
								<span class="span-group-addon">
								</span>
								<span class="span-group-addon">Indikator :</span>
								<span  id="indikator" name="indikator"  style="font-weight:bold" ></span>
							</div><!-- /span-group -->
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group row pad-top">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX"></label>
						<div class="col-md-6 col-sm-5 col-xs-12">
							<div class="span-group">
								<span class="span-group-addon">
									<span aria-label="..." type="checkbox">
									</span>
									<span class="span-group-addon">Sementara, untuk jangka waktu :</span>
									<span  id="jangka_waktu_bln" name="jangka_waktu_bln" style="font-weight:bold"  ></span>
									<span class="span-group-addon">Bulan</span>
								</div><!-- /span-group -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group row pad-top">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX"></label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<div class="span-group">
									<span class="span-group-addon">
										<span aria-label="..." type="checkbox">
										</span>
										<span class="span-group-addon">Lain-lain :</span>
										<span  id="lain_lain" name="lain_lain" style="font-weight:bold" ></span>
									</div><!-- /span-group -->
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group row pad-top">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX">Sumber</label>
								<div class="col-md-4 col-sm-4 col-xs-12">


									<span  id="id_sumber" name="id_sumber"  style="font-weight:bold" ></span>

								</div>

							</div>
						</div>
						<div class="row">
							<div class="form-group row pad-top">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX">Status Pegawai-PNS </label>
								<div class="col-md-3 col-sm-3 col-xs-12">

									<span  id="status_pegawai_pns" name="status_pegawai_pns"  style="font-weight:bold" ></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group row pad-top">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="BDSEX">Status Pegawai-Tetap </label>
								<div class="col-md-4 col-sm-4 col-xs-12">

									<span  id="status_pegawai_tetap" name="status_pegawai_tetap"  style="font-weight:bold" ></span>
								</div>

							</div>
						</div>






						<!-- End Hori sontal -->

					</div>
				</form>
				<script>

					$('.select-chosen').chosen();
					$('.chosen-container').css({"width": "100%"});

					var selectedRows = gridTK.api.getSelectedRows();
// alert('>>'+selectedRows+'<<<');
if(selectedRows == ''){

}else{
	var selectedRowsString = '';
	var id_ukres = '';
	var tahunres = '';
	selectedRows.forEach( function(selectedRow, index) {

		if (index!==0) {
			selectedRowsString += ', ';
		}
		selectedRowsString += selectedRow.id;
		id_ukres += selectedRow.id_unit;
		tahunres += selectedRow.tahun;
	});  
	$('#idtk').val(selectedRowsString);
	getJson(setPengajuan,BASE_URL+'abk/abk/getrowpengajuandetail?id='+selectedRowsString);

}


function setPengajuan(result){
	if(result.hasil ==='success'){
//getOptionsEdit("id_sumber",BASE_URL+"master/direktoratSub",result.data.id_uk_det);
getOptionsEdit("id_kp",BASE_URL+'dokumen/gettaksonomi?id=35',result.data.id_kp);


$('#id_gantikaryawan').html(result.data.id_gantikaryawan);
$('#nama_karyawan').html(result.data.nama_karyawan);
$('#tgl_keluar').html(result.data.tgl_keluar);
$('#alasan_rekrut').html(result.data.alasan_rekrut);
$('#dampak_diharapkan').html(result.data.dampak_diharapkan);
$('#indikator').html(result.data.indikator);
$('#jangka_waktu_bln').html(result.data.jangka_waktu_bln);
$('#lain_lain').html(result.data.lain_lain);   
$('#flag').html(result.data.flag); 

$('#id_sumber').html(result.data.sumber);
$('#status_pegawai_pns').html(result.data.pns);   
$('#status_pegawai_tetap').html(result.data.tetap); 



}else{ 
	$('#id_pengajuandetail').val(selectedRowsString);
	getOptions("id_sumber",BASE_URL+'dokumen/gettaksonomi?id=36');
	getOptions("status_pegawai_pns",BASE_URL+"master/status_pegawai?type=pns");
	getOptions("status_pegawai_tetap",BASE_URL+"master/status_pegawai?type=nonpns");
}
}


</script>