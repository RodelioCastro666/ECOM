<?php

    include('server/connection.php');

    if(isset($_GET['product_id'])){

        $product_id = $_GET['product_id'];

        $stmt  = $conn ->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i",$product_id);

        $stmt->execute();

        $product = $stmt->get_result();

    }
    else{

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

    <!--Single products-->
    <section class="container single-product my-5 pt-5">
        <div class="row mt-5">

            <?php while($row= $product->fetch_assoc()) { ?>

            

            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-60 pb-1 " src="Images/<?php echo $row['product_image']; ?>" id="mainImg">
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="Images/<?php echo $row['product_image']; ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="Images/<?php echo $row['product_image2']; ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="Images/<?php echo $row['product_image3']; ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="Images/<?php echo $row['product_image4']; ?>" width="100%" class="small-img" alt="">
                    </div>
                </div>
                
            </div>

            

            <div class="col-lg-6 col-md-12 col-12">
                <h6>KeyChain</h6>
                <h4 class="py-4"><?php echo $row['product_name']; ?></h4>
                <h3><?php echo $row['product_price']; ?></h3>

                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">

                        <input type="number" name="product_quantity" value="1">
                        <button class="buy-btn" type="submit" name="add_to_cart" >Add to cart</button>


                </form>

                <h5 class="mt-5 mb-5">Product Details</h5>
                <span><?php echo $row['product_description']; ?>
                </span>
            </div>
            
            <?php } ?>
            
        </div>
    </section>

    <!--Related-->
    <section id="related-products" class="my-5 pb-5">
        <div class="container text-center  mt-5 py-5" >
            <h5>Related Products</h5>
            <hr class="mx-auto">
            
        </div>
        <div class="row mx-auto container">
            <div class="product text-center col-lg-4 col-md-6 col-sm-12">
                <img class="img-fluid mb-3 "  src="/Images/Cat Bracelet (2).jpg" ">
                <div class="star" >
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name" >Dinasur hoodie</h5>
                <h4 class="p-price"> PHP 150</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-6 col-sm-12">
                <img class="img-fluid mb-3 "  src="/Images/Cat Bracelet (3).jpg" alt="">
                <div class="star" >
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name" >Dinasur hoodie</h5>
                <h4 class="p-price"> PHP 150</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-4 col-md-6 col-sm-12">
                <img class="img-fluid mb-3 "  src="/Images/Cat Bracelet (4).jpg" alt="">
                <div class="star" >
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name" >Dinasur hoodie</h5>
                <h4 class="p-price"> PHP 150</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    </section>

    <footer class="mt-5">
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

    <script>
        var mainImg = document.getElementById("mainImg");
        var smallImg = document.getElementsByClassName("small-img");

        for(let i = 0; i<4; i++){
            smallImg[i].onclick = function(){
                mainImg.src = smallImg[i].src;
            }
        }
    </script>
</body>
</html>