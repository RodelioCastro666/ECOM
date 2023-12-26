<?php include('header.php'); ?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <title>Bootstap 5 Responsive Admin Dashboard</title>
</head>
<body>
    <?php include('sidemenu.php'); ?>

    <h3>Add Product</h3>
    <div>
        <div>
            <form enctype="multipart/form-data" method="POST" action="create_product.php" >
                <p></p>
                <div>
                    <label for="">Title</label>
                    <input type="text" name="name" placeholder="Title" id="product_name" >
                </div>
                <div>
                    <label for="">Description</label>
                    <input type="text" name="description" id="product_desc" placeholder="Description" >
                </div>
                <div>
                    <label for="">Price</label>
                    <input type="number" name="price" id="product_price" placeholder="Price" >
                </div>
                <div>
                    <label for="">Special Offer/Sale</label>
                    <input type="number" name="offer" id="product_offer" placeholder="Sale" >
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
                    <label for="">Color</label>
                    <input type="text" name="color" placeholder="Color" >
                </div>
                <div>
                    <label for="">Image1</label>
                    <input type="file" class="" id="image1" name="image1" placeholder="image1" required >
                </div>
                <div>
                    <label for="">Image2</label>
                    <input type="file" class="" id="image2" name="image2" placeholder="image2" required >
                </div>
                <div>
                    <label for="">Image3</label>
                    <input type="file" class="" id="image3" name="image3" placeholder="image3" required >
                </div>
                <div>
                    <label for="">Image4</label>
                    <input type="file" class="" id="image4" name="image4" placeholder="image4" required >
                </div>

                <div>
                    <input type="submit" name="create_product" value="Create" >
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>