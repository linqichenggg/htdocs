<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// 获取表单数据
$id = $_POST['id'];
$book_name = $_POST['book_name'];
$book_price = $_POST['book_price'];
$book_pdate = $_POST['book_pdate'];
$book_type = $_POST['book_type'];

// SQL 更新语句
$sql = "UPDATE tb_mrbook SET book_name=?, book_price=?, book_pdate=?, book_type=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $book_name, $book_price, $book_pdate, $book_type, $id);

// 执行语句
if ($stmt->execute()) {
    echo "书籍信息更新成功";
} else {
    echo "更新错误: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>