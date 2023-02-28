<?php
    // import file
    require 'function.php';

    $mahasiswa = query("SELECT * FROM mahasiswa");

    // cek tombol submit
    if (isset($_POST["submit"])) {
        // cek apakah data berhasil ditambahkan atau tidak
        if (tambah($_POST) > 0) {
            echo "
                <script>
                    alert('data gagal ditambahkan');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data berhasil ditambahkan');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }

    // jika tombol cari di klik
    if (isset($_POST["cari"])) {
        $mahasiswa = cari($_POST["keyword"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Data Mahasiswa</title>

    <!-- Link CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <!-- Link CSS Fontawesome -->
    <script src="https://kit.fontawesome.com/4102b9a720.js" crossorigin="anonymous"></script>

</head>
<body>

    <div class="container">
        <h1 class="text-center mt-3">Data Mahasiswa</h1>

        <!-- Start tabel Mahasiswa -->
        <div class="card mt-3">
            <h5 class="card-header bg-primary text-white">Daftar Mahasiswa</h5>
            <div class="card-body">
                 <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-circle-plus"></i> Tambah Data
                </button>
                <!-- End Button trigger modal -->

                <form class="d-flex mt-3" role="search" action="" method="post">
                    <input class="form-control me-2 w-50" type="search" name="keyword" autocomplete="off" autofocus placeholder="Cari data mahasiswa..." aria-label="Search">
                    <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
                </form>
                <table class="table table-striped table-hover mt-3">
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Gambar</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Prodi</th>
                    </tr>

                    <?php $i = 1; ?>
                    <?php foreach( $mahasiswa as $row ) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <a href="ubah.php?id=<?= $row['id']; ?>"class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>  
                        </td>
                        <td><img src="image/<?= $row['gambar'] ?>" alt="Foto Mahasiswa" width="50"></td>
                        <td><?= $row['nim'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['jurusan'] ?></td>
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                </table>
            </div>

            <!-- Start Form Modal -->
            <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Data Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nim" class="form-label">Nim</label>
                            <input type="text" class="form-control" name="tnim" id="nim" placeholder="masukkan nim mahasiswa" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="tnama" id="nama" placeholder="masukkan nama mahasiswa" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="temail" id="email" placeholder="masukkan email mahasiswa" required>
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Prodi</label>
                            <select class="form-select" name="  " id="select" required>
                                <option></option>
                                <option value="D3 - Komputerisasi Akuntansi">D3 - Komputerisasi Akuntansi</option>
                                <option value="S1 - Sistem Informasi">S1 - Sistem Informasi</option>
                                <option value="S1 - Teknik Informtika">S1 - Teknik Informtika</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nim" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="tfoto" id="foto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
            <!-- End Form Modal -->
        </div>
        <!-- End tabel mahasiswa -->
    </div>

    <!-- Link JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>