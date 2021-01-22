<?php
include_once  __DIR__ . "/../header.php"
?>


<div>
    <a class="btn btn-warning" href="http://localhost/php/Shop(stream13)/backend/index.php?model=product&action=create"> Добавить товар</a>
</div>

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
                <a href="http://localhost/php/Shop(stream13)/backend/index.php?model=product&action=delete&id=<?= $product["id"] ?>" class="btn btn-danger">Delete</a>
                <a href="http://localhost/php/Shop(stream13)/backend/index.php?model=product&action=update&id=<?= $product["id"] ?>" class="btn btn-warning">Update</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
include_once  __DIR__ . "/../footer.php"
?>