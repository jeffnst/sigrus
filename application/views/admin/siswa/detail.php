<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?= $title_page ?>
                        </h2>
                        <input type="hidden" id="siswa_id" value="<?= $detail['data_siswa'][0]->id ?>">
                    </div>
                    <div class="body">
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Profil</a></li>
                            <li role="presentation" class=""><a href="#detail_kategori" data-toggle="tab" aria-expanded="false" id="tab_detail_kategori">Riwayat</a></li>
                            <li role="presentation" class=""><a href="#aktif" data-toggle="tab" aria-expanded="false">Keaktifan</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="profile">
                                <div class="row clearfix">
                                    <div class="col-sm-7">
                                        <div class="form-group form-float form-group-md">
                                            <label class="form-label">Nama</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="nama" value="<?= $detail['data_siswa'][0]->nama ?>">
                                            </div>
                                        </div>
                                        <div class="form-group form-float form-group-md">
                                            <label class="form-label">Jenis Kelamin</label>

                                            <div class="demo-radio-button">
                                                <?php
                                                if ($detail['data_siswa'][0]->kelamin == 'L') {
                                                    ?>
                                                    <input type="radio" id="radio_pria" name="jnsklmn" value="L" checked>
                                                    <label for="radio_pria">Laki - Laki</label>
                                                    <?php

                                                } else {
                                                    ?>
                                                    <input type="radio" id="radio_pria" name="jnsklmn" value="L">
                                                    <label for="radio_pria">Laki - Laki</label>
                                                    <?php

                                                }
                                                ?>
                                                <?php
                                                if ($detail['data_siswa'][0]->kelamin == 'P') {
                                                    ?>
                                                    <input type="radio" id="radio_wanita" name="jnsklmn" value="P" checked>
                                                    <label for="radio_wanita">Perempuan</label>
                                                    <?php

                                                } else {
                                                    ?>
                                                    <input type="radio" id="radio_wanita" name="jnsklmn" value="P">
                                                    <label for="radio_wanita">Wanita</label>
                                                    <?php

                                                }
                                                ?>
                                            </div>

                                        </div>

                                        <div class="form-group form-float form-group-md">
                                            <label class="form-label">Tempat Lahir</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="tmp_lahir" value="<?= $detail['data_siswa'][0]->tmp_lahir ?>">
                                            </div>
                                        </div>

                                        <div class="form-group form-float form-group-md">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <div class="form-line">
                                                <input type="text" class="datepicker form-control" placeholder="Please choose a date..." id="tgl_lahir" value="<?= $detail['data_siswa'][0]->tgl_lahir ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <p><label class="form-label">Foto</label></p>
                                        <img id="output_foto" style="width:60%" class="img img-thumbnail" src="<?= $detail['data_siswa'][0]->foto ?>" />
                                        <br><br>
                                        <input type="file" accept="image/*" class="" name="foto" onchange="load(event)" id="foto">
                                        <input type="hidden" id="foto_old" value='<?= $detail['data_siswa'][0]->foto_old ?>'>
                                        <input type="hidden" id="foto_new" value=''>
                                        <script>
                                            var load = function (event) {
                                                var output = document.getElementById('output_foto');
                                                output.src = URL.createObjectURL(event.target.files[0]);
                                                $('#foto_new').val(event.target.files[0].name);
                                            };
                                        </script>
                                    </div>
                                </div>

                                <div class="row clearfix">

                                    <div class="col-md-12">
                                        <div class="form-group form-float form-group-md">
                                            <label class="form-label">Kategori Siswa</label>
                                            <select class="form-control" id="kategori" onchange="setNikah()">
                                                <?php
                                                $options = [
                                                    array("opt" => 'CBR', "label" => "Caberawit"),
                                                    array("opt" => 'PRMJ', "label" => "Praremaja"),
                                                    array("opt" => 'RMJ', "label" => "Remaja"),
                                                    array("opt" => 'MDR', "label" => "Mandiri")
                                                ];
                                                foreach ($options as $opt) {
                                                    if ($detail['data_siswa'][0]->kategori == $opt['opt']) {
                                                        echo '<option value="' . $opt['opt'] . '" selected>' . $opt['label'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $opt['opt'] . '">' . $opt['label'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group form-float form-group-md" id="nikahOption" style="display:none" onload="setNikah()">
                                            <label class="form-label">Status Pernikahan</label>

                                            <div class="demo-radio-button">
                                                <?php
                                                if ($detail['data_siswa'][0]->pkwn == 'L') {
                                                    ?>
                                                    <input type="radio" id='radio_lajang' name="pkwn" value="L" checked>
                                                    <label for="radio_lajang">Lajang</label>
                                                    <?php

                                                } else {
                                                    ?>
                                                    <input type="radio" id='radio_menikah' name="pkwn" value="L">
                                                    <label for="radio_menikah">Lajang</label>
                                                <?php

                                                }
                                                ?>
                                                <?php if ($detail['data_siswa'][0]->pkwn == 'M') {
                                                    ?>
                                                    <input type="radio" id='radio_menikah' name="pkwn" value="M" checked>
                                                    <label for="radio_menikah">Menikah</label>
                                                    <?php

                                                } else {
                                                    ?>
                                                    <input type="radio" id='radio_menikah' name="pkwn" value="M">
                                                    <label for="radio_menikah">Menikah</label>
                                                <?php

                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group form-float form-group-md">
                                            <label class="form-label">TPQ</label>

                                            <input type="hidden" id="old_tpq" value="<?= $detail['data_siswa'][0]->id_tpq ?>">
                                            <select class="form-control" id="tpq">
                                                <?php
                                                if (isset($detail['data_tpq'])) {
                                                    $tpq = $detail['data_tpq'];
                                                    foreach ($tpq as $opt) {
                                                        if ($detail['data_siswa'][0]->id_tpq == $opt->id) {
                                                            echo '<option value="' . $opt->id . '" selected>' . $opt->nama . ' - ' . $opt->wilayah . '</option>';
                                                        } else {
                                                            echo '<option value="' . $opt->id . '">' . $opt->nama . ' - ' . $opt->wilayah . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="form-group form-float form-group-md">
                                            <label class="form-label">Kontak</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="kontak" value="<?= $detail['data_siswa'][0]->kontak ?>">

                                            </div>
                                        </div>
                                        <div class="form-group form-float form-group-md">
                                            <label class="form-label">Alamat</label>
                                            <div class="form-line">
                                                <textarea class="form-control" id="alamat"><?= $detail['data_siswa'][0]->alamat ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="detail_kategori">
                                <div id="pdknOption">
                                    <div class="form-group form-float form-group-md" >
                                        <label class="form-label">Pendidikan Terakhir</label>
                                        <select class="form-control" id="jenjang_pdkn">
                                            <?php
                                            $options = [
                                                array("opt" => 'TK', "label" => "TK"),
                                                array("opt" => 'SD', "label" => "SD"),
                                                array("opt" => 'SMP', "label" => "SMP"),
                                                array("opt" => 'SMA', "label" => "SMA"),
                                                array("opt" => 'MHS', "label" => "Mahasiswa")
                                            ];
                                            foreach ($options as $opt) {
                                                if ($detail['data_pdkn']->jenjang == $opt['opt']) {
                                                    echo '<option value="' . $opt['opt'] . '" selected>' . $opt['label'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $opt['opt'] . '">' . $opt['label'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group form-float form-group-md">
                                        <label class="form-label">Kelas / Semester</label>
                                        <select class="form-control" id="tingkat_pdkn">
                                            <?php
                                            for ($x = 1; $x < 10; $x++) {
                                                if ($detail['data_pdkn']->tingkat == $x) {
                                                    echo '<option value="' . $x . '" selected>' . $x . '</option>';
                                                } else {
                                                    echo '<option value="' . $x . '" >' . $x . '</option>';
                                                }
                                            };
                                            if ($detail['data_pdkn']->tingkat == '10+') {
                                                echo '<option value="10+" selected>10+</option>';
                                            } else {
                                                echo '<option value="10+">10+</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float form-group-md" id="MdrOption">
                                    <label class="form-label">Pekerjaan</label>
                                    <select class="form-control" id="jenjang_mdr">
                                        <?php
                                        $options = [
                                            array("opt" => 'U', "label" => "Pengusaha"),
                                            array("opt" => 'K', "label" => "Karyawan"),
                                        ];
                                        foreach ($options as $opt) {
                                            if ($detail['data_pdkn']->jenjang == $opt['opt']) {
                                                echo '<option selected value="' . $opt['opt'] . '">' . $opt['label'] . '</option>';
                                            } else {
                                                echo '<option  value="' . $opt['opt'] . '">' . $opt['label'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group form-float form-group-md">
                                    <label class="form-label">Keterangan</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="ket_jenjang" value="<?= $detail['data_pdkn']->keterangan ?>" placeholder="Keterangan" >
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="aktif">
                                <div class="form-group form-float form-group-md">
                                    <label class="form-label">Keaktifan</label>

                                    <select class="form-control" id="aktif_data">
                                        <?php
                                        if ($detail['data_siswa'][0]->aktif == 'A') {
                                            echo '<option value="A" selected>Aktif</option>';
                                        } else {
                                            echo '<option value="A">Aktif</option>';
                                        }
                                        ?>
                                        <?php
                                        if ($detail['data_siswa'][0]->aktif == 'N') {
                                            echo '<option value="N" selected >Nonaktif</option>';
                                        } else {
                                            echo '<option value="N">Nonaktif</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="text-right"><button type="button " class="btn bg-teal btn-lg waves-effect" onclick="Put()">Simpan</button></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- #END# Basic Examples -->
    <!-- Exportable Table -->
</section>
<script>
    $('#tgl_lahir').bootstrapMaterialDatePicker({time: false, format: 'DD-MM-YYYY'});

    $(document).ready(function () {
        setNikah();
    });

    var setNikah = function () {

        if ($('#kategori').val() === 'MDR') {
            $('#nikahOption').css('display', '');
            $('#tab_detail_kategori').html('Pekerjaan');
            $('#pdknOption').css('display', 'none');
            $('#MdrOption').css('display', '');
            $('#ket_kategori').attr('placeholder', 'nama usaha / tempat bekerja');
        } else {
            $('#nikahOption').css('display', 'none');
            $('#tab_detail_kategori').html('Pendidikan');
            $('#MdrOption').css('display', 'none');
            $('#pdknOption').css('display', '');
            $('#ket_kategori').attr('placeholder', 'nama sekolah / kampus');
        }
    }

</script>
