<?php 
    require_once 'server.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css"></link>
    <link rel="stylesheet" href="style.css"></link>
    <title>Register</title>
</head>
<body>
    <a class="navbar-brand" href="index.php">Home</a>
    <div class="container">
        <h3 class="mt-4">สมัครสมาชิก</h3>
        <hr>
        <form action="register_db.php" method="post">
            <?php if(isset($_SESSION['error'])){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>

            <?php if(isset($_SESSION['success'])){ ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>

            <?php if(isset($_SESSION['warning'])){ ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" name="firstname" aria-describedby="firstname" placeholder="First name">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" name="lastname" aria-describedby="lastname" placeholder="Last name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" aria-describedby="email" placeholder="E-mail">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
            </div>
            <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
        </form>
        <hr>
        <p>คลิ๊กที่นี่เพื่อ <a href="login.php">เข้าสู่ระบบ</a></p>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>