<form id="form-persyaratan"  method="post" role="form" class="form-horizontal pad-all">
	<div class="row">
		<div class="col-lg-10">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="txtjabatan">Jabatan</label>
				<div class="col-sm-8">
					<input class="form-control" type="hidden" id="id_persyaratan" name="id_persyaratan" >
					<select aria-hidden="true" class="select-chosen" id="txtjabatan" name="txtjabatan" style="width: 70%;" tabindex="-1">
						
					</select>
					<span class="text-xs text-danger">* Wajib Diisi</span>
				</div>
			</div>
		<!-- <div class="form-group">
			<label class="col-sm-4 control-label" for="inputrw">Bagian</label>
			<div class="col-sm-8">
				<select aria-hidden="true" class="select-chosen" id="txtbagian" name="txtbagian" onchange="getToSub(this.value,'unitkerja','master/direktoratSub/')" style="width: 100%;" tabindex="-1">
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="inputpropinsi">Sub Bagian</label>
			<div class="col-sm-8">
				<select aria-hidden="true" class="select-chosen" id="unitkerja" name="unitkerja" style="width: 100%;" tabindex="-1">
					 
				</select>
			</div>
		</div> -->
		<div class="form-group">
			<label class="col-sm-4 control-label" for="masajbt">Masa Jabatan</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" id="masajbt" name="masajbt">
				<span class="text-xs text-danger">* Wajib Diisi</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="kompetensi">Standard Kompetesi</label>
			<div class="col-sm-8">
				<textarea placeholder="" class="form-control input-sm" id="kompetensi" name="kompetensi" type="text"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="formal">Pendidikan Formal</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" id="formal" name="formal">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="nonformal">Pendidikan Non Formal</label>
			<div class="col-sm-8">
				<textarea placeholder="" class="form-control input-sm" id="nonformal" name="nonformal" type="text"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="txtjabatans">Jabatan Yang Telah Diemban</label>
			<div class="col-sm-8">
				<select aria-hidden="true" class="select-chosen" id="txtjabatans" name="txtjabatans" style="width: 70%;" tabindex="-1">
					
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="lain">Lain - Lain</label>
			<div class="col-sm-8">
				<textarea placeholder="" class="form-control input-sm" id="lain" name="lain" type="text"></textarea>
			</div>
		</div>
		<!-- <div class="form-group">
			<label class="col-sm-4 control-label" for="inputrw">Bagian</label>
			<div class="col-sm-8">
				<select aria-hidden="true" class="select-chosen" id="txtbagians" name="txtbagians" onchange="getToSub(this.value,'unitkerjas','master/direktoratSub/')" style="width: 100%;" tabindex="-1">
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="inputpropinsi">Sub Bagian</label>
			<div class="col-sm-8">
				<select aria-hidden="true" class="select-chosen" id="unitkerjas" name="unitkerjas" style="width: 100%;" tabindex="-1">
					 
				</select>
			</div>
		</div> -->
		
		<div class="form-group">
			<label class="col-sm-4 control-label" for="tufoksi">Tupoksi</label>
			<div class="col-sm-8">
				<textarea placeholder="" class="form-control input-sm" id="tufoksi" name="tufoksi" type="text"></textarea>
				<span class="text-xs text-danger">* Wajib Diisi</span>
			</div>
		</div>
		<!-- <div class="body-content">
			<div class="form-group body-remove">
				<label class="col-sm-4 control-label">Standar Kopetensi</label>
				<div class="body-detail">
					<div class="col-sm-5">
						<input type="text" name="kopetensi[]" class="form-control biaya_uraian" id="kopetensi" 
							   placeholder="Kopetensi"/>
					</div>
				</div>
				<div class="col-xs-3 pull right">
					<div class="btn btn-default btn-sm" id="add-data">Add</div>
				</div>
			</div>
		</div>					   --> 				   
	</div>
</div>
</form>


<script>
	$("#add-data").on("click", function () {

		var row = $(
			'<div class="form-group body-remove">' +
			'<label class="col-sm-4 control-label"></label>' +
			'<div class="body-detail">' +
			'<div class="col-sm-5">' +
			'<input type="text" name="kopetensi[]" class="form-control biaya_uraian" placeholder="Kopetensi" />' +
			'</div>' +
			'</div>' +
			'<div class="col-xs-3 pull right">' +
			'<div class="btn btn-default btn-sm btn-remove">' +
			'<i class="fa fa-trash-o"></i>' +
			'</div>' +
			'</div>' +
			'</div>');
		$(".body-content").append(row);
	});
	$(document).on('click', '.btn-remove', function (event) {
		console.log("remove" + $(this));
		$(this).parentsUntil(".body-remove").parent().remove();
	});
	var group = localStorage.getItem('group');
	getOptions("txtjabatan",BASE_URL+"master/jabatan_struktural_fix?id="+group);
	getOptions("txtjabatans",BASE_URL+"master/jabatan_struktural_fix_label");
	$('.select-chosen').chosen();
	$('.chosen-container').css({"width": "100%"});

	var idcell = getGridId(gridOptions_persyaratan,'id');
	$('#id_persyaratan').val(idcell);
	

	window.setTimeout(function(){
		if(!empty($('#id_persyaratan').val())){
			
			getJson(getdata_persyaratan, url_api+'listdata?id='+idcell);
		}
	},500);
	


	function getdata_persyaratan(result){
		
		$('#id_persyaratan').val(result.result[0].id);
		getOptionsEdit("txtjabatan",BASE_URL+"master/jabatan_struktural_fix_label",result.result[0].id_jabatan);
		$('#masajbt').val(result.result[0].masa_jabatan);
		$('#kompetensi').val(result.result[0].kompetensi);
		$('#formal').val(result.result[0].formal);
		$('#nonformal').val(result.result[0].nonformal);
		getOptionsEdit("txtjabatans",BASE_URL+"master/jabatan_struktural_fix_label",result.result[0].id_jabatan_lama);
		$('#tufoksi').val(result.result[0].tufoksi);
		$('#lain').val(result.result[0].lain);
	}

</script>