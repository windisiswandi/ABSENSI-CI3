<script>
    function setJurusan(dataKelas, jurusan = null) {
        $.ajax({
            url: `<?= base_url("Crud/getJurusan") ?>`,
            type: "POST",
            data: {
                kelas: dataKelas
            },
            dataType: "json",
            success: response => {
                $("select#select_jurusan").html(response.data)
                if (jurusan) {
                    setTimeout(() => {
                        document.querySelectorAll("select#select_jurusan option").forEach(options => {
                            if (options.value == set_jurusan) options.setAttribute("selected", "")
                        });
                    }, 200);
                }
            },
            error: e => console.log(e)
        })
    }
</script>
<?php if(isset($_GET["tambah_data"])) : ?>
    <form action="<?= base_url('Crud/tambah_data'); ?>" method="post" class="form" enctype="multipart/form-data">
        <h3>Input Data siswa</h3>
        <div class="mb-3 row mt-4">
            <label class="col-sm-2 col-form-label">NIPD</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="NIPD" required>
            </div>
        </div>
        <div class="mb-3 row mt-4">
            <label class="col-sm-2 col-form-label">NAMA SISWA</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="nama_siswa" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">KELAS</label>
            <div class="col-md-5">
                <select name="kelas" class="form-select" id="select_kelas" onchange="setJurusan(value)">
                    <option value="X">Kelas X</option>
                    <option value="XI">Kelas XI</option>
                    <option value="XII">Kelas XII</option>
                    <option value="XIII">Kelas XIII</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">JURUSAN</label>
            <div class="col-md-5">
                <select name="jurusan" id="select_jurusan" class="form-select"></select>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-md-5">
                <select name="jenisKelamin" id="select_jk" class="form-select">
                    <option value="L">Laki - Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Tahun Masuk</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="thn_masuk">
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Foto</label>
            <div class="col-md-5">
                <input type="file" class="form-control" name="fileFoto">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-7 row justify-content-between">
                <div class="col-auto">
                    <a href="<?= base_url("Dashboard"); ?>" class="btn btn-secondary">kembali</a>
                </div>
                <div class="col-auto">
                    <input type="submit" name="btn_tambah" value="submit" class="btn btn-success">
                </div>
            </div>
        </div>
    </form>
<?php elseif(isset($_GET["update_data"])) : ?>
    <?php if($_GET["update_data"]) : ?>
        <?php 
            $data = $this->Data_model->getDataSiswaById($_GET["update_data"]);
            if ($data["status"]) :
        ?>
            <form  action="<?= base_url("Crud/update_data") ?>" method="post" class="form" enctype="multipart/form-data">
                <h3 class="mb-5">Update Data siswa</h3>
                <div class="row justify-content-start">
                    <div class="col-auto mb-3 me-5">
                        <?php if(file_exists($data["data"]["foto"])) : ?>
                            <img src="<?= base_url($data["data"]["foto"]); ?>" width="200" height="250">
                        <?php else : ?>
                            <img src="<?= base_url('assets/images/orangKosong.jpg'); ?>" width="200" height="250">
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-7">
                        <input type="hidden" value="<?= $data['data']['id_card']; ?>" name="id_card">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">ID CARD</label>
                            <div class="col-md-6">
                                <input type="text" disabled class="form-control" value="<?= $data['data']['id_card']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">NAMA SISWA</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="<?= $data['data']['nama_siswa']; ?>" name="nama_siswa">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">KELAS</label>
                            <div class="col-md-6">
                                <select name="kelas" class="form-select" id="select_kelas" onchange="setJurusan(value)">
                                    <option value="X">Kelas X</option>
                                    <option value="XI">Kelas XI</option>
                                    <option value="XII">Kelas XII</option>   
                                    <option value="XIII">Kelas XIII</option>    
                
                                    <script>
                                        let kelas = "<?= $data['data']["kelas"]; ?>"
                                        document.querySelectorAll("#select_kelas option").forEach(option => {
                                            if (option.value == kelas) option.setAttribute("selected", "")
                                        })
                                    </script>
                                
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">JURUSAN</label>
                            <div class="col-md-6">
                                <select name="jurusan" id="select_jurusan" class="form-select"></select>
                                <script>
                                    setJurusan(kelas, true)
                                </script>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-md-6">
                                <select name="jenisKelamin" id="select_jk" class="form-select">
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                
                                <script>
                                    let jk = "<?= $data['data']["jenisKelamin"]; ?>"
                                    document.querySelectorAll("#select_jk option").forEach(option => {
                                        if (option.value == jk) option.setAttribute("selected", "")
                                    })
                                </script>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Tahun Masuk</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="thn_masuk" value="<?= $data["data"]["thn_masuk"]; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="fileFotoUpdate">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-auto row">
                        <div class="col-auto">
                            <a href="<?= base_url("Dashboard"); ?>" class="btn btn-secondary">kembali</a>
                        </div>
                        <div class="col-auto">
                            <input type="submit" name="btn_tambah" value="submit" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </form>
        <?php else : ?>
            <p><?= $data["msg"]; ?></p>       
        <?php endif; ?>
    <?php endif; ?>

<?php else: ?>
    <h3 class="text-center mb-5">Data Siswa SMK Negeri 1 Selong Tahun <?= date("Y"); ?></h3>

    <?php if($this->session->userdata("success")) : ?>
      <script>
          Swal.fire({
              icon: "success", timer: 1500, showConfirmButton: false, 
              title: "Sukses", text: "<?= $this->session->userdata("success"); ?>"
          })
      </script>
    <?= $this->session->unset_userdata("success"); ?>
    <?php endif; ?>

    <div class="row justify-content-between mt-5">
        <div class="col-auto">
            <a href="?tambah_data" class="btn btn-success"><i class="fas fa-user-plus"></i> Tambah Data</a>
        </div>
        <div class="col-sm-4">
            
            <form method="post" id="form_set">
                <div class="input-group">
                    <select name="kelas" class="form-select set_kelas" onchange="setJurusan(value)">
                        <option value="X">Kelas X</option>
                        <option value="XI">Kelas XI</option>
                        <option value="XII">Kelas XII</option>
                        <option value="XIII">Kelas XIII</option>
                    </select>         
                    <select name="jurusan" class="form-select set_jurusan" id="select_jurusan"></select>
                    <span class="bg-warning text-white input-group-text" id="btn-set" style="cursor: pointer;">Set</span>         
                </div>
            </form>
        </div>
        <div class="col-auto">
            <form method="post" id="form_search">
                <div class="input-group">
                    <input type="text" placeholder="Cari siswa . . ." name="keyword" class="form-control" autofocus aria-describedby="basic-addon2">
                    <span id="search" class="bg-primary text-white input-group-text"><i class="fas fa-search"></i></span> 
                </div>
            </form>
            <?php if($this->session->userdata("keyword")) : ?>
                <p>search: <?= $this->session->userdata("keyword"); ?> | <a href="?reset">reset</a></p>
            <?php endif; ?> 

            <?php if (isset($_GET["reset"])) { $this->session->unset_userdata("keyword"); redirect("/Dashboard");} ?>
        </div>
    </div>    

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbod>
        <?php if (count($data_siswa) > 0) : ?>
                <tbody>
                <?php foreach($data_siswa as $siswa) : ?>
                    <tr>
                        <td><?= ++$start; ?></td>
                        <td><?= $siswa["nama_siswa"]; ?></td>
                        <td><?= $siswa["kelas"] . " " . $siswa["jurusan"]; ?></td>
                        <td><?= $siswa["jenisKelamin"]; ?></td>
                        <td>
                            <a href="?update_data=<?= $siswa['id_card']; ?>" class="btn btn-primary" style="padding: 0px 10px;"><i class="fas fa-user-edit"></i></a>
                            <button class="btn btn-danger" style="padding: 0px 10px;" onclick="return delete_data('<?= $siswa['id_card']; ?>')"><i class="fas fa-user-minus"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>    
                </tbody>
            </table>
            
            <div class="row justify-content-end">
                <div class="col-auto">
                    <?= $this->pagination->create_links(); ?>
                </div>
            </div>
        <?php else : ?>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center">
                            Tidak ada data yang terkait
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    <script>
        function delete_data(id) {
            Swal.fire({
                icon: "warning", title: "Apakah anda yakin ?", text: "Data ini akan di hapus permanen",
                showCancelButton: true, cancelButtonText: "Batal", confirmButtonText: "Ya", cancelButtonColor: "#bb2d3b",
                confirmButtonColor: "#0b5ed7"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = `<?= base_url('Crud/deleteData/');?>${id}`
                }
            })
        }
    </script>
<?php endif; ?>
<script>
    let set_jurusan = "<?= $this->session->userdata("pil_jurusan"); ?>";
    let set_kelas = "<?= $this->session->userdata("pil_kelas"); ?>";
    document.querySelectorAll("select.set_kelas option").forEach(options => {
        if (options.value == set_kelas)  options.setAttribute("selected", "")
    });

    setJurusan(set_kelas)

    setTimeout(() => {
        document.querySelectorAll("select.set_jurusan option").forEach(options => {
            if (options.value == set_jurusan) options.setAttribute("selected", "")
        });
    }, 200);

    $("#btn-set").click(function () {
        $("#form_set").submit()
    })
</script>