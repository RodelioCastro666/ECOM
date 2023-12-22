<?php

session_start();
include('server/connection.php');

if(!isset($_SESSION['logged_in'])){

    header('location: login.php');
    exit;
}

if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])){
        unset($_SESSION['logged_in']);
        unset($_SESSION['logged_email']);
        unset($_SESSION['logged_name']);
        header('location: login.php');
        exit;
    }
    
}

if(isset($_POST['change_password'])){
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_POST['user_email'];

    if($password !== $confirmPassword){
        header('location: account.php?error=password dont match');
    }

    else if(strlen($password) < 6 ){
        header('location: account.php?error=password must be at least 6 numbers');
    }
    else{
        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");

        $stmt->bind_param('ss',md5($password), $user_email);

        if($stmt->execute()){
            header('location: account.php?message=password has been updated sucessfully');
        }
        else{
            header('location: account.php?error=cant update password');
        }
    }
}

if(isset($_SESSION['logged_in'])){

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");

    $stmt->bind_param('i',$user_id);

    $stmt->execute();

    $orders = $stmt->get_result();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/Assets/CSS/style.css">
    <script src="https://kit.fontawesome.com/23729abf95.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">    

        <div class="container">
            <img class="logo" src="Images/strawberry LOGO.png" alt="">
            <h4 class="brand" >strawberry corner <br><span class="brand-second" >est. 2023</span></h4>
            

          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>

          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">home</a>
                </li>
                <li class="nav-item">
                    
                    <a class="nav-link" href="shop.html">Shop</a>
                </li>

                <li class="nav-item">
                    <i class="fa-regular fa-heart"></i>
                   
                  
                  
                </li>

                <li class="nav-item">
                    <a href="cart.php"> <i class="fa-solid fa-bag-shopping"></i></a>
                   
                </li>

                <li class="nav-item">
                    <a href="contact.html"> <i class="fa-solid fa-address-book"></i></a>
                   
                </li>

                <li class="nav-item">
                    <a href="account.html"><i class="fa-regular fa-user"></i></a>
                    
                </li>

                

            </ul>
          </div>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

        </div>
    </nav>


    <!--Account-->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <p>Name: <span> <?php if(isset($_SESSION['register_success'])){echo $_SESSION['register_success']; } ?> </span></p>
                <p>Name: <span> <?php if(isset($_SESSION['login_success'])){echo $_SESSION['login_success']; } ?> </span></p>

                
                <h4 class="font-weight-bold">Account Info</h4>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name: <span> <?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name']; } ?> </span></p>
                    <p>Email: <span><?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email']; } ?></span></p>
                    <p><a href="#orders" id="order-btn">Your Orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <form id="account-form" method="POST" action="account.php" >
                    <p class="text-center" style="color: red;"> <?php if(isset($_GET['error'])){echo $_GET['error']; } ?> </p>
                    <p class="text-center" style="color: red;"> <?php if(isset($_GET['message'])){echo $_GET['message']; } ?> </p>
                    <h4>Change Password</h4>
                    <hr>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="account-spassword" name="password" placeholder="Password">

                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Password">
                        
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change-password" name="change_password" class="btn" id="change-pass-btn">
                    </div>
                </form>
            </div>
        </div>

    </section>

    <!--Orders-->
    <section id="orders" class="orders container my-5 " >
        <div class="container mt-5">
            <h3 class="font-weight-bold text-center">Your Orders</h3>
            <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Order id</th>
                <th>Order Cost</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Order Details</th>
              
            </tr>
            

            <?php while($row = $orders-> fetch_assoc()) { ?>
                <tr>
                    <td>
                       <!--  <div class="">
                           <img src="Images/Black Cat Bracelet (2).jpg" alt=""> 
                            <div> 
                                <p class="mt-3"> <?php echo $row['order_id']; ?> </p>
                            </div> -->
                        </div>
                        <span> <?php echo $row['order_id']; ?></span>
                    </td>

                    <td>
                        <span> <?php echo $row['order_cost']; ?></span>
                    </td>

                    <td>
                        <span> <?php echo $row['order_status']; ?></span>
                    </td>

                    <td>
                        <span> <?php echo $row['order_date']; ?></span>
                    </td>

                    <td>
                        <form action="">
                            <input type="submit" class="btn order-details-btn" value="Details" >
                        </form>
                        
                    </td>
                
                </tr> 
            <?php }?>

        </table>

        
    </section>

    <footer class="mt-1 py-15">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img class="logo" src="Images/strawberry LOGO.png" alt="">
                <p class="pt-3">AFFORDABLE PRODUCTS</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h6 class="pb-2">FEATURED</h6>
                <ul class="text-uppercase">
                    <li> <a href="">Keychains</a> </li>
                    <li> <a href="#">HairClaw</a> </li>
                    <li> <a href="#">Bracelet</a></li>
                    <li> <a href="#">Hoddie</a> </li>
                    <li> <a href="#">Headbands</a> </li>
                </ul>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h6 class="pb-2">Contact Us</h6>
                <div>
                    <h6 class="text-uppercase"><Address></Address></h6>
                    <p>BLA BLA BLA</p>
                </div>
                <div>
                    <h6 class="text-uppercase">PHone</h6>
                    <p>BLA BLA BLA</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>BLA BLA BLA</p>
                </div>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h6 class="pb-2">INTAGRAM</h6>
                <div class="row">
                    <img class="img-fluid w-25 h-100 m-2" src="/Images/Sea Shells Bracelet (2).jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="/Images/Bear Design Bag Charm .jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="/Images/Cat Bracelet (3).jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="/Images/Tignahri Headband.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="/Images/Stuff Toy Keychain.jpg" alt="">
                </div>
            </div>
        </div>

        <div class="copyright mt-5">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <img src="/Images/payment.jpg" alt="">
                </div>

                <div class="col-lg-4 col-md-5 col-sm-12 mb-4  mb-2">
                    <p>Copyright ⓒ 2023 Strawberry Corner. All rights reserved.</p>
                </div>

                <div class="col-lg-3 col-md-5 col-sm-12  mb-4">
                    <a href=""><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>
        </div>  
      </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>