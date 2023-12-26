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

    $stmt1 = $conn->prepare("SELECT COUNT(*) As  total_records FROM products");
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

    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
    $stmt2->execute();
    $products = $stmt2->get_result();



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
                <h3 class="fs-4 mb-3">Products</h3>
                
                <?php if(isset($_GET['edit_success_message'])) { ?>
                    <p style="color: green;" ><?php echo $_GET['edit_success_message']; ?></p>

                <?php }?>

                <?php if(isset($_GET['edit_failure_message'])) { ?>
                    <p style="color: red;" ><?php echo $_GET['edit_failure_message']; ?></p>

                <?php }?>

                <?php if(isset($_GET['deleted_failure'])) { ?>
                    <p style="color: red;" ><?php echo $_GET['deleted_failure']; ?></p>

                <?php }?>

                <?php if(isset($_GET['deleted_successfully'])) { ?>
                    <p style="color: red;" ><?php echo $_GET['deleted_successfully']; ?></p>

                <?php }?>
                
                
                    
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    
                                    <th scope="col">Product id</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Product Offer</th>
                                    <th scope="col">Product Category</th>
                                    <th scope="col">Product Color</th>

                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($products as $product) { ?>
                                    <tr>
                                        
                                        <td><?php echo $product['product_id']; ?></td>
                                        <td><img src="<?php echo "../images/".$product['product_image']; ?>" style="width: 70px" alt=""></td>
                                        <td><?php echo $product['product_name']; ?></td>
                                        <td><?php echo "PHP ".$product['product_price']; ?></td>
                                        <td><?php echo $product['product_special_offer']; ?></td>
                                        <td><?php echo $product['product_category']; ?></td>
                                        <td><?php echo $product['product_color']; ?></td>

                                        <td> <a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>" >Edit</a></td>
                                        <td> <a href="delete-product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a> </td>
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