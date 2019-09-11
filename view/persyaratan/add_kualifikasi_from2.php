<form id="form-pengajuan-detail"  method="post" role="form" class="form-horizontal pad-all">
	<div class="row">
		<h3 class="nama_pengaju"></h3>
		<div class="col-lg-5 col-sm-offset-1">
			<h4>Kualifikasi From 1</h4>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="txtjabatan">Jabatan</label>
				<div class="col-sm-9">
					<input type="hidden" id="txtIdUser" name="txtIdUser"  type="text">
					<select aria-hidden="true" class="select-chosen" id="jabatan" name="jabatan" style="width: 70%;" tabindex="-1">
					</select>
					
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="masajbt">Masa Jabatan</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" id="masajbt" name="masajbt" style="border:none" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="kompetensi">Standard Kompetesi</label>
				<div class="col-sm-9">
					<textarea placeholder="" class="form-control input-sm" id="kompetensi" name="kompetensi" type="text" style="border:none" readonly></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="formal">Pendidikan Formal</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" id="formal" name="formal" style="border:none" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="nonformal">Pendidikan Non Formal</label>
				<div class="col-sm-9">
					<textarea placeholder="" class="form-control input-sm" id="nonformal" name="nonformal" type="text" style="border:none" readonly></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="txtjabatans">Jabatan Yang Telah Diemban</label>
				<div class="col-sm-9">
					<textarea placeholder="" class="form-control input-sm" id="txtkjabatans" name="txtkjabatans" type="text" style="border:none" readonly></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="tufoksi">Tupoksi</label>
				<div class="col-sm-9">
					<textarea placeholder="" class="form-control input-sm" id="tufoksi" name="tufoksi" type="text" style="border:none" readonly></textarea>
				</div>
			</div>

		</div>

		<div class="col-lg-5">
			<h4>Kualifikasi Form 2</h4>
		<!-- <div class="form-group">
			<label class="col-sm-4 control-label" for="txtjabatan">Jabatan</label>
			<div class="col-sm-8">
				
				<input class="form-control" type="text" id="txtjabatan" name="txtjabatan" style="border:none" readonly>
			</div>
		</div> -->
		<div class="form-group">
			<label class="col-sm-3 control-label" for="jabatans">Jabatan</label>
			<div class="col-sm-9">
				<input placeholder="" class="form-control input-sm" id="id_persyaratan" name="id_persyaratan" type="hidden" ></input>
				<input placeholder="" class="form-control input-sm" id="jabatans" name="jabatans" type="text" style="border:none" readonly></input>
				
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="masajbtpengaju">Masa Jabatan</label>
			<div class="col-sm-9">
				<input class="form-control" type="text" id="masajbtpengaju" name="masajbtpengaju">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="kompetensipengaju">Standard Kompetesi</label>
			<div class="col-sm-9">
				<textarea placeholder="" class="form-control input-sm" id="kompetensipengaju" name="kompetensipengaju" type="text" ></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="formalpengaju">Pendidikan Formal</label>
			<div class="col-sm-9">
				<div id="formalpengaju" class="formalpengaju"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="nonformalpengaju">Pendidikan Non Formal</label>
			<div class="col-sm-9">
				<div id="nonformalpengaju" class="nonformalpengaju"></div>
				
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="txtjabatanspengaju">Jabatan Yang Telah Diemban</label>
			<div class="col-sm-9">
				<textarea placeholder="" class="form-control input-sm" id="txtjabatanspengaju" name="txtjabatanspengaju" type="text" style="border:none" readonly></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label" for="tufoksipengaju">Tupoksi</label>
			<div class="col-sm-9">
				<textarea placeholder="" class="form-control input-sm" id="tufoksipengaju" name="tufoksipengaju" type="text"></textarea>
			</div>
		</div>
	</div>

</div>
</form>



<script>
	$('.select-chosen').chosen();
	$('.chosen-container').css({"width": "100%"});
	var id = getGridId(gridOptions,'id');
	$('#txtIdUser').val(id);
	

	window.setTimeout(function(){
		if(!empty($('#txtIdUser').val())){ 
			getJson(getdata, BASE_URL+'pegawai/kualifikasi?id='+id);
			getInputTypeOptions("formalpengaju",BASE_URL+'pegawai/getPend?id='+id);
			getInputTypeOptions("nonformalpengaju",BASE_URL+'pegawais/pelatihan/getPel?id='+id);
			
		}
	},500);
	


	function getdata(result){
		$('#txtIdUser').val(result.id);
		$('#txtjabatanspengaju').val(result.jabatan);
	}
	function loaddata(id, url, valueEdit = null) {
		$('#' + id).children().remove();
		$('#' + id).append('<option value="" selected="selected">Pilih</option>');

		$.ajax({
			type: "GET",
			url: url,
			headers: {
				'Authorization': localStorage.getItem("Token"),
				'X_CSRF_TOKEN': 'donimaulana',
				'Content-Type': 'application/json'
			},
			dataType: "json",
			success: function (e) {
				for (var i = 0; i < e.result.length; i++) {
					$('#' + id).append('<option ' + (e.result[i].id == valueEdit ? 'selected' : '') + ' value="' + e.result[i].id + '" data-id-persyaratan="' + e.result[i].id + '"data-id="' + e.result[i].id_jabatan + '"data-baru="' + e.result[i].jabatan_baru + '" data-masa="' + e.result[i].masa_jabatan + '"data-kompetensi="' + e.result[i].kompetensi + '"data-formal="' + e.result[i].formal + '"data-nonformal="' + e.result[i].nonformal + '"data-jabatan-lama="' + e.result[i].jabatan_lama + '"data-tufoksi="' + e.result[i].tufoksi + '">' + e.result[i].jabatan_baru + ' [Kode :' + e.result[i].kd_jabatan + ']</option>');
				}
				$('#' + id).trigger("chosen:updated");
			}
		});
	}
	loaddata("jabatan", BASE_URL + "persyaratan/persyaratan/listdata");
	
	$("#jabatan").on("change", function () {
		if ($(this).find(':selected').attr("data-id") != undefined) {
			$("#id_persyaratan").val($(this).find(':selected').attr("data-id-persyaratan"));
			$("#id_jabatan").val($(this).find(':selected').attr("data-id"));
			$("#masajbt").val($(this).find(':selected').attr("data-masa"));
			$("#kompetensi").val($(this).find(':selected').attr("data-kompetensi"));
			$("#formal").val($(this).find(':selected').attr("data-formal"));
			$("#nonformal").val($(this).find(':selected').attr("data-nonformal"));
			$("#txtkjabatans").val($(this).find(':selected').attr("data-jabatan-lama"));
			$("#jabatans").val($(this).find(':selected').attr("data-baru"));
			$("#tufoksi").val($(this).find(':selected').attr("data-tufoksi"));
		}else{
			$("#id_persyaratan").val('');
			$("#id_jabatan").val('');
			$("#masajbt").val('');
			$("#kompetensi").val('');
			$("#formal").val('');
			$("#nonformal").val('');
			$("#txtkjabatans").val('');
			$("#jabatans").val('');
			$("#tufoksi").val('');
		}
	});
	
	
</script>