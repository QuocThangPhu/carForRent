<?php

namespace Thangphu\CarForRent\form;

use Thangphu\CarForRent\bootstrap\Model;

class Field
{
    public Model $model;
    public string $attribute;

    public function __construct( Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return '1';
    }
}
