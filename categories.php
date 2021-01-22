<?php
$conn = mysqli_connect("localhost", "shop_user", "shop_password", "db_shop");

if (isset($_GET["delete"])) {
    $id = (int)$_GET["delete"];

    mysqli_query($conn, "delete from categories where id = $id limit 1");
}

if (isset($_GET["update"])) {
    $id = (int)$_GET["update"];

    $result = mysqli_query($conn, "select * from categories where id = $id limit 1");
    $oneCategory = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $oneCategory = reset($oneCategory);
}

if (!empty($_POST)) {
    $id = intval($_POST["id"]);
    $title = htmlspecialchars($_POST["title"]);
    $group_id = $_POST["group_id"];
    $parent_id = $_POST["parent_id"];

    if ($id > 0) {
        $query = "UPDATE categories set title='$title', group_id='$group_id', parent_id='$parent_id' where id = $id limit 1";
    } else {
        $query = "INSERT INTO categories VALUES (null, '$title','$group_id', '$parent_id')";
    }

    $result = mysqli_query($conn, $query);
}

$result = mysqli_query($conn, "select * from categories order by id desc ");
$allCategories = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
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
    </style>
</head>
<body>
<div id="categories">
    <table class="table">
        <thead>
        <th>ID</th>
        <th>Title</th>
        <th>Group id</th>
        <th>Parent id</th>
        </thead>
        <tbody>
        <?php foreach ($allCategories as $category) : ?>
            <tr>
                <td><?= $category["id"] ?></td>
                <td><?= $category["title"] ?></td>
                <td><?= $category["group_id"] ?></td>
                <td><?= $category["parent_id"] ?></td>
                <td style="width: 200px">
                    <a href="?delete=<?= $category["id"] ?>" class="btn btn-danger">Delete</a>
                    <a href="?update=<?= $category["id"] ?>"" class="btn btn-warning">Update</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <h1>
        Create Categories
    </h1>
    <div>
        <form action="categories.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $oneCategory['id'] ?? '' ?>"/>
            <div class="form-group">
                <label>Title</label>
                <input type="text" value="<?= $oneCategory['title'] ?? '' ?>" name="title" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Group id</label>
                <input type="number" value="<?= $oneCategory['group_id'] ?? '' ?>" name="group_id" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Parent id</label>
                <input type="number" value="<?= $oneCategory['parent_id'] ?? '' ?>" name="parent_id" class="form-control"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
</body>
</html>