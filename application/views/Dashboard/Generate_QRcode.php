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
<form method="post" class="form">
    <h3>Generate QRcode</h3>
    <div class="row mt-5">
        <div class="mb-3">
            <label class="col-sm-2 col-form-label">Kelas</label>
            <div class="col-sm-3">
                <select name="kelas" class="form-select" onchange="setJurusan(value)">
                    <option value="X">Kelas X</option>
                    <option value="XI">kelas XI</option>
                    <option value="XII">Kelas XII</option>
                    <option value="XIII">Kelas XIII</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="col-sm-2 col-form-label">Jurusan</label>
            <div class="col-sm-3">
                <select name="jurusan" class="form-select" id="select_jurusan"></select>
            </div>
        </div>
        <div class="col-sm-3">
            <input type="submit" class="btn btn-success mt-3" name="generate" value="Generate">
        </div>
    </div>
</form>