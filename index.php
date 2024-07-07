<?php
session_start();
include 'config.php';

$loggedIn = isset($_SESSION['ses_username']);
$is_admin = $loggedIn && $_SESSION['ses_status'] == 'admin';
$username = $loggedIn ? $_SESSION['ses_username'] : '';

$sql = "SELECT * FROM rooms WHERE available_rooms > 0";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>D'OMAH KOST PUTRI</title>
    <style>
        #hero {
            position: relative;
            background-color: #f8f9fa;
        }
        #hero .img-hero {
            width: 100%;
            max-width: 600px;
            position: absolute;
            bottom: -20px; /* Adjust this value to move the image up or down */
            right: 0;
        }
    </style>
</head>
<body>
    <!--Nav Bar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparan">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Aset/img/logo2-removebg-preview (1).png" alt="" width="60px" class="d-inline-block align-text-center me-2">
                D'OMAH KOST PUTRI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="fitur.html">Menu Kost</a>
                    </li>
                </ul>
                <div>
                    <?php if ($loggedIn): ?>
                        <span>Welcome, <?php echo $username; ?>!</span>
                        <?php if (!$is_admin): ?>
                            <a href="booking.php" class="btn btn-primary">Booking</a>
                            <a href="my_bookings.php" class="btn btn-primary">My Bookings</a>
                        <?php endif; ?>
                        <?php if ($is_admin): ?>
                            <a href="admin_rooms.php" class="btn btn-secondary">Manage Rooms</a>
                            <a href="admin_bookings.php" class="btn btn-secondary">Manage Bookings</a>
                        <?php endif; ?>
                        <a href="logout.php" class="btn btn-secondary">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-primary">Masuk</a>
                        <a href="register.php" class="btn btn-secondary">Daftar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section id="hero">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-md-6 hero-tagline my-auto">
                    <h1>Bingung nyari kost kostan? Di D'OMAH KOST PUTRI SAJA</h1>
                    <p>D'OMAH KOST PUTRI hadir untuk menemani anda dalam memilih kost kostan. Kami memberikan berbagai pilihan kost impian yang nyaman dengan fasilitas yang memadai dan tentunya harga yang terjangkau. Berbagai macam pilihan kost yang cocok untuk mahasiswa, karyawan, maupun keluarga.</p>
                    <h4><i>Yuk tunggu apalagi segera bergabung dengan website kami !!!</i></h4>
                </div>
            </div>
            <img src="Aset/img/2914575-removebg-preview.png" alt="" class="position-absolute img-hero">
        </div>
    </section>

    <!-- Rooms Section -->
    <section id="rooms" class="mt-5">
        <div class="container">
            <h2>Available Rooms</h2>
            <div class="row">
                <?php while ($room = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $room['name']; ?></h5>
                                <p class="card-text"><?php echo $room['description']; ?></p>
                                <p class="card-text">Price: <?php echo $room['price']; ?></p>
                                <p class="card-text">Available Rooms: <?php echo $room['available_rooms']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
</body>
</html>
