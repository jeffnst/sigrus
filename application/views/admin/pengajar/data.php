<!DOCTYPE html>
<section class="content">
    <div class="container-fluid">            
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?= $title_page ?>
                        </h2>                            
                    </div>
                    <div class="body" >
                        <small >
                            <table  class="table table-bordered table-striped table-hover dataTable table1">
                                <thead>
                                    <tr>
                                        <th>#</th>                                        
                                        <th>Nama</th>
                                        <th>Kelamin</th>
                                        <th>TPQ</th>                                                                     
                                        <th>Kontak</th>                                                                                
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>                               
                                <tbody> 
                                    <?php
                                    $no = 1;
                                    if (isset($record)) {
                                        if ($record != "") {
                                            foreach ($record as $item) {
                                                echo "<tr>";
                                                echo "<td>$no</td>";
                                                echo "<td>" . $item['nama'] . "</td>";
                                                if ($item['kelamin'] == "L") {
                                                    $kelamin = "Laki-laki";
                                                } else {
                                                    $kelamin = "Perempuan";
                                                }
                                                echo "<td>" . $kelamin . "</td>";
                                                echo "<td>" . $item['nama_tpq'] . " - " . $item['wilayah'] . "</td>";
                                                echo "<td>" . $item['kontak'] . "</td>";
                                                echo "<td>" . $item['email'] . "</td>";
                                                if ($item['status'] == "PB") {
                                                    $status = "Pribumi";
                                                } else if ($item['status'] == "MT") {
                                                    $status = "Tugasan";
                                                } else if ($item['status'] == "MS") {
                                                    $status = "Setempat";
                                                }
                                                echo "<td>" . $status . "</td>";
                                                if ($item['aktif'] == "A") {
                                                    $aktif = "<p class='font-bold col-teal'>Aktif</p>";
                                                } else if ($item['aktif'] == "N") {
                                                    $aktif = "<p class='font-bold col-pink'>Nonaktif</p>";
                                                }
                                                echo "<td>" . $aktif . "</td>";
                                                echo "<td><a href='" . $item['link'] . "' class='btn btn-success'>Detail</a>&nbsp;<button class='btn btn-danger' onclick='Delete(" . $item['id'] . ")'>Hapus</button></td>";
                                                echo "</tr>";
                                                $no++;
                                            }
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


</html>