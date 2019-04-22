<?php
namespace validation\result;

final class Success implements Result
{
    public function isValid(): bool
    {
         return true;
    }
}