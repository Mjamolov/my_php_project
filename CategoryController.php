<?php

include_once __DIR__ . "/Interface/ControllerInterface.php";

class CategoryController implements ControllerInterface
{
    public function read()
    {
        print "READ CATEGORY!!!";
    }

    public function create()
    {
        print "CREATE CATEGORY!!!";
    }

    public function update()
    {
        print "UPDATE CATEGORY!!!";
    }

    public function delete()
    {
        print "DELETE CATEGORY!!!";
    }
}