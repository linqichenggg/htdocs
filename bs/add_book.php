<?php
// 数据库连接
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$book_name = $_POST['name'];
$book_price = $_POST['price'];
$book_pdate = $_POST['publish_date'];
$book_type = $_POST['name'];

$sql = "INSERT INTO tb_mrbook (book_name, book_price, book_pdate, book_type) VALUES (?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $book_name, $book_price, $book_pdate, $book_type); 

if($stmt->execute()){
    echo"书籍信息添加成功";
} else {
    echo"错误" . $stmt->error;
}

$stmt->close();
$conn->close();
?>
