<form id="form-persyaratan"  method="post" role="form" class="form-horizontal pad-all">
<div class="row">
						<div class="col-lg-5">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrt">Direktorat</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="txtjabatan" name="txtjabatan" onchange="getToSub(this.value,'txtbagian','master/direktoratSub/')" style="width: 70%;" tabindex="-1">
									 
								</select>
							</div>
						</div>
						<div class="form-group">
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
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">Masa Jabatan</label>
							<div class="col-sm-8">
								<input class="form-control" type="text" id="masajbt" name="masajbt">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputrw">Pendidikan Formal</label>
							<div class="col-sm-8">
							 <input class="form-control" type="text" id="formal" name="formal">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputpropinsi">Pendidikan Non Formal</label>
							<div class="col-sm-8">
								<input class="form-control" type="text" id="nonformal" name="nonformal">
						</div>
					   </div>
					   <div class="form-group">
							<label class="col-sm-4 control-label" for="inputrt">Direktorat</label>
							<div class="col-sm-8">
								<select aria-hidden="true" class="select-chosen" id="txtjabatans" name="txtjabatans" onchange="getToSub(this.value,'txtbagians','master/direktoratSub/')" style="width: 70%;" tabindex="-1">
									 
								</select>
							</div>
						</div>
						<div class="form-group">
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
						</div>
           			  </div>
					   <div class="form-group">
					     <label class="col-sm-4 control-label" for="demo-is-inputsmall">Tufoksi</label>
					      <div class="col-sm-8">
					         <textarea placeholder="" class="form-control input-sm" id="tufoksi" name="tufoksi" type="text">
							</textarea>
					     </div>
					   </div>
						<div class="body-content">
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
getOptions("txtjabatan",BASE_URL+"master/direktorat");
getOptions("txtjabatans",BASE_URL+"master/direktorat");
      $('.select-chosen').chosen();
 $('.chosen-container').css({"width": "100%"});

</script>