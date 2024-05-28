<?php include("dataconnection.php");?>

<!DOCTYPE HTML>
<html>
<head>
<title>Add Product</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/product.css">
</head>
<body>
    <div id="container">
        <h1>F1 Product</h1>
        <div class="product-list">
            <h2>Add Product</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Product Code:</td>
                        <td><input type="text" name="product_code" required></td>
                    </tr>
                    <tr>
                        <td>Product Image:</td>
                        <td><input type="file" name="product_img" required></td>
                    </tr>
                    <tr>
                        <td>Product Name:</td>
                        <td><input type="text" name="product_name" required></td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td><input type="text" name="category" required></td>
                    </tr>
                    <tr>
                        <td>Product Size:</td>
                        <td><input type="text" name="product_size" required></td>
                    </tr>
                    <tr>
                        <td>Product Description:</td>
                        <td><textarea name="description" required></textarea></td>
                    </tr>
                    <tr>
                        <td>Product Price:</td>
                        <td><input type="text" name="product_price" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" value="Add Product/Ticket"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $product_code = $_POST['product_code'];
        $product_img = $_FILES['product_img']['name'];
        $product_name = $_POST['product_name'];
        $category = $_POST['category'];
        $product_size = $_POST['product_size'];
        $description = $_POST['description'];
        $product_price = $_POST['product_price'];

        // Upload product image
        $target_dir = "images/product/"; //images file path(directory)
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $product_img = basename($_FILES["product_img"]["name"]);
        $temp_file = $_FILES["product_img"]["tmp_name"];
        $target_file = $target_dir . $product_img; //Directory and image name
        
        if (move_uploaded_file($temp_file, $target_file)) {
            // Check for duplicate product code
            $query = "SELECT * FROM product WHERE product_code='$product_code'";
            $result = mysqli_query($connect, $query);
            
            if (mysqli_num_rows($result) == 0) {
                // Insert into product table
                $query = "INSERT INTO product (product_code, product_img, product_name, category, product_size, description, product_price) VALUES ('$product_code', '$product_img', '$product_name', '$category', '$product_size', '$description', '$product_price')";
                if (mysqli_query($connect, $query)) {
                    header("Location: admin_manage_product.php");
                    exit;
                } else {
                    echo "Error: " . mysqli_error($connect);
                }
            } else {
                echo "Error: Duplicate product code.";
            }
        } else {
            echo "Error: There was an error uploading the file.";
        }
    }
   ?>
</body>
</html>
