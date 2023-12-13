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

$search = $_GET['search'] ?? ''; // PHP 7.0 及以上版本的空合并运算符

if (!empty($search)) {
    // SQL 查询语句，使用 LIKE 进行模糊匹配
    $sql = "SELECT * FROM tb_mrbook WHERE book_name LIKE ?";
    $stmt = $conn->prepare($sql);
    $search = "%" . $search . "%"; // 为模糊搜索准备参数
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // 输出结果
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. "<br>书名: " . $row["book_name"]. "<br>价格: " . $row["book_price"]. "<br>出版日期:" . $row["book_pdate"] . "<br>类别:" . $row["book_type"] . "<br>";
        }
    } else {
        echo "没有找到相关书籍";
    }
} else {
    echo "请输入搜索关键字";
}

$conn->close();
?>
