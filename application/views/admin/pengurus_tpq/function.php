<script>
var url = '<?php echo ADMIN_WEBAPP_URL; ?>';
function setpassword() {
  var pass = $('#password').val();
  $('#new_password').val(pass);
}

function Add() {
  var nama = $('#nama').val();
  var input = new FormData();  
  input.append('nama', nama);
  var post_url = 'pengurus_tpq/add_submit';
  ServerPost(post_url,input,true);
}


function Put() {
  var id = $('#data_id').val();
  var nama = $('#nama').val();
  var input = new FormData();
  input.append('id', id);
  input.append('nama', nama);
  var post_url = 'pengurus_tpq/update_submit';
  ServerPost(post_url,input,true);
}

function Delete(id) {
  $('#deleteTpqModal').modal('show');
  $('#id').val(id);
}

function showPassword(link){
  $('#PasswordModal').modal();
}

function ChangePass(){
  var input = new FormData();
  var old_pass = $.md5($('#old_pass').val());
  var new_pass = $.md5($('#new_pass').val());
  var id_tpq = $("#tpq_id").val();
  var input = new FormData();
  input.append('old_pass', old_pass);
  input.append('new_pass', new_pass);
  input.append('id_tpq',id_tpq);
  var post_url = 'tpq/change_password';
  ServerPost(post_url,input);

}

function DeleteTpqProcess() {
  var id = $('#id').val();
  $.ajax({
    url: url + 'tpq/delete/' + id,
    method: 'GET',
    dataType: 'json',
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response.response == 'OK') {
        $('#deleteTpqModal').modal('hide');
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
