<?php if($this->session->userdata("pesan_edit")) : ?>
    <script>
       Swal.fire({
            icon: "success", timer: 1500, showConfirmButton: false, 
            title: "Sukses", text: "<?= $this->session->userdata("pesan_edit"); ?>"
        })
    </script>
    <?php $this->session->unset_userdata("pesan_edit"); ?>
<?php endif; ?>


<!-- <a href="?downformat=true" class="btn btn-secondary ms-5">Download Format</a><br> -->

<?php if(isset($_GET["upload"])) : ?>
    <h3>Contoh Format Data</h3>
    <img class="mt-4" src="<?= base_url("assets/images/format_data.png"); ?>" style="width: 100%; max-width: 700px">
    <!-- <h3 class="d-inline">Contoh Format Data</h3>
    <a href="" class="btn btn-secondary ms-5">Download Format</a><br> -->
    <div class="row">
        <div class="col-lg-10 custom_upload mt-4">
            <h4 class="mb-3">Upload File</h4>
            <form method="post" enctype="multipart/form-data">
                <input type="file" class="form-control mb-3" name="fileImport" accept=".xlx,.xlsx">
                <input type="submit" name="btn_edit" class="btn btn-primary" value="upload">
            </form>
        </div>
    </div>
<?php elseif(isset($_GET["update"])) : ?>
    <h3>Contoh Format Data</h3>
    <img class="mt-4" src="<?= base_url("assets/images/format_data.png"); ?>" style="width: 100%; max-width: 700px">
    <!-- <h3 class="d-inline">Contoh Format Data</h3>
    <a href="?downformat=true" class="btn btn-secondary ms-5">Download Format</a><br> -->
    <!-- <img class="mt-4" src="<?= base_url("assets/images/format_data.png") ?>" style="width: 100%; max-width: 600px"><br> -->
    <div class="row">
        <div class="col-lg-10 custom_upload mt-4">
            <h4 class="mb-3">Update data</h4>
            <form method="post" enctype="multipart/form-data">
                <input type="file" class="form-control mb-3" name="fileImport" accept=".xlx,.xlsx">
                <input type="submit" name="btn_edit" class="btn btn-success" value="update">
            </form>
        </div>
    </div>
<?php elseif(isset($_GET["delete"])) : ?>
    <div class="row">
        <div class="col-lg-10 custom_upload mt-4">
            <h4 class="mb-3">Delete Data Kelas</h4>
            <p>Silahkan pilih kelas yang akan di hapus</p>
            <form method="post" class="row" action="<?= base_url('Dashboard/deleteDataKelas') ?>">
                <div class="mb-3">
                    <label class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-3">
                        <select name="kelas" class="form-select">
                            <option value="X">Kelas X</option>
                            <option value="XI">kelas XI</option>
                            <option value="XII">Kelas XII</option>
                            <option value="XIII">Kelas XIII</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <input type="submit" name="btn_delete" class="btn btn-danger" value="delete">
                </div>
            </form>
        </div>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col-lg-10 custom_upload mt-4">
            <h4 class="mb-3">Pilih Opsi</h4>
            <a href="<?= base_url("Dashboard/editData?upload"); ?>" class="btn btn-primary">Upload file</a>
            <a href="<?= base_url("Dashboard/editData?update"); ?>" class="btn btn-success">Update data</a>
            <a href="<?= base_url("Dashboard/editData?delete"); ?>" class="btn btn-danger">Delete Data</a>
        </div>
    </div>
<?php endif; ?>
