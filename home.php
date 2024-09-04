<?php
require("koneksi.php");

// Sanitize the input from GET request
$email = isset($_GET['user_fullname']) ? htmlspecialchars($_GET['user_fullname']) : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1 class="mb-4">Selamat Datang <?php echo $email; ?></h1>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM user_detail";
                $result = mysqli_query($koneksi, $query);
                if ($result) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $userMail = htmlspecialchars($row['user_email']);
                        $userName = htmlspecialchars($row['user_fullname']);
                        ?>

                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $userMail; ?></td>
                    <td><?php echo $userName; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php
                        $no++;
                    }
                } 
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>