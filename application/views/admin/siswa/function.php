<script>
    var url = '<?php echo ADMIN_WEBAPP_URL; ?>';
    function setpassword() {
        var pass = $('#password').val();
        $('#new_password').val(pass);
    }

    function Add() {
        var nama = $('#nama').val();
        var kelamin = $('input[name="jnsklmn"]:checked').val();
        var tmp_lahir = $('#tmp_lahir').val();
        var tgl_lahir = $('#tgl_lahir').val();
        var pkwn = $('input[name="pkwn"]:checked').val();
        var kategori = $('#kategori').val();
        var tpq = $('#tpq').val();
        var kontak = $('#kontak').val();
        var alamat = $('#alamat').val();
        var foto = $('#foto').prop('files')[0];
        var input = new FormData();
        input.append('nama', nama);
        input.append('kelamin', kelamin);
        input.append('kategori', kategori);
        input.append('tmp_lahir', tmp_lahir);
        input.append('tgl_lahir', tgl_lahir);
        input.append('pkwn', pkwn);
        input.append('tpq', tpq);
        input.append('kontak', kontak);
        input.append('alamat', alamat);
        input.append('foto', foto);

//        console.log(input);

        $.ajax({
            url: url + 'siswa/add_submit',
            method: 'POST',
            data: input,
            dataType: 'json',
            contentType: 'application/json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.response == 'OK') {
                    $.notify({
                        message: '<i class="mdi mdi-check-all"></i> ' + response.message,
                    }, {type: 'success'})
                    setTimeout(function ()
                    {
                        window.location.href = response.data.link;
                    }, 1000);
                } else {
                    $.notify({
                        message: '<i class="mdi mdi-close"></i> ' + response.message,
                    }, {type: 'danger'})
                }
            }
        });
    }


    function Put() {
        var id = $('#siswa_id').val();
        var nama = $('#nama').val();
        var kelamin = $('input[name="jnsklmn"]:checked').val();
        var tmp_lahir = $('#tmp_lahir').val();
        var tgl_lahir = $('#tgl_lahir').val();
        var kategori = $('#kategori').val();
        var pkwn = $('input[name="pkwn"]:checked').val();
        var sts = $('#sts').val();
        var tpq = $('#tpq').val();
        var old_tpq = $('#old_tpq').val();
        var kontak = $('#kontak').val();
        var alamat = $('#alamat').val();
        var email = $('#email').val();
        var foto = $('#foto').prop('files')[0];
        if (kategori == 'MDR') {
            var jenjang = $('#jenjang_mdr').val();
            var tingkat = "";
        } else {
            var jenjang = $('#jenjang_pdkn').val();
            var tingkat = $('#tingkat_pdkn').val();
        }
        var ket_jenjang = $('#ket_jenjang').val();
        var aktif = $('#aktif_data').val();
        var old_foto = $('#foto_old').val();
        var new_foto = $('#foto_new').val();

        if (new_foto != undefined) {
            var foto = $('#foto').prop('files')[0];
        } else {
            var foto = '';
        }


        var input = new FormData();
        input.append('id', id);
        input.append('nama', nama);
        input.append('kelamin', kelamin);
        input.append('kategori', kategori);
        input.append('tmp_lahir', tmp_lahir);
        input.append('tgl_lahir', tgl_lahir);
        input.append('pkwn', pkwn);
        input.append('tpq', tpq);
        input.append('old_tpq', old_tpq);
        input.append('kontak', kontak);
        input.append('alamat', alamat);
        input.append('foto', foto);
        input.append('old_foto', old_foto);
        input.append('jenjang', jenjang);
        input.append('tingkat', tingkat);
        input.append('ket_jenjang', ket_jenjang);
        input.append('aktif', aktif);

//        console.log(input);

        $.ajax({
            url: url + 'siswa/update_submit',
            method: 'POST',
            data: input,
            dataType: 'json',
//            contentType: 'application/json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.response == 'OK') {
                    $.notify({
                        message: '<i class="mdi mdi-check-all"></i> ' + response.message,
                    }, {type: 'success'})
                    setTimeout(function ()
                    {
                        window.location.href = response.data.link;
                    }, 1000);
                } else {
                    $.notify({
                        message: '<i class="mdi mdi-close"></i> ' + response.message,
                    }, {type: 'danger'})
                }
            }
        });
    }

    function Delete(id) {
        $('#deleteModal').modal('show');
        $('#id').val(id);
    }

    function DeleteProcess() {
        var id = $('#id').val();
        $.ajax({
            url: url + 'siswa/delete/' + id,
            method: 'GET',
            dataType: 'json',
//            contentType: 'application/json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.response == 'OK') {
                    $.notify({
                        message: '<i class="mdi mdi-check-all"></i> ' + response.message,
                    }, {type: 'success'})
                    setTimeout(function ()
                    {
                        location.reload();
                    }, 1000);
                } else {
                    $.notify({
                        message: '<i class="mdi mdi-close"></i> ' + response.message,
                    }, {type: 'danger'})
                }
            }
        });
    }
</script>