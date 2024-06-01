!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel ="../css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Inventory System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_item.php">Tambah Barang</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">

<?php
include 'db.php';


$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jumlah = $_POST['jumlah'];

    $sql = "UPDATE barang SET jumlah_barang = jumlah_barang - $jumlah WHERE id_barang = $id AND jumlah_barang >= $jumlah";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    $sql = "SELECT * FROM barang WHERE id_barang = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<h2>Kurangi Barang</h2>
<form method="POST">
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" value="<?php echo $row['nama_barang']; ?>" disabled>
    </div>
    <div class="form-group">
        <label>Jumlah Barang</label>
        <input type="number" name="jumlah" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Kurangi</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
</form>

<?php
include 'templates/footer.php';
?>
