<?php 

session_start();

include('connection.php');

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $order_status = "paid";
    $user_id = $_SESSION['user_id'];
    $payment_date = date('Y-m-d H:i:S'); 
    


    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si',$order_status,$order_id);

    $stmt->execute();




    $stmt1 = $conn->prepare("INSERT INTO payments (order_id,user_id,payment_date) 
        Values (?,?,?); " );

    $stmt1->bind_param('iis', $order_id,$user_id,$payment_date);

    $stmt1->execute();

    header("location: ../account.php?payment_message=paid succesfully");

}
else{
    header("location: index.php");
}
?>