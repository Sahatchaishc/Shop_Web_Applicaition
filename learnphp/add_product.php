<?php 
    session_start();
    if(!isset($_SESSION['admin_login'])){
        header('location: index.php');
    }
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
    <title>Add Product</title>
</head>
<body>
    <a class="navbar-brand" href="index.php">Home</a>
        <div class="container" name="box">
            <div class="alert alert-primary text-center mt-4 mb-4 h4" role="alert">
                เพิ่มข้อมูลสินค้า
            </div>

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

            <form action="insert_product_db" method="post"></form>
            <label >ชื่อสินค้า</label>
            <input type="text" class="form-control" name="pro_name" placeholder="ชื่อสินค้า..." required><br>

            <label >ประเภทสินค้า</label>
            <select class="form-select" name="typeID">  
                <?php 
                    $stmt = $conn->query("SELECT * FROM type ORDER BY type_name");
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <option value="<?php echo $row['type_id']?>"><?php echo $row['type_name']?></option>
                <?php
                    }
                ?>
            </select><br>

            <label >ราคา</label>
            <input type="number" class="form-control" name="price" placeholder="ราคา..." required><br>

            <label >รูปภาพ</label>
            <input type="file" class="form-control" name="file1" required><br>

            <button type="submit" name="comfirm" class="btn btn-primary">Submit</button>
        </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

