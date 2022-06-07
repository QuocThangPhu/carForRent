<?php

namespace Thangphu\CarForRent\Service;

use Thangphu\CarForRent\Service\Contracts\SessionServiceInterface;

class SessionService implements SessionServiceInterface
{
    const ID = 'user_id';
    const NAME = 'username';


    public function getUserId(): ?int
    {
        // TODO: Implement getUserId() method.
    }

    public function setUserId(int $userId): bool
    {
        // TODO: Implement setUserId() method.
    }

    public function destroyUser(): bool
    {
        // TODO: Implement destroyUser() method.
    }

    public function isLogin(): bool
    {
        // TODO: Implement isLogin() method.
    }
}