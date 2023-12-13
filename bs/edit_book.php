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

// SQL 查询语句
$sql = "SELECT * FROM tb_mrbook WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


if ($row) {
    // 显示编辑表单
    echo "<form action='update_book.php' method='post'>";
    echo "<input type='hidden' name='id' value='{$row["id"]}'>";
    echo "书名: <input type='text' name='book_name' value='{$row["book_name"]}'>";
    echo "价格: <input type='text' name='book_price' value='{$row["book_price"]}'>";
    echo "出版日期: <input type='date' name='book_pdate' value='{$row["book_pdate"]}'>";
    echo "类别: <input type='text' name='book_type' value='{$row["book_type"]}'>";
    echo "<input type='submit' value='修改'>";
    echo "</form>";
} else {
    echo "未找到书籍";
}

$conn->close();
?>