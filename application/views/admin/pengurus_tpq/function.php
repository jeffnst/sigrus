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
  $('#deleteModal').modal('show');
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

function DeleteProcess() {
  var id = $('#id').val();
  var post_url = 'pengurus_tpq/delete';
  var input = new FormData();
  input.append('id', id);
  $('#deleteModal').modal('hide');
  ServerPost(post_url,input,true);

}

</script>
