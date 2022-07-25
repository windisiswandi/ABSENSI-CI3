<div class="row justify-content-start pt-5 pb-5 ps-5">
    <div class="col-sm-3">
        <?php if(file_exists($data["foto"])) : ?>
            <img src="<?= base_url().$data['foto']; ?>" width="200" height="250">
        <?php else : ?>
            <img src="<?= base_url("assets/images/orangKosong.jpg"); ?>" width="200" height="250">
        <?php endif; ?>
    </div>
    <div class="col-lg-6">
        <table>
            <tbody>    
                <tr>
                    <td class="fw-bold" style="font-size: 15px;">Nama</td>
                    <td style="width: 400px;"><?= $data["nama_siswa"]; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold" style="font-size: 15px;">NIPD</td>
                    <td style="width: 400px;"><?= $data["NIPD"]; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold" style="font-size: 15px;">Kelas</td>
                    <td style="width: 400px;"><?= $data["kelas"]." ".$data["jurusan"]; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold" style="font-size: 15px;">Jenis Kelamin</td>
                    <td style="width: 400px;"><?= $data["jenisKelamin"]; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold" style="font-size: 15px;">Jam Masuk</td>
                    <?php if(@$data["sudah_absen_masuk"]) : ?>
                        <td><?= $data["jam_masuk"]; ?></td>
                    <?php else : ?>
                        <td><?= $data["time"]; ?></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <td class="fw-bold" style="font-size: 15px;">Jam Pulang</td>
                    <?php if(@$data["jam_pulang"]) : ?>
                        <td style="width: 400px;"><?= $data["jam_pulang"]; ?></td>
                    <?php else : ?>
                        <td style="width: 400px;">-</td>
                    <?php endif; ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<hr>
<br>
<?php if(@$data["sudah_absen_masuk"]) : ?>
    <center>
        <?php if(@$data["sudah_absen_pulang"]) : ?>
            <h5 class="fw-bold">Anda Sudah Absensi Hari Ini</h5>
        <?php elseif(@$data["baru_absen_pulang"]) : ?>
            <h5 class="fw-bold">Absensi Berhasil</h5>
        <?php else : ?>
            <h5 class="fw-bold">Sudah Absen Masuk Pada Jam <?= $data["jam_masuk"]; ?><br>Siswa Belum Diizinkan Absen Pulang Saat Ini</h5>
        <?php endif; ?>
    </center>
<?php else: ?>
    <?php if(strtolower($data["ket"]) == "hadir") : ?>
        <h4 class="green text-center"><?= $data["ket"]; ?></h4>
    <?php else : ?>
        <h4 class="red text-center"><?= $data["ket"]; ?></h4>
    <?php endif; ?>
<?php endif; ?>
