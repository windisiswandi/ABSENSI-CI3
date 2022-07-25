<?php date_default_timezone_set("Asia/Makassar");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/bootstrap5/css/bootstrap.min.css"); ?>">
    <link href="<?= base_url(); ?>assets/vendors/fontawesome5/css/fontawesome.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendors/fontawesome5/css/brands.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendors/fontawesome5/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("assets/build/css/print.css"); ?>">
    <title>DASHBOARAD | ABSENSI</title>
</head>
<body>
    <a class="btnBack" href="<?= base_url("/absensi/rekap_absensi_harian"); ?>">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div class="container">   
        <div class="row justify-content-between mb-3">
          
            <div class="col-auto">
                <img src="<?= base_url('assets/images/ntb.png'); ?>" width="50">
            </div>
            <div class="col-auto">
                <h6 class="text-center fw-bold" style="font-size: 15px;">DAFTAR HADIR DAN KEGIATAN BELAJAR HARIAN
                <br>SMK NEGERI 1 SELONG<br>TAHUN PELAJARAN  <?= date("Y")."/".intval(date("Y"))+1; ?></h6>
            </div>
            <div class="col-auto">
                <img src="<?= base_url('assets/images/semka.png'); ?>" width="50">
                
            </div>
       
        </div>
        <h3 class="fw-bold fs-6 text-center">KELAS : <?= $name_file; ?></h3> 
        <table border="1px" cellspacing="0">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>NIPD</th>
                    <th>Nama Siswa</th>
                    <th>L/P</th>
                    <th>Jam Masuk</th>
                    <?php if(@$jamPulang) : ?>
                        <th>Jam Pulang</th>
                    <?php endif; ?>
                    <th >Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $j = 1; $L=0; $P=0  ;
                foreach($data_siswa as $siswa) : 
                    if ($siswa["jenisKelamin"] == "L") {$L++;}
                    else {$P++;}
                ?>
                    <tr>
                        <td class="text-center"><?= $j++; ?></td>
                        <td class="text-center"><?= $siswa["NIPD"]; ?></td>
                        <td><?= $siswa["nama_siswa"]; ?></td>
                        <td class="text-center"><?= $siswa["jenisKelamin"]; ?></td>
                        <?php foreach($data_absensi as $absen) : ?>
                            <?php if($siswa["NIPD"] == $absen["NIPD"]) : ?>
                                <td class="text-center"><?= $absen["jam_masuk"]; ?></td>
                                <?php if(@$jamPulang) : ?>

                                    <td class="text-center"><?= $absen["jam_pulang"]; ?></td>
                                    <?php if($absen["jam_pulang"]) : ?>
                                        <td class="last text-center"><?= $absen["keterangan"]; ?></td>
                                    <?php else : ?>
                                        <?php if($absen["jam_masuk"]) : ?>
                                            <td class="last text-center">Bolos</td> 
                                        <?php endif; ?>
                                    <?php endif; ?>

                                <?php else : ?>
                                    <td class="last text-center"><?= $absen["keterangan"]; ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if(@$jamPulang) : ?>
                            <td class="text-center"></td>
                        <?php endif; ?>
                        
                        <td class="text-center"></td>
                        <td class="text-center">Tidak Masuk</td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="7" rowspan="4" style="height: 75px;" class="info_jk">
                        <p><b>Ket :</b></p>
                        <p style="margin-left: 10px;">
                            L : <?= $L; ?>, P : <?= $P; ?> <br>
                            Jml : <?= $L+$P; ?>
                        </p>
                        <span class="tgl"><?= $tanggal; ?></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>