<form id="form-pengajuan"  method="post" role="form" class="form-horizontal pad-all">
	<div class="row">
		<div class="col-lg-10">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="txtjabatan">Jabatan</label>
				<div class="col-sm-8">
					<input class="form-control" type="hidden" id="id_persyaratan" name="id_persyaratan" >
					<input class="form-control" type="text" id="txtjabatan" name="txtjabatan" style="border:none" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="masajbt">Masa Jabatan</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="masajbt" name="masajbt" style="border:none" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="kompetensi">Standard Kompetesi</label>
				<div class="col-sm-8">
					<textarea placeholder="" class="form-control input-sm" id="kompetensi" name="kompetensi" type="text" style="border:none" readonly></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="formal">Pendidikan Formal</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="formal" name="formal" style="border:none" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="nonformal">Pendidikan Non Formal</label>
				<div class="col-sm-8">
					<textarea placeholder="contoh -Office" class="form-control input-sm" id="nonformal" name="nonformal" type="text" style="border:none" readonly></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="txtjabatans">Jabatan Yang Telah Diemban</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="txtjabatans" name="txtjabatans" style="border:none" readonly>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-4 control-label" for="tufoksi">Tupoksi</label>
				<div class="col-sm-8">
					<textarea placeholder="" class="form-control input-sm" id="tufoksi" name="tufoksi" type="text" style="border:none" readonly></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="tufoksi">Kompetensi Yang Dimiliki</label>
				<div class="col-sm-8">
					<textarea placeholder="contoh -Office" class="form-control input-sm" id="kompetensiAnda" name="kompetensiAnda" type="text"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="tufoksi">Tupoksi Kompetensi</label>
				<div class="col-sm-8">
					<textarea placeholder="Tupoksi Kompetensi" class="form-control input-sm" id="tufoksipengaju" name="tufoksipengaju" type="text"></textarea>
				</div>
			</div>
		</div>
	</div>
</form>



<script>

	var idcell = getGridId(gridOptions_persyaratan,'id');
	$('#id_persyaratan').val(idcell);
	

	window.setTimeout(function(){
		if(!empty($('#id_persyaratan').val())){
			
			getJson(getdata_persyaratan, url_api2+'listdata?id='+idcell);
		}
	},500);
	


	function getdata_persyaratan(result){
		
		$('#id_persyaratan').val(result.result[0].id);
		$('#txtjabatan').val(result.result[0].jabatan_baru);
		$('#masajbt').val(result.result[0].masa_jabatan);
		$('#kompetensi').val(result.result[0].kompetensi);
		$('#formal').val(result.result[0].formal);
		$('#nonformal').val(result.result[0].nonformal);
		$('#txtjabatans').val(result.result[0].jabatan_lama);
		$('#tufoksi').val(result.result[0].tufoksi);
	}


</script>