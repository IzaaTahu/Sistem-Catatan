<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<link rel="stylesheet" href="public/css/dashboard.css">

</head>

<body>

<?php
include "components/nav.php"; 
include "components/sidebar.php";
?>

<div class="main-content">

    <div class="dashboard-card">
        <h3>Selamat Datang, <?php echo $_SESSION['username']; ?> 👋</h3>
        <p>Ini adalah halaman dashboard admin untuk mengelola catatan dan kategori.</p>
    </div>

</div>

</body>
</html>