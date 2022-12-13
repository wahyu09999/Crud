<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="./assets/images/logo.png">
    <title>Gervich Store</title>
</head>
<header>
    <a href="index.php" class="logo">
        <img class="logo" src="./assets/images/logo.png" />
    </a>
    <a href="tambah.php">Tambah data</a>
</header>

<body>
    <main>
        <form action="tambah.php" method="POST" name="form1" enctype="multipart/form-data">
            <label>Gambar</label>
            <input class="custom-file-input" type="file" name="gambar" required>
            <label>Nama</label>
            <input type="text" name="nama" required>
            <label>Harga (Rp)</label>
            <input type="number" name="harga" required>
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" required>
            <button class="btn submit-btn" type="submit" name="submit" value="simpan">Simpan</button>
        </form>
    </main>

    <?php

    if (isset($_POST["submit"])) {
        $nama = $_POST["nama"];
        $harga = $_POST["harga"];
        $deskripsi = $_POST["deskripsi"];
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        // Rename nama gambarnya dengan menambahkan tanggal dan jam upload
        $gambarbaru = date('dmY') . $gambar;

        // Set path folder tempat menyimpan gambarnya
        $path = "images/" . $gambarbaru;

        include_once("config.php");

        if (move_uploaded_file($tmp, $path)) {
            $result = mysqli_query($conn, "INSERT INTO catalog(nama,harga,deskripsi,gambar) 
                VALUES('$nama','$harga','$deskripsi','$gambarbaru')");
            if ($result) {
                header("location: index.php");
            } else {
                echo "Gagal Menyimpan Data";
                echo "<br><a href='index.php'>View data</a>";
            }
        } else {
            echo "Upload gambar gagal";
            echo "<br><a href='index.php'>View data</a>";
        }
    }
    ?>
</body>

</html>