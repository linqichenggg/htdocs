<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 数据库连接代码
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books";
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取表单数据
$name = $_POST['name'];
$price = $_POST['price'];
$publish_date = $_POST['publish_date'];
$type = $_POST['type'];

// SQL 插入语句
$sql = "INSERT INTO tb_mrbook (book_name, book_price, book_pdate, book_type) 
VALUES ('$name', '$price', '$publish_date', '$type')";

// 执行 SQL 语句
if ($conn->query($sql) === TRUE) {
    echo "新记录插入成功";
} else {
    echo "错误: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
