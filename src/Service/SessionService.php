<?php

namespace Thangphu\CarForRent\Service;

class SessionService
{
    public static string $userID = 'user_id';

    public static function getUserId()
    {
        if (isset($_SESSION[self::$userID])) {
            return $_SESSION[self::$userID];
        }
        return null;
    }

    public static function setUserId(int $userID)
    {
        $_SESSION[self::$userID] = $userID;
    }

    public static function destroyUser()
    {
        unset($_SESSION[self::$userID]);
    }

    public static function login()
    {
        return self::getUserId() != null;
    }
}
