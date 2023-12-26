<?php

include('server/connection.php');

if(isset($_POST['search'])){

        if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        $page_no = $_GET['page_no'];
        }
        else{
        $page_no = 1;
        }

        $category = $_POST['category'];

        $price = $_POST['price'];   

        $stmt1 = $conn->prepare("SELECT COUNT(*) As  total_records FROM products WHERE product_category=? AND product_price<=?");
        $stmt1 ->bind_param('si',$category,$price);
        $stmt1 ->execute();
        $stmt1->bind_result($total_records);
        $stmt1->store_result();
        $stmt1->fetch();

        $total_records_per_page = 1;
        $offset = ($page_no-1) * $total_records_per_page;

        $previous_page =$page_no - 1;
        $next_page = $page_no + 1;

        $adjacents = "2";

        $total_no_of_pages = ceil($total_records/$total_records_per_page);





        $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset,$total_records_per_page");
        $stmt2->bind_param("si", $category,$price);
        $stmt2->execute();
        $products = $stmt2->get_result();


}
else{

  if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
     $page_no = $_GET['page_no'];
   }
   else{
    $page_no = 1;
   }

   $stmt1 = $conn->prepare("SELECT COUNT(*) As  total_records FROM products");
   $stmt1 ->execute();
   $stmt1->bind_result($total_records);
   $stmt1->store_result();
   $stmt1->fetch();


   $total_records_per_page = 1;
   $offset = ($page_no-1) * $total_records_per_page;

   $previous_page =$page_no - 1;
   $next_page = $page_no + 1;

   $adjacents = "2";

   $total_no_of_pages = ceil($total_records/$total_records_per_page);

   $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
   $stmt2->execute();
   $products = $stmt2->get_result();
 }



?>


<?php include('Layout/header.php')?>

  <!--  <style>
        .product img{
            width: 70%;
            height: auto;
            box-sizing: border-box;
            object-fit: cover;
        }

        .pagination a{
            color: coral;
        }
        .pagination li:hover a{
            color: grey;
            background-color: #FFCDC1;
        }
    </style> -->



    <div class="layer" >
        <section id="search" class="my-5 py-5 ms-2 " >
            <div class="container-fluid mt5 py-5">
                <p>Search Products</p>
                <hr>
            </div>
            <form action="shop.php" method="POST" >
                <div class="row mx-auto container-fluid">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <p>Category</p>
                            <div class="form-check" >
                                <input type="radio" value="keychain" class="form-check-input" name="category" id="category_one" <?php if(isset($category)&& $category=='keychain'){echo 'checked'; } ?> >
                                <label class="form-check-label" for="flexRadioDefault1">Keychain</label>
                            </div>

                            <div class="form-check" >
                                <input type="radio" value="hoodie" class="form-check-input" name="category" id="category_two"  <?php if(isset($category)&& $category=='hoodie'){echo 'checked'; } ?>>
                                <label class="form-check-label" for="flexRadioDefault2">Hoodie</label>
                            </div>

                            <div class="form-check" >
                                <input type="radio" value="hairclaw" class="form-check-input" name="category" id="category_two"  <?php if(isset($category)&& $category=='hairclaw'){echo 'checked'; } ?>>
                                <label class="form-check-label" for="flexRadioDefault2">HairClaw</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" value="bracelet" class="form-check-input" name="category" id="category_two"  <?php if(isset($category)&& $category=='bracelet'){echo 'checked'; } ?>>
                                <label class="form-check-label" for="flexRadioDefault2">Bracelet</label>
                            </div>

                    </div>

                </div>

                <div class="row mx-1 container-fluid mt-5 fixed-right" >
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p>PRICE</p>
                        <input type="range" class="form-range w-auto" name="price" value="<?php if(isset($price)){echo $price; } else { echo "100";} ?>" min="1" max="500" id="customRange2">
                        <div class="">
                            <span style="float: left;">1</span>
                            <span style="float: right;">500</span>
                        </div>

                    </div>

                </div>
                <div class="form-group my-3 mx-3">
                    <input type="submit" name="search" value="Search" class="btn btn-primary">

                </div>
            </form>
        </section>


    

        <section id="shop" class=" py-5">
            <div class="container mt-5 py-5" >
                <h5>Our Hoodie</h5>
                <hr>
                <p>Here you can check out our hoodie for pets</p>
            </div>
            <div class="row mx-auto container">

            <?php while($row = $products->fetch_assoc()) { ?>

                <div onclick="window.location.href='single_product.php'; " class="product text-center col-lg-4 col-md-6 col-sm-12">
                    <img class="img-fluid mb-3 "  src="/Images/<?php echo $row['product_image']; ?> " alt="">
                    <div class="star" >
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h5 class="p-name" ><?php echo $row['product_name']; ?> </h5>
                    <h4 class="p-price">PHP<?php echo $row['product_price']; ?> </h4>
                    <a class="shop-btn" href=" <?php echo  "single_product.php?product_id=".$row['product_id']; ?>">Add to Cart</a>
                </div>

                <?php }?>
            
            </div>
        </section>
    </div>

    

  

    <nav aria-label="Page navigation example">
        <ul class="pagination mt-5">
            <li class="page-item <?php if($page_no<=1){echo 'disabled';}  ?> ">
                <a class="page-link" href="<?php if($page_no <= 1){echo '#'; } else{echo "?page_no=".($page_no-1); } ?>">Previous</a>
            
            </li>
            <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
            <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

            <?php if($page_no >=3) { ?>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item">
                    <a class="page-link" href="<?php echo "?page_no=".$page_no; ?>"> <?php echo $page_no; ?></a>
                </li>
            <?php } ?>


            <li class="page-item <?php if($page_no >= $total_no_of_pages){echo 'disabled'; } ?> ">
                <a class="page-link" href="<?php if($page_no >= $total_no_of_pages) { echo'#'; } else{ "?page_no=".($page_no+1); } ?>">Next</a>
            </li>
        </ul>
    </nav>
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
</body>
</html>