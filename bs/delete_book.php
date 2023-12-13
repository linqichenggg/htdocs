<?php
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

// 获取书籍 ID
$id = $_GET['id'];

// SQL 删除语句
$sql = "DELETE FROM tb_mrbook WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

// 执行语句
if ($stmt->execute()) {
    echo "删除完成";
} else {
    echo "删除错误: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
