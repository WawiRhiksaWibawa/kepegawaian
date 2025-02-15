<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Pegawai</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container my-5">
    <?php
    include "koneksi.php";

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = input($_POST["nama"]);
        $sekolah = input($_POST["sekolah"]);
        $jurusan = input($_POST["jurusan"]);
        $no_hp = input($_POST["no_hp"]);
        $alamat = input($_POST["alamat"]);

        $sql = "INSERT INTO peserta (nama, sekolah, jurusan, no_hp, alamat) VALUES ('$nama','$sekolah','$jurusan','$no_hp','$alamat')";
        $hasil = mysqli_query($kon, $sql);

        if ($hasil) {
            echo "<div class='alert alert-success text-center'>Data berhasil disimpan! Mengalihkan ke halaman utama...</div>";
            header("refresh:2; url=index.php");
        } else {
            echo "<div class='alert alert-danger text-center'>Data gagal disimpan.</div>";
        }
    }
    ?>

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3><i class="fas fa-user-plus"></i> Input Data Pegawai</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama:</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Divisi:</label>
                    <input type="text" name="sekolah" class="form-control" placeholder="Masukkan Divisi" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jurusan:</label>
                    <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP:</label>
                    <input type="tel" name="no_hp" class="form-control" placeholder="Masukkan No HP" pattern="[0-9]{10,13}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat:</label>
                    <textarea name="alamat" class="form-control" rows="4" placeholder="Masukkan Alamat" required></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Submit</button>
                    <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
