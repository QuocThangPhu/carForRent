<?php

namespace Thangphu\CarForRent\Model;

use Thangphu\CarForRent\bootstrap\Model;

class RegisterModel extends Model
{
    public string $name;
    public string $username;
    public string $password;

    public function register()
    {
        echo "Creating new user";
    }
}
