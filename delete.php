<?php 

include_once("config.php");

$id = $_GET["id"];

$result = mysqli_query($conn, "SELECT * FROM catalog WHERE id=$id");
$data = mysqli_fetch_array($result);

if(is_file("images/".$data['gambar']))
	unlink("images/".$data['gambar']);
    
$result = mysqli_query($conn, "DELETE FROM catalog WHERE id=$id");
if($result)
{ 
    header("location: index.php");
}
else
{
    echo "Gagal Menyimpan Data";
    echo "<br><a href='index.php'>View data</a>";
}
