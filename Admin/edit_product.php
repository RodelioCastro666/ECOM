<?php include('header.php') ?>


<?php

if(isset($_GET['product_id'])){

    $product_id =$_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
    $stmt ->bind_param('i',$product_id);
    $stmt->execute();

    $products = $stmt->get_result();
}else if(isset($_POST['edit_btn'])){

    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $offer = $_POST['offer'];
    $color =$_POST['color'];
    $category = $_POST['category'];

    $stmt = $conn->prepare("UPDATE products SET product_name=?,product_description=?, product_price=?,
            product_special_offer=?, product_color=?, product_category=? WHERE product_id=?");

    $stmt->bind_param('ssssssi',$title,$description,$price,$offer,$color,$category,$product_id);

    if( $stmt->execute()){
        header('location: products.php?deleted_successfully=Product has been Updated');
    }
    else{
        header('location: products.php?deleted_failure=Error occured, try again');
    }

   
    
    
}

else{
    header('products.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <title>Bootstap 5 Responsive Admin Dashboard</title>
</head>
</head>
<body>
    <?php include('sidemenu.php'); ?> 
    
    
    <h3>Edi Product</h3>
    <div>
        <div>
            <form action="edit_product.php" method="POST">
                <p><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                <div>
                    <?php foreach($products as $product) { ?>
                        <input type="hidden" name="product_id" id="" value="<?php echo $product['product_id']; ?>">
                    <label>Title</label>
                    <input type="text" id="product_name" name="title" value="<?php echo $product['product_name']?>" placeholder="Title" required >
                </div>
                <div>
                    <label>Description</label>
                    <input type="text" id="product_desc" name="description" value="<?php echo $product['product_description']?>" placeholder="Description" required>
                </div>
                <div>
                    <label>Price</label>
                    <input type="number" id="product_price" name="price" value="<?php echo $product['product_price']?>" placeholder="Price"required>
                </div>

                <div>
                    <label for="">Category</label>
                    <select required name="category" id="">
                        <option value="keychain">Keychains</option>
                        <option value="bracelet">Bracelet</option>
                        <option value="hoodie">Hoodie</option>
                        <option value="hairclaw">HairClaw</option>
                    </select>
                </div>
                <div>
                    <label>Color</label>
                    <input type="text" id="product_desc" value="<?php  echo $product['product_color']?>" name="color" placeholder="Color"  required>
                </div>
                <div>
                    <label>Special Offer</label>
                    <input type="text" id="product_desc" value="<?php echo $product['product_special_offer']?>" name="offer" placeholder="Sale" >
                </div>

                <div>
                    <input type="submit" name="edit_btn" value="Edit" >
                </div>

                <?php }?>

            </form>
        </div>

    </div>




  
</body>
</html>