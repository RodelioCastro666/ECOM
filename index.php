

<?php include('Layout/header.php'); ?>

      <section id="home">
        <div class="container" >
            <h7>NEW ARRIVALS</h5>
            <h3><span>Best Prices</span>This Season</h1>
            <p>BLA BLA BLA BLA BLA</p>
            <button>Add to cart</button>
        </div>

      </section>

      <section id="brand" class="container">
         <div class="row" >
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="/Images/Cat Bracelet (2).jpg" alt="">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="/Images/Cat Bracelet (3).jpg" alt="">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="/Images/Cat Bracelet (4).jpg" alt="">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="/Images/Cat Bracelet (5).jpg" alt="">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="/Images/Cat Bracelet (6).jpg" alt="">
         </div>
      </section>

      <section id="new" class="w-100" >
        <div class="row p-0 m-0">

            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="/Images/Brown Bear Keychain.jpg" alt="">
                <div class="details">
                    <h4>Bla bla KeyChain</h4>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </div>

            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="/Images/Black Cat Bracelet (2).jpg" alt="">
                <div class="details">
                    <h4>Bla bla Bracelet</h4>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </div>

            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="/Images/Dinasour Pet Hoodie Green.jpg" alt="">
                <div class="details">
                    <h4>Bla bla Hoodie</h4>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </div>

        </div>

      </section>

      <!--KeyChain-->
      <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5" >
            <h5>Our Featuredd</h5>
            <hr>
            <p>Here you can check out our featured products</p>
        </div>
        <div class="row mx-auto container-fluid">

            <?php include('server/get_featured_products.php')?>
            <?php while($row = $featured_products->fetch_assoc()) { ?>

            <div onclick="window.location.href='single_product.html';" class="product text-center col-lg-4 col-md-6 col-sm-12">
                <img class="img-fluid mb-3"  src="/Images/<?php echo $row['product_image']; ?>" alt="">
                <div class="star" >
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name" ><?php echo $row['product_name']; ?></h5>
                <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
                <a href="<?php echo "single_product.php?product_id=". $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a> 
            </div>

           <?php } ?>
            
        </div>
      </section>

      <section  id="banner" class="my-5 py-5">
        <div class="container">
            <h6>Christmas Sale</h6>
            <h3>Collection <br>Up to 30%off</h3>
            <button class="text-uppercase">Shop</button>
        </div>

      </section>

      <!--Hoddie-->
      <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5" >
            <h5>Our Hoodie</h5>
            <hr class="mx-auto">
            <p>Here you can check out our hoodie for pets</p>
        </div>
        <div class="row mx-auto container-fluid">

            <?php include('server/get_hoodie.php')?>
            <?php while($row = $hoodie_products->fetch_assoc()) { ?>
            <div class="product text-center col-lg-4 col-md-6 col-sm-12">
                <img class="img-fluid mb-3 "  src="/Images/<?php echo $row['product_image'] ?>" alt="">
                <div class="star" >
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name" ><?php echo $row['product_name']; ?></h5>
                <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
                   <a href="<?php echo "single_product.php?product_id=". $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a> 
            </div>

            <?php } ?>

        </div>
      </section>

      <!--HairClaw-->
      <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5" >
            <h5>Hair Claw</h5>
            <hr class="mx-auto">
            <p>Here you can check out our hoodie for pets</p>
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-4 col-md-6 col-sm-12">
                <img class="img-fluid mb-3 "  src="/Images/Hair Claw (10).jpg" alt="">
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
                <img class="img-fluid mb-3 "  src="/Images/Hair Claw (11).jpg" alt="">
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
                <img class="img-fluid mb-3 "  src="/Images/Hair Claw (12).jpg" alt="">
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

      <!--Bracelet-->
      <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5" >
            <h5>Bracelet</h5>
            <hr class="mx-auto">
            <p>Here you can check out our hoodie for pets</p>
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-4 col-md-6 col-sm-12">
                <img class="img-fluid mb-3 "  src="/Images/Cat Bracelet (2).jpg" alt="">
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


<?php include('Layout/footer.php') ?>
      