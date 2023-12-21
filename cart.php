<?php

session_start();

if(isset($_POST['add_to_cart']))
{
    if(isset($_SESSION['cart']))
    {
        $product_array_ids = array_column($_SESSION['cart'], "product_id");

        if(!in_array($_POST['product_id'], $product_array_ids))
        {
            $product_id = $_POST['product_id'];
    
            $product_array = array(
                'product_id' =>  $_POST['product_id'],
                'product_name' =>$_POST['product_name'],
                'product_price' =>  $_POST['product_price'],
                'product_quantity' => $_POST['product_quantity'],
                'product_image' => $_POST['product_image'], 
            );
    
            $_SESSION['cart'][$product_id] = $product_array;
        }
        else
        {
            echo '<script>alert("Product added to cart")</script>';
           
        }
    }
    
    else
    {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];
        $product_image = $_POST['product_image'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_quantity' => $product_quantity,
            'product_image' => $product_image,
        );

        $_SESSION['cart'][$product_id] = $product_array;
    }
}

else if(isset($_POST['remove_product']))
{
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);       
}

else if(isset($_POST['edit_quantity']))
{
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = $_SESSION['cart'][$product_id];

    $product_array['product_quantity'] = $product_quantity;

    $_SESSION['cart'][$product_id] = $product_array;
}
else
{
    header('location: index.php');
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
                    <a class="nav-link" href="index.html">home</a>
                </li>
                <li class="nav-item">
                    
                    <a class="nav-link" href="shop.html">Shop</a>
                </li>

                <li class="nav-item">
                    <i class="fa-regular fa-heart"></i>
                   
                  
                  
                </li>

                <li class="nav-item">
                    <a href="cart.html"> <i class="fa-solid fa-bag-shopping"></i></a>
                   
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



    <!--CArt-->
    <section class="cart container my-5 py-5" >
        <div class="container mt-5">
            <h3 class="font-weight-bold text-center">Cart</h3>

        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>SubTotal</th>
            </tr>
            
            <?php foreach($_SESSION['cart'] as $key => $value) { ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="Images/<?php  echo $value['product_image']; ?>"/>
                        <div>
                            <p><?php echo $value['product_name']; ?></p>
                            <small><span>PHP</span><?php echo $value['product_price'];?></small>
                            <br>
                            <form method="POST" action="cart.php">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                <input type="submit" name="remove_product" class="remove-btn mt-5" value="remove">
                            </form>
                           
                        </div>
                    </div>
                </td>

                <td>
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                        <input type="number" name="product_quantity"  value="<?php echo $value['product_quantity']; ?>" />
                        <input type="submit" class="edit-btn" name="edit_quantity"  value="edit" >

                    </form>
                    
                </td>

                <td>
                    <span>PHP</span>
                    <span class="product-price">150</span>
                </td>
            </tr>

            <?php  } ?>

        </table>

        <div class="cart-total">
            <table>
                <tr>
                    <td>SubTotal</td>
                    <td>PHP 150</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>PHP 150</td>
                </tr>
            </table>
        </div>

        <div class="checkout-container">
            <button class="btn checkout-btn">CHECKOUT</button>
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