<?php


namespace Source\Models;


use Source\Core\Model;

class Order extends Model
{
    public function __construct()
    {
        parent::__construct("orders", ["id"], ["client_origem", "client_dest"]);
    }
}