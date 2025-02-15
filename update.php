<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Update Pegawai</title>
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

    if (isset($_GET['id_peserta'])) {
        $id_peserta = input($_GET["id_peserta"]);
        $sql = "SELECT * FROM peserta WHERE id_peserta=$id_peserta";
        $hasil = mysqli_query($kon, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_peserta = htmlspecialchars($_POST["id_peserta"]);
        $nama = input($_POST["nama"]);
        $sekolah = input($_POST["sekolah"]);
        $jurusan = input($_POST["jurusan"]);
        $no_hp = input($_POST["no_hp"]);
        $alamat = input($_POST["alamat"]);

        $sql = "UPDATE peserta SET nama='$nama', sekolah='$sekolah', jurusan='$jurusan', no_hp='$no_hp', alamat='$alamat' WHERE id_peserta=$id_peserta";
        $hasil = mysqli_query($kon, $sql);

        if ($hasil) {
            echo "<div class='alert alert-success text-center'>Data berhasil diperbarui! Mengalihkan ke halaman utama...</div>";
            header("refresh:2; url=index.php");
        } else {
            echo "<div class='alert alert-danger text-center'>Data gagal diperbarui.</div>";
        }
    }
    ?>

    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white text-center">
            <h3><i class="fas fa-edit"></i> Update Data Pegawai</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama:</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" value="<?php echo $data['nama']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Divisi:</label>
                    <input type="text" name="sekolah" class="form-control" placeholder="Masukkan Divisi" value="<?php echo $data['sekolah']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jurusan:</label>
                    <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan" value="<?php echo $data['jurusan']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP:</label>
                    <input type="tel" name="no_hp" class="form-control" placeholder="Masukkan No HP" pattern="[0-9]{10,13}" value="<?php echo $data['no_hp']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat:</label>
                    <textarea name="alamat" class="form-control" rows="4" placeholder="Masukkan Alamat" required><?php echo $data['alamat']; ?></textarea>
                </div>

                <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>">

                <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-warning text-white"><i class="fas fa-save"></i> Update</button>
                    <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
