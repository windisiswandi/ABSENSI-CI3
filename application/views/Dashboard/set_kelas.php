<?php if(isset($_GET["update_kelas"])) : ?>
    <?php
        $kelas = $_GET["update_kelas"];
        $datakelas = $this->db->get_where("tb_kelas", ["kelas" => $kelas])->row_array();  
    ?>

    <form  action="<?= base_url("Crud/update_kelas") ?>" method="post" class="form">
        <h3 class="mb-5">Update Data Kelas</h3>
        <div class="row justify-content-start">
            <div class="col-lg-7">
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">KELAS</label>
                    <div class="col-md-6">
                        <input type="text" name="kelas" class="form-control" value="<?= $datakelas['kelas']; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">JURUSAN</label>
                    <div class="col-md-6">
                        <textarea name="jurusan" class="form-control"><?= $datakelas["jurusan"]; ?></textarea><br>
                        <i>(*) wajib pisah masing-masing jurusan dengan tanda (,)</i>
                        <i>contoh : KGSP, DITF</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-auto row">
                <div class="col-auto">
                    <a href="<?= base_url("Dashboard/setKelas"); ?>" class="btn btn-secondary">kembali</a>
                </div>
                <div class="col-auto">
                    <input type="submit" name="btn_tambah" value="submit" class="btn btn-success">
                </div>
            </div>
        </div>
    </form>
<?php elseif(isset($_GET["tambah_kelas"])) : ?>
    <form  action="<?= base_url("Crud/tambah_kelas") ?>" method="post" class="form">
        <h3 class="mb-5">Tambah Data Kelas</h3>
        <div class="row justify-content-start">
            <div class="col-lg-7">
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">KELAS</label>
                    <div class="col-md-6">
                        <input type="text" name="kelas" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">JURUSAN</label>
                    <div class="col-md-6">
                        <textarea name="jurusan" class="form-control"></textarea><br>
                        <i>(*) wajib pisah masing-masing jurusan dengan tanda (,)</i>
                        <i>contoh : KGSP, DITF</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-auto row">
                <div class="col-auto">
                    <a href="<?= base_url("Dashboard/setKelas"); ?>" class="btn btn-secondary">kembali</a>
                </div>
                <div class="col-auto">
                    <input type="submit" name="btn_tambah" value="submit" class="btn btn-success">
                </div>
            </div>
        </div>
    </form>
<?php else : ?>
    <h3 class="text-center mb-5">Data Kelas</h3>
    <div class="row justify-content-between mt-5">
        <div class="col-auto">
            <a href="?tambah_kelas" class="btn btn-success"><i class="fas fa-user-plus"></i> Tambah Kelas</a>
        </div>
    </div>    
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Kelas</th>
                <th>List Jurusan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbod>
        <?php 
        $start = 1;
        if (count($data_kelas) > 0) : ?>
                <tbody>
                <?php foreach($data_kelas as $kelas) : ?>
                        <tr>
                            <td><?= $start++; ?></td>
                            <td><?= $kelas["kelas"]; ?></td>
                            <td><?= $kelas["jurusan"]; ?></td>
                            <td>
                                <a href="?update_kelas=<?= $kelas['kelas']; ?>" class="btn btn-primary" style="padding: 0px 10px;"><i class="fas fa-user-edit"></i></a>
                                <button class="btn btn-danger" style="padding: 0px 10px;" onclick="return delete_data('<?= $kelas['kelas']; ?>')"><i class="fas fa-user-minus"></i></button>
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
<?php endif; ?>

<?php if($this->session->userdata("pesan_edit")) : ?>
    <script>
       Swal.fire({
            icon: "success", timer: 1500, showConfirmButton: false, 
            title: "Sukses", text: "<?= $this->session->userdata("pesan_edit"); ?>"
        })
    </script>
    <?php $this->session->unset_userdata("pesan_edit"); ?>
<?php endif; ?>