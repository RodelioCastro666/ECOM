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



<?php include('Layout/header.php') ?>

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

<?php include('Layout/footer.php') ?>
