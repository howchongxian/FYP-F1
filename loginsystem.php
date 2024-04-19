
<?php
session_start();
include "dataconnection.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['username']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: login.php?error=Username is required");
        exit();
    } else if (empty($pass)) {
        header("Location: login.php?error=Password is required");
        exit();
    }

    $sql = "SELECT * FROM user WHERE username = '$uname' AND password='$pass'";

    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

    if ($row) {
        // 登录成功
        $_SESSION["userid"] = $row["id"]; // 保存用户ID到会话中
    
        if ($row["role"] == "admin") {
            // 管理员登录
            $_SESSION["role"] = "admin";
            header("Location: userlist.php"); // 重定向到管理员页面
            echo "Welcome, Admin!";
            exit();
        } 
        else {
            // 普通用户登录
            $_SESSION["role"] = "user";
            header("Location:index.php"); // 重定向到用户页面
            exit();
        }
    } else {
        // 登录失败
        $error = "Invalid username or password";
    }
}

else {
    header("Location: login.php?error=Incorrect Username or Password");
    exit();
}
}
?>