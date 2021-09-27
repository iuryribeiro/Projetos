<?php


namespace Source\Models;


use Source\Core\Model;

class OrderItem extends Model
{
    public function __construct()
    {
        parent::__construct("order_items", ["id"], ["order_id"]);
    }

    public function save(): bool
    {
        $this->create($this->safe());
        return true;
    }
}