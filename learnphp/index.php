<?php 
    session_start();
    require_once 'server.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css"></link>
    <link rel="stylesheet" href="style.css"></link>
    <title>Learn PHP</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        หมวดหมู่
                        </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                    </li>
                </ul>       
            </div>
        </div>
    </nav>
    <?php 
        if(isset($_SESSION['user_login'])){
            $user_id = $_SESSION['user_login'];
            $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
    ?>
    <h3 class="mt-4">Welcome,<?php echo $row['firstname'].' '.$row['lastname']?></h3>
    <?php
        }
    ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="add_product.php">Add product</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
