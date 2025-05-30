<?php

namespace app\middlewares;

class AuthenMiddleware
{
    public function show()
    {
        echo "Authentication middleware is running. Access granted.";
        echo "<br>";
        return true;
    }

    public function show2()
    {
        // Additional authentication logic can be added here
        echo "Additional authentication checks passed.";
        echo "<br>";

        return true;
    }
}