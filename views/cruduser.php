<?php  
// KONEKSI  
$conn = mysqli_connect("127.0.0.1", "root", "root", "peminjaman_alat");  
  
// Cek Koneksi (Opsional untuk debug)
if (!$conn) { die("Koneksi gagal: " . mysqli_connect_error()); }

// TAMBAH & UPDATE  
if (isset($_POST['simpan'])) {  
    $username = $_POST['username'];  
    $password = $_POST['password'];  
    $role = $_POST['role'];  
  
    if ($_POST['id'] == "") {  
        // TAMBAH - Perbaikan pada nama kolom dan jumlah values
        mysqli_query($conn, "INSERT INTO user (username, password, role) VALUES ('$username','$password','$role')");  
    } else {  
        // UPDATE  
        $id = $_POST['id'];  
        mysqli_query($conn, "UPDATE user SET username='$username', password='$password', role='$role' WHERE id='$id'");  
    }  
    header("Location: cruduser.php");  
    exit(); // Selalu gunakan exit setelah header redirect
}  
  
// HAPUS  
if (isset($_GET['hapus'])) {  
    $id = $_GET['hapus'];  
    mysqli_query($conn, "DELETE FROM user WHERE id='$id'");  
    header("Location: cruduser.php");  
    exit();
}  
  
// EDIT  
$edit = false;  
if (isset($_GET['edit'])) {  
    $edit = true;  
    $id = $_GET['edit'];  
    $res = mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");
    $dataEdit = mysqli_fetch_array($res);  
}  
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD User</title>
    <style>
        body { font-family: Arial; background-color: #f2f2f2; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #444; }
        input { width: 100%; padding: 10px; margin: 6px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { padding: 10px 18px; background: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; width: 100%; }
        button:hover { background: #5a6268; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background: #6c757d; color: white; }
        tr:nth-child(even) { background: #f8f9fa; }
        .hapus { background: #495057; padding: 6px 10px; color: white; border-radius: 5px; text-decoration: none; font-size: 12px; }
        .edit { background: #adb5bd; padding: 6px 10px; color: #212529; border-radius: 5px; text-decoration: none; font-size: 12px; }
    </style>
</head>
<body>
<div class="container">
    <h2><?= $edit ? "Edit User" : "Tambah User"; ?></h2>

    <form method="post">
        <input type="hidden" name="id" value="<?= $edit ? $dataEdit['id'] : ""; ?>">
        <input type="text" name="username" placeholder="Username" value="<?= $edit ? $dataEdit['username'] : ""; ?>" required>
        <input type="password" name="password" placeholder="Password" value="<?= $edit ? $dataEdit['password'] : ""; ?>" required>
        <input type="text" name="role" placeholder="Role (admin/user)" value="<?= $edit ? $dataEdit['role'] : ""; ?>" required>
        <button type="submit" name="simpan">
            <?= $edit ? "Update" : "Simpan"; ?>
        </button>
    </form>

    <table>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM user");
        while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['username']; ?></td>
            <td><?= $data['password']; ?></td>
            <td><?= $data['role']; ?></td>
            <td> <a href="?edit=<?= $data['id']; ?>" class="edit">Edit</a>
                <a href="?hapus=<?= $data['id']; ?>" class="hapus" onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
