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
$sql = "SELECT * FROM barang WHERE id_barang = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $satuan_barang = $_POST['satuan_barang'];
    $harga_beli = $_POST['harga_beli'];
    $status_barang = isset($_POST['status_barang']) ? 1 : 0;

    $sql = "UPDATE barang SET kode_barang = '$kode_barang', nama_barang = '$nama_barang', jumlah_barang = $jumlah_barang, satuan_barang = '$satuan_barang', harga_beli = $harga_beli, status_barang = $status_barang WHERE id_barang = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>Update Barang</h2>
<form method="POST">
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text" name="kode_barang" class="form-control" value="<?php echo $row['kode_barang']; ?>" required>
    </div>
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" value="<?php echo $row['nama_barang']; ?>" required>
    </div>
    <div class="form-group">
        <label>Jumlah Barang</label>
        <input type="number" name="jumlah_barang" class="form-control" value="<?php echo $row['jumlah_barang']; ?>" required>
    </div>
    <div class="form-group">
        <label>Satuan Barang</label>
        <select name="satuan_barang" class="form-control" required>
            <option value="kg" <?php if ($row['satuan_barang'] == 'kg') echo 'selected'; ?>>kg</option>
            <option value="pcs" <?php if ($row['satuan_barang'] == 'pcs') echo 'selected'; ?>>pcs</option>
            <option value="liter" <?php if ($row['satuan_barang'] == 'liter') echo 'selected'; ?>>liter</option>
            <option value="meter" <?php if ($row['satuan_barang'] == 'meter') echo 'selected'; ?>>meter</option>
        </select>
    </div>
    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" step="0.01" name="harga_beli" class="form-control" value="<?php echo $row['harga_beli']; ?>" required>
    </div>
    <div class="form-group">
        <label>Status Barang</label>
        <input type="checkbox" name="status_barang" <?php if ($row['status_barang']) echo 'checked'; ?>> Available
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
</form>

<?php
include 'templates/footer.php';
?>