<section class="content">
    <div class="container-fluid">            
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?= $title_page ?>
                        </h2>                 
                        <p><small>Isi form di bawah ini untuk menambahkan data siswa terbaru : </small></p>
                    </div>
                    <div class="body">                        
                        <div class="row clearfix">                                        
                            <div class="col-sm-7">
                                <div class="form-group form-float form-group-md">
                                    <label class="form-label">Nama</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="nama">
                                    </div>
                                </div>              
                                <div class="form-group form-float form-group-md">
                                    <label class="form-label">Jenis Kelamin</label>

                                    <div class="demo-radio-button">                                                        
                                        <input type="radio" id="radio_pria" name="jnsklmn" value="L">
                                        <label for="radio_pria">Laki - Laki</label>
                                        <input  type="radio" id="radio_wanita" name="jnsklmn" value="P">
                                        <label for="radio_wanita">Perempuan</label>
                                    </div>

                                </div>  

                                <div class="form-group form-float form-group-md">
                                    <label class="form-label">Tempat Lahir</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="tmp_lahir">
                                    </div>
                                </div>                                    

                                <div class="form-group form-float form-group-md">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <div class="form-line">
                                        <input type="text" class="datepicker form-control" placeholder="Please choose a date..." id="tgl_lahir">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-5">
                                <p><label class="form-label">Foto</label></p>                                            
                                <input type="hidden" id="max_num_gallery" value=''>                                                                                                                                                

                                <img id="output_foto" style="width:60%" class="img img-thumbnail" src="<?= BACKEND_IMAGE_FOLDER . 'noimg.png' ?>"/>
                                <br><br>
                                <input type="file" accept="image/*" class="" name="foto" onchange="load(event)" id="foto">                                            
                                <script>
                                    var load = function (event) {
                                        var output = document.getElementById('output_foto');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                    };
                                </script>
                            </div>
                        </div>

                        <div class="row clearfix">                                    
                            <div class="col-md-12">
                                <div class="form-group form-float form-group-md">
                                    <label class="form-label">Kategori Siswa</label>                                            
                                    <select class="form-control" id="kategori" onchange="setNikah()">
                                        <option value="CBR">Caberawit</option>                                                
                                        <option value="PRMJ">Praremaja</option>                                                
                                        <option value="RMJ">Remaja</option>                                                                                                        
                                        <option value="MDR">Mandiri</option>                                                                                                        
                                    </select>                                            
                                </div>
                                <div class="form-group form-float form-group-md" id="nikahOption" style="display:none">
                                    <label class="form-label">Status Pernikahan</label>

                                    <div class="demo-radio-button">                                                        
                                        <input type="radio" id='radio_lajang' name="pkwn" value="L">
                                        <label for="radio_lajang">Lajang</label>
                                        <input  type="radio" id='radio_menikah' name="pkwn" value="M">
                                        <label for="radio_menikah">Menikah</label>
                                    </div>    
                                </div>                             
                                <div class="form-group form-float form-group-md">
                                    <label class="form-label">TPQ</label>                                                                                                
                                    <select class="form-control" id="tpq">                                                                                                                
                                        <?php
                                        if (isset($tpq)) {
                                            foreach ($tpq as $opt) {
                                                echo '<option value="' . $opt->id . '">' . $opt->nama . ' - ' . $opt->wilayah . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>           

                                <div class="form-group form-float form-group-md">
                                    <label class="form-label">Kontak</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="kontak">

                                    </div>
                                </div>
                                <div class="form-group form-float form-group-md">
                                    <label class="form-label">Alamat</label>
                                    <div class="form-line">
                                        <textarea class="form-control" id="alamat"></textarea>
                                    </div>
                                </div> 

                            </div>
                        </div>                                                
                    </div>
                    <div class="text-right"><button type="button " class="btn bg-teal btn-lg waves-effect" onclick="Add()">Simpan</button></div>
                </div>
            </div>

        </div>        
</section>     
<script>
    $('#tgl_lahir').bootstrapMaterialDatePicker({time: false, format: 'DD-MM-YYYY'});
    var setNikah = function () {

        if ($('#kategori').val() === 'MDR') {
            $('#nikahOption').css('display', '');
        } else {
            $('#nikahOption').css('display', 'none');
        }
    }
</script>

</html>