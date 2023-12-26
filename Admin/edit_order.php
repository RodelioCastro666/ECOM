<?php include('header.php'); ?>

<?php 

if(isset($_GET['order_id'])){

    $order_id =$_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=?");
    $stmt ->bind_param('i',$order_id);
    $stmt ->execute();

    $order = $stmt->get_result();
}
else if(isset($_POST['edit_order'])){

    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];

    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt ->bind_param('si', $order_status,$order_id);

    if($stmt->execute()){
        header('location: index.php?order_updated=Order has been Updated successfully');
    }else{
        header('location: products.php?order_failed=Error occured,Try again');
    }

}else{
    header('location" index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <title>Bootstap 5 Responsive Admin Dashboard</title>
</head>
<body>

    <?php include('sidemenu.php'); ?>

    <h3>Edit Order</h3>

    <div>
        <div>
            <form action="edit_order.php"  method="POST" >

                <?php foreach($order as $r) { ?>
                <p></p>
                <div>
                    <label for="">Order Id</label>
                    <p><?php echo $r['order_id']; ?></p>
                </div>
                <div>
                    <label for="">Order Price</label>
                    <p><?php echo $r['order_price']; ?></p>
                </div>

                    <input type="hiiden" name="order_id" value="<?php echo $r['order_id']; ?>" >

                <div>
                    <label for="">ORder Status</label>
                    <select required name="order_status" id="">
                        <option value="not paid" <?php if($r['order_status'] == 'not paid'){echo "selected"; } ?> >Not Paid</option>
                        <option value="paid" <?php if($r['order_status'] == 'paid'){echo "selected"; } ?> >Paid</option>
                        <option value="shipped" <?php if($r['order_status'] == 'shipped'){echo "selected"; } ?> >Shipped</option>
                        <option value="delivered" <?php if($r['order_status'] == 'delivered'){echo "selected"; } ?> >Delivered</option>
                    </select>
                </div>

                <div>
                    <label for="">Order Date</label>
                    <p><?php echo $r['order_date']; ?></p>
                </div>

                <div>
                    <input type="submit" name="edit_order" id="" value="Edit" >
                </div>

                <?php } ?>


            </form>
        </div>
    </div>
    
</body>
</html>