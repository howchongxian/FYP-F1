<?php
include("dataconnection.php");

if (isset($_GET['edit']) && isset($_GET['procode'])) {
    $product_code = $_GET['procode'];
    $stmt = $connect->prepare("SELECT * FROM product WHERE product_code=?");
    $stmt->bind_param("s", $product_code);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: admin_manage_product.php");
        exit;
    }
}

if (isset($_POST['update'])) {
    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $product_size = $_POST['product_size'];
    $description = $_POST['description'];
    $product_price = $_POST['product_price'];

    $stmt = $connect->prepare("UPDATE product SET product_name=?, category=?, product_size=?, description=?, product_price=? WHERE product_code=?");
    $stmt->bind_param("ssssss", $product_name, $category, $product_size, $description, $product_price, $product_code);
    $stmt->execute();

    header("Location: admin_manage_product.php");
    exit;
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Product</title>
    <meta charset="utf-8">
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/product.css">
    <!-- Add the following CSS rules here or in the style.css file -->
    <style>
        input[type="text"],
        textarea {
            border: 1px solid #ccc;
            padding: 5px;
            width: calc(100% - 12px); /* Adjust width to match other inputs */
            box-sizing: border-box;
            margin-top: 5px; /* Add margin to match other inputs */
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-top: 10px; /* Add margin to match other inputs */
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>F1 Product</h1>
        <div class="product-list">
            <h2>Edit Product</h2>
            <form action="admin_edit_product.php?edit&procode=<?php echo $product_code; ?>" method="post">
                <table>
                    <tr>
                        <td>Product Code:</td>
                        <td><input type="text" name="product_code" value="<?php echo $row['product_code'];?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Product Name:</td>
                        <td><input type="text" name="product_name" value="<?php echo $row['product_name'];?>"></td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td><input type="text" name="category" value="<?php echo $row['category'];?>"></td>
                    </tr>
                    <tr>
                        <td>Product Size:</td>
                        <td><input type="text" name="product_size" value="<?php echo $row['product_size'];?>"></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><textarea name="description"><?php echo $row['description'];?></textarea></td>
                    </tr>
                    <tr>
                        <td>Product Price:</td>
                        <td><input type="text" name="product_price" value="<?php echo $row['product_price'];?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="update" value="Update Product"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
