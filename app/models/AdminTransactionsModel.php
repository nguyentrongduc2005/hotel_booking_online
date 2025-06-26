<?php

namespace app\models;

use app\core\db;

class AdminTransactionsModel
{

    public function __construct()
    {
        db::connect();
        // Initialize the model if needed
    }
}
