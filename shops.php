<?php

$conn = mysqli_connect("localhost", "shop_user", "shop_password", "db_shop");

if (isset($_GET["delete"])) {
    $id = (int)$_GET["delete"];

    mysqli_query($conn, "delete from shops where id = $id limit 1");
}

if (isset($_GET['update'])) {
    $id = (int)$_GET['update'];

    $result = mysqli_query($conn, "select * from shops where id = $id limit 1");
    $oneShop = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $oneShop = reset($oneShop);
    // $oneShop = reset($oneShop);
}


if (!empty($_POST)) {
        
        $id = $_POST["id"];
        $title = htmlspecialchars($_POST["title"]);
        $address = $_POST["address"];
    
        if ($id > 0) {
            $query = "UPDATE shops set title='$title', address='$address' where id = $id limit 1";
        } else {
            $query = "INSERT INTO shops VALUES (null, '$title','$address')";
        }
    
        $result = mysqli_query($conn, $query);

}

    $result = mysqli_query($conn, "select * from shops order by id desc");

    $allShops = mysqli_fetch_all($result, MYSQLI_ASSOC); 

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shops</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <style>
            form {
                width: 500px;
                margin: 20px auto;
            }
            h1 {
                text-align: center;
            }
        </style>
    </head>
    <body>
    <div id="shops">
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Title</th>
                    <th>address</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($allShops as $shop) : ?>
                    <tr>
                        <td><?=$shop['id']?></td>
                        <td><?=$shop['title']?></td>
                        <td><?=$shop['address']?></td>
                        <td style="width: 200px;">
                            <a href="?delete=<?=$shop['id']?>" class="btn btn-danger">Delete</a>
                            <a href="?delete=<?=$shop['id']?>" class="btn btn-warning">Update</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <h1>Shops</h1>
        <div>
            <form action="shops.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?=$oneShops['id']??''?>" name="id" >
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" value="<?= $oneShop['title'] ?? '' ?>" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" value="<?= $oneShop['address'] ?? '' ?>" name="address" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </body>
</html>