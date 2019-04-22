<?php
namespace validation\result;

interface Result
{
    public function isValid(): bool;
}