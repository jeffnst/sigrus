<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              <?= $title_page ?>
            </h2>
            <input type="hidden" id="tpq_id" value="<?= $detail['data_tpq'][0]->id_tpq ?>">
          </div>
          <div class="body">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
              <li role="presentation" class=""><a href="#overview" data-toggle="tab" aria-expanded="false">Overview</a></li>
              <li role="presentation" class=""><a href="#siswa" data-toggle="tab" aria-expanded="false">Siswa</a></li>
              <li role="presentation" class=""><a href="#pengajar" data-toggle="tab" aria-expanded="false">Pengajar</a></li>
              <li role="presentation" class=""><a href="#sarpar" data-toggle="tab" aria-expanded="false">Sarana Prasana</a></li>
              <li role="presentation" class=""><a href="#kegiatan" data-toggle="tab" aria-expanded="false">Kegiatan</a></li>
              <li role="presentation" class=""><a href="#galeri" data-toggle="tab" aria-expanded="false">Galeri</a></li>
              <li role="presentation" class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Profil</a></li>
              <li role="presentation" class=""><a href="#design" data-toggle="tab" aria-expanded="false">Logo & Tampilan</a></li>
              <li role="presentation" class=""><a href="#kepengurusan" data-toggle="tab" aria-expanded="false">Kepengurusan</a></li>
              <li role="presentation" class=""><a href="#akses" data-toggle="tab" aria-expanded="false">Akses</a></li>
            </ul>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="overview">
              </div>
              <div role="tabpanel" class="tab-pane fade active in" id="siswa">
              </div>
              <div role="tabpanel" class="tab-pane fade active in" id="sarpar">
              </div>
              <div role="tabpanel" class="tab-pane fade active in" id="pengajar">
              </div>
              <div role="tabpanel" class="tab-pane fade active in" id="kegiatan">
              </div>
              <div role="tabpanel" class="tab-pane fade active in" id="galeri">
              </div>
              <div role="tabpanel" class="tab-pane fade active in" id="profile">
                <div class="row clearfix">
                  <div class="col-sm-12">
                    <div class="form-group form-float form-group-md">
                      <label class="form-label">Nama</label>
                      <div class="form-line">
                        <input type="text" class="form-control" id="nama" value="<?= $detail['data_tpq'][0]->nama ?>">
                      </div>
                    </div>
                    <div class="form-group form-float ">
                      <label class="form-label">Pengurus Cabang (PC)</label>
                      <select class="form-control show-tick" id="pc">
                        <?php
                        if (isset($detail['pc'])) {
                          foreach ($detail['pc'] as $opt) {
                            if ($detail['data_tpq'][0]->id_pc == $opt->id) {
                              echo '<option value="' . $opt->id . '" selected>' . $opt->nama . '</option>';
                            } else {
                              echo '<option value="' . $opt->id . '">' . $opt->nama . '</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group form-float form-group-md">
                      <label class="form-label">Wilayah</label>
                      <div class="form-line">
                        <input type="text" class="form-control" id="wilayah" value="<?= $detail['data_tpq'][0]->wilayah ?>">
                      </div>
                    </div>
                    <div class="form-group form-float form-group-md">
                      <label class="form-label">Kontak</label>
                      <div class="form-line">
                        <input type="text" class="form-control" id="kontak" value="<?= $detail['data_tpq'][0]->kontak ?>">

                      </div>
                    </div>
                    <div class="form-group form-float form-group-md">
                      <label class="form-label">Alamat</label>
                      <div class="form-line">
                        <textarea class="form-control" id="alamat"><?= $detail['data_tpq'][0]->alamat ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div role="tabpanel" class="tab-pane fade" id="design">
                <div class="row">
                  <div class="col-md-4">
                    <p><label class="form-label">Logo TPQ</label></p>
                    <input type="hidden" id="max_num_gallery" value=''>
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <img id="output_logo" style="width:100%" class="img img-thumbnail" src="<?= $detail['data_tpq'][0]->logo ?>"/>
                      </div>
                      <div class="panel-footer">
                        <input type="hidden" id="logo_old" value="<?= $detail['data_tpq'][0]->logo_old ?>">
                        <input type="hidden" id="logo_new" value="">
                        <input type="file" accept="image/*" class="" name="logo" onchange="loadLogo(event)" id="logo">
                        <script>
                        var loadLogo = function (event) {
                          var output = document.getElementById('output_logo');
                          output.src = URL.createObjectURL(event.target.files[0]);
                          $('#logo_new').val(event.target.files[0].name);
                        };
                        </script>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <p><label class="form-label">Gambar cover TPQ : </label></p>
                    <input type="hidden" id="max_num_cover" value=''>
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <img id="output_cover" style="width:100%;height:400px;" class="img img-thumbnail" src="<?= $detail['data_tpq'][0]->cover ?>">
                      </div>
                      <div class="panel-footer">
                        <input type="hidden" id="cover_old" value="<?= $detail['data_tpq'][0]->cover_old ?>">
                        <input type="hidden" id="cover_new" value="">
                        <input type="file" accept="image/*" class="" name="cover" onchange="loadCover(event)" id="cover">
                        <script>
                        var loadCover = function (event) {
                          var cover = document.getElementById('output_cover');
                          cover.src = URL.createObjectURL(event.target.files[0]);
                          $('#cover_now').val(event.target.files[0].name);
                        };
                        </script>

                      </div>
                    </div>
                  </div>
                  <!--<input type="file" name="img_cover" id="cover" >-->
                  <!--<input type="file" name="img_cover" >-->
                </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="kepengurusan">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Kategori</th>
                      <th>Nama</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    if (isset($detail['pgrs'])) {
                      $x = 0;
                      foreach ($detail['pgrs'] as $each) {
                        echo "<tr>";
                        echo '<td>' . $each->nama_kat_pgrs . '</td>';
                        echo "<td><input type='hidden' value='" . $each->id_kat_pgrs . "'><input type='text' id='' class='nama_pgrs form-control' param='" . $each->id_kat_pgrs . "' value='" . $each->nama_pgrs . "'></td>";
                        echo "</tr>";
                        $x++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="akses">
                <div class="form-group form-float form-group-md">
                  <label class="form-label">Email</label>
                  <div class="form-line">
                    <input type="text" class="form-control" id="email" value="<?= $detail['data_tpq'][0]->email ?>">
                  </div>
                </div>
                <div class="">
                  <label class="form-label">Password</label>
                  <div class="form-line">
                    <button class="btn btn-default" onclick="showPassword()">Ganti Password</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-right"><button type="button " class="btn bg-teal btn-lg waves-effect" onclick="Put()">Simpan</button></div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="modal fade"  aria-labelledby="myModalLabel" id="PasswordModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ganti Password</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Masukkan Password Lama</label>
                <div class="form-line">
                <input type="password" class="form-control " id="old_pass">
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Masukkan Password Baru</label>
                <div class="form-line">
                <input type="password" class="form-control " id="new_pass">
                <input type="hidden" class="form-control " id="tpq">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="ChangePass()">Ganti </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
          </div>
        </div>

      </div>
    </div>
    </div>
  </section>
