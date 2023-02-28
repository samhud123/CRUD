<?php
    // koneksi database
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "dbmahasiswa";

    $conn = mysqli_connect($server, $user, $pass, $database);

    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ( $row = mysqli_fetch_assoc($result) ) {
            $rows[] = $row;
        }

        return $rows;
    }

    function tambah($data) {
        global $conn;
        
        // ambil data dari tiap-tiap elemen form
        $nim = htmlspecialchars($data['tnim']);
        $nama = htmlspecialchars($data['tnama']);
        $email = htmlspecialchars($data['temail']);
        $prodi = htmlspecialchars($data['tprodi']);

        $gambar = upload();
        
        if (!$gambar) {
            return false;
        }

        // query insert data
        $query = "INSERT INTO mahasiswa VALUES ('', '$gambar', '$nim', '$nama', '$email', '$prodi')";

        mysqli_query($conn, $query);
    } 

    function upload() {
        $namaFile = $_FILES['tfoto']['name'];
        $ukuranFile = $_FILES['tfoto']['size'];
        $error = $_FILES['tfoto']['error'];
        $tmpName = $_FILES['tfoto']['tmp_name'];

        // cek apakh tidak ada gambar yang diupload
        if ( $error === 4 ) {
            echo "
                <script>
                    alert('Pilih gambar terlebih d  ahulu!');
                </script>
                ";
            return false;
        }
        
        // cek apakah yang diupload adalah gambar atau bukan
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
            echo "
                <script>
                    alert('Yang anda upload bukan gambar!');
                </script>
                ";
            return false;
        }

        // cek jika ukurannya terlalu besar
        if ( $ukuranFile > 1000000 ) {
            echo "
                <script>
                    alert('Ukuran gambar terlalu besar!');
                </script>
                ";
            return false;
        }

        // lolos pengecekan gambar siap diupload
        //  generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'image/'.$namaFileBaru);

        return $namaFileBaru;
    }

    function hapus($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

        return mysqli_affected_rows($conn);
    }

    function ubah($data) {
        global $conn;

        // ambil data dari tiap elemen form
        $id = $data["id"];
        $nim = htmlspecialchars($data["tnim"]);
        $nama = htmlspecialchars($data["tnama"]);
        $email = htmlspecialchars($data["temail"]);
        $jurusan = htmlspecialchars(($data["tprodi"]));
        $gambarLama = $data["gambarLama"];

        // cek apakah user pilih gambar baru atau tidak
        if ($_FILES['tfoto']['error'] === 4) {
            $gambar = $gambarLama;
        } else {
            $gambar = upload();
        }

        // query insert data
        $query = "UPDATE mahasiswa SET 
                    nim = '$nim',
                    nama = '$nama',
                    email = '$email',
                    jurusan = '$jurusan',
                    gambar = '$gambar'
                WHERE id = $id
        ";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function cari($keyword) {
        $query = "SELECT * FROM mahasiswa WHERE
                    nama LIKE '%$keyword%' OR
                    nim LIKE '%$keyword%' OR
                    email LIKE '%$keyword%' OR
                    jurusan LIKE '%$keyword%'
                ";
        return query($query);
    }
?>