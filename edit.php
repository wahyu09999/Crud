<?php

include_once("config.php");

if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $deskripsi = $_POST["deskripsi"];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if (empty($gambar)) {
        $result = mysqli_query($conn, "UPDATE catalog SET 
        nama='$nama',harga=$harga,deskripsi='$deskripsi' WHERE id=$id");
        if ($result) {
            header("location: index.php");
        } else {
            echo "Gagal Mengubah Data";
            echo "<br><a href='index.php'>View data</a>";
        }
    } else {
        $gambarbaru = date('dmY') . $gambar;

        $path = "images/" . $gambarbaru;

        if (move_uploaded_file($tmp, $path)) {
            $result = mysqli_query($conn, "SELECT * FROM catalog WHERE id=$id");
            $data = mysqli_fetch_array($result);

            if (is_file("images/" . $data['gambar']))
                unlink("images/" . $data['gambar']);

            $result = mysqli_query($conn, "UPDATE catalog SET 
            nama='$nama',harga=$harga,deskripsi='$deskripsi',gambar='$gambarbaru' WHERE id=$id");
            if ($result) {
                header("location: index.php");
            } else {
                echo "Gagal Mengubah Data";
                echo "<br><a href='index.php'>View data</a>";
            }
        }

        header("location: index.php");
    }
}

?>

<?php
$id = $_GET["id"];
$result = mysqli_query($conn, "SELECT * FROM catalog WHERE id=$id");

while ($data = mysqli_fetch_array($result)) {
    $id = $data["id"];
    $nama = $data["nama"];
    $harga = $data["harga"];
    $deskripsi = $data["deskripsi"];
}

?>

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
        <form name="update_user" method="POST" action="edit.php" enctype="multipart/form-data">
            <label>Gambar</label>
            <input class="custom-file-input" type="file" name="gambar">
            <label>Nama</label>
            <input type="text" name="nama" required value="<?php echo $nama; ?>">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" required value="<?php echo $harga; ?>">
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" required value="<?php echo $deskripsi; ?>">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button class="btn submit-btn" type="submit" name="update" value="update">Update</button>
        </form>
    </main>

</body>

</html>