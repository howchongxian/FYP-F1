<?php
include("dataconnection.php"); 
session_start();
$userid = $_SESSION['userid'];

// 检查是否有产品尺寸数据提交
if (isset($_POST['product_size'])) {
    $product_sizes = $_POST['product_size'];

    // 连接数据库
    $conn = new mysqli($sname, $uname, $password, $db_name);

    // 检查连接是否成功
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 遍历用户输入的尺寸值
    foreach ($product_sizes as $product_code => $size) {
        // 净化用户输入
        $size = $conn->real_escape_string($size);
        $product_code = $conn->real_escape_string($product_code);

        // 构建 SQL 语句
        $sql = "UPDATE shopping_cart SET product_size = '$size' WHERE product_code = '$product_code' AND id = '$userid'";

        // 执行 SQL 语句
        if ($conn->query($sql) === TRUE) {
            // 更新成功
            echo "Product size updated successfully for product code: $product_code<br>";
        } else {
            // 更新失败
            echo "Error updating record: " . $conn->error . "<br>";
        }
    }

    // 关闭数据库连接
    $conn->close();

    // 重定向到 order.php 页面
    header("Location: order.php");
    exit();
} else {
    echo "No product size data submitted.";
}
?>