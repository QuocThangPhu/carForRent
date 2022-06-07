<?php

namespace Thangphu\CarForRent\varlidator;

abstract class FileValidator extends Validator
{
    const MAXSIZE = 10 * 1024 * 1024;
    protected $file;

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): self
    {
        $this->file = $file;
        return $this;
    }

    public function required(): self
    {
        if (!isset($this->file) || $this->file["error"] != 0) {
            $this->errors[$this->name] = "File upload does not exist.";
        }
        return $this;
    }

    public function checkSize(int $size): self
    {
        if (!empty($this->errors[$this->name])) {
            return $this;
        }
        if ($this->file['size'] > static::MAXSIZE) {
            $this->errors[$this->name] = "File size is larger than $size MB.";
        }
        return $this;
    }
}