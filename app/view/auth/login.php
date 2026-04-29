<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Login Admin</div>

            <?php if(isset($error)) echo "<div class='alert-danger'> $error</div>";?>
            <?php if(isset($success)) echo "<div class='alert-success'>$success</div>";?>

            <form action="index.php?act=login-process" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password_pengguna" class="form-control" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <hr>
            <a href="index.php?act=register" class="text-center">Belum Punya Akun? Daftar</a>
        </div>
    </div>
</body>
</html>