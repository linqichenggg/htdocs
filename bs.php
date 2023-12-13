<!DOCTYPE html>
<html>

<head>
  <title>书籍列表</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid black;
    }
    th, td {
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    #editBookForm {
      margin: 0 auto;
    }
</style>
</head>

<body>

<form>
  <input type="text" name="search" placeholder="书籍搜索">
  <input type="submit" value="查询">
</form>

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

// 读取数据
$sql = "SELECT * FROM tb_mrbook";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出数据
    echo "<table><tr><th>ID</th><th>书名</th><th>价格</th><th>出版日期</th><th>类别</th><th>操作</th></tr>";
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["id"]. "</td><td>" . $row["book_name"]. "</td><td>" . $row["book_price"]. "</td><td>" . $row["book_pdate"]. "</td><td>" . $row["book_type"]. "</td>";
      echo "<td>
      <button onclick='editBook(" . $row["id"] . ")'>修改</button>
      <button onclick='Delete(" . $row["id"] . ")'>删除</button>
      </td></tr>";
    }
    echo "</table>";
} else {
    echo "0 结果";
}
$conn->close();
?>

<script>
function editBook(id) {
}

function Delete(id) {
}
</script>

<!-- 编辑书籍 -->
<form id="editBookForm" action="edit_book.php" method="post">
    <input type="hidden" name="id" id="editBookId">
    书名: <input type="text" name="name" id="editBookName">
    价格: <input type="text" name="price" id="editBookPrice">
    出版时间: <input type="date" name="publish_date" id="editPublish">
    类别: <input type="text" name="type" id="editType">
    <input type="submit" value="提交">
</form>


</body>
</html>