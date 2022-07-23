<?php date_default_timezone_set("Asia/Makassar");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url("assets/images/semka.png") ?>" type="image/x-icon">
    <title>ABSENSI SISWA</title>
    <link href="<?= base_url(); ?>assets/vendors/fontawesome5/css/fontawesome.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendors/fontawesome5/css/brands.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendors/fontawesome5/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/bootstrap5/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/build/css/custom.css") ?>">
    <script src="<?= base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendors/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <style>
        body {background-color: #F7F7F7; color: black; height: 100%;}
        .data-left {box-shadow: 0 0 25px rgba(0,0,0, 0.3);background: white;border-radius: 0 0 10px 10px;box-sizing: border-box; height: 80vh; padding:20px;}
        .data-left .boxData {height: fit-content; margin-top:60px;}
        .input_absen > div {width: 100%;padding: 10px; font-size: 15px;}
        .input_absen > input.data {width: 100%;}
        .data-left span a {text-decoration: none; color: black; font-size: 15px;}
        .data-right {background: white;box-shadow: 0 0 20px rgba(0,0,0, 0.3);padding: 15px;border-radius: 0 0 0 10px;box-sizing: border-box;height: 80vh;}
        tbody > tr td {padding: 5px;font-size: 15px;width: 200px;}
        #data_absen .d-flex {background-color: #1c3681;padding: 10px 0;}
        @media screen and (max-width: 1180px) {.dt-siswa .row .col-lg-6 {margin-left: 60px;}}
        @media screen and (max-width: 995px) {
            div.dt-siswa .row .col-lg-6 {margin-left: 0;margin-top: 20px;}.data-right {height: fit-content;}
            #data_absen .d-flex {padding: 10px 20px;}
        }
        @media screen and (max-width: 776px) {.row > .col-sm-3 {width: 100%;} .row > .col-sm-3 .data-left{border-radius: 0; margin:0; height: fit-content;}}
        /* input.data {opacity: 0;} */
    </style>
</head>
<body>
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="data-left">
                <?php if(@$admin) : ?>
                    <span><a href="<?= base_url("Dashboard"); ?>"><i class="fas fa-th"></i> Dashboard</a></span><br>
                <?php endif; ?>
                <div class="boxData text-center">
                    <img src="<?= base_url("assets/images/semka.png"); ?>" alt="semka" width="150">
                    <h3 class="fw-bold fs-5 mt-3"><span style="font-size: 20px;">Absensi Berbasis Web</span> <br> SMK Negeri 1 Selong</h3>
                    <div class="input_absen mt-3">
                        <div id="time" class="fw-bold bg-dark  text-white"></div>
                        <form method="post" class="text-center form_absen">
                            <input type="text" name="data" class="data form-control mt-3" placeholder="Input ID Card" required>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="data-right">
                <div id="data_absen">
                    <div class="d-flex justify-content-around">
                        <div>
                            <img src="<?= base_url("assets/images/ntb.png"); ?>" width="50">
                        </div>
                        <div class="text-white">
                            <p style="padding: 0; margin:0; font-size: 12px;" class="text-center">PEMERINTAH PROVINSI NUSA TENGGARA BARAT DINAS PENDIDIKAN DAN KEBUDAYAAN</p>
                            <h5 class="text-center fw-bold" style="padding: 0; margin:3px;">SMK NEGERI 1 SELONG</h5>
                            <p style="padding: 0; margin:0; font-size: 10px;" class="text-center fst-italic">Jl. Pejanggik No. 74 Selong 83611 Telp (0376)23624 / Fax (0376)23254 Website. www.smkn1selong.sch.id Email : smkn01_selong@yahoo.co.id</p>
                        </div>
                        <div>
                            <img src="<?= base_url("assets/images/semka.png"); ?>" width="50">
                        </div>
                    </div>
                    <div class="dt-siswa">
                        <div class="row justify-content-start pt-5 pb-5 ps-5">
                            <div class="col-sm-3">
                               <img class="text-center" src="<?= base_url("assets/images/orangKosong.jpg"); ?>"  width="200" height="250">
                            </div>
                            <div class="col-lg-6">
                                <table>
                                    <tbody>    
                                        <tr>
                                            <td class="fw-bold" style="font-size: 15px;">Nama</td>
                                            <td style="width: 400px;">-</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold" style="font-size: 15px;">NIPD</td>
                                            <td style="width: 400px;">-</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold" style="font-size: 15px;">Kelas</td>
                                            <td style="width: 400px;">-</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold" style="font-size: 15px;">Jenis Kelamin</td>
                                            <td style="width: 400px;">-</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold" style="font-size: 15px;">Jam Masuk</td>
                                            <td style="width: 400px;">-</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold" style="font-size: 15px;">Jam Pulang</td>
                                            <td style="width: 400px;">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var input = document.querySelector(".data");
        input.focus();
        setInterval(() => {
            input.focus();
        }, 1000);

        function getDataAjax() {
           $.ajax({
                url: "<?= base_url("Absensi/Presensi/")?>"+$("input.data").val(),
                type: "GET",
                success: response => {
                    var data = response
                    try {
                        data = JSON.parse(data)
                         Swal.fire({
                            icon: "warning", timer: 1000, showConfirmButton: false, 
                            title: "Oops", text: "NIPD Siswa Ini Tidak Ditemukan"
                        })
                    } catch (error) {
                        $(".dt-siswa").html(response)
                    }
                }
           })   
        }

        $(".form_absen").submit(function (e) {
            e.preventDefault();
            getDataAjax();
            $("input.data").val("");
        })
    </script>
    <script src="<?= base_url("assets/build/js/custom.js") ?>"></script>
</body>
</html>
