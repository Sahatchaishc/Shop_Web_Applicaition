<?php 
    session_start();
    require_once 'server.php';

    #เอา input ที่ได้หลังจากกดปุ่ม signup มาเก็บในตัวแปรเพื่อเช็คข้อมูลต่างๆ
    if(isset($_POST['signup'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $urole = 'user';

        #เช็คข้อมูลจาก form
        if(empty($firstname)){
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: register.php");
        }else if(empty($lastname)){
            $_SESSION['error'] = 'กรุณากรอกนามสกุล';
            header("location: register.php");
        }else if(empty($email)){
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: register.php");
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: register.php");
        }else if(empty($password)){
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: register.php");
        }else if(strlen($_POST['password'])>20 || strlen($_POST['password'])<5){
            $_SESSION['error'] = 'รหัสผ่านจะต้องมีความยาวระหว่าง 5-20 ตัวอักษร';
            header("location: register.php");
        }else if(empty($confirmpassword)){
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: register.php");
        }else if($password != $confirmpassword){
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: register.php");
        }else{
            try{
                #เชื่อมต่อ db โดยเลือกที่อยู่ของ email จากตาราง users แต่ตำแหน่งจะใช้ placeholder :email แทน $email(email จาก input) เพื่อกัน sql injection
                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $check_email->bindParam(":email",$email);
                #ประมวลผลคำสั่ง2บรรทัดบน
                $check_email->execute();
                #เก็บค่าที่ fetch ไว้ใน $row
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                #ถ้า email ใน db ตรงกับ email จาก input ให้แจ้งเตือน
                if($row['email'] == $email){
                    $_SESSION['warning'] = "อีเมลนี้ถูกใช้งานแล้ว <a href='login.php'>คลิ๊กที่นี่ </a>เพื่อเข้าสู่ระบบ";
                    #Redirect
                    header("location: register.php");
                }else if(!isset($_SESSION['error'])){ #ถ้าไม่มี error 
                    #เข้ารหัส password
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    #การเก็บข้อมูลลงไปใน db
                    $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, email, password, urole) 
                                            VALUE(:firstname, :lastname, :email, :password, :urole)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->execute();
                    $_SESSION['success'] = 'สมัครสมาชิกเรียบร้อยแล้ว! <a href="login.php" class="alert-link">คลิ๊กที่นี่ </a>เพื่อเข้าสู่ระบบ';
                    header("location: register.php");
                }else{
                    $_SESSION['error'] = 'มีบางอย่างผิดพลาด';
                    header("location: register.php");
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }

?>