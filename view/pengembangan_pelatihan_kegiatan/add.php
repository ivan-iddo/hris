<style type="text/css">
    /*.daterangepicker{
        position: static !important;
    }*/
</style>
<form class="form-horizontal">
    <input type="text" name="id" id="id" style="width: 220px;display:none" class="form-control"/>
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-3 control-label" for="demo-hor-inputemail">Nama</label>
            <div class="col-sm-5">
                <input type="text" name="nama" id="nama" class="form-control"/>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    function simpan(action) {
        data = {};
        data.id = $("#id").val();
        data.nama = $("#nama").val();
        console.log(data);
        // return;

        if ($('#id').val().length == "") {
            URL = BASE_URL + "pengembangan_pelatihan_kegiatan/save";
        } 
        else{
            URL = BASE_URL + "pengembangan_pelatihan_kegiatan/edit";
        }
        save(URL, data, loaddata);
    }
</script>