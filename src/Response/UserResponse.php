<?php

namespace Thangphu\CarForRent\Response;

use Firebase\JWT\JWT;

class UserResponse
{
    /**
     * @param $userModel
     * @return array
     */
    public function userResponse($userModel): array
    {
        return [
            'id' => $userModel->getId(),
            'username' => $userModel->getUsername(),
        ];
    }
}
