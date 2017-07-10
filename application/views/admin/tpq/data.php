
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
                        <div class="body">
                            <small>
                                <table class="table table-bordered table-striped table-hover dataTable table1">
                                    <thead>
                                        <tr>
                                            <th>#</th>                                        
                                            <th>Nama</th>
                                            <th>PC</th>
                                            <th>Wilayah</th>
                                            <th>Kontak</th>                                        
                                            <th>Alamat</th>
                                            <th>Email</th>
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
                                                echo "<td>" . $item['nama_pc'] . "</td>";
                                                echo "<td>" . $item['wilayah'] . "</td>";
                                                echo "<td>" . $item['kontak'] . "</td>";
                                                echo "<td>" . $item['alamat'] . "</td>";
                                                echo "<td>" . $item['email'] . "</td>";
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

</html>