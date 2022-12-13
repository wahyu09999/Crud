<?php

include_once("config.php");

$result = mysqli_query($conn, "SELECT * FROM catalog ORDER BY id DESC");

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

<body>
    <header>
        <a href="index.php" class="logo">
            <img class="logo" src="./assets/images/logo.png" />
        </a>
        <a href="tambah.php">Tambah data</a>
    </header>

    <main>
        <div class="product-list">
            <?php
            while ($data = mysqli_fetch_array($result)) {
                echo '<div class="card">';
                echo '<img src="images/' . $data["gambar"] . '" />';
                echo '<div class="product-detail">';
                echo '<h2>' . $data['nama'] . '</h2>';
                echo '<span>' . $data['deskripsi'] . '</span>';
                echo '<span>Rp.' . $data['harga'] . '</span>';
                echo '</div>';
                echo '<div class="action-card">';
                echo '<button class="update-btn btn">
                                    <a href="edit.php?id=' . $data['id'] . '">Edit</a>
                                </button>';
                echo '<button class="delete-btn btn">
                                <a href="delete.php?id=' . $data['id'] . '">Hapus</a>
                            </button>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

    </main>
</body>

</html>