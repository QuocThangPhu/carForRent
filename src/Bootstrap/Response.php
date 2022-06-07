<?php

namespace Thangphu\CarForRent\Bootstrap;

use Thangphu\CarForRent\Model\UserModel;

class Response extends \Thangphu\CarForRent\Request\LoginRequest
{
    const HTTP_OK = 200;
    const HTTP_NOT_FOUND = 404;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_INTERNAL_SERVER_ERROR = 500;

    protected ?string $template = null;
    protected int $statusCode;
    protected ?string $redirectUrl = null;
    protected ?array $data = null;
    protected UserModel $user;

    public function getTemplate()
    {
        return $this->template;
    }


    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @param int $code
     * @return void
     */
    public function setStatusCode($statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param array|null $data
     */
    public function setData(?array $data): void
    {
        $this->data = $data;
    }

    public function renderView($template, array $data = null)
    {
        $this->setTemplate($template);
        if ($data != null) {
            $this->setData([...$data]);
        } else {
            $this->setData(null);
        }
        return $this;
    }

    public function redirect(string $url)
    {
        $this->setRedirectUrl($url);
        return $this;
    }

    /**
     * @return UserModel
     */
    public function getUser(): UserModel
    {
        return $this->user;
    }

    /**
     * @param UserModel $user
     */
    public function setUser(UserModel $user): void
    {
        $this->user = $user;
    }

    public function toJson(array $data, int $statusCode = self::HTTP_OK)
    {
        $this->setStatusCode($statusCode);
        $this->setData([...$data]);
        return $this;
    }
}
