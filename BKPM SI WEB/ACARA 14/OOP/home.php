<?php
// Menghubungkan file koneksi.php untuk koneksi ke database
require ('koneksi.php'); 

// Menghubungkan file query.php jika diperlukan (dikomentari jika tidak butuh)
require ('query.php'); // Pastikan ini dikomentari hanya jika Anda tidak butuh file ini

// Mengambil data 'user_fullname' dari URL, dengan cara aman untuk menghindari error jika parameter tidak ada
$fullname = $_GET['user_fullname'] ?? ''; // Menghindari notice jika parameter tidak ada

// Membuat objek dari class 'crud', pastikan class crud sudah tersedia dan bisa diakses
$obj = new crud; 
?>
<html>

<head>
    <title>Home</title>
</head>

<body>
    <!-- Menampilkan pesan selamat datang dengan nama user yang diambil dari URL, menggunakan htmlspecialchars untuk mencegah XSS -->
    <h1>Selamat Datang <?php echo htmlspecialchars($fullname);?></h1>

    <!-- Membuat tabel untuk menampilkan data user -->
    <table border='1'>
        <tr>
            <td>No</td>
            <td>Email</td>
            <td>Nama</td>
            <td>Aksi</td>
        </tr>
        <?php
        // Mengambil data dari objek $obj menggunakan method 'lihatData'
        $data = $obj->lihatData(); // Pastikan function lihatData mengembalikan data dengan benar
        $no = 1; // Inisialisasi nomor urut
        
        // Mengecek apakah ada data yang dikembalikan dari database
        if($data->rowCount() > 0){
            // Looping data user
            while($row = $data->fetch(PDO::FETCH_ASSOC)){
        ?>
        <!-- Menampilkan data user ke dalam tabel -->
        <tr>
            <td><?php echo $no;?></td>
            <td><?php echo htmlspecialchars($row['user_email']); ?></td>
            <td><?php echo htmlspecialchars($row['user_fullname']); ?></td>
            <td>
                <!-- Tombol aksi untuk mengedit dan menghapus data user berdasarkan ID -->
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="hapus.php?id=<?php echo $row['id']; ?>">Hapus</a>
            </td>
        </tr>
        <?php
                $no++; // Menambah nomor urut setiap data ditampilkan
            }
        } else {
            // Jika tidak ada data, menampilkan pesan "Tidak ada data."
            echo "<tr><td colspan='4'>Tidak ada data.</td></tr>";
        }
    ?>
    </table>
</body>

</html>