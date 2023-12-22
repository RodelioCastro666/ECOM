<?php

session_start();

if(!empty($_SESSION['cart']) && isset($_POST['checkout'])){

}



else{

    header('location : index.php');
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


    <!--Checkout-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h3 class="form-weight-bold">Checkout</h3>
            <hr class="mx-auto">
        </div> 
        <div class="mx-auto container">
            <form id="checkout-form" method="POST" action="server/place_order.php">
                <div class="form-group checkout-small-element">
                    <label>Name</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Email</label>
                    <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Phone</label>
                    <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>City</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
                </div>
                <div class="form-group checkout-large-element">
                    <label>Address</label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required>
                </div>
                <div class="form-group checkout-btn-container">
                    <p>Total Amount: PHP <?php echo $_SESSION['total']; ?></p>
                    <input type="submit" class="btn" name="place_order" id="checkout-btn" value="PlaceOrder">
                </div>
                
            </form>

        </div>

    </section>

    <footer class="mt-5 py-5">
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