<?php

namespace app\models;

use app\core\db;

class DashboardModel
{

    public function __construct()
    {
        db::connect();
        // Initialize the model if needed
    }
}
