<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition:attachment; filename=$name_file.xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/bootstrap5/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/build/css/print.css"); ?>">
    <title>DASHBOARAD | ABSENSI</title>
    <style type="text/css">
        table th, table td{
            font-family: sans-serif;
           padding: 3px 8px;
        }
        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
        <center> 
            <h3>DAFTAR HADIR DAN KEGIATAN BELAJAR HARIAN
                <br>SMK NEGERI 1 SELONG<br>TAHUN PELAJARAN <?= date("Y")."/".intval(date("Y"))+1; ?></h3>
            <h3>KELAS : <?= $name_file; ?></h3> 
        </center>
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
                $j = 1; $L=0; $P=0;
                foreach($data_siswa as $siswa) : 
                    $fieldKosong = true;
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
                                <?php $fieldKosong=false; break; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if($fieldKosong) : ?>
                            <td class="text-center"></td>
                            <?php if(@$jamPulang) : ?>
                                <td class="text-center"></td>
                            <?php endif; ?>
                            <td class="text-center">Tidak Masuk</td>
                        <?php endif; ?>
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
</body>
</html>