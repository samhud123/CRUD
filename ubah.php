<?php 
    require 'function.php';

    // ambil data di URL
    $id = $_GET['id'];

    // query data mahasiswa berdasarkan id
    $mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

    // cek apakah tombol submit sudah ditekan atau belum
    if (isset($_POST["submit"])) {
        // cek apakah data berhasil diubah atau tidak
        if ( ubah($_POST) > 0 ) {
            echo "
                <script>
                    alert('data berhasil diubah');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal diubah');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data - Mahasiswa</title>

    <!-- Link CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <!-- link internal CSS -->
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <div class="container mt-3">
        <div class="card text-center">
        <div class="card-header bg-primary text-white fs-5 fw-semibold">
            Ubah Data Mahasiswa
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <input type="hidden" name="id" value="<?= $mhs['id']; ?>">
                <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"] ?>">
                <div class="mb-3">
                    <img src="image/<?= $mhs['gambar'] ?>" alt="foto Mahasiswa">
                    <p class="mt-2 fs-4 fw-semibold"><?= $mhs['nama']; ?></p>
                </div>
                <div class="mb-3 d-flex ubah">
                    <label for="nim" class="form-label fs-5 fw-semibold ubah-label">Nim : </label>
                    <input type="text" class="form-control w-50 align-items-center" name="tnim" id="nim" required value="<?= $mhs['nim']; ?>">
                </div>
                <div class="mb-3 d-flex ubah">
                    <label for="nama" class="form-label fs-5 fw-semibold ubah-label">Nama : </label>
                    <input type="text" class="form-control w-50 align-items-center" name="tnama" id="nama" required value="<?= $mhs['nama']; ?>">
                </div>
                <div class="mb-3 d-flex ubah">
                    <label for="email" class="form-label fs-5 fw-semibold ubah-label">Email : </label>
                    <input type="text" class="form-control w-50 align-items-center" name="temail" id="email" required value="<?= $mhs['email']; ?>">
                </div>
                <div class="mb-3 d-flex ubah">
                    <label for="prodi" class="form-label fs-5 fw-semibold ubah-label">Prodi : </label>
                    <select class="form-select w-50" name="tprodi" id="select" required>
                        <option value="<?= $mhs['jurusan']; ?>"><?= $mhs['jurusan']; ?></option>
                        <option value="D3 - Komputerisasi Akuntansi">D3 - Komputerisasi Akuntansi</option>
                        <option value="S1 - Sistem Informasi">S1 - Sistem Informasi</option>
                        <option value="S1 - Teknik Informtika">S1 - Teknik Informtika</option>
                    </select>
                </div>
                <div class="mb-3 d-flex ubah">
                    <label for="foto" class="form-label fs-5 fw-semibold ubah-label">Foto : </label>
                    <input type="file" class="form-control w-50 align-items-center" name="tfoto" id="foto">
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" name="submit" class="btn btn-primary">Ubah Data!</button>
            </div>
        </form>
        </div>
    </div>

    <!-- Link JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>