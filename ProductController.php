<?php

include_once __DIR__ . "/Interface/ControllerInterface.php";
include_once __DIR__ . "/../Model/Product.php";
//include_once __DIR__ . "/../Service/FileUploader.php";

class ProductController implements ControllerInterface
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect("localhost", "shop_user", "shop_password", "db_shop");
    }

    public function save()
    {
        if (!empty($_POST)) {
            if (!empty($_FILES['picture']['tmp_name'])) {
                $fileName = md5(rand(10000, 99999) . microtime()) . $_FILES["picture"]["name"];
                copy($_FILES["picture"]["tmp_name"], __DIR__ . '/../../../uploads/'
                    . $fileName);
            }

            $id = intval($_POST["id"]);
            $title = htmlspecialchars($_POST["title"]);

            if (strlen($title) > 256) {
                die('Lenght of title incorrect');
            }

            $preview = htmlspecialchars($_POST["preview"]);
            $picture = htmlspecialchars($fileName ?? '');
            $content = htmlspecialchars($_POST["content"]);
            $price = $_POST["price"];
            $status = $_POST["status"];
            $created = date("Y-m-d H:i:s", time());
            $updated = date("Y-m-d H:i:s", time());

            $product = new Product($id, $title, $picture, $preview, $content, $price, $status, $created, $updated);
            $product->save();
        }
        return $this->read();
    }

    public function create()
    {
        $oneProduct = [];
        include_once __DIR__ . "/../../views/product/form.php";
    }

    public function read()
    {
        $result = mysqli_query($this->conn, "select * from products order by id desc ");
        $allProducts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        include_once __DIR__ . "/../../views/product/all.php";

    }

    public function update()
    {
        $id = (int)$_GET["id"];

        if (empty($id)) die('Undefined ID');

        $result = mysqli_query($this->conn, "select * from products where id = $id limit 1");
        $oneProduct = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $oneProduct = reset($oneProduct);

        if (empty($oneProduct)) die('Product not found');

        include_once __DIR__ . "/../../views/product/form.php";
    }

    public function delete()
    {

        $id = (int)$_GET["id"];

        mysqli_query($this->conn, "delete from products where id = $id limit 1");
        return $this->read();
    }
}