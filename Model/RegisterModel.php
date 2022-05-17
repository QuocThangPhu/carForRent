<?php

namespace Thangphu\UnLock\Model;

use Thangphu\UnLock\core\Model;

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
