<?php date_default_timezone_set("Asia/Makassar"); ?>
<script>
    setJurusan()
    function setJurusan(dataKelas = "X", jurusan = null) {
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

<form method="post" action="<?= base_url("absensi/download_absensi_harian") ?>" class="form"> 
    <h3 class="mb-5">REKAP ABSENSI SISWA - PER HARI</h3>
    <input type="radio" name="export" value="excel" id="excel" style="opacity: 0; position: absolute;">
    <input type="radio" name="export" value="print" id="print" style="opacity: 0; position: absolute;">
    <label for="excel" class="excel_label btn btn-outline-success" >EXCEL</label>
    <label for="print" class="print_label btn btn-outline-success" >PRINT</label>

    <script>
        $(".excel_label").click(function (e) {
            $(".excel_label").addClass("bg-green");
            $(".excel_label").removeClass("btn-outline-success");
            $(".print_label").addClass("btn-outline-success");
            $(".print_label").removeClass("bg-green");
        })
        $(".print_label").click(function (e) {
            $(".print_label").addClass("bg-green");
            $(".print_label").removeClass("btn-outline-success");
            $(".excel_label").addClass("btn-outline-success");
            $(".excel_label").removeClass("bg-green");          
        })
    </script>
    <div class="row mt-3"> 
        <div class="left_box row">
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Tanggal</label>
                <div class="col-md-7">
                    <input type="date" name="tanggal" class="form-control">
                </div>
            </div>
             <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Kelas</label>
                <div class="col-md-7">
                    <select name="kelas" class="form-select" id="select_kelas" onchange="setJurusan(value)">
                        <option value="X">Kelas X</option>
                        <option value="XI">Kelas XI</option>
                        <option value="XII">Kelas XII</option>
                        <option value="XIII">Kelas XIII</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Jurusan</label>
                <div class="col-md-7">
                    <select name="jurusan" class="form-select" id="select_jurusan"></select>
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
