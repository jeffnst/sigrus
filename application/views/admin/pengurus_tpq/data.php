
<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <div class="row">
              <div class="col-md-6">
                <h2 class="pull-left">
                  <?= $title_page ?>
                </h2>
                </div>
                <div class="col-md-6">
                <a href="<?=site_url().'admin/pengurus_tpq/add'?>" class="pull-right btn btn-md btn-success"><i class="fa fa-plus fa-1x"></i>&nbsp; Tambah</a>
              </div>
            </div>
          </div>
          <div class="body">
            <small>
              <table class="table table-bordered table-striped table-hover dataTable table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  if ($record != "") {
                    foreach ($record as $item) {
                      echo "<tr>";
                      echo "<td>$no</td>";
                      echo "<td>" . $item['nama'] . "</td>";
                      echo "<td><a href='" . $item['link'] . "' class='btn btn-success'>Detail</a>&nbsp;<button class='btn btn-danger' onclick='Delete(" . $item['id'] . ")'>Hapus</button></td>";
                      echo "</tr>";
                      $no++;
                    }
                  } else {
                    echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </small>
          </div>
          <!-- #END# Widgets -->
          <!-- CPU Usage -->

        </div>

      </div>
    </div>
  </div>
  <!-- #END# Basic Examples -->
  <!-- Exportable Table -->

</section>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
            </div>
            <div class="modal-body">
                Menghapus data ini akan menghapus data terkait lainnya, Anda yakin menghapus data ini ?
                <input type="hidden" id="id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" onclick="DeleteProcess()">Ya</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>
</html>
