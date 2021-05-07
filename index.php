<?php
$customerList = [
    "1" => [
        "ten" => "Mai Hoang Anh",
        "ngaysinh" => "1983-08-20",
        "diachi" => "Hà Nội",
        "anh" => "img/download.jpeg"
    ],
    "2" => [
        "ten" => "Nguyễn Hoang Yen",
        "ngaysinh" => "1983-08-20",
        "diachi" => "Bắc Giang",
        "anh" => "img/download (1).jpeg"
    ],
    "3" => [
        "ten" => "Nguyễn Thái Linh",
        "ngaysinh" => "1983-08-21",
        "diachi" => "Nam Định",
        "anh" => "img/images.jpeg"
    ],
    "4" => [
        "ten" => "Trần Huyen Trang",
        "ngaysinh" => "1983-08-22",
        "diachi" => "Hà Tây",
        "anh" => "img/images (1).jpeg"
    ],
    "5" => [
        "ten" => "Nguyễn Thi Linh",
        "ngaysinh" => "1983-08-17",
        "diachi" => "Hà Nội",
        "anh" => "img/images (2).jpeg"
    ]
];
function searchByDate($customers, $fromDate, $toDate) {
  if (empty($fromDate) || empty($toDate)) {
      return $customers;
  }

  $filteredCustomers = [];
  foreach ($customers as $customer) {
      if (strtotime($customer['ngaysinh']) < strtotime($fromDate))
          continue;
      if (strtotime($customer['ngaysinh']) > strtotime($toDate))
          continue;
      $filteredCustomers[] = $customer;
  }
  return $filteredCustomers;
}
?>
<?php
$fromDate = null;
$toDate = null;
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $fromDate = $_REQUEST["from"];
    $toDate = $_REQUEST["to"];
}
$filteredCustomers = searchByDate($customerList, $fromDate, $toDate);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
<form method="GET" style="text-align: center">
    Chọn ngày sinh từ: <input id="from" type="date" name="from" placeholder="yyyy/mm/dd"
                              value=""/>
    đến: <input id="to" type="date" name="to" placeholder="yyyy/mm/dd"
                value=""/>
    <input style="width: auto" type="submit" id="submit" value="Tim kiem"/>
</form>
<table>
    <caption><h1>Danh sách khách hàng</h1></caption>
    <thead>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($customerList as $key => $value): ?>
        <tr>
            <td><?php echo $key ?></td>
            <td><?php echo $value['ten'] ?></td>
            <td><?php echo $value['ngaysinh'] ?></td>
            <td><?php echo $value['diachi'] ?></td>
            <td><img src="<?php echo $value['anh'] ?>" alt="" width="100"</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<table border="0">
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
    <?php foreach ($filteredCustomers as $index => $customer): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $customer['ten']; ?></td>
            <td><?php echo $customer['ngaysinh']; ?></td>
            <td><?php echo $customer['diachi']; ?></td>
            <td>
                <div class="profile"><img src="<?php echo $customer['anh']; ?>" width="100"/></div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
