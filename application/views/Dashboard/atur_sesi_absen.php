
<form method="post" class="form"> 
    <h3 class="mb-5">ATUR SESI ABSENSI HARI INI</h3>
    <div class="row mt-3"> 
        <div class="left_box row">
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Jam Masuk</label>
                <div class="col-md-7">
                    <input type="time" name="jam_masuk" class="form-control" value="<?= date("07:00"); ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Jam Pulang</label>
                <div class="col-md-7">
                    <input type="time" name="jam_pulang" class="form-control" value="<?= date("14:00"); ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Tanggal</label>
                <div class="col-md-7">
                    <input type="date" name="tgl" class="form-control" value="<?= date("Y-m-d"); ?>">
                </div>
            </div>
        </div>
        <div class="mt-3 row">
            <div class="col-md-7">
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </div>
    </div>
</form>

<?php if($this->session->userdata("setJAMPUL")) : ?>
    <script>
        Swal.fire({
            icon: "success", timer: 1500, showConfirmButton: false, 
            title: "Sukses", text: "Pengaturan Absensi Berhasil"
        })
    </script>
<?= $this->session->unset_userdata("setJAMPUL"); ?>
<?php endif; ?>
