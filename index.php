<?php
// Pastikan ini di baris pertama file
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepegawaian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-users"></i> Kepegawaian App
            </a>
            <div class="ms-auto">
                <?php if (isset($_SESSION['role'])): ?>
                    <a href="logout.php" class="btn btn-light"><i class="fas fa-sign-out-alt"></i> Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-light"><i class="fas fa-sign-in-alt"></i> Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>


    <div class="container my-4">
        <!-- Heading -->
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">Daftar Pegawai</h2>
            <p class="text-muted">Manajemen Data Pegawai dengan Interface yang Menarik</p>
        </div>

        <!-- Search Bar -->
        <div class="mb-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Cari nama pegawai...">
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered text-center shadow-sm" id="dataTable">
                <thead class="table-info">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Jurusan</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    session_start();
                    include "koneksi.php";
                    $sql="SELECT * FROM peserta ORDER BY id_peserta DESC";
                    $hasil=mysqli_query($kon,$sql);
                    $no=0;
                    while ($data = mysqli_fetch_array($hasil)) {
                        $no++;
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td class='nama'>{$data['nama']}</td>";
                        echo "<td>{$data['sekolah']}</td>";
                        echo "<td>{$data['jurusan']}</td>";
                        echo "<td>{$data['no_hp']}</td>";
                        echo "<td>{$data['alamat']}</td>";
                        echo "<td>";
                        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                            echo "<a href='update.php?id_peserta={$data['id_peserta']}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Update</a> ";
                            echo "<a href='".htmlspecialchars($_SERVER['PHP_SELF'])."?id_peserta={$data['id_peserta']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'><i class='fas fa-trash-alt'></i> Delete</a>";
                        } else {
                            echo "<span class='text-muted'>Hanya admin yang dapat mengelola data</span>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Add Data Button -->
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <div class="text-end">
                <a href="create.php" class="btn btn-success shadow-sm"><i class="fas fa-plus"></i> Tambah Data</a>
            </div>
        <?php endif; ?>

        <!-- Alert for Deletion -->
        <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && isset($_GET['id_peserta'])) {
            $id_peserta = htmlspecialchars($_GET["id_peserta"]);
            $stmt = $kon->prepare("DELETE FROM peserta WHERE id_peserta=?");
            $stmt->bind_param("i", $id_peserta);
            $hasil = $stmt->execute();
            
            if ($hasil) {
                echo "<div class='alert alert-success mt-3'>Data berhasil dihapus!</div>";
                header("Refresh:2; url=index.php");
            } else {
                echo "<div class='alert alert-danger mt-3'>Data gagal dihapus!</div>";
            }
            $stmt->close();
        }
        ?>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center text-white py-3 fixed-bottom">
        <p class="mb-0">&copy; 2025 Kepegawaian App. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#dataTable tbody tr');

            rows.forEach(row => {
                let name = row.querySelector('.nama').textContent.toLowerCase();
                row.style.display = name.includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
