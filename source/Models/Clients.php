<?php


namespace Source\Models;

use Source\Core\Model;

class Clients extends Model
{
    public function __construct()
    {
        parent::__construct("clients", ["id"], ["fullname", "email", "telefone"]);
    }
}