<form id="form-pensiun"  method="post" role="form" class="form-horizontal pad-all">
	<div class="row pad-all">
		<div class="col-lg-12">
			
		</div>
		<div class="col-lg-8">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrt">Alasan Keluar</label>
				<div class="col-sm-8">
					<input id="txtIdUser" name="txtIdUser" style="display:none" type="text">
					<select aria-hidden="true" class="select-chosen" id="id_alasan" name="id_alasan"  style="width: 70%;" tabindex="-1">
						
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrw">T.M.T</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="tgl_keluar" name="tgl_keluar" placeholder="dd-mm-yyyy">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputpropinsi">Pejabat penandatangan SK</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="pejabat" name="pejabat">
					
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="inputrw">No.SK</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="no_sk" name="no_sk">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="demo-is-inputsmall">Keterangan</label>
				<div class="col-sm-8">
					<textarea placeholder="" class="form-control input-sm" id="keterangan" name="keterangan" type="text">
					</textarea>
				</div>
			</div>        
		</div>
	</div>
	
</form>


<script>
	$('.select-chosen').chosen();
	$('.chosen-container').css({"width": "100%"});
	$(document).ready(function () {
		$('#tgl_keluar').datepicker({
			format: "dd-mm-yyyy",
		}).on('change', function(){
			$('.datepicker').hide();
		});
	});    
</script>