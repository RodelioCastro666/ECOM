<?php
include('header.php');

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit;
}

?>

<?php 


    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        $page_no = $_GET['page_no'];
    }
    else{
    $page_no = 1;
    }

    $stmt1 = $conn->prepare("SELECT COUNT(*) As  total_records FROM orders");
    $stmt1 ->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();


    $total_records_per_page = 10;
    $offset = ($page_no-1) * $total_records_per_page;

    $previous_page =$page_no - 1;
    $next_page = $page_no + 1;

    $adjacents = "2";

    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    $stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");
    $stmt2->execute();
    $orders = $stmt2->get_result();



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
   

        <!-- /#sidebar-wrapper -->
        <?php include('sidemenu.php'); ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>John Doe
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">720</h3>
                                <p class="fs-5">Products</p>
                            </div>
                            <i class="fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">4920</h3>
                                <p class="fs-5">Sales</p>
                            </div>
                            <i
                                class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">3899</h3>
                                <p class="fs-5">Delivery</p>
                            </div>
                            <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">%25</h3>
                                <p class="fs-5">Increase</p>
                            </div>
                            <i class="fas fa-chart-line fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Recent Orders</h3>
                        <?php if(isset($_GET['order_updated'])) { ?>
                         <p style="color: green;" ><?php echo $_GET['order_updated']; ?></p>

                        <?php }?>

                        <?php if(isset($_GET['order_failed'])) { ?>
                         <p style="color: red;" ><?php echo $_GET['order_failed']; ?></p>

                        <?php }?>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    
                                    <th scope="col">Order id</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">User Id</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">User Phone</th>
                                    <th scope="col">User Address</th>

                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($orders as $order) { ?>
                                    <tr>
                                        
                                        <td><?php echo $order['order_id']; ?></td>
                                        <td><?php echo $order['order_status']; ?></td>
                                        <td><?php echo $order['user_id']; ?></td>
                                        <td><?php echo $order['order_date']; ?></td>
                                        <td><?php echo $order['user_phone']; ?></td>
                                        <td><?php echo $order['user_address']; ?></td>

                                        <td> <a href="edit_order.php?order_id=<?php echo $order['order_id']; ?>">Edit</a> </td>
                                        <td>Delete</td>
                                    </tr>
                                <?php }?>
                               
                            </tbody>
                        </table>
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
                </div>
                
            </div>
        </div>
        
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>