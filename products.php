<?php
$conn = mysqli_connect("localhost", "shop_user", "shop_password", "db_shop");

if (isset($_GET["delete"])) {
    $id = (int)$_GET["delete"];

    mysqli_query($conn, "delete from products where id = $id limit 1");
}

if (isset($_GET["update"])) {
    $id = (int)$_GET["update"];
    $result = mysqli_query($conn, "select * from products where id = $id limit 1");
    $oneProduct = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $oneProduct = reset($oneProduct);
}

if (!empty($_POST)) {
    if (!empty($_FILES['picture']['tmp_name'])) {
        $fileName = md5(rand(10000, 99999) . microtime()) . $_FILES["picture"]["name"];
        copy($_FILES["picture"]["tmp_name"], __DIR__ . '/../../uploads/' . $fileName);
    }

    $id = intval($_POST["id"]);
    $title = htmlspecialchars($_POST["title"]);
    $preview = htmlspecialchars($_POST["preview"]);
    $picture = htmlspecialchars($fileName ?? '');
    $content = htmlspecialchars($_POST["content"]);
    $price = $_POST["price"];
    $status = $_POST["status"];
    $created = date("Y-m-d H:i:s", time());
    $updated = date("Y-m-d H:i:s", time());

    if ($id > 0) {
        $query = "UPDATE products set title='$title',preview='$preview',  price='$price', status='$status', content='$content', updated='$updated' where id = $id limit 1";
    } else {
        $query = "INSERT INTO products VALUES (null, '$title','$picture', '$preview',  '$price', '$status', '$content', '$created', '$updated')";
    }

    $result = mysqli_query($conn, $query);
}

$result = mysqli_query($conn, "select * from products order by id desc ");
$allProducts = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
    <style>
        form {
            width: 500px;
            margin: 20px auto;
        }

        h1 {
            text-align: center;
        }

        img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
<div id="products">
    <table class="table">
        <thead>
        <th>ID</th>
        <th>Picture</th>
        <th>Title</th>
        <th>Preview</th>
        <th>Price</th>
        <th>Status</th>
        <th>Content</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Actions</th>
        </thead>
        <tbody>
        <?php foreach ($allProducts as $product) : ?>
            <tr>
                <td><?= $product["id"] ?></td>
                <td><img width="100" src="/php/Shop(stream13)/uploads/<?= $product["picture"] ?>"></td>
                <td><?= $product["title"] ?></td>
                <td><?= $product["preview"] ?></td>
                <td><?= $product["price"] ?></td>
                <td><?= $product["status"] ?></td>
                <td><?= $product["content"] ?></td>
                <td><?= $product["created"] ?></td>
                <td><?= $product["updated"] ?></td>
                <td style="width: 200px">
                    <a href="?delete=<?= $product["id"] ?>" class="btn btn-danger">Delete</a>
                    <a href="?update=<?= $product["id"] ?>" class="btn btn-warning">Update</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<h1>Create Products</h1>
<div>
    <form action="products.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $oneProduct['id'] ?? '' ?>"/>
        <div class="form-group">
            <label>Title</label>
            <input type="text" value="<?= $oneProduct['title'] ?? '' ?>" name="title" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Picture</label>
            <input type="file" name="picture" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Preview</label>
            <input type="text" value="<?= $oneProduct['preview'] ?? '' ?>" name="preview" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input name="price" value="<?= $oneProduct['price'] ?? '' ?>" type="number" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Status</label>
            <input name="status" value="<?= $oneProduct['status'] ?? '' ?>" type="number" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea rows="7" name="content" class="form-control"> <?= $oneProduct['content'] ?? '' ?> </textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-success">
        </div>
    </form>
</div>
</body>
</html>
