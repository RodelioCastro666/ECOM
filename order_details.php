<?php
    include('server/connection.php');

    if(isset($_POST['order_details_btn']) && isset($_POST['order_id']))
    {
        $order_id = $_POST['order_id'];
        $order_status = $_POST['order_status'];
        $stmt = $conn->prepare("SELECT *  FROM order_items WHERE order_id = ? ");
        $stmt ->bind_param('i',$order_id);
        $stmt->execute();
        $order_details = $stmt->get_result();

        $order_total_price = calculateTotalOrderPrice($order_details);
    }
    else
    {
        header('location: account.php');
        exit;
    }

    function  calculateTotalOrderPrice($order_details){

        $total = 0;

        foreach($order_details as $_row){

            $product_price = $_row['product_price'];
            $product_quantity = $_row['product_quantity'];

            $total = $total + ($product_price * $product_quantity);
        }
    
       
    
        return $total;
    }
    
?>



<?php include('Layout/header.php') ?>

    <!--ORDER Details-->
    <section id="orders" class="orders container mt-5 pt-5 " >
        <div class="container mt-5">
            <h3 class="font-weight-bold text-center">ORDER DETAILS</h3>
            <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                
              
            </tr>
            
            <?php foreach($order_details as $row) { ?>
            
                <tr>
                    <td>
                         <div class="product-info">
                           <img src="Images/<?php echo $row['product_image']; ?> " alt=""> 
                            <div> 
                                <p class="mt-3"> <?php echo $row['product_name']; ?>  </p>
                            </div> 
                        </div>
                        
                    </td>

                    <td>
                        <span>PHP <?php echo $row['product_price']; ?> </span>
                    </td>

                    <td>
                        <span> <?php echo $row['product_quantity']; ?></span>
                    </td>


                
                
                </tr> 
            <?php } ?>

        </table>

                <?php if($order_status == "not paid") { ?>
                
                    <form style="float: right;" method="POST" action="server/payment.php" >
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" >
                    <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>" id="">
                        <input type="hidden" name="order_status" value="<?php echo $order_status; ?>" >
                        <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now" >
                    </form>

                <?php } ?>

    </section>


<?php include('Layout/footer.php') ?>