
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
    <a class="btnBack" href="<?= base_url("/absensi/rekap_absensi_mingguan"); ?>">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div class="container1">   
        <div class="row justify-content-center mb-3">
          
            <div class="col-auto">
                <h6 class="text-center fw-bold" style="font-size: 15px;">DAFTAR HADIR DAN KEGIATAN BELAJAR MINGGUAN
                <br>SMK NEGERI 1 SELONG<br>TAHUN PELAJARAN  <?= date("Y")."/".intval(date("Y"))+1; ?></h6>
            </div>
       
        </div>
        <h3 class="fw-bold fs-6 text-center">KELAS : <?= $name_file; ?></h3> 
        <table border="1px" cellspacing="0">
            <thead>
                <tr class="text-center">
                    <th rowspan="2">No</th>
                    <th rowspan="2">NIPD</th>
                    <th rowspan="2" style="width: 250px;">Nama Siswa</th>
                    <th rowspan="2" style="transform: rotate(-90deg);">L/P</th>
                    <th colspan="3"><?= $data_absensi1["tanggal"]; ?></th>
                    <th colspan="3"><?= $data_absensi2["tanggal"]; ?></th>
                    <th colspan="3"><?= $data_absensi3["tanggal"]; ?></th>
                    <th colspan="3"><?= $data_absensi4["tanggal"]; ?></th>
                    <th colspan="3"><?= $data_absensi5["tanggal"]; ?></th>
                    <th colspan="3"><?= $data_absensi6["tanggal"]; ?></th>
                </tr>
                <tr class="text-center">
                    <th>JM</th>
                    <th>JP</th>
                    <th>KET</th>
                    
                    <th>JM</th>
                    <th>JP</th>
                    <th>KET</th>
                    
                    <th>JM</th>
                    <th>JP</th>
                    <th>KET</th>
                    
                    <th>JM</th>
                    <th>JP</th>
                    <th>KET</th>
                    
                    <th>JM</th>
                    <th>JP</th>
                    <th>KET</th>
                    
                    <th>JM</th>
                    <th>JP</th>
                    <th>KET</th>
                </tr
                >
            </thead>
            <tbody>
                <?php $i=1; $L=0; $P=0 ;
                foreach($data_siswa as $siswa) : 
                    $stop1 = TRUE; $stop2 = TRUE;$stop3 = TRUE; $stop4 = TRUE;$stop5 = TRUE;$stop6 = TRUE;
                    if ($siswa["jenisKelamin"] == "L") {$L++;}
                    else {$P++;}
                ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td class="text-center"><?= $siswa["NIPD"]; ?></td>
                        <td><?= $siswa["nama_siswa"]; ?></td>
                        <td class="text-center"><?= $siswa["jenisKelamin"]; ?></td>

                        <?php foreach($data_absensi1 as $absen) : ?>
                            <?php if(isset($absen["NIPD"])): ?>
                                <?php if($siswa["NIPD"] == $absen["NIPD"]) : ?>

                                    <td class="text-center"><?= $absen["jam_masuk"]; ?></td>
                                    <td class="text-center"><?= $absen["jam_pulang"]; ?></td>
                                    <?php if($absen["jam_pulang"]) : ?>
                                        <td class="text-center"><?= $absen["keterangan"]; ?></td>
                                    <?php else : ?>
                                        <td class="text-center">Bolos</td> 
                                    <?php endif; ?>
                                    <?php $stop1 = false; break; ?>

                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if($stop1) : ?>
                            <td></td>
                            <td></td>
                            <td class="text-center">Tidak Masuk</td>
                        <?php endif; ?>
                        
                        <?php foreach($data_absensi2 as $absen) : ?>
                            <?php if(isset($absen["NIPD"])): ?>
                                <?php if($siswa["NIPD"] == $absen["NIPD"]) : ?>

                                    <td class="text-center"><?= $absen["jam_masuk"]; ?></td>
                                    <td class="text-center"><?= $absen["jam_pulang"]; ?></td>
                                    <?php if($absen["jam_pulang"]) : ?>
                                        <td class="text-center"><?= $absen["keterangan"]; ?></td>
                                    <?php else : ?>
                                        <td class="text-center">Bolos</td> 
                                    <?php endif; ?>
                                    <?php $stop2 = false; break; ?>

                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if($stop2) : ?>
                            <td></td>
                            <td></td>
                            <td class="text-center">Tidak Masuk</td>
                        <?php endif; ?>

                        <?php foreach($data_absensi3 as $absen) : ?>
                            <?php if(isset($absen["NIPD"])): ?>
                                <?php if($siswa["NIPD"] == $absen["NIPD"]) : ?>

                                    <td class="text-center"><?= $absen["jam_masuk"]; ?></td>
                                    <td class="text-center"><?= $absen["jam_pulang"]; ?></td>
                                    <?php if($absen["jam_pulang"]) : ?>
                                        <td class="text-center"><?= $absen["keterangan"]; ?></td>
                                    <?php else : ?>
                                        <td class="text-center">Bolos</td> 
                                    <?php endif; ?>
                                    <?php $stop3 = false; break; ?>

                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if($stop3) : ?>
                            <td></td>
                            <td></td>
                            <td class="text-center">Tidak Masuk</td>
                        <?php endif; ?>

                        <?php foreach($data_absensi4 as $absen) : ?>
                            <?php if(isset($absen["NIPD"])): ?>
                                <?php if($siswa["NIPD"] == $absen["NIPD"]) : ?>

                                    <td class="text-center"><?= $absen["jam_masuk"]; ?></td>
                                    <td class="text-center"><?= $absen["jam_pulang"]; ?></td>
                                    <?php if($absen["jam_pulang"]) : ?>
                                        <td class="text-center"><?= $absen["keterangan"]; ?></td>
                                    <?php else : ?>
                                        <td class="text-center">Bolos</td> 
                                    <?php endif; ?>
                                    <?php $stop4 = false; break; ?>

                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if($stop4) : ?>
                            <td></td>
                            <td></td>
                            <td class="text-center">Tidak Masuk</td>
                        <?php endif; ?>

                        <?php foreach($data_absensi5 as $absen) : ?>
                            <?php if(isset($absen["NIPD"])): ?>
                                <?php if($siswa["NIPD"] == $absen["NIPD"]) : ?>

                                    <td class="text-center"><?= $absen["jam_masuk"]; ?></td>
                                    <td class="text-center"><?= $absen["jam_pulang"]; ?></td>
                                    <?php if($absen["jam_pulang"]) : ?>
                                        <td class="text-center"><?= $absen["keterangan"]; ?></td>
                                    <?php else : ?>
                                        <td class="text-center">Bolos</td> 
                                    <?php endif; ?>
                                    <?php $stop5 = false; break; ?>

                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if($stop5) : ?>
                            <td></td>
                            <td></td>
                            <td class="text-center">Tidak Masuk</td>
                        <?php endif; ?>

                        <?php foreach($data_absensi6 as $absen) : ?>
                            <?php if(isset($absen["NIPD"])): ?>
                                <?php if($siswa["NIPD"] == $absen["NIPD"]) : ?>

                                    <td class="text-center"><?= $absen["jam_masuk"]; ?></td>
                                    <td class="text-center"><?= $absen["jam_pulang"]; ?></td>
                                    <?php if($absen["jam_pulang"]) : ?>
                                        <td class="text-center"><?= $absen["keterangan"]; ?></td>
                                    <?php else : ?>
                                        <td class="text-center">Bolos</td> 
                                    <?php endif; ?>
                                    <?php $stop6 = false; break; ?>

                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if($stop6) : ?>
                            <td></td>
                            <td></td>
                            <td class="text-center">Tidak Masuk</td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="22" rowspan="4" style="height: 75px;" class="info_jk">
                        <p><b>Ket :</b></p>
                        <p style="margin-left: 10px;">
                            L : <?= $L; ?>, P : <?= $P; ?> <br>
                            Jml : <?= $L+$P; ?>
                        </p>
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