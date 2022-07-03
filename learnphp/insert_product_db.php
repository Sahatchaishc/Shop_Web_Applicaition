<?php
    session_start();
    require_once 'server.php';
    if(isset($_POST['comfirm'])){
        $pro_name = $_POST['pro_name'];
        $typeID = $_POST['typeID'];
        $price = $_POST['price'];
        
        //อัพโหลดรูปภาพ
        if(is_uploaded_file($_FILES['file1']['tmp_name'])){
            $new_image_name = 'pr_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
            $image_upload_path = "./image".$new_image_name;
            move_upload_file($_FILES['file1']['tmp_name'], $image_upload_path);
            }else{
                $new_image_name ="";
            }

            $stmt = $conn->prepare("INSERT INTO product(pro_name, type_id, price, image) 
                            VALUE(:pro_name, :type_id, :price, :image)");
            $stmt->bindParam(":pro_name", $proname);
            $stmt->bindParam(":type_id", $typeID);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":image", $new_image_name);
            $stmt->execute();
            if($stmt){
                $_SESSION['success'] = 'บันทึกข้อมูลเรียบร้อย!';
                header("location: add_product.php");
            }else
                $_SESSION['error'] = 'ไม่สามารถบันทึกข้อมูลได้!';
                header("location: add_product.php");
    }
?>  
