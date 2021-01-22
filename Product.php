<?php


class Product
{
    public $id;
    public $title;
    public $picture;
    public $preview;
    public $content;
    public $price;
    public $status;
    public $created;
    public $updated;

    private $conn;

    public function __construct($id, $title, $picture, $preview, $content, $price, $status, $created, $updated)
    {
        $this->conn = mysqli_connect("localhost", "shop_user", "shop_password", "db_shop");

        $this->id = $id;
        $this->title = $title;
        $this->picture = $picture;
        $this->preview = $preview;
        $this->content = $content;
        $this->price = $price;
        $this->status = $status;
        $this->created = $created;
        $this->updated = $updated;
    }

    public function save()
    {
        if ($this->id > 0) {
            $query = "UPDATE products set
                title='" . $this->title . "',  " .
                ((!empty($this->picture)) ? "picture='" . $this->picture . "', " : "")
                . " preview='" . $this->preview . "',
                price='" . $this->price . "', 
                status='" . $this->status . "', 
                content='" . $this->created . "', 
                updated='" . $this->updated . "' 
                where id = " . $this->id . " limit 1";
        } else {
            $query = "INSERT INTO products VALUES (
                null, 
                '" . $this->title . "',
                '" . $this->picture . "', 
                '" . $this->preview . "',  
                '" . $this->content . "', 
                '" . $this->price . "', 
                '" . $this->status . "', 
                '" . $this->created . "', 
                '" . $this->updated . "'
                )";
        }
        $result = mysqli_query($this->conn, $query);
    }
}