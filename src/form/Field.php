<?php

namespace Thangphu\CarForRent\form;

use Thangphu\CarForRent\bootstrap\Validation;

class Field
{
    public Validation $model;
    public string $attribute;

    public function __construct(Validation $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return '1';
    }
}
