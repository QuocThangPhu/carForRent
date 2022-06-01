<?php

namespace Thangphu\CarForRent\varlidator;

class Validator
{
    public string $name;
    public $value;
    public array $patterns = array(
        'uri' => '[A-Za-z0-9-\/_?&=]+',
        'url' => '[A-Za-z0-9-:.\/_?&=#]+',
        'alpha' => '[\p{L}]+',
        'words' => '[\p{L}\s]+',
        'alphanum' => '[\p{L}0-9]+',
        'int' => '[0-9]+',
        'float' => '[0-9\.,]+',
        'tel' => '[0-9+\s()-]+',
        'text' => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
        'file' => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
        'folder' => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
        'address' => '[\p{L}0-9\s.,()°-]+',
        'date_dmy' => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
        'date_ymd' => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
        'email' => '[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]'
    );
    public array $errors = array();

    public function name($name): static
    {
        $this->name = $name;
        return $this;
    }

    public function value($value): static
    {
        $this->value = $value;
        return $this;
    }

    public function pattern($name): static
    {
        if ($name == 'array') {
            if (!is_array($this->value)) {
                $this->errors[$this->name] = 'Field format ' . $this->name . ' invalid.';
            }
        } else {
            $regex = '/^(' . $this->patterns[$name] . ')$/u';
            if ($this->value != '' && !preg_match($regex, $this->value)) {
                $this->errors[$this->name] = 'Field format ' . $this->name . ' invalid.';
            }
        }
        return $this;
    }

    public function customPattern($pattern): static
    {
        $regex = '/^(' . $pattern . ')$/u';
        if ($this->value != '' && !preg_match($regex, $this->value)) {
            $this->errors[$this->name] = 'Field format ' . $this->name . ' invailid.';
        }
        return $this;
    }

    public function required(): static
    {
        if ((isset($this->file) && $this->file['error'] == 4) || ($this->value == '' || $this->value == null)) {
            $this->errors[$this->name] = 'Field value ' . $this->name . ' is required.';
        }
        return $this;
    }

    public function min($length): static
    {
        if (is_string($this->value)) {
            if (strlen($this->value) < $length) {
                $this->errors[$this->name] = 'Field value ' . $this->name . ' less than the minimum value';
            }
        } else {
            if ($this->value < $length) {
                $this->errors[$this->name] = 'Field value ' . $this->name . ' less than the minimum value';
            }
        }
        return $this;
    }

    public function max($length): static
    {
        if (is_string($this->value)) {
            if (strlen($this->value) > $length) {
                $this->errors[$this->name] = 'Field value' . $this->name . ' higher than the maximum value';
            }
        } else {
            if ($this->value > $length) {
                $this->errors[$this->name] = 'Field value ' . $this->name . ' higher than the maximum value';
            }
        }
        return $this;
    }

    public function purify($string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    public function maxSize($size): static
    {
        if ($this->file['error'] != 4 && $this->file['size'] > $size) {
            $this->errors[$this->name] = 'The file ' . $this->name . ' exceeds the maximum size of ' . number_format(
                    $size / 1048576,
                    2
                ) . ' MB.';
        }
        return $this;
    }

    public  function is_int(): static
    {
        if(is_numeric($this->value)) return $this;
        $this->errors[$this->name] = 'Field value ' . $this->name . ' must be integer';
        return $this;
    }

    public function equal($value): static
    {
        if ($this->value != $value) {
            $this->errors[$this->name] = 'Field value ' . $this->name . ' not match.';
        }
        return $this;
    }

    public function getErrors()
    {
        if (!$this->isSuccess()) {
            return $this->errors;
        }
    }


    public function isSuccess(): bool
    {
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }
}