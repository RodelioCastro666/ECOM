<?php


session_start();

include('../server/connection.php');
    
if(isset($_SESSION['logged_in'])){
    header('location: index.php');
    exit;
}

if(isset($_POST['login_btn'])){
    $email = $_POST['email'];
    $password =  md5($_POST['password']);

    $stmt =  $conn->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM ad WHERE admin_email=? AND admin_password = ? LIMIT 1");

    $stmt->bind_param('ss',$email,$password);

    if($stmt->execute()){
        $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
        $stmt->store_result();

        if($stmt->num_rows() == 1 ){
            $stmt->fetch();

            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;

            header('location: index.php?login_success=Logged in sucessfully');
        }
        else{
            header('location: login.php?error=could not verify');
        }
    }
    else{
        header('location: login.php?error=something went wrong');
    }
} 

?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <div>
        <form action="login.php" method="POST" enctype="multipart/form-data" id="login-form" >
            <p style="color: red;" > <?php if(isset($_GET['error'])){echo $_GET['error']; } ?></p>
            <div>
                <label for="">Email</label>
                <input type="email" placeholder="Email" id="product-name" name="email" >
            </div>
            <div>
                <label for="">Password</label>
                <input type="password" placeholder="Password" name="password" >
            </div>
            <div>
                <input type="submit" name="login_btn" value="Login" >
            </div>
        </form>
    </div>
</body>
</html>