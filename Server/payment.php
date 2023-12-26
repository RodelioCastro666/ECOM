<?php

session_start();

if(isset($_POST['order_pay_btn'])){
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
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
                    <a class="nav-link" href="../index.php">home</a>
                </li>
                <li class="nav-item">
                    
                    <a class="nav-link" href="../shop.php">Shop</a>
                </li>

                <li class="nav-item">
                    <i class="fa-regular fa-heart"></i>
                   
                  
                  
                </li>

                <li class="nav-item">
                    <a href="../cart.php"> <i class="fa-solid fa-bag-shopping"></i></a>
                   
                </li>

                <li class="nav-item">
                    <a href="../contact.php"> <i class="fa-solid fa-address-book"></i></a>
                   
                </li>

                <li class="nav-item">
                    <a href="../account.php"><i class="fa-regular fa-user"></i></a>
                    
                </li>

                

            </ul>
          </div>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

        </div>
    </nav>




    <!--Payment-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h3 class="form-weight-bold">Payment</h3>
            <hr class="mx-auto">
        </div> 
        <div class="mx-auto container text-center">
           

        <?php if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>
                <?php $amount = strval( $_POST['order_total_price']); ?>
                <?php $order_id =$_POST['order_id']; ?>
                <p>Total payment: $<?php echo $_POST['order_total_price'];  ?></p>  
              <!-- <input class="btn btn-primary" type="submit" value="Pay Now" > --> 
              <div id="paypal-button-container" ></div>
              <div class="btn btn-primary" onclick="myFunction();" ></div>

            <?php }else if(isset($_SESSION['total']) && $_SESSION['total'] != 0 ) {?>
                <?php $amount = strval($_SESSION['total']); ?>
                <?php $order_id = $_SESSION['order_id'];  ?>
                <p>Total payment: $ <?php echo $_SESSION['total'];  ?></p>
              <!--   <input type="submit" class="btn btn-primary" type="submit" value="Pay Now" > -->
              <div id="paypal-button-container" ></div>
              <div class="btn btn-primary" onclick="myFunction();"  ></div>
              


            

            <?php } else {?>
                <p>You dont have an order</p>
            <?php }?>

           



        </div>

    </section>


      <!-- Replace "test" with your own sandbox Business account app client ID -->
      <script src="https://www.paypal.com/sdk/js?client-id=ARfuX-nO4UfwrzuicpKd-vvzHYpPTSSwjiIkSKjMqPs25JAznXL9g58J787s6BTXyFrnETq-9PDzNxVr&currency=USD"></script>
        <!-- Set up a container element for the button -->
        
        <script>
            function myFunction(){
                alert("lklk");
                return window.location.href = "complete_payment.php?order_id="+<?php echo $order_id;?>
            }

        paypal.Buttons({
            createOrder:function(data,action){
                return action.order.create({
                    purchase_units:[{
                        amount:{
                            value: '<?php echo $amount;?>'
                        }
                    }]
                });
            },
           
            
            // Order is created on the server and the order id is returned
          //  createOrder: (data, actions) => {
          //  return fetch("/api/orders", {
              //  method: "post",
                // use the "body" param to optionally pass additional order information
                // like product skus and quantities
          //  })
          // .then((response) => response.json())
          //  .then((order) => order.id);
           // },
            // Finalize the transaction on the server after payer approval
            onApprove: function (data, actions)  {
            return actions.order.capture().then(function(orderData){
                console.log('Capture result', orderData, JSON.stringify(orderData,null,2));
                var transaction = orderData.purchase_units[0].payments.capture[0];
                alert('Transaction '+ transaction.status + ':' + transaction.id + '\n\nSee console');
                
                window.location.href = "server/complete_payment.php?transaction_id="+transaction_id+"&order_id="+<?php echo $order_id; ?>;
            });
            }
        }).render('#paypal-button-container');
        </script>

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