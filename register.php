<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $status = $_POST['status'];
    //menambahkan user baru 
    $sql = "INSERT INTO users (username, password, email, status) VALUES ('$username', '$password', '$email', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Registration successful.');
        window.location.href='login.php';
      </script>"; // jika berhasil daftar masuk ke halaman login
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; //jika gagal
    }

    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Register - D'OMAH KOST PUTRI</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <center><h2>Register</h2></center>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <center>
                    <p>apakah anda sudah mempunyai akun ? <a href="login.php"><b> Login </b></a></p>
                </center>
            </div>
            <div class="col-md-6">
                <img src="Aset/img/login.jpg" class="img-fluid" alt="Registration Image">
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
